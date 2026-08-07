.. _component_templates:

Templates in MetaModels
========================

Für die Ein- und Ausgabe von Daten sowie die Filterung bietet MetaModels verschiedene Templates an. Alle Templates
können als eigene Templatevarianten angepasst und geladen werden.

Neben den hier aufgeführten Templates können einzelne Attribute oder Erweiterungen separate Templates mitbringen.


.. _component_templates_twig:
Twig-Templates (ab MetaModels 2.5)
----------------------------------

Ab MetaModels 2.5 kann jedes der unten beschriebenen Templates zusätzlich als **Twig-Template**
(``.html.twig``) bereitgestellt werden. Existiert eine Twig-Variante, hat sie **Vorrang** vor dem
klassischen ``.html5`` (Frontend und Backend, nur für die HTML-Ausgabe - das ``.text``-Format bleibt
auf der bisherigen Engine). Fehlt die Twig-Variante, wird unverändert das ``.html5`` verwendet.

Namensschema:

* Das MetaModels-eigene Rendering (Listen-/Item- und Attribut-Templates sowie die Filter-Widgets) liegt
  im Contao-Namespace ``@Contao`` unter der Untergruppe ``metamodels/``:

  * Item/Liste ``metamodel_prerendered`` → ``@Contao/metamodels/item/prerendered.html.twig``
  * Attribut ``mm_attr_text`` → ``@Contao/metamodels/attribute/text.html.twig``
  * Filter-Widget ``mm_filteritem_default`` → ``@Contao/metamodels/filter/default.html.twig``

* Die Contao-Inhaltselement-/Modul-Wrapper behalten ihren flachen Namen im ``@Contao``-Namespace, z. B.
  ``@Contao/ce_metamodel_list.html.twig``, ``@Contao/mm_filter_default.html.twig``,
  ``@Contao/mm_clearall_default.html.twig``, ``@Contao/mm_pagination.html.twig`` sowie das separate
  ``@Contao/mm_actionbutton.html.twig`` (die Listen-Templates binden es per ``include`` ein, sodass
  eigene Action-Button-Templates es weiterhin überschreiben können).

In den Twig-Templates stehen dieselben Variablen wie im ``.html5`` zur Verfügung (z. B. ``{{ raw }}``,
``{{ data }}``, ``{{ additional_class }}``). Attributstemplates bekommen ab MM 2.5 zusätzlich ``{{ label }}``,
``{{ colName }}``, ``{{ hideLabels }}`` und ``{{ legacyAttributeWrapper }}`` - siehe
:ref:`component_templates_attribute-wrapper`. Weil die Templates im gemanagten ``@Contao``-Namespace
liegen, sind sie im **Template Studio** von Contao bearbeitbar und über Theme-Ordner sowie das
Projekt-``templates/``-Verzeichnis überschreibbar. Ein bestehendes Override am flachen ``.html5``-Namen
(z. B. ``templates/metamodel_prerendered.html5``) behält übergangsweise Vorrang - diese Rücksichtnahme
entfällt in MetaModels 3.0.

Eigene Twig-Templates eines Pakets liegen - wie in Contaos Bundles - unter einem Namespace-Root
(Ordner ``twig/`` mit leerer Marker-Datei ``.twig-root``); im Projekt genügt der Ordner ``templates/``.

Siehe auch :ref:`new_in_mm250`.


.. _component_templates_fe-list:
Frontend-Liste
--------------

Für die Ausgabe im Frontend steht eine dreistufige Hierarchie von Templates zur Verfügung.

Die **erste Stufe** sind die Templates der MetaModels-Liste als Content-Element ``ce_metamodel_list`` bzw. FE-Modul
``mod_metamodel_list``. Dieses Template dient als "Wrapper" für die Ausgabe und wird im jeweiligen Content-Element bzw.
FE-Modul ausgewählt. Hier ist als Standard die Listenausgabe ("zweite Stufe") und die Paginierung eingebunden.

Die **zweite Stufe** bildet das Template des Renderings ``metamodel_prerendered`` bzw. ``metamodel_unrendered`` - hier
werden in einer Schleife alle Datensätze ausgegeben. In dem Template werden üblicher Weise die meisten Anpassungen an
eine individuelle Ausgabe vorgenommen. Diese Templates werden bei den Einstellungen des Renderings ausgewählt.

.. note:: Das Standardtemplate ``metamodel_prerendered`` ist für die erste Ausgabe ausreichend und es werden alle bei
   den Rendersettings aktivierten Attribute ausgegeben. Für eine individuelle Ausgabe kann man sich ein eigenes
   Template auf der Basis von ``metamodel_prerendered_debug`` erstellen und sein HTML-Markup einfügen.

