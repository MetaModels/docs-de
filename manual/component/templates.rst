.. _component_templates:

Templates in MetaModels
========================

Für die Ein- und Ausgabe von Daten sowie die Filterung bietet MetaModels verschiedene Templates an. Alle Templates
können als eigene Templatevarianten angepasst und geladen werden.

Neben den hier aufgeführten Templates können einzelne Attribute oder Erweiterungen separate Templates mitbringen.


Frontend-Liste
--------------

Für die Ausgabe im Frontend steht eine dreistufige Hierarchie von Templates zur Verfügung.

Die **erste Stufe** sind die Templates der MetaModels-Liste als Content-Element ``ce_metamodel_list`` bzw. FE-Modul
``mod_metamodel_list``. Dieses Template dient als "Wrapper" für die Ausgabe und wird im jeweiligen Content-Element bzw.
FE-Modul ausgewählt. Hier ist als Standard die Listenausgabe und die Paginierung eingebunden.

Die **zweite Stufe** bildet das Template des Renderings ``metamodel_prerendered`` bzw. ``metamodel_unrendered`` - hier
werden in einer Schleife alle Datensätze ausgegeben. In dem Template werden üblicher Weise die meisten Anpassungen an
eine individuelle Ausgabe vorgenommen. Diese Templates werden bei den Einstellungen des Renderings ausgewählt.

.. note:: Das Standardtemplate ``metamodel_prerendered`` ist für die erste Ausgabe ausreichend und es werden alle bei
   den Rendersettings aktivierten Attribute ausgegeben. Für eine individuelle Ausgabe kann man sich ein eigenes
   Template auf der Basis von ``metamodel_prerendered_debug`` erstellen und sein HTML-Markup einfügen.

Die Ausgabe von vorgerenderten (prerendered) Ausgaben der Widgets macht die Ausgabe sehr einfach - das Rendern kostet
aber entsprechend Rechenzeit. Bei sehr vielen gleichzeitigen Ausgaben kann das zu Problemen mit der Serverbelastung
führen. Als Alternative kann man ungerenderte Ausgaben in der CE-Modul-MM-Liste aktivieren.

Dem Listentemplate kann man für FE-Ausgabe noch Parameter übergeben die z. B. für eine Steuerung eines Sliders oder
Übersetzungen usw. - siehe ":ref:`rst_cookbook_templates_fe_list_parameters`".

Die **dritte Stufe** bilden die Templates der Attribute ``mm_attr_<Attributstyp>``. Die Auswahl erfolgt bei den Rendersettings
in den einzelnen Attributen. Diese Templates werden eher dann modifiziert, wenn diese Anpassung auch bei verschiedenen
Rendersettings zum Tragen kommt - z. B. gibt es für das Attribut Datei ein Template als Ausgabe mit "ul" und eins als
"div". In den Attributseinstellungen der Rendersettings kann auch eine individuelle CSS-Klasse an das Template
übergeben werden.

In den Templates von MM können auch die Templates von Contao eingebunden werden um zum Beispiel beim Attribut Text
eine Ausgabe als You-Tube-ContentElement zu erhalten - siehe ":ref:`rst_cookbook_templates_fe_template_ce_elements`".

Für die Listen- und Attributstemplates ("Stufe zwei und drei") gibt es die **Templates in den Typen bzw. Extension**
``.text`` **und** ``.html5`` sowie immer gleichlautendem Dateinamen. Das Rendering als ``.text`` ist immer vorhanden und
wird in der Ausgabe im Knoten ``text`` als auch in ``raw`` verwendet. Ob auch ``.html5`` verwendet wird, hängt von den
Einstellungen des Rendersettings ab. Die Ausgabe kann durch die Wahl bei "Ausgabeformat" beeinflusst werden. Ist dort
keine Auswahl getroffen, wird die Standardausgabe der Webseite verwendet - im BE und FE üblicher Weise ``HTML5``. Es ist
aber auch möglich die Ausgabe auf ein entsprechendes Format festzulegen wie z. B. ``Text``.

