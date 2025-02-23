.. _rst_cookbook_panels_manipulate-schema:

Anpassung des Schema für Attribute
==================================

.. note:: Der Schemamanager ist ab Version 2.3 implementiert.

Die Datenbankeigenschaften für Attribute werden über den Schemamanager manipuliert - mehr dazu beim
:ref:`component_schema-manager`. Geprüft und ausgeführt werden die Änderungen beim Ablauf der DB-Migration - diese
kann über den Contao-Manager oder über die Konsole angestoßen werden.

Im folgenden Beispiel wird das Feld des Attributes Langtext von `TEXT` (65535) auf `MEDIUMTEXT` (16777215) geändert - siehe
`Doctrine <https://www.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/types.html#mapping-matrix>`_.

.. code-block:: php
   :linenos:

   <?php
   // src/AppBundle/EventListener/SchemaManagerListener.php
   namespace AppBundle\EventListener;

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

           $table->getColumn('vita')->setLength(16777215);
       }
   }

.. code-block:: yml
   :linenos:

   # src/AppBundle/Resources/config/services.yml
   services:
     # SchemaManagerListener:
     AppBundle\EventListener\SchemaManagerListener:
       tags:
         - { name: 'metamodels.schema-generator.doctrine', priority: -20 }

.. |br| raw:: html

   <br />