Im Template kann man auf verschiedene Daten zugreifen - z. B.

* ``$this->total``: :ref:`gesamte Anzahl der Items <rst_cookbook_frontend_output-item-count>`
* ``$this->data``: Array mit allen Datensätzen (s. u.)
* ``$this->generateSortingLink``: :ref:`Links für die Umschaltung der Sortierung <rst_cookbook_templates_fe_list_sorting>`
* ``$this->renderSortingLink``: :ref:`Links für die Umschaltung der Sortierung <rst_cookbook_templates_fe_list_sorting>`
* ``$this->filterParams``: wenn die Liste gefiltert wird, hat man hier Zugriff auf die Filterdaten
* ``$this->parameter``: :ref:`rst_cookbook_templates_fe_list_parameters`

Für die Ausgabe der Datensätze wird im Template eine Schleife über die Daten von ``foreach ($this->data as $item)``
eingebaut. In jedem ``$item`` hat man Zugriff auf die folgenden Knoten des Arrays eines Datensatzes:

* ``$this->raw``: Rohdaten des Datensatzes inkl. die Systemspalten wie ``id``, ``tstamp`` usw., Zahlenwerte wie auch das
  Datum werden hier wie in der DB gespeichert ausgegeben; bei Relations-Attributen hat man hier die Möglichkeit, weiter
  auf den verknüpften Datensatz zuzugreifen (siehe ":ref:`component_relations_standard-relations`"); bei Dateien hat man
  Zugriff auf die Meta-Daten, Pfadangaben, UUID; usw.
* ``$this->text``: Liste mit Ausgabe in der Text-Repräsentation (Template aus "dritte Stufe")
* ``$this->html5``: Liste mit Ausgabe in der HTML-Repräsentation (Template aus "dritte Stufe")
* ``$this->attributes``: Liste mit Ausgabe des Wertes "Name" aus der Konfiguration des jeweiligen Attributes (:ref:`bei
  Mehrsprachigkeit in entsprechender Übersetzung <component_multi-language_attribute>`)
* ``$this->actions``: Knoten ``jumpTo`` mit Link aus den Rendersettings - meist Link zur Detailseite; es können aber
  auch weitere Angaben z. B. aus der :ref:`Merkliste <rst_extended_notelist>` vorhanden sein.
* ``$this->jumpTo``: Knoten ist deprecated - Knoten ``$this->actions`` verwenden
* weitere Knoten z. B. aus der :ref:`Merkliste <rst_extended_notelist>`

Die Ausgabe von vorgerenderten (prerendered) Ausgaben der Widgets macht die Ausgabe sehr einfach - das Rendern kostet
aber entsprechend Rechenzeit. Bei sehr vielen gleichzeitigen Ausgaben kann das zu Problemen mit der Serverbelastung
führen. Als Alternative kann man ungerenderte Ausgaben in der CE-Modul-MM-Liste aktivieren.

Möchte man in das Listentemplate bestimmte Anzeigebedingungen einbauen z. B. Anzeige von Blöcken nur wenn Werte
gesetzt sind oder einen bestimmten Wert haben, sollte die Prüfung der Bedingung immer mit Werten aus dem raw-Knoten
erfolgen (ggf. text-Knoten sofern Templates nicht angepasst wurden). Im html5-Knoten sind üblicher Weise immer Tags
vorhanden, so dass diese für eine Prüfung meist unbrauchbar sind.

Dem Listentemplate kann man für FE-Ausgabe noch Parameter übergeben die z. B. für eine Steuerung eines Sliders oder
Übersetzungen usw. - siehe ":ref:`rst_cookbook_templates_fe_list_parameters`".

Die **dritte Stufe** bilden die Templates der Attribute ``mm_attr_<Attributstyp>``. Die Auswahl erfolgt bei den Rendersettings
in den einzelnen Attributen. Diese Templates werden eher dann modifiziert, wenn diese Anpassung auch bei verschiedenen
Rendersettings zum Tragen kommt - z. B. gibt es für das Attribut Datei ein Template als Ausgabe mit "ul" und eins als
"div". In den Attributseinstellungen der Rendersettings kann auch eine individuelle CSS-Klasse an das Template
übergeben werden.

In den Templates von MM können auch die Templates von Contao eingebunden werden um zum Beispiel beim Attribut Text
eine Ausgabe als You-Tube-ContentElement zu erhalten - siehe ":ref:`rst_cookbook_templates_fe_template_ce_elements`".


.. _component_templates_attribute-wrapper:

Der umschließende Block (ab MetaModels 2.5)
...........................................

