.. _rst_cookbook_filter_exclusion:

Filterregel als Ausschluss
==========================

Möchte man einen Filter erstellen welcher das Attribut nicht "eingrenzt"
sondern "ausgrenzt", kann man dies mit einer speziellen Anordnung der 
Filterregeln erreichen.

Als Beispiel kann die :ref:`Mitarbeiterliste <mm_first_conclusion>`
herangezogen werden. Wenn ein
Filter auf die Abteilung erstellt wird, werden die Ergebnisse auf genau
die im Filter ausgewählte Abteilung eingegrenzt, d.h. es werden nur die
Items ausgegeben, bei denen "Abteilung gleich Filterwert" ist - z.B.
"Filtere alle Mitarbeiter aus Abteilung 'Marketing'".

Möchte man aber alle Abteilungen **außer** der im Filter ausgewählten
Abteilung (diese also ausschließen, z.B. "Filtere alle Mitarbeiter
die nicht in Abteilung 'Marketing' sind"), kann man wie folgt vorgehen:

* man fügt eine Filterregel "ODER-Bedingung (OR)" ein mit gesetzter Checkbox
  "Nach erstem Treffer beenden"
* in die Filterregel kommt eine Filterregel "Eigenes SQL" sowie eine Filterregel
  wie z.B. "Einzelauswahl"

Anschließend sollten die Filterregeln etwa wie im Screenshot zu sehen angeordnet sein.

|img_exclusion|

In der Filterregel "Eigenes SQL" wird folgende Query eingetragen:

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM {{table}} 
   WHERE abteilung IN (
     SELECT id
     FROM mm_abteilung
     WHERE alias != {{param::get?name=abteilung}} 
     OR ({{param::get?name=abteilung}} IS NULL)
   )

**Hintergrund:** Die Filterregel "Einzelauswahl" dient lediglich für die Erstellung
bzw. Anzeige des Formularwidgets im Frontend. Die eigentliche Filterung erfolgt in
der Filterregel "Eigenes SQL". Die Abarbeitung der weiteren Filterregel im "ODER-Zweig"
wird aber unterbrochen, so dass die eigentliche Filterregel "Einzelauswahl" nicht
mehr zum Zuge kommt.


.. |img_exclusion| image:: /_img/screenshots/cookbook/filter/exclusion.jpg

