.. _component_attribute_translatedcontentarticle:

Übersetzter Inhalt eines Artikels
==================================

Das Attribut "Übersetzter Inhalt eines Artikels" ist die mehrsprachige Variante
des :ref:`Attributs "Inhalt eines Artikels" <component_attribute_contentarticle>`.
Es ermöglicht je Sprache eigene Contao-Inhaltselemente für einen MetaModels-Datensatz.
Die Inhalte werden in der Contao-Tabelle ``tl_content`` mit einem zusätzlichen
Sprachfeld gespeichert.

Typische Einsatzbereiche:

* Mehrsprachige Produktbeschreibungen mit komplexem Inhaltslayout
* Sprachabhängige Detailseiten-Inhalte mit verschiedenem Aufbau je Sprache
* Übersetzter redaktioneller Inhalt pro Item

.. seealso:: Die einsprachige Variante dieses Attributs ist unter
   :ref:`component_attribute_contentarticle` beschrieben.

.. seealso:: Dieses Attribut wird von der :ref:`File-Usage Integration <rst_extended_file-usage>`
   unterstützt. Damit lässt sich in der Contao-Dateiverwaltung anzeigen, ob und wo eine Datei
   eingebunden ist.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_translatedcontentarticle


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Das Attribut besitzt keine eigenen spezifischen Einstellungen beim Anlegen.
Es werden nur die allgemeinen Attribut-Einstellungen verwendet:

* Name, Spaltenname, Beschreibung
* Varianten überschreiben


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe der Inhaltselemente.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular.
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur wenn "Frontend Editing" installiert ist).

.. note:: Das Attribut kann erst nach dem erstmaligen Speichern des Datensatzes
   mit Inhaltselementen befüllt werden.


Filterregeln
------------

Das Attribut unterstützt keine eigenen Filterregeln.


Sonderfunktionen
-----------------

**Speicherung**

Die Inhaltselemente werden in ``tl_content`` gespeichert — identisch zur
einsprachigen Variante, jedoch mit einem zusätzlichen Feld:

* ``pid`` – ID des MetaModels-Datensatzes
* ``ptable`` – Name der MetaModel-Tabelle
* ``mm_slot`` – Spaltenname des Attributs
* ``mm_lang`` – Sprachcode des Inhaltselements (z. B. ``de``, ``en``)

Die Abfrage der Inhaltselemente erfolgt sprachspezifisch. Fehlt für eine Sprache
ein Inhaltselement, wird automatisch auf die Fallback-Sprache zurückgegriffen.

**Backend-Widget**

Das Backend-Widget zeigt die Inhaltselemente der aktuell aktiven Backend-Sprache
an. Die Sprachauswahl wird über den ``setWidgetLanguage``-Event-Listener
automatisch an das Widget übergeben.

**Duplizieren von Datensätzen**

Wird ein MetaModels-Datensatz dupliziert, werden die zugeordneten Inhaltselemente
aller Sprachen mitkopiert. Beim Kopieren von einer Sprache in eine andere Sprache
ist ein Kopieren in dieselbe Sprache nicht möglich (Fehlerhinweis).

**Fallback-Sprache**

Fehlt für eine Sprache ein Inhaltselement-Set, werden automatisch die Inhalte
der Fallback-Sprache ausgegeben.


.. |br| raw:: html

   <br />