Bis MM 2.4 kam der Block um jeden Attributwert aus dem **Listentemplate** ("zweite Stufe"):

.. code-block:: html

   <div class="field <spaltenname>">
     <div class="label">Beschriftung:</div>   <!-- entfällt bei "Labels verbergen" -->
     <div class="value">…</div>
   </div>

Das Attributstemplate lieferte nur den innersten Schnipsel, meist ein ``<span class="text …">``. Wer die Ausgabe
gestalten wollte, saß damit im DOM zu tief und kam an den umschließenden Container nicht heran.

Ab MM 2.5 gibt das **Attributstemplate** ("dritte Stufe") diesen Block selbst aus. Damit lässt sich pro Attributstyp
nicht nur der Wert, sondern auch sein Container anpassen.

Für bestehende Ausgaben ändert sich dadurch **nichts**: In den Rendersettings gibt es die neue Option
"Wrapper im Item-Template (Altverhalten, Deprecated)". Eine Migration setzt sie beim Upgrade für **alle vorhandenen**
Rendersettings, deren Ausgabe damit unverändert bleibt. Nur **neu angelegte** Rendersettings starten ohne die Option
und bekommen den Block aus dem Attributstemplate.

.. note:: Die Option ist von Anfang an als deprecated gekennzeichnet und entfällt in MetaModels 3.0. Bis dahin
   sollten eigene Templates umgestellt werden.

Was dabei zu beachten ist:

* **Eigene Attributstemplates** geben den Block nicht aus, solange sie nicht angepasst wurden. Legt man eine neue
  Rendersetting an, fehlt er dort. Entweder das Template nachziehen oder in dieser Rendersetting die Option setzen.
* **Im Spaltenmodus** der Backend-Liste ("Spalten anzeigen") wird kein Block ausgegeben - dort trägt bereits die
  Spaltenüberschrift die Beschriftung. Das Listentemplate wird in diesem Modus ohnehin übersprungen.
* **Leere Werte** verhalten sich wie bisher. Die Option "Leere Einträge verbergen" wirkt unverändert, sie wird
  anhand des Rohwertes ausgewertet, bevor irgendein Template läuft.
* **Der Knoten** ``html5`` enthält den Block danach mit. Wer ihn außerhalb des Listentemplates verwendet - etwa in
  eigenem PHP-Code über ``parseAll()`` oder ``parseValue()`` - bekommt für neue Rendersettings andere Werte. Die
  Knoten ``text``, ``raw`` und ``attributes`` bleiben unverändert; wer strukturierte Daten braucht, ist dort
  ohnehin besser aufgehoben.

Die Beschriftung läuft in beiden Fällen über denselben Übersetzungsschlüssel wie zuvor, weshalb der Doppelpunkt
erhalten bleibt.

Damit ein Attributstemplate den Block ausgeben kann, bekommt es seit MM 2.5 zusätzlich diese Werte:

* ``label``: der übersetzte Name des Attributes (bei Mehrsprachigkeit in der aktiven Sprache)
* ``colName``: der Spaltenname, der auch als CSS-Klasse am Container dient
* ``hideLabels``: ob in den Rendersettings "Labels verbergen" gesetzt ist
* ``legacyAttributeWrapper``: ob das Listentemplate den Block ausgibt - siehe oben

.. note:: Diese Werte werden im Core aufgelöst und fertig übergeben. Ein Template soll sie **nicht** selbst über
   ``settings.getParent()`` holen: Twig kennt kein ``try``/``catch``, und die Render-Einstellung hat nicht in jedem
   Fall eine übergeordnete Sammlung - der Aufruf würde die Ausgabe dann zerlegen.

Ein eigenes Attributstemplate folgt damit diesem Muster - der Inhalt wird zuerst eingesammelt, damit bei leerem
Ergebnis gar kein Block entsteht:

.. code-block:: twig

   {% set mmFieldContent %}<span class="text meintyp{{ additional_class|default('') }}">{{ raw|default('')|raw }}</span>{% endset %}
   {% if mmFieldContent|trim is not empty %}
       {%- if legacyAttributeWrapper -%}
           {{- mmFieldContent|raw -}}
       {%- else -%}
           <div class="field {{ colName }}">
               {%- if not hideLabels %}<div class="label">{{ 'field_label'|trans({'%field_label%': label}, 'metamodels_list') }}</div>{% endif -%}
               <div class="value">{{ mmFieldContent|raw }}</div>
           </div>
       {%- endif -%}
   {% endif %}

Die ``.text``-Templates bekommen den Block **nicht** - sie liefern die reine Textdarstellung.

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
