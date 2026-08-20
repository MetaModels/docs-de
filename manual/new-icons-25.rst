.. _manual_new_icons-25:

Neue Icons für MetaModels als SVG
=================================

Sämtliche Icons des Backends wurden von **PNG auf SVG** umgestellt. Sie bleiben damit in jeder
Größe scharf - auch bei vergrößerter Browser-Darstellung oder auf hochauflösenden Bildschirmen.

.. seealso:: Wem die Icons im Backend grundsätzlich zu klein sind, kann sie mit der Erweiterung
   `contao-backend-size-bundle <https://github.com/e-spin/contao-backend-size-bundle>`_ im eigenen
   Benutzerprofil vergrößern - die Einstellung gilt pro Benutzer, nicht für die ganze Installation.
   Die Erweiterung gehört **nicht** zu MetaModels und ist unabhängig davon einsetzbar; durch die
   Umstellung auf SVG bleiben die MetaModels-Icons dabei aber scharf.


Was sich sonst noch geändert hat
--------------------------------

**Farbe nach Bereich.** Die Symbole der Strukturebene sind eingefärbt, sodass sich die Bereiche
im Backend auf einen Blick unterscheiden lassen: das MetaModel und seine Eingabemasken in Ocker,
die Attribute in Blau, die Filter in Rot, die Ansichten in Grün. Die Icons der einzelnen
Attribut-, Filter- und Bedingungstypen bleiben bewusst neutral dunkelgrau - sie stehen für den
Inhalt, nicht für den Bereich.

Die gewählten Farben sind so gewählt, dass sie in das Farbschema von Contao passen, untereinander unterscheidbar sind,
möglichst sowohl für Hell- als auch Dunkelmodus gehen, auch bei Rot-Grün-Farbschwäche unterscheidbar sind.

**Eigene Variante für den Dark Mode.** Zu jedem Icon gehört eine Datei mit dem Zusatz
``--dark``. Contao wählt sie selbst aus, wenn das Backend im dunklen Farbschema läuft; es ist
also keine Einstellung nötig.

**Blasse Variante für „abgeschaltet".** Die Datei mit dem Zusatz ``_1`` ist die ausgegraute
Fassung. MetaModels nutzt sie überall dort, wo etwas zwar eingerichtet, aber nicht aktiv ist -
eine deaktivierte Filterregel, eine abgeschaltete Bedingung, ein nicht übersetztes MetaModel.

Die folgenden Tabellen stellen für jeden Typ das bisherige Icon dem neuen gegenüber. Ein „-" in
der Spalte *Bisher* heißt, dass es für diesen Typ vorher kein eigenes Icon gab.

.. note:: Contao bindet die Icons mit 16 Pixeln ein. In den Tabellen stehen sie mit 22 Pixeln -
   also so, wie sie mit der oben genannten Erweiterung im vergrößerten Backend ankommen. Dabei
   zeigt sich nebenbei genau der Grund für die Umstellung: die alten PNGs sind Rastergrafiken
   und werden beim Vergrößern weich, die neuen SVGs bleiben scharf.


Core und Struktur
-----------------

Die Symbole der Baumstruktur und der Menüs - alles, was ein MetaModel selbst, seine Eingabemasken,
Filtersets und Ansichten kennzeichnet.

