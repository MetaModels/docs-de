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

Die **dritte Stufe** bilden die Templates der Attribute ``mm_attr_<Attributstyp>``. Die Auswahl erfolgt bei den Rendersettings
in den einzelnen Attributen. Diese Templates werden eher dann modifiziert, wenn diese Anpassung auch bei verschiedenen
Rendersettings zum Tragen kommt - z. B. gibt es für das Attribut Datei ein Template als Ausgabe mit "ul" und eins als
"div". In den Attributseinstellungen der Rendersettings kann auch eine individuelle CSS-Klasse an das Template
übergeben werden.

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
