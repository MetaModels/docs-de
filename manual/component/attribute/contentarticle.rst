.. _component_attribute_contentarticle:

|svg_attr_contentarticle_22| Inhalt eines Artikels
==================================================

Das Attribut "Inhalt eines Artikels" ermöglicht es, einem MetaModels-Datensatz
Contao-Inhaltselemente (Content Elements) zuzuordnen — analog zu den Inhaltselementen
eines Contao-Artikels. Die Inhalte werden in der Contao-Tabelle ``tl_content``
gespeichert und über ein eigenes Backend-Widget verwaltet.

Typische Einsatzbereiche:

* Produktbeschreibungen mit komplexem Inhaltslayout (Text, Bilder, Tabellen)
* Detailseiten mit redaktionell aufbereitetem Inhalt pro Item
* Mehrere Inhaltsbereiche pro Datensatz (z. B. Hauptinhalt + Sidebar)

Im Backend erscheint ein Widget, das eine Liste der zugeordneten Inhaltselemente
anzeigt und einen direkten Link zur Inhaltsverwaltung bietet.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedcontentarticle` zur Verfügung.

.. seealso:: Dieses Attribut wird von der :ref:`File-Usage Integration <rst_extended_file-usage>`
   unterstützt. Damit lässt sich in der Contao-Dateiverwaltung anzeigen, ob und wo eine Datei
   eingebunden ist.

.. seealso:: Die Ausgabe von MetaModels-Listen und -Filtern im Frontend ist auf der Seite
   :ref:`component_contentelements` beschrieben.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_contentarticle


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

.. note:: Das Attribut kann erst nach dem erstmaligen Speichern des Datensatzes
   mit Inhaltselementen befüllt werden. Solange der Datensatz noch nicht gespeichert
   ist, erscheint eine entsprechende Hinweismeldung.


Filterregeln
------------

Das Attribut "Inhalt eines Artikels" unterstützt keine eigenen Filterregeln —
Inhaltselemente können nicht als Filterkriterium im Frontend genutzt werden.


Sonderfunktionen
-----------------

**Speicherung**

Die Inhaltselemente werden **nicht** in der MetaModel-Tabelle gespeichert, sondern
als reguläre Contao-Inhaltselemente in ``tl_content`` mit folgenden Verknüpfungsfeldern:

* ``pid`` – ID des MetaModels-Datensatzes
* ``ptable`` – Name der MetaModel-Tabelle (z. B. ``mm_produkte``)
* ``mm_slot`` – Spaltenname des Attributs (ermöglicht mehrere Artikel-Attribute pro MM)

Die Inhaltselemente werden über ``ContentModel::findPublishedByPidAndTable()``
abgerufen und mit ``Controller::getContentElement()`` gerendert.

**Backend-Widget**

Im Backend-Formular zeigt das Widget eine Liste der vorhandenen Inhaltselemente
mit Typ und Sichtbarkeitsstatus an. Ein Link führt direkt zur Verwaltungsoberfläche
der Inhaltselemente. AJAX-Anfragen werden direkt im Widget-Container aktualisiert.

**Duplizieren von Datensätzen**

Wird ein MetaModels-Datensatz dupliziert oder eingefügt (Paste), werden die
zugeordneten Inhaltselemente automatisch mitkopiert. MetaModels erkennt dabei
alle ``contentarticle``-Attribute und erstellt Kopien der ``tl_content``-Einträge
mit dem neuen ``pid``-Wert.

**Rekursionsschutz**

Die Erweiterung enthält einen Rekursionsschutz, um Endlosschleifen zu verhindern,
falls Inhaltselemente selbst MetaModels-Inhalte referenzieren.


.. |svg_attr_contentarticle_22| image:: /_img/icons_svg/article.svg
   :width: 22px
.. |br| raw:: html

   <br />
