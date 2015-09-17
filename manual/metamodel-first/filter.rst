.. _mm_first_filter:

|img_filter| Filter
===================

Der Schritt "Filter" zählt zu den optionalen Komponenten und steuert verschiedene
Optionen der Ausgabe. In unserem Beispiel soll ein Filter angelegt werden,
der für die Frontendausgabe nur die Einträge mit aktiviertem "Veröffentlicht".

Zum Aufruf der Filter wird wieder die Übersicht MetaModels aktiviert,
so dass der Eintrag der "Mitarbeiterliste" zu sehen ist. Nun erfolgt ein Klick
auf das Icon "|img_filter| Filter" und die Ansicht wechselt zur 
Übersicht der Filter - diese ist aktuell noch leer.

Nach einem Klick auf "|img_new| Neu" öffnet sich sofort die Maske
für die Erstellung eines Filters. Es wird lediglich eine Bezeichnung
für den Filter im Eingabefeld "Name" eingetragen - z.B. "Veröffentlicht"
(siehe Screenshot)

|img_filter_01|

In der Übersicht der Filter sollte nun der erste Eintrag mit
"Veröffentlicht" zu sehen sein - siehe Screenshot.

|img_filter_02|

Über einen Klick auf das Icon "|img_filter_setting| Attribute"
wird die nächste Ebene für die Filterattribute geöffnet. An dieser Stelle
wird der Filter mit seinen Filterattributen konfiguriert. Die Filterattribute
können in verschiedener Kombination und Verschachtelung miteinander verknüpft
werden. Für das Beispiel wird nur ein Filterattribut dem Filter hinzugefügt,
in dem in der Kopfzeile auf das Icon "|img_new| Neu" geklickt wird.

Nach dem Klick ist zunächst nur das Klemmmappenicon |img_pasteinto| zu sehen -
mit einem Klick auf das Icon öffnet sich die Konfigurationsmaske.

Zum Filtern des Veröffentlicht-Status gibt es unter "Typ" einen speziellen
Filter, der ausgewählt wird. Als Attribut wird "Veröffentlicht" ausgewählt
(siehe Screenshot).

|img_filter_03|

Nach einem Klick auf "Aktiviert" und "Speichern und schließen" ist das
Filterattribut fertig und es sollte folgende Listenansicht zu sehen sein
(siehe Screenshot).

|img_filter_04|

Der Filter ist damit definiert und kann in verschiedenen Komponenten
aktiviert werden.

.. |img_filter| image:: /_img/icons/filter.png
.. |img_filter_setting| image:: /_img/icons/filter_setting.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_about| image:: /_img/icons/about.png
.. |img_pasteinto| image:: /_img/icons/pasteinto.gif

.. |img_filter_01| image:: /_img/screenshots/metamodel_first/filter_01.png
.. |img_filter_02| image:: /_img/screenshots/metamodel_first/filter_02.png
.. |img_filter_03| image:: /_img/screenshots/metamodel_first/filter_03.png
.. |img_filter_04| image:: /_img/screenshots/metamodel_first/filter_04.png