.. list-table::
   :header-rows: 1
   :widths: 44 9 9 38

   * - Bedeutung
     - Bisher
     - Neu
     - Hinweis
   * - MetaModels im Breadcrumb
     - |alt_logo_png|
     - |neu_mm_logo_small_svg|
     -
   * - Attribute
     - |alt_fields_png|
     - |neu_fields_svg|
     -
   * - Render-Einstellungen
     - |alt_rendersettings_png|
     - |neu_rendersettings_svg|
     -
   * - Felder einer Render-Einstellung
     - |alt_rendersetting_png|
     - |neu_rendersetting_svg|
     -
   * - „Alle hinzufügen" in der Render-Einstellung
     - |alt_rendersettings_add_png|
     - |neu_rendersettings_add_svg|
     -
   * - Eingabemasken
     - |alt_dca_png|
     - |neu_dca_svg|
     -
   * - Felder einer Eingabemaske
     - |alt_dca_setting_png|
     - |neu_dca_setting_svg|
     -
   * - Ansichtsbedingung eines Feldes
     - |alt_dca_condition_png|
     - |neu_dca_condition_svg|
     -
   * - Gruppierung und Sortierung
     - |alt_dca_groupsortsettings_png|
     - |neu_dca_groupsortsettings_svg|
     -
   * - „Alle hinzufügen" in der Eingabemaske
     - |alt_dca_add_png|
     - |neu_dca_add_svg|
     -
   * - Sucheinstellungen
     - |alt_searchable_pages_png|
     - |neu_searchable_pages_svg|
     -
   * - Filterset
     - |alt_filter_png|
     - |neu_filter_svg|
     -
   * - Filterregeln
     - |alt_filter_setting_png|
     - |neu_filter_setting_svg|
     -
   * - Rechte-Zuordnung
     - |alt_dca_combine_png|
     - |neu_dca_combine_svg|
     -
   * - Varianten
     - |alt_variants_png|
     - |neu_variants_svg|
     -
   * - übersetztes MetaModel
     - |alt_locale_png|
     - |neu_locale_svg|
     -
   * - Kindtabelle ohne eigenes Icon
     - |alt_metamodels_png|
     - |neu_child_table_svg|
     - bisher das Standard-Icon eines MetaModels, das hier nichts aussagte
   * - Standard-Icon eines MetaModels
     - |alt_metamodels_png|
     - |neu_metamodels_svg|
     - Fallback, wenn ein MetaModel kein eigenes Icon gesetzt hat
   * - Menügruppe „MetaModels" im Backend-Menü
     - |alt_mm_group_icon_contour_svg|
     - |neu_mm_group_icon_svg|
     - bisher nur der Umriss, jetzt gefüllt


Attribute
---------

Die Typ-Icons der Attribute, wie sie in der Attributliste und in der Auswahl des Attributtyps
erscheinen.

.. list-table::
   :header-rows: 1
   :widths: 22 30 9 9 30

   * - Typ
     - Beschriftung im Backend
     - Bisher
     - Neu
     - Hinweis
   * - ``alias``
     - Alias
     - |alt_alias_png|
     - |neu_alias_svg|
     -
   * - ``checkbox``
     - Checkbox
     - |alt_checkbox_png|
     - |neu_checkbox_svg|
     -
   * - ``color``
     - Farbwähler
     - |alt_color_png|
     - |neu_color_svg|
     -
   * - ``combinedvalues``
     - Kombinierte Einträge
     - |alt_combinedvalues_png|
     - |neu_combinedvalues_svg|
     -
   * - ``contentarticle``
     - Inhalt eines Artikels
     - |alt_article_png|
     - |neu_article_svg|
     -
   * - ``country``
     - Land
     - |alt_country_png|
     - |neu_country_svg|
     -
   * - ``decimal``
     - Dezimal
     - |alt_decimal_png|
     - |neu_decimal_svg|
     -
   * - ``file``
     - Datei
     - |alt_file_png|
     - |neu_file_svg|
     -
   * - ``geodistance``
     - Geo-Entfernung
     - |alt_geodistance_png|
     - |neu_geodistance_svg|
     -
   * - ``langcode``
     - Sprachschlüssel
     - |alt_langcode_png|
     - |neu_langcode_svg|
     -
   * - ``levenshtein``
     - Levenshtein-gestützte Suche
     - |alt_levenshtein_png|
     - |neu_levenshtein_svg|
     -
   * - ``longtext``
     - Langtext
     - |alt_longtext_png|
     - |neu_longtext_svg|
     -
   * - ``marker_icon``
     - Cowegis-Marker
     - |alt_marker_png|
     - |neu_marker_svg|
     -
   * - ``numeric``
     - Numerisch
     - |alt_numeric_png|
     - |neu_numeric_svg|
     -
   * - ``rating``
     - Bewertung
     - —
     - |neu_star_svg|
     - bekommt erstmals ein eigenes Typ-Icon
   * - ``select``
     - Einzelauswahl [select]
     - |alt_select_png|
     - |neu_select_svg|
     -
   * - ``tablemulti``
     - Tabelle multi (MCW)
     - |alt_tablemulti_png|
     - |neu_tablemulti_svg|
     -
   * - ``tabletext``
     - Text-Tabelle
     - |alt_tabletext_png|
     - |neu_tabletext_svg|
     -
   * - ``tags``
     - Mehrfachauswahl [tags]
     - |alt_tags_png|
     - |neu_tags_svg|
     -
   * - ``text``
     - Text
     - |alt_text_png|
     - |neu_text_svg|
     -
   * - ``timestamp``
     - Datum/Zeit
     - |alt_timestamp_png|
     - |neu_timestamp_svg|
     -
   * - ``token``
     - Token
     - |alt_token_png|
     - |neu_token_svg|
     -
   * - ``url``
     - URL
     - |alt_url_png|
     - |neu_url_svg|
     -


Übersetzte Attribute
....................

