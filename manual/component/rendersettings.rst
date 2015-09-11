.. _component_rendersettings:

|img_rendersettings| Rendereinstellungen
========================================

.. note:: Listenansichen für Backend und Frontend erstellen;
  Attribute hinzufügen und aktivieren

Einleitung
----------

Mit den "Rendereinstellungen" werden die grundlegenden Parameter für die Auflistung bzw.
Anzeige der einzugebenden bzw. auszugebenden Datensätze sowohl für das Backend als auch
für das Frontend - jeweils separat - festgelegt. Die einzelnen Datensätze, die in einem
MetaModel eingespeichert werden, werden auch als "Items" bezeichnet.

Im Backend müssen die Items zur weiteren Eingabe oder Änderung aufgelistet werden und
im Frontend für eine Anzeige bzw. Ausgabe. Auch wenn verschiedene Aspekte zwischen
Backenend und Frontend unterschiedlich sind, gleichen sich dennoch sehr viele Sachen,
so dass die Einstellungen in der Komponente "Rendereinstellungen" zusammengefasst sind.

Für das Backend benötigt jedes MetaModel eine Rendereinstellung, da nur über diese eine
Eingabemaske für die Dateneingabe und -änderung aufgerufen werden kann.

Für das Frontend sind nur bei den MetaModel Rendereinstellungen anzulegen, deren Items auch
als solche aufgelistet bzw. angezeigt werden sollen. MetaModel, welche über eine Relation
(Attribute "Auswahl" oder "Mehrfachauswahl") an ein anderen MetaModel angebunden sind,
benötigen somit nicht zwingend eine Rendereinstellung für das Frontend.

Neben unterschiedlichen Anforderungen für Backend und Frontend, können mit den
Rendereinstellungen auch weitere Anforderungen abgedeckt werden. Für jedes MetaModel
kann eine Vielzahl von unterschiedlichen Rendereinstellungen angelegt werden, um
zum Beispiel differenzierte Ausgaben zu erzeugen. So könnte eine Rendereinstellung
eine Liste mit grundlegenden Informationen aufbereiten und eine weitere Rendereinstellung
eine Detailausgabe (eine Detailausgabe ist "eine Liste mit einem Item"). Weiterhin
kann einzelnen Rendereinstellungen der Zugriff von Benutzer und/oder Mitgliedergruppen
über die :ref:`component_dca-combine` gewährt werden.

Ist eine Rendereinstellung erzeugt und die Grundeinstellungen eingetragen, muss
als weiterer Schritt die Attribute für die Einstellung aktiviert werden. Mehr dazu
unter dem Punkt "Ablauf". Als weitere Einstellungsmöglichkeit kann bei jedem 
Attribut in einer Rendereinstellung ein individuelles Template angewählt 
werden (wenn dies vorher angelegt wurde) und eine eigene CSS-Klasse
z.B. zur Hervorhebung im Backenend.

Optionen
--------

* **Name** |br|
  der Name kann frei gewählt werden; zur besseren Unterscheidung werden häufig die
  Kürzel "BE" und "FE" für Backend und Frontend vor den Namen gesetzt z.B.
  "BE Liste", "BE Erfassung" oder "FE Liste komplett"
* **Template** |br|
  an dieser Stelle wird ein Template ausgewählt, in dem alle Items in einer Schleife
  ausgebene werden; das Template ist sehr leicht in der Contao-üblichen Art übberschreibbar
  zu beachten ist lediglich, dass Templates für das Backend nicht in einem Template-
  Unterordner angelegt werden dürfen; dem Template werden alle Attribute im Typ "raw" und
  nur die aktiven Attribute im Typ "html" und "text" übergeben
* **Ausgabeformat** |br|
  mögliche Auswahl ist HTML5, XHTML und Text; sofern keine speziellen Anfroderungen bestehen,
  kann die Auswahl leer gelassen werden
* **Weiterleitungsseite** |br|
  die Weiterleitungsseite ist für die Frontendausgabe, um z.B. auf eine Detailseite zu verlinken;
  auf der Detailseite sollte ein Listenelemnt mit einem entsprechenden Filter vorhanden sein; bei
  mehrsprachingen MetaModel gibt es je Sprache eine einstellung für Link und Filter
* **Leere Einträge verbergen** |br|
  leere Einträge der Attribute werden übersprungen - wichtig im Zusammenspiel, wenn die 
  Label der Attribute mit ausgeben werden
* **Labels verbergen** |br|
  die Attributnamen werden als "Label" nicht ausgeben
* **Zusätzliche CSS/Javascript-Dateien** |br|
  zur Ausgabeformatierung und Interaktion können CSS- und/oder Javascript-Dateien mit ausgegeben
  werden

Ablauf
------

Eine neue Eingabe für die Rendereinstellung wird über "|img_new| Neu" geöffnet. Nachdem 
alle notwendigen Optionen eingetragen bzw. ausgewählt sind, wird die Einstellung gespeichert
und erscheint in der Liste der vorhandenen Rendereinstellungen eines Metamodels.

Neben dem "|img_edit| Stifticon" existiert das Icon für die "|img_rendersetting| Attributeinstellungen".
Mit Kick auf das Icon öffnet sich eine Auflistung mit den zu den Rendereinstellungen aktivierten
Attributen. Sind keine Attribute vorhanden, bzw. müssen welche hinzugefügt werden, kann das über
das Icon "|img_rendersettings_add| Alle hinzufügen" erfolgen - alternativ über "|img_new| Neu". 
Bei dem Weg über "Alle hinzufügen" muss zwei mal eine Bestätigung erfolgen.

Anschließend stehen die Attribute der Rendereinstellung zur Verfügung und müssen ggf. noch aktiviert
werden bzw. es müssen nur die aktiviert sein, die in der Listenansicht angezeigt werden sollen.

Bei den einzelnen Attributen kann das zu verwendende Template geändert und/oder eine spezielle
CSS-Klasse eingetragen werden ("|img_edit| Bearbeiten").


.. |img_rendersettings| image:: /_img/rendersettings.png
.. |img_rendersetting| image:: /_img/rendersetting.png
.. |img_rendersettings_add| image:: /_img/rendersettings_add.png
.. |img_new| image:: /_img/new.gif
.. |img_edit| image:: /_img/edit.gif

.. |br| raw:: html

   <br />

