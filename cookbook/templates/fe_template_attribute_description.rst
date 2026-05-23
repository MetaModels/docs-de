.. _rst_cookbook_templates_attribute_description.rst:

Ausgabe der Attributs-Beschreibung im Template
==============================================

Im Listentemplate steht über den Knoten ``attributes`` der Name bzw. die Bezeichnung eines Attributs zur Verfügung.

Möchte man aber zusätzlich auch einen Zugriff auf die Beschreibung aus den Attributseinstellungen haben, so kann man
folgende Anpassung im Template ``metamodels_prerendered.html5`` vornehmen:

.. code-block:: php
   :linenos:

   <?php

   /**
    * Add description.
    */

   use Contao\System;
   use MetaModels\IMetaModel;

   /** @var IMetaModel $model */
   $model      = $this->items->getItem()->getMetaModel();
   $attributes = $model->getAttributes();

   $attributeDescriptions = [];
   foreach ($attributes as $attribute) {
       if (empty($attribute->getColName())) {
           continue;
       }
       $attributeDescriptions[$attribute->getColName()] = $attribute->get('description');
   }

   // Debug.
   if (System::getContainer()->get('kernel')->isDebug()) {
       dump($this->data);
   }
   ?>
   <?php if (\count($this->data)): ?>
       <div class="layout_full">
   // ....

Zur Erklärung: mit $this->items->getItem() holen wir uns ein Item - da die Attributsangaben immer gleich bleiben,
reicht ein Item um das MetaModel abzufragen und darüber dessen Attribute. Das ``foreach`` ist nur zur leichteren
Handhabung im weiteren Template. Das Ganze könnte man auch schöner in einen Helper auslagern -
`siehe Vortrag CK23 <https://www.e-spin.de/contao-metamodels/metamodels-vortrag-contao-konferenz-2023.html>`_

In der weiteren Ausgabe kann man die Beschreibung über den Spaltennamen des Attributs ausgeben - |br|
z. B. ``<?= $attributeDescriptions['firstname'] ?? '' ?>``

Bei mehrsprachigen Models wird die zur FE-Sprache passende Beschreibung ausgegeben.


.. |br| raw:: html

   <br />
