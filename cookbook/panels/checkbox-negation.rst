.. _rst_cookbook_panels_checkbox-negation:

Ansichtsbedingung: Anzeige wenn Checkbox nicht gesetzt
======================================================

Möchte man eine Ansichtsbedingung erstellen bei welcher das entsprechende
Feld angezeigt wird, wenn eine Checkbox **nicht** gesetzt ist, so ist das
mit den einem Trigger auf den Wert der Checkbox "Inaktiv" nicht zu erreichen.

Grund dafür ist die zwischen MetaModels und Contao-Core unterschiedliche Behandlung
des Wertes für "unchecked" - In Contao-Core wird dafür statt einer Null (0) Nichts
'' gespeichert. Das wiederum kann aktuell von MetaModels bzw. dem DCG nicht
verarbeitet werden.

Das Problem kann mit einem kleinen Workaround umgangen werden, in dem die 
Sichtbarkeit auf "checked" getriggert wird aber die Prüfung mit einem NICHT (NOT)
invertiert wird. Dazu wird bei den Ansichtsbedingung zunächst eine Bedingung NICHT
angelegt und in diese die Prüfung der Checkbox auf "Aktiv" (siehe Screenshot).

|img_checkbox-negation_01|

In den folgenden zwei Screenshots sieht man das Ausblenden der E-Mail-Eingabemaske mit
gesetzter Checkbox.

E-Mail eingeblendet

|img_checkbox-negation_02|

E-Mail ausgeblendet

|img_checkbox-negation_03|

.. |img_checkbox-negation_01| image:: /_img/screenshots/cookbook/panels/checkbox-negation_01.jpg
.. |img_checkbox-negation_02| image:: /_img/screenshots/cookbook/panels/checkbox-negation_02.jpg
.. |img_checkbox-negation_03| image:: /_img/screenshots/cookbook/panels/checkbox-negation_03.jpg


.. |br| raw:: html

   <br />
