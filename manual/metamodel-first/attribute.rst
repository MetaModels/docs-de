.. _mm_first_attribute:

|img_fields| Attribute
=========================

Nachdem die Tabelle "mm_telefonliste" in der Datenbank erstellt wurde, muss in dieser
nun die Felder bzw. Tabellenspalten zur Speicherung der Daten erzeugt werden - sprich
die Attribute. Dieser Schritt erfolgt über die gleichnamige Komponente
"|img_fields| Attribute".

Anhand der Aufgabenstellung werden die folgenden Felder benötigt:

+-----------------+----------------+----------+
| **Bezeichnung** | **Attr.-Name** | **Typ**  |
+-----------------+----------------+----------+
| Name            | name           | Text     |
+-----------------+----------------+----------+
| Vorname         | vorname        | Text     |
+-----------------+----------------+----------+
| E-Mail          | email          | Text     |
+-----------------+----------------+----------+
| Abteilung       | abteilung      | Text     |
+-----------------+----------------+----------+
| Veröffentlicht  | published      | Checkbox |
+-----------------+----------------+----------+

Im ersten Schritt wechseln wir in dem MetaModel "Telefonliste" in die Komponente
"Attribute" in dem auf das Icon |img_fields| geklickt wird. Anschließend kann über
"|img_new| Neues Attribut" das erste Attribut erstellt werden. Mit dem Klick auf
"|img_new| Neues Attribut" wird nicht sofort die Eingabemaske geöffnet, sondern
ein Klemmappenicon |img_pasteafter| - auf dieses wird geklickt (siehe Screenshot).

|img_attribute_01|

Mit dem Klick auf das Klemmappenicon |img_pasteafter| öffnet sich die Eingabemaske
für das Attribut. Hier wird zunächst der Attributtyp "Text" aus der Auswahlliste
ausgewält und nach der Aktualisierung der Eingabemaske stehen die notwendigen Felder
zur Eingabe bereit. Diese werden für das erste Attribut "Name" wie im Screenshot
zu sehen ausgefüllt.

|img_attribute_02|

Mit "Speichern und schließen" wird das Attribut "Name" angelegt, d.h. die Spalte
"name" in der Datenbanktabelle erzeugt, und anschließend zur Attributübersicht
gewechselt. Diese Schritte zur Erstellung eines Attributes werden nun für
Vorname, E-Mail und Abteilung wiederholt.

Für das Attribut "Veröffentlicht" wird ebenfalls ein neues Attribut erstellt, aber
bei Attributtyp "Kontrollkästchen (Checkbox)" ausgewählt. Bei dem Attribut wird
bei "erweiterten Einstellungen" die Option "Veröffentlichen" aktiviert (siehe
Screenshot).

|img_attribute_03|

Die Liste der erstellten Attribute sollte nun, wie im Screenshot zu sehen, aufgeführt
werden.

|img_attribute_04|



.. |img_fields| image:: /_img/icons/fields.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_pasteafter| image:: /_img/icons/pasteafter.gif

.. |img_attribute_01| image:: /_img/screenshots/metamodel_first/attribute_01.png
.. |img_attribute_02| image:: /_img/screenshots/metamodel_first/attribute_02.png
.. |img_attribute_03| image:: /_img/screenshots/metamodel_first/attribute_03.png
.. |img_attribute_04| image:: /_img/screenshots/metamodel_first/attribute_04.png

.. |br| raw:: html

   <br />
   
.. |nbsp| unicode:: 0xA0 
   :trim:

