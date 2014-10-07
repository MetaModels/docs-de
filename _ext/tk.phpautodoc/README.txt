tk.phpautodoc
=============

tk.phpautodoc is sphinx extension to embed PHPDocs to sphinx document.
It works like sphinx.ext.autodoc.

Setup
=====

Install this package and add 'sphinxcontrib_phpautodoc' to extensions list::

   # in conf.py
   extensions += ['sphinxcontrib.phpdomain', 'sphinxcontrib_phpautodoc']

That's all.

Directives
==========

phpautomodule

   phpautomodule works like automodule directive in sphinx.ext.autodoc.
   It parses .php file, and then pick up functions, classes and methods to your docs.

   ex::

      .. phpautomodule::
         :filename: path/to/source_code.php
         :members:
         :undoc-members:


phpautoclass

   phpautoclass works like autoclass directive in sphinx.ext.autodoc.
   It parses .php file, and then pick up classes and their members to your docs.

   ex::

      .. phpautoclass:: MyClass,MySubClass
         :filename: path/to/source_code.php
         :members:
         :undoc-members:


   If you do not specify any class-names, phpautoclass picks up all classes in .php file.

   ex::

      .. phpautoclass::
         :filename: path/to/source_code.php
         :members:
         :undoc-members:


phpautofunction

   phpautofunction works like autofunction directive in sphinx.ext.autodoc.
   It parses .php file, and then pick up functions to your docs.

   ex::

      .. phpautofunction:: my_function
         :filename: path/to/source_code.php


LICENSE
=======
Apache License 2.0
