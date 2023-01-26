# -*- coding: utf-8 -*-
#
# MetaModels documentation build configuration file.
#
# This file is execfile()d with the current directory set to its
# containing dir.

import sys
import os
import sphinx_rtd_theme
from datetime import date

#sys.path.append(os.path.abspath('_ext/phpdomain'))
#sys.path.append(os.path.abspath('_ext/tk.phpautodoc/src'))

# -- General configuration ------------------------------------------------

extensions = [
    'sphinx.ext.intersphinx',
    #'sphinxcontrib-phpdomain',
    #'sphinxcontrib_phpautodoc',
]

templates_path = ['_templates']
source_suffix = '.rst'
master_doc = 'index'
project = u'MetaModels'
#copyright = u'{:d}, <a href="https://now.metamodel.me/de/ueber-uns/team" title="Team MetaModels" target="_blank">Team MetaModels</a>'.format(date.today().year)
copyright = u'{:d}, Team MetaModels'.format(date.today().year)
version = '2.3'
release = '2.3.0'
language = 'de'
exclude_patterns = ['_build', '_ext']
pygments_style = 'sphinx'

# -- Options for HTML output ----------------------------------------------

html_theme = 'sphinx_rtd_theme'
html_theme_path = ['_themes', ]
# html_static_path = []
html_use_modindex = False
htmlhelp_basename = 'MetaModelsdoc'
html_favicon = '_img/favicon.ico'
html_last_updated_fmt = '%d.%m.%Y'
html_show_sphinx = False
html_show_copyright = True
html_css_files = [
    'style.css',
]

# -- Options for LaTeX output ---------------------------------------------

latex_elements = {
  'papersize': 'a4paper',
  'pointsize': '10pt',
  'classoptions': ',openany,oneside',
  'babel' : '\\usepackage[german]{babel}',
}

latex_documents = [
  ('index', 'MetaModels.tex', u'MetaModels Documentation',
   u'Team MetaModels', 'manual'),
]

# -- Options for manual page output ---------------------------------------

man_pages = [
    ('index', 'metamodels', u'MetaModels Documentation',
     [u'Team MetaModels'], 1)
]

# -- Options for Texinfo output -------------------------------------------

texinfo_documents = [
  ('index', 'MetaModels', u'MetaModels Dokumentation',
   u'Team MetaModels', 'MetaModels', 'Online-Handbuch des Projektes.',
   'Miscellaneous'),
]

intersphinx_mapping = {
    'dcgeneral': ('http://contao-community-alliance.github.io/dc-general-docs/', None)
}