Die übersetzten Attribute nutzen dasselbe Icon wie ihr nicht-übersetztes Pendant; nur
``translatedtablemulti`` und ``translatedtabletext`` haben ein eigenes.

.. list-table::
   :header-rows: 1
   :widths: 22 30 9 9 30

   * - Typ
     - Beschriftung im Backend
     - Bisher
     - Neu
     - Hinweis
   * - ``translatedalias``
     - Übersetzter Alias
     - |alt_alias_png|
     - |neu_alias_svg|
     -
   * - ``translatedcheckbox``
     - Übersetzte Checkbox
     - |alt_checkbox_png|
     - |neu_checkbox_svg|
     -
   * - ``translatedcombinedvalues``
     - Übersetzte kombinierte Werte
     - |alt_combinedvalues_png|
     - |neu_combinedvalues_svg|
     -
   * - ``translatedcontentarticle``
     - Übersetzter Inhalt eines Artikels
     - |alt_article_png|
     - |neu_article_svg|
     -
   * - ``translatedfile``
     - Übersetzte Datei
     - |alt_file_png|
     - |neu_file_svg|
     -
   * - ``translatedlongtext``
     - Übersetzter Langtext
     - |alt_longtext_png|
     - |neu_longtext_svg|
     -
   * - ``translatedselect``
     - Übersetzte Einzelauswahl [select]
     - |alt_select_png|
     - |neu_select_svg|
     -
   * - ``translatedtablemulti``
     - Übersetzte Tabelle multi (MCW)
     - |alt_translatedtablemulti_png|
     - |neu_translatedtablemulti_svg|
     - eigenes Icon
   * - ``translatedtabletext``
     - Übersetzte Text-Tabelle
     - |alt_translatedtabletext_png|
     - |neu_translatedtabletext_svg|
     - eigenes Icon
   * - ``translatedtags``
     - Übersetzte Mehrfachauswahl [tags]
     - |alt_tags_png|
     - |neu_tags_svg|
     -
   * - ``translatedtext``
     - Übersetzter Text
     - |alt_text_png|
     - |neu_text_svg|
     -
   * - ``translatedurl``
     - Übersetzte URL
     - |alt_url_png|
     - |neu_url_svg|
     -


Filterregeln
------------

Sämtliche im Backend auswählbaren Filterregeln, alphabetisch nach Typ - unabhängig davon, aus
welchem Paket sie stammen.

.. list-table::
   :header-rows: 1
   :widths: 22 30 9 9 30

   * - Typ
     - Beschriftung im Backend
     - Bisher
     - Neu
     - Hinweis
   * - ``checkbox``
     - Ja / Nein
     - |alt_filter_checkbox_png|
     - |neu_filter_yes_no_svg|
     - Datei heißt jetzt ``filter_yes-no``
   * - ``checkbox_published``
     - Checkbox-Status
     - |alt_visible_png|
     - |neu_filter_checkbox_svg|
     - bisher das Auge (``visible.png``)
   * - ``conditionand``
     - UND-Bedingung
     - |alt_filter_and_png|
     - |neu_filter_and_svg|
     - aus dem Core
   * - ``conditionor``
     - ODER-Bedingung
     - |alt_filter_or_png|
     - |neu_filter_or_svg|
     - aus dem Core
   * - ``customsql``
     - Eigenes SQL
     - |alt_filter_customsql_png|
     - |neu_filter_customsql_svg|
     - aus dem Core
   * - ``expression_rule``
     - Expression-Regel
     - |alt_filter_expression_png|
     - |neu_filter_expression_svg|
     - aus dem Core
   * - ``fromto``
     - Wert von/bis für ein Attribut
     - |alt_filter_fromto_png|
     - |neu_filter_fromto_svg|
     -
   * - ``fromtodate``
     - Wert von/bis für ein Datumsattribut
     - |alt_filter_fromto_png|
     - |neu_filter_fromto_date_svg|
     - eigenes Icon, bisher dasselbe wie ``fromto``
   * - ``idlist``
     - Vordefinierter Satz von Items
     - |alt_filter_default_png|
     - |neu_filter_idlist_svg|
     - eigenes Icon, bisher das Rückfall-Icon
   * - ``levenshtein``
     - Levenshtein-gestützte Suche
     - |alt_filter_levenshtein_png|
     - |neu_filter_levenshtein_svg|
     -
   * - ``loupe``
     - Loupe-gestützte Suche
     - —
     - |neu_loupe_emblem_svg|
     - war schon vorher SVG, unverändert
   * - ``member_filter``
     - Berechtigung für Frontend-Mitglieder
     - |alt_filter_member_png|
     - |neu_filter_member_svg|
     - aus contao-frontend-editing
   * - ``perimetersearch``
     - Umkreissuche
     - |alt_filter_perimetersearch_png|
     - |neu_filter_perimetersearch_svg|
     -
   * - ``range``
     - Wert von/bis für zwei Attribute
     - |alt_filter_range_png|
     - |neu_filter_range_svg|
     -
   * - ``rangedate``
     - Wert von/bis für zwei Datums-Attribute
     - |alt_filter_range_png|
     - |neu_filter_rangedate_svg|
     - eigenes Icon, bisher dasselbe wie ``range``
   * - ``register``
     - Register
     - |alt_filter_register_png|
     - |neu_filter_register_svg|
     -
   * - ``related``
     - Filter auf Attribut des Modells mit einer Relation
     - |alt_filter_by_related_png|
     - |neu_filter_by_related_svg|
     -
   * - ``select``
     - Einzelauswahl
     - |alt_filter_select_png|
     - |neu_filter_select_svg|
     -
   * - ``simplelookup``
     - Einfache Abfrage
     - |alt_filter_default_png|
     - |neu_filter_simplelookup_svg|
     - eigenes Icon, bisher das Rückfall-Icon
   * - ``tags``
     - Mehrfachauswahl
     - |alt_filter_tags_png|
     - |neu_filter_tags_svg|
     -
   * - ``text``
     - Textfilter
     - |alt_filter_text_png|
     - |neu_filter_text_svg|
     -
   * - ``translatedcheckbox_published``
     - Übersetzter Checkbox-Status
     - |alt_visible_png|
     - |neu_filter_checkbox_svg|
     - teilt sich das Icon mit ``checkbox_published``
   * - —
     - Filterregel ohne eigenes Icon
     - |alt_filter_default_png|
     - |neu_filter_default_svg|
     - Rückfallwert; die Typen ``idlist`` und ``simplelookup`` haben jetzt eigene Icons


