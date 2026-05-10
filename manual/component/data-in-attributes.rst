.. _component_data-in-attributes:

Datentypen als Attribute anlegen
================================

Bei der Planung wie man sein MetaModels aufbauen möchte, ist neben dem Aufbau der
:ref:`Datenbankstruktur <component_relations_database_structure>` wichtig, mit welchen Möglichkeiten ich meine
realen Daten wie z. B. Texte, Zahlen, Datum, PLZ usw. abspeichern kann. Dabei sind sowohl die Datentypen der Datenbank
(MySQL/MariaDB) als auch die Eingabemöglichkeiten über die Widgets von Contao zu berücksichtigen.

Folgend ist eine Übersicht, mit welchen Attributen die gewünschten Daten gespeichert werden können. Zusätzlich ist bei
"Filterregel" angegeben, welche :ref:`Filterregeln für die Filterung/Suche <component_filter>` im Frontend verwendet
werden können. Zudem ist aufgeführt, welche Attribute für das :ref:`Frontend-Editing (FEE) <rst_extended_frontend_editing>`
zur Verfügung stehen (✔) - ggf. sind :ref:`weitere Repositories zu installieren <rst_extended_frontend_editing_installation>` (🗹).

Texte
-----

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "FEE", "Bemerkung"
   :widths: 10, 10, 10, 10, 10, 10

    "Kurze Texte", ":ref:`Text <component_attribute_text>`", `attribute_text <https://github.com/MetaModels/attribute_text>`_, "Textsuche, |br| Einzelauswahl, |br| Mehrfachauswahl, |br| Einfache Abfrage, |br| Register, |br| Levenshtein, |br| Loupe", "✔", "bis 255 Zeichen; |br| Anzahl des Attributes durch |br| DB limitiert"
    "Lange Texte", ":ref:`Langtext <component_attribute_longtext>`", `attribute_longtext <https://github.com/MetaModels/attribute_longtext>`_, "Textsuche, |br| Levenshtein, |br| Loupe", "✔", "bis 65535 Zeichen; |br| :ref:`anpassbar <rst_cookbook_inputmask_manipulate-select-values>`"
    "Text als Alias", ":ref:`Alias <component_attribute_alias>`", `attribute_alias <https://github.com/MetaModels/attribute_alias>`_, "Textsuche, |br| Einfache Abfrage, |br| Levenshtein, |br| Loupe", "✔", "bis 255 Zeichen; |br| Generierung aus ein |br| ein oder mehreren Attributen"
    "Kombinierte Werte", ":ref:`Kombinierte Einträge <component_attribute_combinedvalues>`", `attribute_combinedvalues <https://github.com/MetaModels/attribute_combinedvalues>`_, "Textsuche, |br| Einzelauswahl, |br| Mehrfachauswahl, |br| Einfache Abfrage, |br| Register, |br| Levenshtein, |br| Loupe", "✔", "bis 255 Zeichen; |br| Ergebnisstring per ``sprintf`` definierbar"
    "Text als Tabelle", ":ref:`Text-Tabelle <component_attribute_tabletext>`", `attribute_tabletext <https://github.com/MetaModels/attribute_tabletext>`_, "Levenshtein, |br| Loupe", ":ref:`🗹 <rst_extended_frontend_editing_installation>`", "bis 255 Zeichen je Zelle"
    "Text als URL", ":ref:`URL <component_attribute_url>`", `attribute_url <https://github.com/MetaModels/attribute_url>`_, "Levenshtein, |br| Loupe", ":ref:`🗹 <rst_extended_frontend_editing_installation>`", "bis 255 Zeichen; |br| Anzahl Zeichen für Titel und URL"
    "*Mehrsprachig*"
    "Kurze Texte mehrsprachig", ":ref:`Übersetzter Text <component_attribute_translatedtext>`", `attribute_translatedtext <https://github.com/MetaModels/attribute_translatedtext>`_, "siehe Text", "✔", "bis 255 Zeichen"
    "Lange Texte mehrsprachig", ":ref:`Übersetzter Langtext <component_attribute_translatedlongtext>`", `attribute_translatedlongtext <https://github.com/MetaModels/attribute_translatedlongtext>`_, "siehe Langtext", "✔", "siehe Langtext"
    "Text als Alias mehrsprachig", ":ref:`Übersetzter Alias <component_attribute_translatedalias>`", `attribute_translatedalias <https://github.com/MetaModels/attribute_translatedalias>`_, "siehe Alias", "✔", "siehe Alias"
    "Kombinierte |br| Werte mehrsprachig", ":ref:`Übersetzte Kombinierte Einträge <component_attribute_translatedcombinedvalues>`", `attribute_translatedcombinedvalues <https://github.com/MetaModels/attribute_translatedcombinedvalues>`_, "siehe |br| Kombinierte Einträge", "✔", "siehe Kombinierte Einträge"
    "Text als |br| Tabelle mehrsprachig", ":ref:`Übersetzte Text-Tabelle <component_attribute_translatedtabletext>`", `attribute_translatedtabletext <https://github.com/MetaModels/attribute_translatedtabletext>`_, "Levenshtein, |br| Loupe", ":ref:`🗹 <rst_extended_frontend_editing_installation>`", "siehe Text-Tabelle"
    "Text als |br| URL mehrsprachig", ":ref:`Übersetzte URL <component_attribute_translatedurl>`", `attribute_translateurl <https://github.com/MetaModels/attribute_translateurl>`_, "Levenshtein, |br| Loupe", ":ref:`🗹 <rst_extended_frontend_editing_installation>`", "siehe URL"