Hat man ein individuelles Template als ``html5`` angelegt z. B. ``mm_attr_text_special.html5`` wird auch nach
``mm_attr_text_special.text`` gesucht - wird das nicht gefunden, kommt das Standardtemplate ``mm_attr_text.html5``
zum Einsatz. Die Anzeige bei eigenen html5-Templates kann man optimieren, indem man ein ein zugehöriges text-Template
anlegt - damit verkürzt sich die Suche nach einem passenden Template.

Möchte man die text-Templates im Backend bei Templates editierbar haben, sollten folgende Einträge in der eigenen
``tl_templates.php`` angelegt werden:

.. code-block:: php
   :linenos:

   <?php
   // contao/dca/tl_templates.php
   if (!empty($GLOBALS['TL_DCA']['tl_templates']['config']['validFileTypes'])) {
       $GLOBALS['TL_DCA']['tl_templates']['config']['validFileTypes'] .= ',text';
   }
   if (!empty($GLOBALS['TL_DCA']['tl_templates']['config']['editableFileTypes'])) {
       $GLOBALS['TL_DCA']['tl_templates']['config']['editableFileTypes'] .= ',text';
   }

Neben ``.text`` und ``.html5`` könnte es in Zukunft weitere Formate wie ``.json`` oder ``.xml`` geben - das Format
``.xhtml`` ist inzwischen nicht mehr dabei.

**Zusätzlich** gibt es ein Template für die Ausgabe der Paginierung ``mm_pagination`` und eins für die Action-Buttons
``mm_actionbutton``.


Frontend-Filterung
------------------

Für die Ausgabe der Frontendfilter gibt es ein "Wrapper-Template" als ``mm_filter_default`` welches beim CE bzw. FE-Modul
"MetaModels-Frontendfilter" gewählt wird. In dem Template wird das Formular gebaut sowie alle Einzelfilter in einer Schleife
ausgegeben.

Bei den Filterregeln kann man ein entsprechendes Template ``mm_filteritem_*`` aktivieren -  Standard ist
``mm_filteritem_default``. Statt "default" gibt es aber auch weitere vordefinierte Templates wie "..checkbox", "..linklist",
"..radiobuttons".

Bei den Filterregeln kann zudem eine individuelle Id oder CSS-Klassen übergeben werden.

Die Anpassung der Ausgabe des "MetaModel-Filterreset" ist mit dem Template ``mm_clearall_default`` möglich.


Backend-Liste
-------------

Im Backend kann die Ausgabe über die Einstellungen beim Rendersetting beeinflusst werden. In der Listendarstellung über
``metamodel_prerendered`` - aber nur wenn die Ausgabe nicht in Tabellenform erfolgt - sowie für die Attribute mit
``mm_attr_<Attributstyp>``.


Backend-Eingabemaske
--------------------

In den Attributseinstellungen der Eingabemaske können eigene Templates der Backend-Widgets geladen werden. Eine
Anpassung wäre auch über die Events des `DC_G <https://github.com/contao-community-alliance/dc-general/>`_ möglich.


Frontend-Editing (FEE)
----------------------

Zum Einblenden eines Links zum Erstellen eines neuen Datensatzes, gibt es für den "Listen-Wrapper" das Template
``ce_metamodel_list_edit`` bzw. ``mod_metamodel_list_edit``.

Auf der Seite für die Anzeige der FEE-Eingabemaske gibt es als "Wrapper-Template" ``ce_metamodel_frontend_edit`` bzw.
``mod_metamodel_frontend_edit``. Das Template gibt alle Eingabewidgets aus und beinhaltet ein JavaScript-Snippet für
die :ref:`Ansichtsbedingungen <mm_special_visibility-conditions>` - die Templates gibt es auch ohne JavaScript als
``*_nojs``.

Eine Anpassung der Eingabewidgets kann bei den Attributen in den Rendersettings erfolgen - es ist zu beachten, dass hier
keine BE-Widgets sondern (FE) Formular-Widgets anzulegen und auszuwählen sind.

.. |br| raw:: html

   <br />
