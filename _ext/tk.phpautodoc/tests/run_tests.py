#!/usr/bin/env python

import os
import re
import sys
import shutil
import unittest
from cStringIO import StringIO
from mock import Mock, patch
from tempfile import mkdtemp
from docutils.parsers.rst import Parser
from docutils.frontend import OptionParser
from docutils.utils import new_document
from sphinx.application import Sphinx
from sphinx.config import Config
import sphinxcontrib_phpautodoc as phpautodoc

TESTDIR = os.path.dirname(__file__)


class FakeSphinx(Sphinx):
    def __init__(self):
        self.config = Config(None, None, {}, None)
        self.verbosity = 0


class TestPHPAutodoc(unittest.TestCase):
    def setUp(self):
        self.parser = Parser()
        self.settings = OptionParser().get_default_values()
        self.settings.tab_width = 8
        self.settings.pep_references = False
        self.settings.rfc_references = False
        self.settings.env = Mock(srcdir=os.path.dirname(__file__),
                                 doctreedir=mkdtemp())

        self.app = FakeSphinx()
        phpautodoc.setup(self.app)

    def tearDown(self):
        shutil.rmtree(self.settings.env.doctreedir)

    def test_syntax_error(self):
        try:
            orig_stderr = sys.stderr
            sys.stderr = StringIO()

            doc = new_document('<test>', self.settings)
            src = ".. phpautomodule::\n   :filename: inputs/syntax_error.php\n"
            self.parser.parse(src, doc)
        finally:
            sys.stderr = orig_stderr

    @classmethod
    def append(cls, name):
        @patch("sphinxcontrib_phpautodoc.ViewList")
        def testcase(self, ViewList):
            doc = new_document('<test>', self.settings)
            src = open(os.path.join(TESTDIR, 'inputs', name)).read()
            self.parser.parse(src, doc)

            results = "\n".join(args[0][0] for args in ViewList().append.call_args_list)
            expected = open(os.path.join(TESTDIR, 'outputs', name)).read()
            self.assertEqual(results, expected)

        funcname = "test_%s" % re.sub('[\.\-/]', '_', name, re.M)
        testcase.__name__ = funcname
        setattr(cls, funcname, testcase)


# setup testcases
for root, dirs, files in os.walk(os.path.join(TESTDIR, 'inputs')):
    dirname = re.sub('.*?inputs/?', '', root)
    for filename in files:
        if filename[-4:] == '.rst':
            path = os.path.join(dirname, filename)
            TestPHPAutodoc.append(path)


if __name__ == "__main__":
    suite = unittest.TestLoader().loadTestsFromTestCase(TestPHPAutodoc)
    unittest.TextTestRunner(verbosity=1).run(suite)
