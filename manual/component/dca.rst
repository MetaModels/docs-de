.. _component_dca:

|img_dca_32| Eingabemasken
==========================

.. note:: Eingabemasken für Dateneingabe erstellen;
  Attribute hinzufügen, aktivieren und konfigurieren; optional
  Anzeigebedingung des Eingabefeldes definieren; Definition
  von Gruppierung und Sortierung der gespeicherten
  Items möglich

Einleitung
----------

Zum Befüllen der Datenbank aus dem Backend sind Eingabemasken notwendig. Jede
Eingabemaske kann die je MetaModel definierten Attribute als Eingabeelemente
aufnehmen.

Für jedes MetaModel kann eine oder auch mehrere unterschiedliche Eingabemasken
erstellt werden, die mit unterschiedlichen Attribut-Eingabefeldern bestückt sind.
Damit können verschiedene Berechtigungen oder Workflows abgedeckt werden.

Die Erstellung der Eingabemasken teilt sich auch hier in die Grundeinstellungen
der Eingabemaske, der Aktivierung der Attribute sowie der Auswahl der spezifischen
Optionen der einzelnen Attribute wie z.B. Pflichtfeld, Anordnung, Validierung o.ä.
Die meisten Einstellungsoptionen spiegeln die Möglichkeiten des "DCA" des
"Contao-Frameworks" wieder (siehe `DCA <https://docs.contao.org/books/api/dca/index.html>`_)
Mehr zu den Optionen unter dem Punkt "Ablauf".

Eines der wichtigsten Punkte bei den Grundeinstellungen ist die Auswahl der
Option "Integration" mit den Möglichkeiten "Unabhängig" oder "Kind-Tabelle".
Mit "Unabhängig" wird die Eingabemaske in einem der Navigationsblöcke in Contao
eingegliedert und mit "Kind-Tabelle" einer vorhandenen MetaModel- oder
Contao-Tabelle zugeordnet.

Bei der Auswahl "Kind-Tabelle" ist zu beachten, dass der "Render-Modus" auf die Einstellung
"Elternelement vorhanden" gestellt werden muss, sofern eine eindeutige Zuordnung von Kind-
Items zu einem Elternitem erfolgen soll. Anderenfalls sind alle Kindelitems bei
allen Elternitems aufgelistet.

Die Anzeige des Eingabefeldes kann über weitere Steuerungsparameter beeinflusst
werden. Jede Rendereinstellungen hat ein Bearbeitungsicon zur Erstellung von Abhängigkeiten
der Anzeige bzw. Sichtbarkeit ("Ansichtsbedingungen"). So kann ein oder mehrere
Eingabefelder in der Eingabemaske nur sichtbar sein, wenn z.B. eine bestimmte
Checkbox gesetzt ist.

Für jede Eingabemaske kann man ein oder mehrere Gruppierungen und Sortierungen für
eine übersichtliche Darstellung der gespeicherten Items definieren.

Möchte man die Anzeige der Items in der Listenansicht als Baumstruktur bzw. Hierarchie,
sind zwei grundlegende Einstellungen notwendig:

* in Eigenschaften der Eingabemaske den "Render-Modus" auf "Hierarchie" (Tabellenansicht aus)
* in Sortierung Eingabemaske eine Sortierung als Standard mit "Manuelle Sortierung aktivieren"



Optionen der Eingabemaske
-------------------------
* **Name**: |br|
  Bezeichnung
* **Panel-Layout**: |br|
  Konfiguration der Tools in der Kopfzeile: Suche, Sortieren, Filtern, Limit;
  für Suche und Filterung der Attribute muss die Option bei den Eingabewidgets
  gesetzt sein
* **Integration**: |br|
  "Unabhängig" mit Auswahl des Backendbereiches; "Als Kind-Tabelle" mit Auswahl
  der Eltern-Tabelle
* **Render-Modus**: |br|
  Ausgabemodus der Auflistung als "Eine Ebene (ohne Hierarchie)" oder "Hierarchie"
  bzw. bei Kind-Tabellen zusätzlich auch als "Elternelement vorhanden"
* **Anzeige in Tabellenform**: |br|
  Option zur Anzeige der Attribute als Tabelle
