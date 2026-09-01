.. _component_rendersettings:

|svg_rendersettings_32| |img_rendersettings_32| Render-Einstellungen
====================================================================

.. note:: Listenansichten für Backend und Frontend erstellen;
  Attribute hinzufügen und aktivieren

Einleitung
----------

Mit den "Render-Einstellungen" werden die grundlegenden Parameter für die Auflistung bzw.
Anzeige der einzugebenden bzw. auszugebenden Datensätze sowohl für das Backend als auch
für das Frontend - jeweils separat - festgelegt. Die einzelnen Datensätze, die in einem
MetaModel eingespeichert werden, werden auch als "Items" bezeichnet.

Im Backend müssen die Items zur weiteren Eingabe oder Änderung aufgelistet werden und
im Frontend für eine Anzeige bzw. Ausgabe. Auch wenn verschiedene Aspekte zwischen
Backend und Frontend unterschiedlich sind, gleichen sich dennoch sehr viele Sachen,
so dass die Einstellungen in der Komponente "Render-Einstellungen" zusammengefasst sind.

Für das Backend benötigt jedes MetaModel eine Render-Einstellung, da nur über diese eine
Eingabemaske für die Dateneingabe und -änderung aufgerufen werden kann.

Für das Frontend sind nur bei den MetaModel Render-Einstellungen anzulegen, deren Items auch
als solche aufgelistet bzw. angezeigt werden sollen. MetaModel, welche über eine Relation
(Attribute "Auswahl" oder "Mehrfachauswahl") an ein anderen MetaModel angebunden sind,
benötigen somit nicht zwingend eine Render-Einstellung für das Frontend.

Neben unterschiedlichen Anforderungen für Backend und Frontend, können mit den
Render-Einstellungen auch weitere Anforderungen abgedeckt werden. Für jedes MetaModel
kann eine Vielzahl von unterschiedlichen Render-Einstellungen angelegt werden, um
zum Beispiel differenzierte Ausgaben zu erzeugen. So könnte eine Render-Einstellung
eine Liste mit grundlegenden Informationen aufbereiten und eine weitere Render-Einstellung
eine Detailausgabe (eine Detailausgabe ist "eine Liste mit einem Item"). Weiterhin
kann einzelnen Render-Einstellungen der Zugriff von Benutzer und/oder Mitgliedergruppen
über die :ref:`component_dca-combine` gewährt werden.

Ist eine Render-Einstellung erzeugt und sind die Grundeinstellungen eingetragen, müssen
als weiterer Schritt die Attribute für die Einstellung aktiviert werden. Mehr dazu
unter dem Punkt "Ablauf". Als weitere Einstellungsmöglichkeit kann bei jedem
Attribut in einer Render-Einstellung ein individuelles Template angewählt
werden (wenn dies vorher angelegt wurde) und eine eigene CSS-Klasse
z.B. zur Hervorhebung im Backend.

Optionen
--------

* **Name** |br|
  der Name kann frei gewählt werden; zur besseren Unterscheidung werden häufig die
  Kürzel "BE" und "FE" für Backend und Frontend vor den Namen gesetzt z.B.
  "BE Liste", "BE Erfassung" oder "FE Liste komplett"
* **Template** |br|
  an dieser Stelle wird ein Template ausgewählt, in dem alle Items in einer Schleife
  ausgegeben werden; das Template ist sehr leicht in der Contao-üblichen Art überschreibbar
  zu beachten ist lediglich, dass Templates für das Backend nicht in einem Template-
  Unterordner angelegt werden dürfen; dem Template werden alle Attribute im Typ "raw" und
  nur die aktiven Attribute im Typ "html" und "text" übergeben
* **Ausgabeformat** |br|
  mögliche Auswahl ist HTML5 und Text; sofern keine speziellen Anforderungen bestehen,
  kann die Auswahl leer gelassen werden; das Format XHTML wird mit MM 2.2 nicht mehr
  unterstützt
* **Weiterleitungsseite** |br|
  die Weiterleitungsseite mit Seitenauswahl und Filter ist nur für die Frontendausgabe, um
  z.B. auf eine Detailseite zu verlinken; auf der Detailseite sollte ein Listenelement mit
  einem entsprechenden Filter vorhanden sein; bei mehrsprachigen MetaModel gibt es je 
  Sprache eine Einstellung für Seitenauswahl und Filter
* **Leere Einträge verbergen** |br|
  leere Einträge der Attribute werden übersprungen - wichtig im Zusammenspiel, wenn die
  Label der Attribute mit ausgegeben werden
* **Labels verbergen** |br|
  die Attributnamen werden als "Label" nicht ausgegeben
* **Attribute nur bei Bedarf rendern [Lazy] (ab MM 2.5)** |br|
  ein Attribut wird erst gerendert, wenn das Template tatsächlich darauf zugreift, statt wie
  bisher sofort beide Ausgabeformate (HTML5 und Text) für jedes Attribut zu erzeugen; lohnt sich,
  wenn ein Template nur einen Teil der Attribute oder konsequent nur ein Ausgabeformat nutzt -
  greift ein Template dagegen auf alle Attribute in beiden Formaten zu, bringt die Option keinen
  Vorteil und kann einen kleinen Mehraufwand bedeuten; Standard ist aus, je Render-Einstellung
  passend zum verwendeten Template wählbar
* **Wrapper im Listen-Template [Altverhalten, Deprecated] (ab MM 2.5)** |br|
  gibt den umschließenden Block (Feld, Label, Wert) wie bis MM 2.4 im Listen-Template aus statt -
  wie ab 2.5 üblich - in den Attribut-Templates selbst; bei bestehenden Render-Einstellungen beim
  Upgrade automatisch aktiviert, damit sich an der Ausgabe nichts ändert, neu angelegte
  Render-Einstellungen starten ohne die Option; von Anfang an als Altverhalten markiert und
  entfällt in MetaModels 3.0 - Muster und Beispiel für eigene Attribut-Templates unter
  :ref:`component_templates_attribute-wrapper`