Ansichtsbedingungen
-------------------

Die Bedingungen, mit denen sich einzelne Felder der Eingabemaske ein- und ausblenden lassen
(*Bedingungen verwalten* an einer Eingabemasken-Einstellung), hatten bisher überhaupt kein Icon -
die Liste zeigte für jede Bedingung dasselbe Symbol. Jeder Bedingungstyp bekommt jetzt ein
eigenes, sodass sich UND-, ODER- und NICHT-Verknüpfungen auch in einer verschachtelten Liste
auseinanderhalten lassen.

.. note:: Bringt ein Bedingungstyp aus einem Drittpaket kein eigenes Icon mit, wird
   ``condition_default.svg`` gezeigt. Ein neuer Typ braucht also nur eine Datei
   ``condition_<name>.svg`` im Core - eine Registrierung ist nicht nötig.

.. list-table::
   :header-rows: 1
   :widths: 22 30 9 9 30

   * - Typ
     - Beschriftung im Backend
     - Bisher
     - Neu
     - Hinweis
   * - ``conditionand``
     - UND
     - —
     - |neu_condition_and_svg|
     - verknüpft mehrere Bedingungen, alle müssen zutreffen
   * - ``conditionor``
     - ODER
     - —
     - |neu_condition_or_svg|
     - verknüpft mehrere Bedingungen, eine genügt
   * - ``conditionnot``
     - NICHT
     - —
     - |neu_condition_not_svg|
     - kehrt die enthaltene Bedingung um
   * - ``conditionpropertyvalueis``
     - Eigenschaftswert ist …
     - —
     - |neu_condition_propertyvalueis_svg|
     - prüft auf einen bestimmten Wert
   * - ``conditionpropertycontainanyof``
     - Eigenschaftswert kann beinhalten …
     - —
     - |neu_condition_propertycontainanyof_svg|
     - prüft auf einen von mehreren Werten
   * - ``conditionpropertyvisible``
     - Eigenschaft ist sichtbar …
     - —
     - |neu_condition_propertyvisible_svg|
     - knüpft an die Sichtbarkeit einer anderen Eigenschaft an
   * - —
     - Rückfall-Icon
     - —
     - |neu_condition_default_svg|
     - für Bedingungstypen aus Drittpaketen, die kein eigenes Icon mitbringen


Weitere Symbole
---------------

Zustands- und Frontend-Symbole, die nicht für einen Typ stehen.

