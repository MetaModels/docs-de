.. _component_data-in-attributes:

Datentypen als Attribute anlegen
================================

Bei der Planung wie man sein MetaModels aufbauen möchte, ist neben dem Aufbau der
:ref:`Datenbankstruktur <component_relations_database_structure>` wichtig, mit welchen Möglichkeiten ich meine
realen Daten wie z. B. Texte, Zahlen, Datum, PLZ usw. abspeichern kann. Datei sind sowohl die Datentypen der Datenbank
(MySQL/MariaDB) als auch die Eingabemöglichkeiten über die Widgets von Contao zu beachten.

Folgend ist eine Übersicht, mit welchen Attributen die gewünschten Daten gespeichert werden können. Zusätzlich ist bei
"Filterregel" angegeben, welche Filterregeln für die Filterung/Suche im Frontend verwendet werden können.

Texte
-----

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "Kurze Texte", "Text", `attribute_text <https://github.com/MetaModels/attribute_text>`_, "Textsuche, |br| Einzelauswahl, |br| Mehrfachauswahl, |br| Einfache Abfrage, |br| Register, |br| Levenshtein, |br| Loupe", "bis 255 Zeichen; |br| Anzahl des Attributes durch |br| DB limitiert"
    "Lange Texte", "Langtext", `attribute_longtext <https://github.com/MetaModels/attribute_longtext>`_, "Textsuche, |br| Levenshtein, |br| Loupe", "bis 65535 Zeichen; |br| :ref:`anpassbar <rst_cookbook_inputmask_manipulate-select-values>`"
    "Text als Alias", "Alias", `attribute_alias <https://github.com/MetaModels/attribute_alias>`_, "Textsuche, |br| Einfache Abfrage, |br| Levenshtein, |br| Loupe", "bis 255 Zeichen; |br| Generierung aus ein |br| ein oder mehreren Attributen"
    "Kombinierte Werte", "Kombinierte Einträge", `attribute_combinedvalues <https://github.com/MetaModels/attribute_combinedvalues>`_, "Textsuche, |br| Einzelauswahl, |br| Mehrfachauswahl, |br| Einfache Abfrage, |br| Register, |br| Levenshtein, |br| Loupe", "bis 255 Zeichen; |br| Ergebnisstring per sprintf definierbar"
    "Text als Tabelle", "Text-Tabelle", `attribute_tabletext <https://github.com/MetaModels/attribute_tabletext>`_, "Levenshtein, |br| Loupe", "bis 255 Zeichen je Zelle"
    "Text als URL", "URL", `attribute_url <https://github.com/MetaModels/attribute_url>`_, "Levenshtein, |br| Loupe", "bis 255 Zeichen; |br| Anzahl Zeichen für Titel und URL"
    "Mehrsprachig"
    "Kurze Texte mehrsprachig", "Übersetzter Text", `attribute_translatedtext <https://github.com/MetaModels/attribute_translatedtext>`_, "siehe Text", "bis 255 Zeichen"
    "Lange Texte mehrsprachig", "Übersetzter Langtext", `attribute_translatedlongtext <https://github.com/MetaModels/attribute_translatedlongtext>`_, "siehe Langtext", "siehe Langtext"
    "Text als Alias mehrsprachig", "Übersetzter Alias", `attribute_translatedalias <https://github.com/MetaModels/attribute_translatedalias>`_, "siehe Alias", "siehe Alias"
    "Kombinierte |br| Werte mehrsprachig", "Übersetzte |br| Kombinierte Einträge", `attribute_translatedcombinedvalues <https://github.com/MetaModels/attribute_translatedcombinedvalues>`_, "siehe |br| Kombinierte Einträge", "siehe Kombinierte Einträge"
    "Text als |br| Tabelle mehrsprachig", "Übersetzte |br| Text-Tabelle", `attribute_translatedtabletext <https://github.com/MetaModels/attribute_translatedtabletext>`_, "Levenshtein, |br| Loupe", "siehe Text-Tabelle"
    "Text als |br| URL mehrsprachig", "Übersetzte URL", `attribute_translateurl <https://github.com/MetaModels/attribute_translateurl>`_, "Levenshtein, |br| Loupe", "siehe URL"

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

Boolescher Wert
------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "Boolescher Wert", "Checkbox", `attribute_checkbox <https://github.com/MetaModels/attribute_checkbox>`_, "Checkbox-Status", "Anzeige in BE-Liste als Toogle-Icon möglich"
    "Mehrsprachig"
    "Boolescher Wert mehrsprachig", "Übersetzte Checkbox", `attribute_translatedcheckbox <https://github.com/MetaModels/attribute_translatedcheckbox>`_, "Übersetzter Checkbox-Status", "siehe Checkbox"


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

Weitere Informationen findet man auf der Seite :ref:`component_relations`.

Weitere Daten
-------------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "Bemerkung"
   :widths: 10, 10, 10, 10, 10

    "Farbwert", "Farbwähler", `attribute_color <https://github.com/MetaModels/attribute_color>`_, , "Opacity/Transparency auch wählbar; |br| Sortierung nach Farbe möglich; |br| :ref:`siehe Attribut Color <rst_extended_attribute_color>`"
    "Inhaltselemente", "Inhalt eines Artikels", `attribute_contentarticle <https://github.com/MetaModels/attribute_contentarticle>`_, , "mehrere Inhaltselemente wie beim Artikel"
    "Ländernamen", "Land", `attribute_country <https://github.com/MetaModels/attribute_country>`_, , "mögliche Länder eingrenzbar"
    "Sprachenkürzel", "Sprachenschlüssel", `attribute_langcode <https://github.com/MetaModels/attribute_langcode>`_, , "mögliche Sprachen eingrenzbar"
    "Geo-Entfernung", "Geo-Entfernung", `attribute_geodistance <https://github.com/MetaModels/attribute_geodistance>`_, , "Zusatzangabe für Umkreissuche"
    "Sterne-Bewertung", "Bewertung", `attribute_rating <https://github.com/MetaModels/attribute_rating>`_, , "Anzahl der Sterne wählbar"
    "MCW-Tabelle", "Tabelle multi (MCW)", `attribute_tablemulti <https://github.com/MetaModels/attribute_tablemulti>`_, , ":ref:`siehe Attribut für Multi-Column-Wizard <rst_extended_attribute_mcw>`"
    "Pin für Cowegis-Map", "Cowegis-Marker", `cowegis-layer <https://github.com/MetaModels/cowegis-layer>`_, , ":ref:`siehe Cowegis-Layer Integration für Marker <extended_cowegis-layer-marker>`"
    "Mehrsprachig"
    "Inhaltselemente |br| mehrsprachig", "Übersetzter |br| Inhalt eines Artikels", `attribute_translatedcontentarticle <https://github.com/MetaModels/attribute_translatedcontentarticle>`_, , "siehe Inhalt eines Artikels"
    "MCW-Tabelle |br| mehrsprachig", "Übersetzte |br| Tabelle multi (MCW)", `attribute_translatedtablemulti <https://github.com/MetaModels/attribute_translatedtablemulti>`_, , "siehe Tabelle multi (MCW)"


.. |br| raw:: html

   <br />
