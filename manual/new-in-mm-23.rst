.. _new_in_mm230:

Änderungen und Features von MM 2.3
==================================

Folgend eine Übersicht der Änderungen und Features zu MetaModels 2.3, die durch das
"early adopter Programm" ermöglicht wurden - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-3>`_.

Für einen Check nach einem Upgrade zu MM 2.3 sind :ref:`unten weitere Hinweise <check_upgrade_mm230>`.

.. note:: zum Anlegen von mm_*-Tabellen und Spalten der Attribute muss eine DB-Migration durchgeführt werden
   - siehe :ref:`Schemamanager <component_schema-manager>`


Allgemein und Core
------------------

* Einbau eines neuen Schemamanagers - :ref:`Mehr Infos <component_schema-manager>`
* Einträge für Sortierung/Gruppierung haben einen Toggle-Button und können damit aktiviert/deaktiviert
  werden (`#1380 <https://github.com/MetaModels/core/issues/1380>`_)
* Hinweis für Programmierer: es gibt eine neue Klasse, mit der die Attribute nach Namen sortiert werden
  können (src/CoreBundle/Sorter/AttributeSorter.php) - zum Einsatz kommt diese z. B. bei der Auswahl des
  Attributes bei der Sortierung (die sind nun aufsteigend sortiert)
* wenn die erste Sortierung angelegt wird, ist nun die Checkbox für "Standard" vorausgewählt
  (`#1472 <https://github.com/MetaModels/core/issues/1472>`_)
* wird bei der Eingabemaske der Render-Modus auf "Hierarchie" gestellt, erscheint nun ein Hinweis,
  dass die Sortierung auf "Manuell" einzustellen ist (`#1324 <https://github.com/MetaModels/core/issues/1324>`_)
* die Checkbox "Variante" bei den Attributen ist disabled, wenn das Model nicht-variant ist
  (`#884 <https://github.com/MetaModels/core/issues/884>`_)
* die Klasse "getSearchablePages" (Indexierung der Detailseiten) wurde komplett neu geschrieben und läuft nun
  effektiver/schneller
* es gibt ein neues Event zum Manipulieren der Überschrift der Eingabemaske
  `GetEditMaskSubHeadlineEvent <https://github.com/contao-community-alliance/dc-general/blob/39ec68cee8b7034e5c1900692cd1b0eeaa7d4c7e/src/Contao/View/Contao2BackendView/Event/GetEditMaskSubHeadlineEvent.php>`_
* bei der Eingabemaske kann eingestellt werden, dass in der Überschrift der Maske beim Editieren Werte aus dem Item
  angezeigt werden
* die Insert-Tags wurden komplett überarbeitet - :ref:`bitte teilweise geänderte Syntax beachten <component_inserttags>`
* Anpassung an Contao-Änderung der Locale-Angaben (nun ``_`` statt ``-``) - alle Angaben von $GLOBALS[TL_LANGUAGE] als
  deprercated gekennzeichnet
* die Sortierung beim CE/Modul hat eine Einstellung zum Anfügen eines URL-Fragments zum Ansteuern eines Ankerpunktes
  für ``generateSortingLink`` und ``renderSortingLink``
* im Listentemplate ``metamodels_prerendered`` stehen zwei Methoden zur Verfügung, um für ein Attribut Links für einen
  Sortierwechsel auszugeben - mehr im :ref:`"Kochbuch" <rst_cookbook_templates_fe_list_sorting>`
* Unterstützung des in Contao 4.10 eingebauten neuen Routings - damit kann das Legacy-Routing über die config.yml
  abgeschaltet werden (``legacy_routing: false``)
* das Sessionhandling wurde von der Contao- zur Symfony-Session umgebaut
* Behandlung der Routenpriorität - siehe :ref:`rst_cookbook_tips_set-route-priority`
* bei Varianten-Items werden die nicht-variant Attribute in der Maske nun nicht mehr ausgeblendet, sondern als
  readonly dargestellt
* Auswahlmöglichkeit der Widget-Templates für die Eingabemaske (BE) - siehe Attribute
* Models, die als Kindtabelle verknüpft sind, können nun Varianten beinhalten (`#1054 <https://github.com/MetaModels/core/issues/1054>`_)
* Liste im BE kann nach nach Kalenderwoche gruppiert werden - die Formatierung über einen Sprachschlüssen individuell je
  Sprache angepasst möglich
