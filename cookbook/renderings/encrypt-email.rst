.. _rst_cookbook_rendering_encrypt-email:

Rendering: E-Mail-Ausgabe verschlüsseln
=======================================

.. note:: Die Verschlüsselung von E-Mails für die Ausgabe als HTML5 ist inzwischen
   automatisch im Rendering der Texte enthalten - siehe `Github <https://github.com/MetaModels/core/issues/1233>`_ 

In Contao eingegebene E-Mails werden im Quelltext verschlüsselt ausgegeben, um das automatische
Abgreifen von E-Mail-Adressen zu erschweren.

MetaModels hat kein spezielles "E-Mail-Attribut" für diese Option - die Funktion ist aber mit
einem angepassten Template für ein Attribut "Text" schnell nachgerüstet.

Es muss lediglich ein spezielles Template für das Rendering angelegt und aktiviert werden. Dazu
die folgenden Schritte abarbeiten:

* im BE unter "Templates" ein Template "mm_attr_text.html5" anlegen
* das Template umbenennen in "mm_attr_text_email.html5"
* in das neue Template den Quelltext |br|
  ``<span class="text<?= $this->additional_class ?>">{{email::<?= $this->raw ?>}}</span>``
* in den Render-Einstellungen des entsprechenden Textattibutes das neue Template "mm_attr_text_email" auswählen

|img_encrypt-email|


.. |br| raw:: html

   <br />

.. |img_encrypt-email| image:: /_img/screenshots/cookbook/renderings/encrypt-email.jpg

