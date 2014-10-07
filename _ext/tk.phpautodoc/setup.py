# -*- coding: utf-8 -*-
from setuptools import setup, find_packages
import os, sys
import pkg_resources


setup(
     name='tk.phpautodoc',
     version='1.2.1',
     description='sample implementation of phpdocumentor using sphinx',
     long_description=open('README.txt').read(),
     author='Takeshi Komiya',
     author_email='i.tkomiya at gmail.com',
     url='https://bitbucket.org/tk0miya/tk.phpautodoc',
     license='Apache License 2.0',
     py_modules=['sphinxcontrib_phpautodoc'],
     packages=find_packages('src'),
     package_dir={'': 'src'},
     include_package_data=True,
     install_requires=(
         'Sphinx',
         'ply',
         'sphinxcontrib-phpdomain',
     ),
     extras_require=dict(
         test=[
             'mock'
         ]
     ),
)
