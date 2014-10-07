# -*- coding: utf-8 -*-
"""
    sphinxcontrib_phpautodoc
    ~~~~~~~~~~~~~~~~~~~~~~~~~

    :copyright: Copyright 2013 by Takeshi KOMIYA
    :license: Apache 2.0, see LICENSE for details.
"""
import os
import re
import codecs
import pickle
from phply import phpast as ast
from phply.phplex import lexer
from phply.phpparse import parser
from docutils import nodes
from docutils.parsers import rst
from docutils.parsers.rst import Directive
from docutils.statemachine import ViewList


def is_comment(node):
    if isinstance(node, ast.Comment) and node.text[0:3] == '/**':
        return True
    else:
        return False


def is_private_comment(comment):
    if is_comment(comment):
        return re.search('@access\s+private', comment.text)
    else:
        return False


def comment2lines(node):
    comments = []
    for line in node.text.splitlines():
        if re.match('^\s*/?\*{1,2} ?', line):  # starts with '/**' or '/*' or '*' ?
            line = re.sub('\s*\*/.*$', '', line)  # remove '*/' of tail
            line = re.sub('^\s*/?\*{1,2} ?', '', line)  # remove '/**' or '/*' or '*' of top

            comments.append(line)

    return "\n".join(comments).strip().splitlines()


def to_s(node):
    if isinstance(node, ast.Constant):
        ret = node.name
    elif isinstance(node, ast.Array):
        elems = (to_s(n) for n in node.nodes)
        ret = "array(%s)" % ", ".join(elems)
    elif isinstance(node, ast.FormalParameter):
        ret = ""
        if node.type:
            ret += "%s " % to_s(node.type)
        if node.is_ref:
            ret += "&"

        ret += "%s" % node.name

        if node.default:
            ret += ' = %s' % to_s(node.default)
    elif isinstance(node, (ast.Function, ast.Method)):
        if node.params is None:
            ret = node.name
        else:
            params = (to_s(p) for p in node.params)
            ret = "%s(%s)" % (node.name, ", ".join(params))
    else:
        ret = str(node)

    return ret


def is_same_mtime(path1, path2):
    try:
        mtime1 = os.stat(path1).st_mtime
        mtime2 = os.stat(path2).st_mtime

        return mtime1 == mtime2
    except:
        return False


def basename(path, ext=None):
    filename = os.path.basename(path)
    if ext:
        basename, _ext = os.path.splitext(filename)
        filename = "%s.%s" % (basename, ext)

    return filename


class AutodocCache(object):
    def parse_code(self, filename):
        basedir = self.state.document.settings.env.doctreedir
        cachename = os.path.join(basedir, basename(filename, 'parse'))
        if is_same_mtime(filename, cachename):
            tree = pickle.load(open(cachename, 'rb'))
        else:
            try:
                with codecs.open(filename, 'r', 'utf-8') as f:
                    tree = parser.parse(f.read(), lexer=lexer.clone())

                with open(cachename, 'wb') as f:
                    pickle.dump(tree, f)
                mtime = os.stat(filename).st_mtime
                os.utime(cachename, (mtime, mtime))
            except:
                raise

        return tree


class PHPDocWriter(Directive):
    option_spec = {
        'undoc-members': rst.directives.flag,
    }

    def run(self):
        self.result = ViewList()
        self.indent = u''

    def add_line(self, line, indent_level=0):
        if line:
            indent = self.indent + u'   ' * indent_level
            self.result.append(indent + line, '<phpautodoc>')
        else:
            self.result.append('', '<phpautodoc>')

    def add_directive_header(self, directive, name, indent_level):
        domain = getattr(self, 'domain', 'php')
        self.add_line(u'.. %s:%s:: %s' % (domain, directive, name), indent_level)
        self.add_line('')

    def add_directive(self, directive, name, comment_node, indent_level=0, force=False):
        if is_private_comment(comment_node):
            if force is True:
                self.add_directive_header(directive, name, indent_level)
        elif is_comment(comment_node) or 'undoc-members' in self.options or force is True:
            self.add_directive_header(directive, name, indent_level)

            if is_comment(comment_node):
                for line in comment2lines(comment_node):
                    self.add_line(line, indent_level + 1)
                self.add_line('')