.. list-table::
   :header-rows: 1
   :widths: 44 9 9 38

   * - Bedeutung
     - Bisher
     - Neu
     - Hinweis
   * - Checkbox aktiv (Listenansicht)
     - |alt_visible_svg|
     - |neu_checkbox_active_svg|
     - bisher Contaos eigenes ``visible.svg``, jetzt ein eigenes
   * - Checkbox inaktiv (Listenansicht)
     - |alt_invisible_svg|
     - |neu_checkbox_inactive_svg|
     - bisher Contaos eigenes ``invisible.svg``, jetzt ein eigenes
   * - Bewertung – leerer Stern
     - |alt_star_empty_png|
     - |neu_star_empty_svg|
     - Frontend-Darstellung
   * - Bewertung – gefüllter Stern
     - |alt_star_full_png|
     - |neu_star_full_svg|
     - Frontend-Darstellung
   * - Bewertung – Stern beim Überfahren
     - |alt_star_hover_png|
     - |neu_star_hover_svg|
     - Frontend-Darstellung
   * - Levenshtein – Index
     - |alt_levenshtein_index_png|
     - |neu_levenshtein_index_svg|
     -


Erweiterungen
-------------

Zwei Erweiterungen bringen eigene Symbole mit. Sie folgen derselben Regel wie der Core: was
eine Einheit bezeichnet, ist eingefärbt; was für einen Typ steht, bleibt neutral grau. Bei der
Merkliste ist beides zu sehen - die Merkliste selbst in Gelb, ihre Filterregel in Grau.

Das Attribut ``marker_icon`` steht zusätzlich oben bei den Attributen, weil es sich sein Icon
mit der Erweiterung teilt.

.. list-table::
   :header-rows: 1
   :widths: 44 9 9 38

   * - Bedeutung
     - Bisher
     - Neu
     - Hinweis
   * - Merkliste
     - |alt_notelist_png|
     - |neu_notelist_svg|
     - die Merkliste selbst - gelb, weil das Icon für die Einheit steht
   * - Merkliste – Eintrag enthalten
     - |alt_notelist_png|
     - |neu_notelist_filled_svg|
     - bisher dasselbe Icon wie die Merkliste selbst - der gefüllte Zustand ist neu
   * - Merkliste-Filterregel
     - |alt_notelist_png|
     - |neu_filter_notelist_svg|
     - eigenes graues Typ-Icon
   * - Cowegis – MetaModels-Layer
     - |alt_metamodels_marker_svg|
     - |neu_metamodels_marker_svg|
     - Layer-Typ in der Cowegis-Karte; war schon vorher SVG
   * - Cowegis – Marker
     - |alt_marker_png|
     - |neu_marker_svg|
     - zugleich das Typ-Icon des Attributs ``marker_icon``


.. Bild-Ersetzungen

.. |alt_alias_png| image:: /_img/icons/alias.png
   :width: 22px
.. |alt_article_png| image:: /_img/icons/article.png
   :width: 22px
.. |alt_checkbox_png| image:: /_img/icons/checkbox.png
   :width: 22px
.. |alt_color_png| image:: /_img/icons/color.png
   :width: 22px
.. |alt_combinedvalues_png| image:: /_img/icons/combinedvalues.png
   :width: 22px
.. |alt_country_png| image:: /_img/icons/country.png
   :width: 22px
.. |alt_dca_add_png| image:: /_img/icons/dca_add.png
   :width: 22px
.. |alt_dca_combine_png| image:: /_img/icons/dca_combine.png
   :width: 22px
.. |alt_dca_condition_png| image:: /_img/icons/dca_condition.png
   :width: 22px
.. |alt_dca_groupsortsettings_png| image:: /_img/icons/dca_groupsortsettings.png
   :width: 22px
.. |alt_dca_png| image:: /_img/icons/dca.png
   :width: 22px
.. |alt_dca_setting_png| image:: /_img/icons/dca_setting.png
   :width: 22px
.. |alt_decimal_png| image:: /_img/icons/decimal.png
   :width: 22px
.. |alt_fields_png| image:: /_img/icons/fields.png
   :width: 22px
.. |alt_file_png| image:: /_img/icons/file.png
   :width: 22px
.. |alt_filter_and_png| image:: /_img/icons/filter_and.png
   :width: 22px
.. |alt_filter_by_related_png| image:: /_img/icons/filter_by_related.png
   :width: 22px
.. |alt_filter_checkbox_png| image:: /_img/icons/filter_checkbox.png
   :width: 22px
.. |alt_filter_customsql_png| image:: /_img/icons/filter_customsql.png
   :width: 22px
.. |alt_filter_default_png| image:: /_img/icons/filter_default.png
   :width: 22px
.. |alt_filter_expression_png| image:: /_img/icons/filter_expression.png
   :width: 22px