* Übersetzungen wurde vom `CCA-Translator <https://github.com/contao-community-alliance/translator>`_ und den
  `Global-Lang-Arrays <https://symfony.com/doc/current/translation.html>`_ zum Symfony-Translator umgestellt. Damit
  werden die Übersetzungen im entsprechenden Symfony-Message-Catalog vorgehalten und beschleunigen den Seitenaufbau im BE.
  Die eigenen Übersetzungen können nun auch im Xliff-Format gepflegt werden. |br|
  Im BE ist nur an wenigen Stellen etwas von dem Wechsel zu spüren - gefixt werden konnte z. B. die Tabellenansicht der
  Items, wenn ein Attribut der Liste nicht in der zugehörigen Eingabemaske vorhanden war. Da erschien bisher nur der
  Übersetzungsschlüssel - nun der entsprechende Titel des Attributes.
* es wurde ein Wechsel des Routings vorgenommen: Die Masken von MM im BE werden künftig nicht mehr über den
  GET-Parameter ``...contao?do=metamodels`` angesteuert, sondern über die Route ``...contao/metamodels``. Hierdurch war eine
  Verschlankung z. B. die Rechtevergabe im BE möglich. Bisher mussten für die Benutzergruppen sowohl bei den Eingabe-
  und Renderzuordnungen ("letztes Icon") als auch bei den Benutzergruppen-Einstellungen von Contao entsprechende Klicks
  durchgeführt werden - die Einstellungen bei Contao sind weg gefallen und man muss nur noch in MM die Rechte zuteilen
  (Eingabemaske + Zuordnungen).
* der Core, Attribute und Filter wurden mit der Toolsammlung `PHPCQ <https://github.com/phpcq/phpcq>`_ geprüft und
  entsprechend angepasst - siehe `Github <https://github.com/MetaModels/core/issues/1502>`_


Attribute
---------

* bei allen Attributen wurden die HTML5-Templates überarbeitet: CSS-Klasse mit Attributtyp und Ausgabetyp, PHP-Shortcode,
  umschließendes HTML-Tag mit Ausgabe der optionalen CSS-Klasse
* bei allen Attributen kann das Template für das Backend per Select ausgewählt werden - für das Frontend siehe FEE


* Langtext
    * Langtext unterstützt als TinyMCE und ACE das readonly - `siehe <https://github.com/contao/contao/pull/5985>`_
* Tabelle-Multi (MCW)
    * Support für readonly und CSS-Klassen für tl_class des Widgets
* Text-Tabelle
    * Support für readonly
* Übersetzte Text-Tabelle
    * Support für readonly
* Übersetzte Tabelle-Multi (MCW)
    * Support für readonly und CSS-Klassen für tl_class des Widgets


Filter
------

* beim CE-/FE-Modul Filter sind bei den Bezeichnungen der Filterregeln nun auch der Typ mit angegeben
  (`#1473 <https://github.com/MetaModels/core/issues/1473>`_)
* beim CE-/FE-Modul Filter kann die ID für das "FORM_SUBMIT" überschrieben werden - siehe :ref:`rst_cookbook_filter_filter-with-forwarding`
* passend zum FEE-Rechtemanagement gibt es eine neue Filterregel, der die Liste nach den zugehörigen Items
  eines eingeloggten Mitgliedes filtert
* das Template für die Ausgabe der Filterung als Linkliste wurde überarbeitet, so dass der Contao-Crawler den
  Links für die Suche-Indexierung nicht mehr folgt
* Eigenes SQL
   * bei dem Inserttag-Parameter "aggregate" wurde nun der Typ "list" hinzugefügt - der wurde zwar schon immer in der Infobox beschrieben,
     war aber bisher nicht implementiert; damit können nun kommaseparierte Listenwerte als GET-Wert übergeben werden
* Einzelauswahl [select]
    * Attributstyp Numerisch (Integer) möglich
    * Template Listenausgabe Attribut ``data-escargot-ignore`` eingefügt, damit Links nicht indexiert werden
* Mehrfachauswahl [Tags]
    * Attributstyp Numerisch (Integer) möglich
    * Template Listenausgabe Attribut ``data-escargot-ignore`` eingefügt, damit Links nicht indexiert werden
