# -*- coding: utf-8 -*-
#
# MetaModels documentation build configuration file.
#
# This file is execfile()d with the current directory set to its
# containing dir.

import sys
import os

sys.path.append(os.path.abspath('_ext/phpdomain'))
sys.path.append(os.path.abspath('_ext/tk.phpautodoc/src'))

# -- General configuration ------------------------------------------------

extensions = [
    'sphinx.ext.intersphinx',
    'sphinxcontrib.phpdomain',
    'sphinxcontrib_phpautodoc',
]

templates_path = ['_templates']
source_suffix = '.rst'
master_doc = 'index'
project = u'MetaModels'
copyright = u'2015, Team MetaModels'
version = '2.0'
release = '2.0.0'
language = 'en'
exclude_patterns = ['_build', '_ext']
pygments_style = 'sphinx'

# -- Options for HTML output ----------------------------------------------

html_theme = 'default'
html_theme = "sphinx_rtd_theme"
html_theme_path = ["_themes", ]
html_static_path = ['_static']
html_use_modindex = False
htmlhelp_basename = 'MetaModelsdoc'

# -- Options for LaTeX output ---------------------------------------------

latex_elements = {
'papersize': 'a4paper',
'pointsize': '10pt',
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
  ('index', 'MetaModels', u'MetaModels Documentation',
   u'Team MetaModels', 'MetaModels', 'One line description of project.',
   'Miscellaneous'),
]

intersphinx_mapping = {
    'dcgeneral': ('http://contao-community-alliance.github.io/dc-general-docs/', None)
}
