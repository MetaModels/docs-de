.. _component_dca:

|img_dca| Eingabemasken
=========================

.. note:: Eingabemasken für Dateneingabe erstellen;
  Attribute hinzufügen, aktivieren und konfigurieren; Definition
  von Sortier- und Gruppieroptionen der gespeicherten Items
  möglich

Einleitung
----------

Zum Befüllen der Datenbank aus dem Backend sind Eingabemasken notwendig. Jede
Eingabemaske kann die je MetaModel definierten Attribute als Eingabeelemente
aufnehmen.

Für jedes MetaModel kann eine oder auch mehrere unterschiedliche Eingabemasken
erstellt werden, die mit unterschiedlichen Attribut-Eingabefeldern bestückt sind.
Damit können verschiedene Berechtigungen oder Workflows abgedeckt werden.

Die Erstellung der Eingabemasken teilt sich auch hier in die Grundeinstellungen
der Eingabemaske, der Aktivierung der Attribute sowie der Auswahl der spezifishen
Optionen der einzelnen Attribute wie z.B. Pflichtfeld, Anordung, Validierung o.ä.
Die meisten Einstellungsoptionen spiegeln die Möglichkeiten des "DCA" des
"Contao-Frameworks" wieder (siehe `DCA <https://docs.contao.org/books/api/dca/index.html>`_)
Mehr zu den Optionen unter dem Punkt "Ablauf".

Eines der wichtigsten Punkte bei den Grundeinstellungen ist die Auswahl der
Option "Integration" mit den Möglichkeiten "Unabhängig" oder "Kind-Tabelle".
Mit "Unabhängig" wird die Eingabemaske in einem der Navigationsblöcke in Contao
eingegliedert und mit "Kind-Tabelle" einer vorhandenen MetaModel- oder
Contao-Tabelle zugeordnet.

Für jede Eingabemaske kann man ein oder mehrere Sortier- und Gruppieroptionen für
eine übersichtliche Darstellung der gespeicherten Items definieren.


Optionen der Eingabemaske
-------------------------

Optionen der Eingabewidgets
---------------------------
* **Typ**: |br|
  Legende: 
  Attribut:
* ** Anzeigeoptionen** |br|

Optionen der Sortierung und Gruppierung
---------------------------------------
* **Name**: |br|
  Bezeichnung
* **Enable manual sorting**: |br|
  wenn der Wert gesezt ist, können die Items manuell sortiert werden; ist
  die Checkbox nicht gesetzt, können folgende Optionen gesetzt werden:
* **Grouping attribute**: |br|
  Auswahl des Attributes, nach dem Gruppiert werden soll
* **Grouping type**: |br|
  Gruppierungstyp wie nach Anfangsbuchstabe oder auch nach Zeitraum wie Woche,
  Monat
* **rendersortattr**: |br|
  ???
* **rendersort**: |br|
  Sortierrichtung: Aufsteigend (ASC) oder Absteigend (DESC)

Ablauf
------

Eine neue Eingabe für die Einstellung der Eingabemaske wird über "|img_new| Neue Eingabemaske"
geöffnet. Nachdem alle notwendigen Optionen eingetragen bzw. ausgewählt sind, wird
die Einstellung gespeichert und erscheint in der Liste der vorhandenen Eingabemasken
eines Metamodels.

Neben dem "|img_edit| Stifticon" existiert das Icon für die "|img_dca_setting| Einstellungen der
Eingabemaske". Mit Kick auf das Icon öffnet sich eine Auflistung mit den zur Eingabemaske
aktivierten Attributen. Sind keine Attribute vorhanden, bzw. müssen welche hinzugefügt
werden, kann das über das Icon "|img_dca_setting_add| Alle hinzufügen" erfolgen
- alternativ über "|img_new| Neu". Bei dem Weg über "Alle hinzufügen"
muss zwei mal eine Bestätigung erfolgen.

Anschließend stehen die Attribute der Eingabemaske zur Verfügung und müssen ggf.
noch aktiviert werden.

Bei den einzelnen Attributen kann das zu verwendende Template geändert und/oder
eine spezielle CSS-Klasse eingetragen werden ("|img_edit| Bearbeiten").

Anschließend können in der Listenansicht der Eingabemasken über das Icon
"|img_dca_groupsortsettings| Sortierung und Gruppierung" verschiedene Einträge
für die Sortierung und Gruppierung der gespeicherten Items angelegt werden.


.. |img_dca| image:: /_img/dca.png
.. |img_dca_setting| image:: /_img/dca_setting.png
.. |img_dca_setting_add| image:: /_img/dca.png
.. |img_dca_groupsortsettings| image:: /_img/dca_groupsortsettings.png
.. |img_new| image:: /_img/new.gif
.. |img_edit| image:: /_img/edit.gif

.. |br| raw:: html

   <br />