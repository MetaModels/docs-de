.. _rst_cookbook_panels_manipulate-schema:

Anpassung des Schema für Attribute
==================================

.. note:: Der Schemamanager ist ab Version 2.3 implementiert.

Die Datenbankeigenschaften für Attribute werden über den Schemamanager manipuliert - mehr dazu beim
:ref:`component_schema-manager` - und nicht über eine Anpassung des DCA. Geprüft und ausgeführt werden die Änderungen
beim Ablauf der DB-Migration - diese kann über den Contao-Manager oder über die Konsole angestoßen werden.

Im folgenden Beispiel wird das Feld des Attributes Langtext `vita` im Model `mm_employees` von `TEXT` (65535)
auf `MEDIUMTEXT` (16777215) geändert - siehe
`Doctrine <https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#mapping-matrix>`_ und
`Github <https://github.com/doctrine/dbal/blob/369ab24fc865939ff451c5214742cebac052f2f1/src/Platforms/AbstractMySQLPlatform.php#L40-L46>`_.

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/SchemaManagerListener.php
   namespace App\EventListener;

   use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;
   use MetaModels\Information\MetaModelCollectionInterface;
   use MetaModels\Schema\Doctrine\DoctrineSchemaGeneratorInterface;
   use MetaModels\Schema\Doctrine\DoctrineSchemaInformation;

   final class SchemaManagerListener implements DoctrineSchemaGeneratorInterface
   {
       public function generate(DoctrineSchemaInformation $schema, MetaModelCollectionInterface $collection): void
       {
           if (!$schema->getSchema()->hasTable('mm_employees')) {
               return;
           }

           $table = $schema->getSchema()->getTable('mm_employees');

           $table->getColumn('vita')->setLength(AbstractMySQLPlatform::LENGTH_LIMIT_MEDIUMTEXT);
       }
   }

.. code-block:: yml
   :linenos:

   # config/services.yml
   services:
     App\EventListener\SchemaManagerListener:
       tags:
         - { name: 'metamodels.schema-generator.doctrine', priority: -20 }

.. |br| raw:: html

   <br />