.. |alt_filter_fromto_png| image:: /_img/icons/filter_fromto.png
   :width: 22px
.. |alt_filter_levenshtein_png| image:: /_img/icons/filter_levenshtein.png
   :width: 22px
.. |alt_filter_member_png| image:: /_img/icons/filter_member.png
   :width: 22px
.. |alt_filter_or_png| image:: /_img/icons/filter_or.png
   :width: 22px
.. |alt_filter_perimetersearch_png| image:: /_img/icons/filter_perimetersearch.png
   :width: 22px
.. |alt_filter_png| image:: /_img/icons/filter.png
   :width: 22px
.. |alt_filter_range_png| image:: /_img/icons/filter_range.png
   :width: 22px
.. |alt_filter_register_png| image:: /_img/icons/filter_register.png
   :width: 22px
.. |alt_filter_select_png| image:: /_img/icons/filter_select.png
   :width: 22px
.. |alt_filter_setting_png| image:: /_img/icons/filter_setting.png
   :width: 22px
.. |alt_filter_tags_png| image:: /_img/icons/filter_tags.png
   :width: 22px
.. |alt_filter_text_png| image:: /_img/icons/filter_text.png
   :width: 22px
.. |alt_geodistance_png| image:: /_img/icons/geodistance.png
   :width: 22px
.. |alt_invisible_svg| image:: /_img/icons/invisible.svg
   :width: 22px
.. |alt_langcode_png| image:: /_img/icons/langcode.png
   :width: 22px
.. |alt_levenshtein_index_png| image:: /_img/icons/levenshtein_index.png
   :width: 22px
.. |alt_levenshtein_png| image:: /_img/icons/levenshtein.png
   :width: 22px
.. |alt_locale_png| image:: /_img/icons/locale.png
   :width: 22px
.. |alt_logo_png| image:: /_img/icons/logo.png
   :width: 22px
.. |alt_longtext_png| image:: /_img/icons/longtext.png
   :width: 22px
.. |alt_marker_png| image:: /_img/icons/marker.png
   :width: 22px
.. |alt_metamodels_marker_svg| image:: /_img/icons/metamodels_marker.svg
   :width: 22px
.. |alt_metamodels_png| image:: /_img/icons/metamodels.png
   :width: 22px
.. |alt_mm_group_icon_contour_svg| image:: /_img/icons/mm_group_icon_contour.svg
   :width: 22px
.. |alt_notelist_png| image:: /_img/icons/notelist.png
   :width: 22px
.. |alt_numeric_png| image:: /_img/icons/numeric.png
   :width: 22px
.. |alt_rendersetting_png| image:: /_img/icons/rendersetting.png
   :width: 22px
.. |alt_rendersettings_add_png| image:: /_img/icons/rendersettings_add.png
   :width: 22px
.. |alt_rendersettings_png| image:: /_img/icons/rendersettings.png
   :width: 22px
.. |alt_searchable_pages_png| image:: /_img/icons/searchable_pages.png
   :width: 22px
.. |alt_select_png| image:: /_img/icons/select.png
   :width: 22px
.. |alt_star_empty_png| image:: /_img/icons/star-empty.png
   :width: 22px
.. |alt_star_full_png| image:: /_img/icons/star-full.png
   :width: 22px
.. |alt_star_hover_png| image:: /_img/icons/star-hover.png
   :width: 22px
.. |alt_tablemulti_png| image:: /_img/icons/tablemulti.png
   :width: 22px
.. |alt_tabletext_png| image:: /_img/icons/tabletext.png
   :width: 22px
.. |alt_tags_png| image:: /_img/icons/tags.png
   :width: 22px
.. |alt_text_png| image:: /_img/icons/text.png
   :width: 22px
.. |alt_timestamp_png| image:: /_img/icons/timestamp.png
   :width: 22px
.. |alt_token_png| image:: /_img/icons/token.png
   :width: 22px
.. |alt_translatedtablemulti_png| image:: /_img/icons/translatedtablemulti.png
   :width: 22px
.. |alt_translatedtabletext_png| image:: /_img/icons/translatedtabletext.png
   :width: 22px
.. |alt_url_png| image:: /_img/icons/url.png
   :width: 22px
.. |alt_variants_png| image:: /_img/icons/variants.png
   :width: 22px
.. |alt_visible_png| image:: /_img/icons/visible.png
   :width: 22px
.. |alt_visible_svg| image:: /_img/icons/visible.svg
   :width: 22px
.. |neu_alias_svg| image:: /_img/icons_svg/alias.svg
   :width: 22px
