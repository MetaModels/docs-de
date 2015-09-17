.. _mm_first_conclusion:

Zusammenfassung und Ausblick
============================

Mit dem Aufbau des ersten MetaModels wurden eine einfache Tabelle
angelegt und dabei die grundlegenden Arbeitsschritte für ein
MetaModel bearbeitet.

Mit dem MetaModel "Mitarbeiterliste" ist die Eingabe im Backend und
die Ausgabe im Frontend realisiert. Dies stellt natürlich nur
einen kleinen Abschnitt der Möglichkeiten von MetaModels dar und
selbst dieses einfache Beispiel kann weiter ausgebaut werden.

Folgend eine kleine Aufzählung an Möglichkeiten:

* Datenstruktur ändern - Abteilung in eigenes MetaModel und Verbindung
  (Relation) zur Telefonliste
* im Backend können Filterungen, Sortierungen und Suchfunktionen
  hinzugefügt werden
* im Frontend wäre ebenfalls der Ausbau mit Filterungen,
  Sortierungen und Suchfunktionen möglich
  
Als Anregung die folgenden zwei Screenshots - zum einen vom Backend mit
einem separaten MetaModel für die Abteilungen (Änderung des Attributes
"Abteilung" von "Text" auf "Auswahl")

|img_conclusion_01|

sowie eine Ansicht des Frontends mit Filtern und Suche (Mitarbeiter
aus Abteilung "GF" mit Anfangsbuchstaben "F")

|img_conclusion_02|
  
In dem Kapitel :ref:`mm_second_index` wird eine komplexere Datenstruktur
umgesetzt und in dem Kapitel :ref:`mm_special_index` einzelne Aspekte wie
Mehrsprachigkeit, Varianten, Kind-Tabellen usw. aufgegriffen.

.. |img_conclusion_01| image:: /_img/screenshots/metamodel_first/conclusion_01.png
.. |img_conclusion_02| image:: /_img/screenshots/metamodel_first/conclusion_02.png