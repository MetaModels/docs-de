.. _component_data-in-attributes:

Datentypen als Attribute anlegen
================================

Bei der Planung wie man sein MetaModels aufbauen möchte, ist neben dem Aufbau der
:ref:`Datenbankstruktur <component_relations_database_structure>` wichtig, mit welchen Möglichkeiten ich meine
realen Daten wie z. B. Texte, Zahlen, Datum, PLZ usw. abspeichern kann. Datei sind sowohl die Datentypen der Datenbank
(MySQL/MariaDB) als auch die Eingabemöglichkeiten über die Widgets von Contao zu beachten.

Folgend ist eine Übersicht, mit welchen Attributen die gewünschten Daten gespeichert werden können. Zusätzlich ist bei
"Filterregel" angegeben, welche Filterregeln für die Filterung/Suche im Frontend verwendet werden können.

Text
----

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "Kurze Texte", "Text", `attribute_text <https://github.com/MetaModels/attribute_text>`_, "Textsuche, |br| Einzelauswahl, |br| Mehrfachauswahl, |br| Einfache Abfrage, |br| Register, |br| Levenshtein, |br| Loupe", "bis 255 Zeichen; |br| Anzahl des Attributes durch DB limitiert"
    "Lange Texte", "Langtext", `attribute_longtext <https://github.com/MetaModels/attribute_longtext>`_, "Textsuche, |br| Levenshtein, |br| Loupe", "bis 65535 Zeichen; |br| :ref:`anpassbar <rst_cookbook_inputmask_manipulate-select-values>`"
    "Mehrsprachig"
    "Kurze Texte mehrsprachig", "Übersetzter Text", `attribute_translatedtext <https://github.com/MetaModels/attribute_translatedtext>`_, "siehe Text", "bis 255 Zeichen"
    "Lange Texte mehrsprachig", "Übersetzter Langtext", `attribute_translatedlongtext <https://github.com/MetaModels/attribute_translatedlongtext>`_, "siehe Langtext", "siehe Langtext"

Zahlen
------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "Ganzzahlige Werte", "Numerisch", `attribute_numeric <https://github.com/MetaModels/attribute_numeric>`_, "Wert von/bis für ein Attribut, |br| Wert von/bis für zwei Attribute", "für PLZ oder Telefonnummern Attribut |br| Text verwenden"
    "Dezimalzahlen", "Dezimal", `attribute_decimal <https://github.com/MetaModels/attribute_decimal>`_, "Wert von/bis für ein Attribut, |br| Wert von/bis für zwei Attribute", "Eingabe mit Punkt als Dezimaltrenner"
    "Datum oder Zeit", "Datum", `attribute_timestamp <https://github.com/MetaModels/attribute_timestamp>`_, "Wert von/bis für ein Datumsattribut, |br| Wert von/bis für zwei Datumsattribute", "Speicherung als UNIX-Zeitstempel; |br| Eingabe kann auf nur Datum oder nur |br| Zeit eingegrenzt werden"
    "Geokoordinaten", "siehe Dezimal", , "Umkreissuche", "für Latitude und Longitude jeweils |br| ein Attribut anlegen"

Dateien
-------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "Datei", "Datei", `attribute_file <https://github.com/MetaModels/attribute_file>`_, , "im BE nach Dateiname oder UUID suchbar; |br| für Ausgabe von Bildern ist Bildgröße wählbar"
    "Mehrsprachig"
    "Datei mehrsprachig", "Übersetzte Datei", `attribute_translatedfile <https://github.com/MetaModels/attribute_translatedfile>`_, , "siehe Datei"


Relationen
----------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "1:n", "Einzelauswahl [select]", `attribute_select <https://github.com/MetaModels/attribute_select>`_, "Einzelauswahl, |br| Filter auf Attribut des Modells mit einer Relation", "Relation zu anderer Tabelle für einen Wert |br| MM-Tabellen oder weitere Contao-Tabellen"
    "m:n", "Mehrfachauswahl [tags]", `attribute_tags <https://github.com/MetaModels/attribute_tags>`_, "Mehrfachauswahl, |br| Filter auf Attribut des Modells mit einer Relation", "Relation zu anderer Tabelle für mehrere Werte |br| MM-Tabellen oder weitere Contao-Tabellen"
    "Mehrsprachig |br| Einzel- und Mehrfachauswahl können |br| per se mit mehrsprachigen MMs umgehen"
    "1:n", "Übersetzte Einzelauswahl [select]", `attribute_translatedselect <https://github.com/MetaModels/attribute_translatedselect>`_, "Einzelauswahl", "nur für Spezialfälle mit eigener Spalte für Sprachschlüssel"
    "m:n", "Übersetzte Mehrfachauswahl [tags]", `attribute_translatedtags <https://github.com/MetaModels/attribute_translatedtags>`_, "Mehrfachauswahl", "nur für Spezialfälle mit eigener Spalte für Sprachschlüssel"

Weitere Informationen finden sich auf der Seite :ref:`component_relations`.




.. |br| raw:: html

   <br />