class PHPAutodocDirectiveBase(PHPDocWriter, AutodocCache):
    directive_name = "phpautodoc"

    option_spec = {
        'filename': rst.directives.unchanged,
        'members': rst.directives.flag,
        'undoc-members': rst.directives.flag,
    }

    def run(self):
        super(PHPAutodocDirectiveBase, self).run()

        if 'filename' not in self.options:
            msg = '%s requires :filename: option' % self.directive_name
            return [self.state.document.reporter.warning(msg, line=self.lineno)]

        srcdir = self.state.document.settings.env.srcdir
        filename = os.path.join(srcdir, self.options['filename'])
        if not os.path.exists(filename):
            msg = '%s cannot read source code: %s' % (self.directive_name, self.options['filename'])
            return [self.state.document.reporter.warning(msg, line=self.lineno)]

        try:
            tree = self.parse_code(filename)
            self.traverse(tree)
            self.state.document.settings.env.note_dependency(filename)

            if self.content:
                for line in self.content:
                    self.add_line(line, 1)

                self.add_line('')

            self.add_line('')

            node = nodes.paragraph()
            node.document = self.state.document
            self.state.nested_parse(self.result, 0, node)

            return node.children
        except SyntaxError as exc:
            msg = 'phpautodoc parse error [%s]: %s' % (filename, exc)
            return [self.state_machine.reporter.warning(msg, line=self.lineno)]

    def traverse(self, tree, indent=0):
        pass

    def traverse_all(self, tree, indent=0):
        last_node = None
        for node in tree:
            if isinstance(node, ast.Function):
                self.add_directive('function', to_s(node), last_node, indent)
            elif isinstance(node, ast.Class):
                if is_private_comment(last_node):
                    pass
                else:
                    self.add_directive('class', node.name, last_node, indent)

                    if 'members' in self.options:
                        self.traverse_all(node.nodes, indent + 1)
            elif isinstance(node, ast.Interface):
                if is_private_comment(last_node):
                    pass
                else:
                    self.add_directive('interface', node.name, last_node, indent)

                    if 'members' in self.options:
                        self.traverse_all(node.nodes, indent + 1)
            elif isinstance(node, ast.Method):
                if 'protected' in node.modifiers or 'private' in node.modifiers:
                    pass
                else:
                    self.add_directive('method', to_s(node), last_node, indent)
            elif isinstance(node, ast.ClassVariables):
                if 'protected' in node.modifiers or 'private' in node.modifiers:
                    pass
                else:
                    for variable in node.nodes:
                        self.add_directive('attr', variable.name, last_node, indent)

            last_node = node


class PHPAutoModuleDirective(PHPAutodocDirectiveBase):
    directive_name = "phpautomodule"

    def traverse(self, tree, indent=0):
        self.traverse_all(tree, indent)


class PHPAutoClassDirective(PHPAutodocDirectiveBase):
    has_content = True
    required_arguments = 1
    directive_name = "phpautoclass"

    def run(self):
        self.targets = [t.strip() for t in self.arguments[0].split(',')]
        return super(PHPAutoClassDirective, self).run()

    def traverse(self, tree, indent=0):
        last_node = None
        for node in tree:
            if isinstance(node, ast.Class) and node.name in self.targets:
                self.add_directive('class', node.name, last_node, indent, force=True)

                if 'members' in self.options:
                    self.traverse_all(node.nodes, indent + 1)
            elif isinstance(node, ast.Interface) and node.name in self.targets:
                self.add_directive('interface', node.name, last_node, indent, force=True)

                if 'members' in self.options:
                    self.traverse_all(node.nodes, indent + 1)

            last_node = node


class PHPAutoFunctionDirective(PHPAutodocDirectiveBase):
    has_content = True
    required_arguments = 1
    directive_name = "phpautofunction"

    option_spec = {
        'filename': rst.directives.unchanged,
    }

    def run(self):
        self.targets = [t.strip() for t in self.arguments[0].split(',')]
        return super(PHPAutoFunctionDirective, self).run()

    def traverse(self, tree, indent=0):
        last_node = None
        for node in tree:
            if isinstance(node, ast.Function) and node.name in self.targets:
                self.add_directive('function', to_s(node), last_node, indent, force=True)
                break

            last_node = node


def setup(app):
    classes = [PHPAutoModuleDirective,
               PHPAutoClassDirective,
               PHPAutoFunctionDirective]
    for cls in classes:
        app.add_directive(cls.directive_name, cls)