* **Zusätzliche CSS/Javascript-Dateien** |br|
  zur Ausgabeformatierung und Interaktion können CSS- und/oder Javascript-Dateien mit in
  der Liste ausgegeben werden; die Einbindung erfolgt aber nur, wenn mindestens ein Item
  in der Liste ausgegeben wird


Ablauf
------

Eine neue Eingabe für die Render-Einstellung wird über "|img_new| Neu" geöffnet. Nachdem
alle notwendigen Optionen eingetragen bzw. ausgewählt sind, wird die Einstellung gespeichert
und erscheint in der Liste der vorhandenen Render-Einstellungen eines MetaModels.

Neben dem "|img_edit| Stifticon" existiert das Icon für die "|img_rendersetting| Render-Einstellungen der Attribute".
Mit Klick auf das Icon öffnet sich eine Auflistung mit den zu den Render-Einstellungen aktivierten
Attributen. Sind keine Attribute vorhanden, bzw. müssen welche hinzugefügt werden, kann das über
das Icon "|img_rendersettings_add| Alle hinzufügen" erfolgen - alternativ über "|img_new| Neu".
Bei dem Weg über "Alle hinzufügen" muss zweimal eine Bestätigung erfolgen.

Anschließend stehen die Attribute der Render-Einstellung zur Verfügung und müssen ggf. noch aktiviert
werden bzw. es müssen nur die aktiviert sein, die in der Listenansicht angezeigt werden sollen.

Bei den einzelnen Attributen kann das zu verwendende Template geändert und/oder eine spezielle
CSS-Klasse eingetragen werden ("|img_edit| Bearbeiten").


Hinweise zu Attribute nur bei Bedarf rendern [Lazy] (ab MM 2.5)
---------------------------------------------------------------

Ohne diese Option rendert MetaModels beim Aufbau einer Liste für **jedes** aktivierte Attribut
**beide** Ausgabeformate - sowohl das angeforderte Format (in der Regel HTML5) als auch den
Text-Wert - unabhängig davon, ob das Listentemplate am Ende überhaupt beide oder auch nur eines
davon ausgibt. Bei einer Vielzahl von Attributen und Datensätzen kostet das spürbar Zeit, die für
nie verwendete Werte draufgeht.

Ist die Option aktiviert, bekommt das Template stattdessen für jedes Format einen eigenen
Platzhalter, der ein Attribut erst dann tatsächlich rendert, wenn im Template konkret darauf
zugegriffen wird - und zwar je Format unabhängig: Greift das Template nur auf ``html5`` zu, wird
``text`` für dieses Attribut gar nicht erst berechnet, und umgekehrt. Für die Template-Autoren
ändert sich an der Verwendung nichts, der Zugriff auf ``html5``, ``text``, ``raw`` und
``attributes`` funktioniert wie gewohnt.

**Wann sich das lohnt:** Die Option hilft immer dann, wenn ein Template nicht ohnehin auf alle
aktivierten Attribute in beiden Formaten zugreift - etwa weil nur ein Teil der Attribute
tatsächlich ausgegeben wird, oder weil das Template konsequent nur ein Format nutzt (z. B. nur
``text`` für einen Suchindex, oder nur ``html5`` für die sichtbare Ausgabe). Greift ein Template
dagegen ohnehin auf alle Attribute in beiden Formaten zu, bringt Lazy keinen Vorteil und kann durch
den etwas teureren, allgemeinen Zugriff sogar minimal langsamer sein. Es gibt also kein
grundsätzlich "besseres" Verhalten - deshalb ist die Option je Render-Einstellung passend zum
verwendeten Template ein- oder auszuschalten, und der Standard ist für neue wie bestehende
Render-Einstellungen gleichermaßen aus.

**Messwerte:** Zur Einordnung wurden auf einer echten Testseite mit 13 bzw. 208 Items und 25
konfigurierten Attributen mehrere Szenarien gemessen (reine CPU-Zeit statt Wanduhrzeit, um
Systemlast auf dem Messrechner herauszurechnen; jeweils mehrfach reproduziert):

================================================  ==================  ==================
Szenario                                          13 Items            208 Items
================================================  ==================  ==================
Alle Attribute, beide Formate genutzt             kein Unterschied    kein Unterschied
Alle Attribute, nur HTML5 genutzt                 14-20 % schneller   10-11 % schneller
Alle Attribute, nur Text genutzt                  63-69 % schneller   70-71 % schneller
Nur 3 von 25 Attributen genutzt                   37-45 % schneller   36-43 % schneller
================================================  ==================  ==================

Der Effekt ist bei reiner Text-Nutzung am größten, weil das HTML5-Rendering pro Attribut spürbar
mehr Aufwand macht als die reine Textausgabe - wird es durch Lazy komplett übersprungen, fällt das
entsprechend stark ins Gewicht.

.. seealso:: :ref:`rst_cookbook_rendering_encrypt-email`


.. |svg_rendersettings_32| image:: /_img/icons_svg/rendersettings.svg
   :width: 32px
.. |img_rendersettings_32| image:: /_img/icons/rendersettings_32.png
.. |img_rendersettings| image:: /_img/icons/rendersettings.png
.. |img_rendersetting| image:: /_img/icons/rendersetting.png
.. |img_rendersettings_add| image:: /_img/icons/rendersettings_add.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_edit| image:: /_img/icons/edit.gif

.. |br| raw:: html

   <br />
