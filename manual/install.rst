MetaModels installieren
-----------------------

via Composer
^^^^^^^^^^^^

MetaModels und alle seine Abhängigkeiten können mit der großartigen `Composer Erweiterung <https://c-c-a.org/ueber-composer>`_ geladen werden.

Wenn euer Contao Installation bereits mit der neuen Paketverwaltung Composer versehen ist, könnt ihr MetaModels
einfach installieren indem ihr folgende Pakete auswählt:

* `MetaModels/core <https://packagist.org/packages/MetaModels/core>`_ (~2.0)
* `MetaModels/bundle_all <https://packagist.org/packages/MetaModels/bundle_all>`_ (~1.0)

Solltet ihr nicht alle Attribute oder Filter brauchen, könnt ihr diese auch einzeln Installieren oder eins unseren anderen
`Pakete <https://github.com/MetaModels?query=bundle>`_ auswählen. Die Pakete sind in Gruppen zusammen gefasst und
sollten für jeden das richtige bieten.

Beispiel der composer.json:

.. code-block:: javascript

    {
        "require": {
            "metamodels/core": "~2.0",
            "metamodels/bundle_all": "~1.0"
        }
    }

via Nightly build
^^^^^^^^^^^^^^^^^

Alternativ könnt ihr auch die aktuelle MetaModels Version von unserer `Projektseite http://now.metamodel.me/ <http://now.metamodel.me/>`_ laden.