Zahlen
------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "FEE", "Bemerkung"
   :widths: 10, 10, 10, 10, 10, 10

    "Ganzzahlige Werte", ":ref:`Numerisch <component_attribute_numeric>`", `attribute_numeric <https://github.com/MetaModels/attribute_numeric>`_, "Wert von/bis für ein Attribut, |br| Wert von/bis für zwei Attribute", "✔", "für PLZ oder Telefonnummern Attribut |br| Text verwenden"
    "Dezimalzahlen", ":ref:`Dezimal <component_attribute_decimal>`", `attribute_decimal <https://github.com/MetaModels/attribute_decimal>`_, "Wert von/bis für ein Attribut, |br| Wert von/bis für zwei Attribute", "✔", "Eingabe mit Punkt als Dezimaltrenner"
    "Datum oder Zeit", ":ref:`Datum <component_attribute_timestamp>`", `attribute_timestamp <https://github.com/MetaModels/attribute_timestamp>`_, "Wert von/bis für ein Datumsattribut, |br| Wert von/bis für zwei Datumsattribute", "✔", "Speicherung als UNIX-Zeitstempel; |br| Eingabe kann auf nur Datum oder nur |br| Zeit eingegrenzt werden"
    "Geokoordinaten", "siehe Dezimal", , "Umkreissuche", "**—**", "für Latitude und Longitude jeweils |br| ein Attribut anlegen"

Dateien
-------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "FEE", "Bemerkung"
   :widths: 10, 10, 10, 10, 10, 10

    "Datei", ":ref:`Datei <component_attribute_file>`", `attribute_file <https://github.com/MetaModels/attribute_file>`_, , "✔ Upload", "im BE nach Dateiname oder UUID suchbar; |br| für Ausgabe von :ref:`Bildern ist Bildgröße <rst_cookbook_templates_fe_work_with_images>` wählbar"
    "*Mehrsprachig*"
    "Datei mehrsprachig", ":ref:`Übersetzte Datei <component_attribute_translatedfile>`", `attribute_translatedfile <https://github.com/MetaModels/attribute_translatedfile>`_, , "✔ Upload", "siehe Datei"

Übergabe z. B. an ein :ref:`Rocksilid-Slider <rst_cookbook_templates_fe_template_ce_elements_rstslider>`.

Boolescher Wert
------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "FEE", "Bemerkung"
   :widths: 10, 10, 10, 10, 10, 10

    "Boolescher Wert", ":ref:`Checkbox <component_attribute_checkbox>`", `attribute_checkbox <https://github.com/MetaModels/attribute_checkbox>`_, "Checkbox-Status", "✔", "Anzeige in BE-Liste als Toogle-Icon möglich"
    "*Mehrsprachig*"
    "Boolescher Wert mehrsprachig", ":ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>`", `attribute_translatedcheckbox <https://github.com/MetaModels/attribute_translatedcheckbox>`_, "Übersetzter Checkbox-Status", "✔", "siehe Checkbox"