.. |neu_article_svg| image:: /_img/icons_svg/article.svg
   :width: 22px
.. |neu_checkbox_active_svg| image:: /_img/icons_svg/checkbox_active.svg
   :width: 22px
.. |neu_checkbox_inactive_svg| image:: /_img/icons_svg/checkbox_inactive.svg
   :width: 22px
.. |neu_checkbox_svg| image:: /_img/icons_svg/checkbox.svg
   :width: 22px
.. |neu_child_table_svg| image:: /_img/icons_svg/child_table.svg
   :width: 22px
.. |neu_color_svg| image:: /_img/icons_svg/color.svg
   :width: 22px
.. |neu_combinedvalues_svg| image:: /_img/icons_svg/combinedvalues.svg
   :width: 22px
.. |neu_condition_and_svg| image:: /_img/icons_svg/condition_and.svg
   :width: 22px
.. |neu_condition_default_svg| image:: /_img/icons_svg/condition_default.svg
   :width: 22px
.. |neu_condition_not_svg| image:: /_img/icons_svg/condition_not.svg
   :width: 22px
.. |neu_condition_or_svg| image:: /_img/icons_svg/condition_or.svg
   :width: 22px
.. |neu_condition_propertycontainanyof_svg| image:: /_img/icons_svg/condition_propertycontainanyof.svg
   :width: 22px
.. |neu_condition_propertyvalueis_svg| image:: /_img/icons_svg/condition_propertyvalueis.svg
   :width: 22px
.. |neu_condition_propertyvisible_svg| image:: /_img/icons_svg/condition_propertyvisible.svg
   :width: 22px
.. |neu_country_svg| image:: /_img/icons_svg/country.svg
   :width: 22px
.. |neu_dca_add_svg| image:: /_img/icons_svg/dca_add.svg
   :width: 22px
.. |neu_dca_combine_svg| image:: /_img/icons_svg/dca_combine.svg
   :width: 22px
.. |neu_dca_condition_svg| image:: /_img/icons_svg/dca_condition.svg
   :width: 22px
.. |neu_dca_groupsortsettings_svg| image:: /_img/icons_svg/dca_groupsortsettings.svg
   :width: 22px
.. |neu_dca_setting_svg| image:: /_img/icons_svg/dca_setting.svg
   :width: 22px
.. |neu_dca_svg| image:: /_img/icons_svg/dca.svg
   :width: 22px
.. |neu_decimal_svg| image:: /_img/icons_svg/decimal.svg
   :width: 22px
.. |neu_fields_svg| image:: /_img/icons_svg/fields.svg
   :width: 22px
.. |neu_file_svg| image:: /_img/icons_svg/file.svg
   :width: 22px
.. |neu_filter_and_svg| image:: /_img/icons_svg/filter_and.svg
   :width: 22px
.. |neu_filter_by_related_svg| image:: /_img/icons_svg/filter_by_related.svg
   :width: 22px
.. |neu_filter_checkbox_svg| image:: /_img/icons_svg/filter_checkbox.svg
   :width: 22px
.. |neu_filter_customsql_svg| image:: /_img/icons_svg/filter_customsql.svg
   :width: 22px
.. |neu_filter_default_svg| image:: /_img/icons_svg/filter_default.svg
   :width: 22px
.. |neu_filter_expression_svg| image:: /_img/icons_svg/filter_expression.svg
   :width: 22px
.. |neu_filter_fromto_date_svg| image:: /_img/icons_svg/filter_fromto_date.svg
   :width: 22px
.. |neu_filter_fromto_svg| image:: /_img/icons_svg/filter_fromto.svg
   :width: 22px
.. |neu_filter_idlist_svg| image:: /_img/icons_svg/filter_idlist.svg
   :width: 22px
.. |neu_filter_levenshtein_svg| image:: /_img/icons_svg/filter_levenshtein.svg
   :width: 22px
.. |neu_filter_member_svg| image:: /_img/icons_svg/filter_member.svg
   :width: 22px
.. |neu_filter_notelist_svg| image:: /_img/icons_svg/filter_notelist.svg
   :width: 22px
.. |neu_filter_or_svg| image:: /_img/icons_svg/filter_or.svg
   :width: 22px
.. |neu_filter_perimetersearch_svg| image:: /_img/icons_svg/filter_perimetersearch.svg
   :width: 22px
.. |neu_filter_range_svg| image:: /_img/icons_svg/filter_range.svg
   :width: 22px
.. |neu_filter_rangedate_svg| image:: /_img/icons_svg/filter_rangedate.svg
   :width: 22px
