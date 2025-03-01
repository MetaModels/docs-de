.. _rst_cookbook_filter_filter-with-static-parameter:

Eingrenzung der Items in CE-/FE-Modul MM-Liste
==============================================

Die Ausgabe einer MM-Liste kann man über einen Filter steuern - zum Beispiel wenn man eine Liste von Mitarbeitern hat,
die nach der Abteilung gefiltert ausgegeben werden sollen.

Man erstellt also einen Filter für "Abteilung xy" und wählt diesen bei den Einstellungen des CE-/FE-Modul MM-Liste aus.

Wenn man nun aber auf mehreren Seiten jeweils eine spezielle Abteilung ausgeben möchte, ist es recht umständlich und
unübersichtlich für jede Abteilung einen separaten Filter anzulegen.

Das kann man umgehen, wenn als Filterregel "Einfache Abfrage" eingebunden ist und man dort die Checkbox
"Statischer Parameter" setzt.

Ist dies erfolgt, so wird in CE-/FE-Modul MM-Liste bei den Filtereinstellungen ein zusätzliches Selectfeld eingeblendet.
In diesem wären in unserem Beispielfall alle Abteilungen aufgeführt und man kann eine anzuzeigende Abteilung auswählen.

|img_static-parameter.png|

Es ist auch möglich, mehrere "Einfache Abfrage"-Regeln einzusetzen.

Als Alternative kann man für Redakteure auch ein
:ref:`entsprechendes vordefiniertes Contentelement <rst_cookbook_specials_ce_element_for_editors>` zur Verfügung stellen.


.. |img_static-parameter.png| image:: /_img/screenshots/cookbook/filter/static-parameter.png