* Register
    * das Template für die Ausgabe der Filterung als Linkliste wurde überarbeitet, so dass der Contao-Crawler den
      Links für die Suche-Indexierung nicht mehr folgt
    * im Template sind Blocks für `formlabel` und `formfield` eingefügt
    * Template Listenausgabe Attribut ``data-escargot-ignore`` eingefügt, damit Links nicht indexiert werden


Frontend-Editing (FEE)
----------------------

* Es wurde ein einfaches Rechtemanagement eingebaut welches nach Aktivierung ermöglicht, dass jedes
  eingeloggte Mitglied nur noch seine Einträge bearbeiten kann (`#14 <https://github.com/MetaModels/contao-frontend-editing/issues/14>`_)
* passend zum Rechtemanagement gibt es eine neue Filterregel, die die Liste nach den zugehörigen Items eines
  eingeloggten Mitglieds filtert
* es gibt ein neues Event zum Manipulieren der Überschrift der Eingabemaske
  `GetEditMaskSubHeadlineEvent <https://github.com/contao-community-alliance/dc-general/blob/39ec68cee8b7034e5c1900692cd1b0eeaa7d4c7e/src/Contao/View/Contao2BackendView/Event/GetEditMaskSubHeadlineEvent.php>`_
* bei der Eingabemaske kann eingestellt werden, dass in der Überschrift der Maske beim Editieren Werte aus dem Item
  angezeigt werden (`#14 <https://github.com/MetaModels/contao-frontend-editing/issues/43>`_) - :ref:`siehe FEE <extended_frontend_editing_headlines>`
* der "Create"-Link ist im Standardtemplate des FE-Moduls nicht mehr dabei - das Template wurde an das des CE angeglichen
* Upload Modi "Einzelner Datei-Upload" sind deprecated
* Änderung der Auflösung der Inserttags beim :ref:`Dateiupload <extended_frontend_editing_upload>` - ggf. anpassen
* Thumbnails von Bilddateien in der Dropzone werden nach einem Seitenreload nun angezeigt
* Auswahlmöglichkeit der Form-Templates für die Eingabemaske (FEE) bei allen nichtübersetzten Attributen
* bei überschreiben der Buttons für die Eingabemaske, kann nun bei "Parameter" neben den "Simple-Tokens" auch ein
  Inserttag eingefügt werden


.. _check_upgrade_mm230:
Check für Upgrade auf MM 2.3
----------------------------

Grundsätzlich ist ein Upgrade innerhalb des MM 2.x-Zweiges problemlos möglich und ggf. notwendige Anpassungen an
Bezeichnungen und DB-Änderungen werden über Migrationen abgefangen. Es gibt aber ein paar Sachen, die damit nicht
oder nur sehr schwer abzufangen sind. Aus dem Grund sollten bei der Umstellungen auf MM 2.3 die folgenden Punkte
im Blick behalten werden:

* wenn ein Upgrade gemacht wurde, bitte bei dem Benutzer im BE die Sessiondaten löschen um Anzeige von
  "Pseudo-Fehlern" (z. B. `Cannot assign null ... $intAmount of type int <https://now.metamodel.me/de/mm-eap-newsletter/details/eap-info-mm-2-3-dezember-ii-2023>`_)
  zu vermeiden
* bei einem Upgrade kleiner 2.2 bitte die :ref:`Checkliste für MM 2.2 beachten <check_upgrade_mm220>`
* zum Anlegen von mm_*-Tabellen und Spalten der Attribute eine DB-Migration durchführen -
  :ref:`siehe Schemamanager <component_schema-manager>`
* Check der HTML5-Templates - die wurden überarbeitet (siehe Attribute)
* Check der HTML5-Templates der Filterwidgets, die Linklisten ausgeben - Crawling der URLs wurde unterbunden
* bei FEE und FE-Modul ggf. das Template umstellen für den "Create"-Link
* Filter mit "auto_item" Routenpriorität prüfen - siehe :ref:`rst_cookbook_tips_set-route-priority`
* bei FEE Check Upload-Modus :ref:`Dateiupload <extended_frontend_editing_upload>`
* bei FEE Check Auflösung der Inserttags beim :ref:`Dateiupload <extended_frontend_editing_upload>`
* Check Änderungen beim Template mm_form_field_dropzone.html5
* Check der eigenen Übersetzungen - ggf. Umstellung auf Xliff-Format


Re-Finanzierung
---------------
.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. |br| raw:: html

   <br />