Relationen
----------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "FEE", "Bemerkung"
   :widths: 10, 10, 10, 10, 10, 10

    "1:n", ":ref:`Einzelauswahl [select] <component_attribute_select>`", `attribute_select <https://github.com/MetaModels/attribute_select>`_, "Einzelauswahl, |br| Filter auf Attribut des Modells mit einer Relation", "✔", "Relation zu anderer Tabelle für einen Wert |br| MM-Tabellen oder weitere Contao-Tabellen"
    "m:n", ":ref:`Mehrfachauswahl [tags] <component_attribute_tags>`", `attribute_tags <https://github.com/MetaModels/attribute_tags>`_, "Mehrfachauswahl, |br| Filter auf Attribut des Modells mit einer Relation", "✔", "Relation zu anderer Tabelle für mehrere Werte |br| MM-Tabellen oder weitere Contao-Tabellen"
    "*Mehrsprachig* |br| Einzel- und Mehrfachauswahl können |br| per se mit mehrsprachigen MMs umgehen"
    "1:n", ":ref:`Übersetzte Einzelauswahl [select] <component_attribute_translatedselect>`", `attribute_translatedselect <https://github.com/MetaModels/attribute_translatedselect>`_, "Einzelauswahl", "✔", "nur für Spezialfälle mit eigener Spalte für Sprachschlüssel"
    "m:n", ":ref:`Übersetzte Mehrfachauswahl [tags] <component_attribute_translatedtags>`", `attribute_translatedtags <https://github.com/MetaModels/attribute_translatedtags>`_, "Mehrfachauswahl", "✔", "nur für Spezialfälle mit eigener Spalte für Sprachschlüssel"

Weitere Informationen findet man auf der Seite :ref:`component_relations`.

Weitere Daten
-------------

.. csv-table::
   :header: "Datentyp", "Attribut", "Paketname", "Filterregel", "FEE", "Bemerkung"
   :widths: 10, 10, 10, 10, 10, 10

    "Farbwert", ":ref:`Farbwähler <component_attribute_color>`", `attribute_color <https://github.com/MetaModels/attribute_color>`_, , ":ref:`🗹 <rst_extended_frontend_editing_installation>`", "Opacity/Transparency auch wählbar; |br| Sortierung nach Farbe möglich; |br| :ref:`siehe Attribut Color <rst_extended_attribute_color>`"
    "Inhaltselemente", ":ref:`Inhalt eines Artikels <component_attribute_contentarticle>`", `attribute_contentarticle <https://github.com/MetaModels/attribute_contentarticle>`_, , "**—**", "mehrere Inhaltselemente wie beim Artikel"
    "Ländernamen", ":ref:`Land <component_attribute_country>`", `attribute_country <https://github.com/MetaModels/attribute_country>`_, , "✔", "mögliche Länder eingrenzbar"
    "Sprachenkürzel", ":ref:`Sprachenschlüssel <component_attribute_langcode>`", `attribute_langcode <https://github.com/MetaModels/attribute_langcode>`_, , "✔", "mögliche Sprachen eingrenzbar"
    "Geo-Entfernung", ":ref:`Geo-Entfernung <component_attribute_geodistance>`", `attribute_geodistance <https://github.com/MetaModels/attribute_geodistance>`_, , "**—**", "Zusatzangabe für Sortierung |br| der Umkreissuche"
    "Sterne-Bewertung", ":ref:`Bewertung <component_attribute_rating>`", `attribute_rating <https://github.com/MetaModels/attribute_rating>`_, , "**—**", "Anzahl der Sterne wählbar"
    "MCW-Tabelle", ":ref:`Tabelle multi (MCW) <component_attribute_tablemulti>`", `attribute_tablemulti <https://github.com/MetaModels/attribute_tablemulti>`_, , ":ref:`🗹 <rst_extended_frontend_editing_installation>`", ":ref:`siehe Attribut für Multi-Column-Wizard <rst_extended_attribute_mcw>`"
    "Pin für Cowegis-Map", "Cowegis-Marker", `cowegis-layer <https://github.com/MetaModels/cowegis-layer>`_, , "✔", ":ref:`siehe Cowegis-Layer Integration für Marker <extended_cowegis-layer-marker>`"
    "*Mehrsprachig*"
    "Inhaltselemente |br| mehrsprachig", ":ref:`Übersetzter Inhalt eines Artikels <component_attribute_translatedcontentarticle>`", `attribute_translatedcontentarticle <https://github.com/MetaModels/attribute_translatedcontentarticle>`_, , "**—**", "siehe Inhalt eines Artikels"
    "MCW-Tabelle |br| mehrsprachig", ":ref:`Übersetzte Tabelle multi (MCW) <component_attribute_translatedtablemulti>`", `attribute_translatedtablemulti <https://github.com/MetaModels/attribute_translatedtablemulti>`_, , ":ref:`🗹 <rst_extended_frontend_editing_installation>`", "siehe Tabelle multi (MCW)"

Ausgabe z. B. als :ref:`CE-YouTube <rst_cookbook_templates_fe_template_ce_elements_youtube>`.

.. |br| raw:: html

   <br />
