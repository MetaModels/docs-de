How to install
--------------

via Composer
^^^^^^^^^^^^

MetaModels and all its dependencies are available through the great `composer extension <https://c-c-a.org/ueber-composer>`_

When your Contao Installation is composerized, you can simply installing metamodels by requiring following packages:

* `MetaModels/core <https://packagist.org/packages/MetaModels/core>`_ (~2.0)
* `MetaModels/bundle_all <https://packagist.org/packages/MetaModels/bundle_all>`_ (~1.0)

If you do not need all attributes & filters, feel free to just install the core and grab some filter and attributes of
your choice. (Or another `bundle <https://github.com/MetaModels?query=bundle>`_ of your choice).

We have prepared some of them to separate all the things into groups.

Example composer.json:

.. code-block:: javascript

    {
        "require": {
            "metamodels/core": "~2.0",
            "metamodels/bundle_all": "~1.0"
        }
    }

via Nightly build
^^^^^^^^^^^^^^^^^

Use the nightly package from our project website: `http://now.metamodel.me/ <http://now.metamodel.me/>`_
