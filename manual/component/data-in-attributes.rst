.. _component_data-in-attributes:

Datentypen als Attribute anlegen
================================

Bei der Planung wie man sein MetaModels aufbauen möchte, ist neben dem Aufbau der
:ref:`Datenbankstruktur <component_relations_database_structure>` wichtig, mit welchen Möglichkeiten ich meine
realen Daten wie z. B. Texte, Zahlen, Datum, PLZ usw. abspeichern kann. Datei sind sowohl die Datentypen der Datenbank
(MySQL/MariaDB) als auch die Eingabemöglichkeiten über die Widgets von Contao zu beachten.

Folgend ist eine Übersicht, mit welchen Attributen die gewünschten Daten gespeichert werden können. Zusätzlich ist bei
"Filterregeln" angegeben, welche Filterregeln für die Filterung/Suche im Frontend verwendet werden können.

Text
----

+--------------+--------------+---------------+---------------+-----------------+---------------+
| **Datentyp** | **Attribut** | **Paketname** | **Bemerkung** | **Filterregel** | **Bemerkung** |
+==============+==============+===============+===============+=================+===============+
| Kurze Texte | Text | `attribute_text <https://github.com/MetaModels/attribute_text>`_ | Textsuche |br| Einzelauswahl |br| Mehrfachauswahl |br| Einfache Abfrage |br| Register |br| Levenshtein |br| Loupe | bis 255 Zeichen |br| Anzahl des Attributes druch DB limitiert |
+--------------+--------------+---------------+---------------+-----------------+---------------+


.. |br| raw:: html

   <br />