* **Bearbeitung/Erstellen/Löschen erlauben**: |br|
  Freigabe zum Ändern, Erstellen, Löschen von Eingaben

Optionen der Eingabefeldes
--------------------------
* **Typ**: |br|
  Legende: Unterteilung des Eingabepanels ("Grüne Linie") |br|
  Attribut: Anzeige der Attributoptionen
* **Funktionsbezogene Einstellungen**: |br|
  Aktivierung von "nur lesen" oder "Pflichtfeld" |br|
  weitere Optionen je nach Attributtyp
* **Anzeigeoptionen**: |br|
  Angabe der Contao-CSS-Backendklassen z.B. "w50" für eine 50%-Breite

Optionen der Anzeigebedingungen des Eingabewidgets
--------------------------------------------------
* **Typ**: |br|
  Typ der Anzeigebedingungen: UND/ODER/NOT zur Verknüpfung bzw.
  Abhängigkeit per Eigenschaft von anderen Attributen
* **Attribut/Wert** |br|
  Auswahl bei Abhängigkeit zu einem anderen Attribut

Optionen der Gruppierung und Sortierung
---------------------------------------
* **Name**: |br|
  Bezeichnung
* **Manuelle Sortierung aktivieren**: |br|
  wenn der Wert gesetzt ist, können die Items manuell sortiert werden; ist
  die Checkbox nicht gesetzt, können folgende Optionen gesetzt werden:
* **Attribut der Gruppierung**: |br|
  Auswahl des Attributes, nach dem Gruppiert werden soll
* **Gruppierungslänge**: |br|
  Die Anzahl an Buchstaben, welche für die Gruppierung eingesetzt wird
  (wenn Gruppierungstyp gesetzt)
* **Gruppierungstyp**: |br|
  Gruppierungstyp wie nach Anfangsbuchstabe oder auch nach Zeitraum wie Woche,
  Monat
* **Sorting attribute**: |br|
  Auswahl des Attributes, nach dem Sortiert werden soll (ggf. innerhalb einer
  Gruppierung)
* **Sorting direction**: |br|
  Sortierrichtung: Aufsteigend (ASC) oder Absteigend (DESC)

Ablauf
------

Eine neue Eingabe für die Einstellung der Eingabemaske wird über "|img_new| Neue Eingabemaske"
geöffnet. Nachdem alle notwendigen Optionen eingetragen bzw. ausgewählt sind, wird
die Einstellung gespeichert und erscheint in der Liste der vorhandenen Eingabemasken
eines MetaModels.

Neben dem "|img_edit| Stifticon" existiert das Icon für die "|img_dca_setting| Einstellungen der
Eingabemaske". Mit Kick auf das Icon öffnet sich eine Auflistung mit den zur Eingabemaske
aktivierten Attributen. Sind keine Attribute vorhanden, bzw. müssen welche hinzugefügt
werden, kann das über das Icon "|img_dca_setting_add| Alle hinzufügen" erfolgen
- alternativ über "|img_new| Neu". Bei dem Weg über "Alle hinzufügen"
muss zweimal eine Bestätigung erfolgen.

Anschließend stehen die Attribute der Eingabemaske zur Verfügung und müssen ggf.
noch aktiviert werden.

Bei den einzelnen Attributen kann das zu verwendende Template geändert und/oder
eine spezielle CSS-Klasse eingetragen werden ("|img_edit| Bearbeiten").

Über "|img_dca_condition| Anzeigebedingungen" ist die Sichtbarkeit des Eingabewidgets
in der Eingabemaske einstellbar.

Anschließend können in der Listenansicht der Eingabemasken über das Icon
"|img_dca_groupsortsettings| Sortierung und Gruppierung" verschiedene Einträge
für die Sortierung und Gruppierung der gespeicherten Items angelegt werden.


.. |img_dca_32| image:: /_img/icons/dca_32.png
.. |img_dca| image:: /_img/icons/dca.png
.. |img_dca_setting| image:: /_img/icons/dca_setting.png
.. |img_dca_setting_add| image:: /_img/icons/dca.png
.. |img_dca_groupsortsettings| image:: /_img/icons/dca_groupsortsettings.png
.. |img_dca_condition| image:: /_img/icons/dca_condition.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_edit| image:: /_img/icons/edit.gif

.. |br| raw:: html

   <br />