.. |neu_filter_register_svg| image:: /_img/icons_svg/filter_register.svg
   :width: 22px
.. |neu_filter_select_svg| image:: /_img/icons_svg/filter_select.svg
   :width: 22px
.. |neu_filter_setting_svg| image:: /_img/icons_svg/filter_setting.svg
   :width: 22px
.. |neu_filter_simplelookup_svg| image:: /_img/icons_svg/filter_simplelookup.svg
   :width: 22px
.. |neu_filter_svg| image:: /_img/icons_svg/filter.svg
   :width: 22px
.. |neu_filter_tags_svg| image:: /_img/icons_svg/filter_tags.svg
   :width: 22px
.. |neu_filter_text_svg| image:: /_img/icons_svg/filter_text.svg
   :width: 22px
.. |neu_filter_yes_no_svg| image:: /_img/icons_svg/filter_yes-no.svg
   :width: 22px
.. |neu_geodistance_svg| image:: /_img/icons_svg/geodistance.svg
   :width: 22px
.. |neu_langcode_svg| image:: /_img/icons_svg/langcode.svg
   :width: 22px
.. |neu_levenshtein_index_svg| image:: /_img/icons_svg/levenshtein_index.svg
   :width: 22px
.. |neu_levenshtein_svg| image:: /_img/icons_svg/levenshtein.svg
   :width: 22px
.. |neu_locale_svg| image:: /_img/icons_svg/locale.svg
   :width: 22px
.. |neu_longtext_svg| image:: /_img/icons_svg/longtext.svg
   :width: 22px
.. |neu_loupe_emblem_svg| image:: /_img/icons_svg/loupe-emblem.svg
   :width: 22px
.. |neu_marker_svg| image:: /_img/icons_svg/marker.svg
   :width: 22px
.. |neu_metamodels_marker_svg| image:: /_img/icons_svg/metamodels_marker.svg
   :width: 22px
.. |neu_metamodels_svg| image:: /_img/icons_svg/metamodels.svg
   :width: 22px
.. |neu_mm_group_icon_svg| image:: /_img/icons_svg/mm_group_icon.svg
   :width: 22px
.. |neu_mm_logo_small_svg| image:: /_img/icons_svg/mm_logo_small.svg
   :width: 22px
.. |neu_notelist_filled_svg| image:: /_img/icons_svg/notelist_filled.svg
   :width: 22px
.. |neu_notelist_svg| image:: /_img/icons_svg/notelist.svg
   :width: 22px
.. |neu_numeric_svg| image:: /_img/icons_svg/numeric.svg
   :width: 22px
.. |neu_rendersetting_svg| image:: /_img/icons_svg/rendersetting.svg
   :width: 22px
.. |neu_rendersettings_add_svg| image:: /_img/icons_svg/rendersettings_add.svg
   :width: 22px
.. |neu_rendersettings_svg| image:: /_img/icons_svg/rendersettings.svg
   :width: 22px
.. |neu_searchable_pages_svg| image:: /_img/icons_svg/searchable_pages.svg
   :width: 22px
.. |neu_select_svg| image:: /_img/icons_svg/select.svg
   :width: 22px
.. |neu_star_empty_svg| image:: /_img/icons_svg/star-empty.svg
   :width: 22px
.. |neu_star_full_svg| image:: /_img/icons_svg/star-full.svg
   :width: 22px
.. |neu_star_hover_svg| image:: /_img/icons_svg/star-hover.svg
   :width: 22px
.. |neu_star_svg| image:: /_img/icons_svg/star.svg
   :width: 22px
.. |neu_tablemulti_svg| image:: /_img/icons_svg/tablemulti.svg
   :width: 22px
.. |neu_tabletext_svg| image:: /_img/icons_svg/tabletext.svg
   :width: 22px
.. |neu_tags_svg| image:: /_img/icons_svg/tags.svg
   :width: 22px
.. |neu_text_svg| image:: /_img/icons_svg/text.svg
   :width: 22px
.. |neu_timestamp_svg| image:: /_img/icons_svg/timestamp.svg
   :width: 22px
.. |neu_token_svg| image:: /_img/icons_svg/token.svg
   :width: 22px
.. |neu_translatedtablemulti_svg| image:: /_img/icons_svg/translatedtablemulti.svg
   :width: 22px
.. |neu_translatedtabletext_svg| image:: /_img/icons_svg/translatedtabletext.svg
   :width: 22px
.. |neu_url_svg| image:: /_img/icons_svg/url.svg
   :width: 22px
.. |neu_variants_svg| image:: /_img/icons_svg/variants.svg
   :width: 22px
