.. _component_filter:

|svg_filter_32| | |img_filter_32| Filtersets
=============================================

.. note:: optionale Filtersets für Backend und Frontend erstellen;
  Filterset erstellen und in Komponenten oder Inhaltselementen/Modulen
  aktivieren


Einleitung
----------

Mit der Komponente "Filterset" steht ein umfangreiches Werkzeug zur Verfügung,
um die Ansicht und Auswahl der Datensätze (Items) eines MetaModel zu beeinflussen.
Die Filtersets reduzieren die Gesamtmenge der Items, d.h. nach einer Filterung steht
eine Teilmenge von diesen für die Ausgabe bereit. Es gilt zu beachten, dass 
jedes Filterset immer nur eine Liste mit IDs (der Items) ausgibt bzw. eine 
Filterregel eine Liste mit IDs an eine nächste Filterregel weiter reicht
- eine Änderung der Itemwerte ist z.B. über eine SQL-Query nicht möglich.

Die Erstellung eines Filterset erfolgt in einer zweistufigen Hierarchie, in dem
zunächst ein bezeichnetes Filterset "als Container" erstellt wird, der wiederum
ein oder mehrere Filterregeln beinhalten kann. Sind mehrere Filterregeln auf
dieser Ebene vorhanden, sind diese automatisch per UND verknüpft. Für eine 
ODER-Verknüpfung muss eine Filterregel ODER erstellt werden, welche wiederum
weitere Filterregeln aufnehmen kann. Mit den Möglichkeiten der Verschachtelung
können nahezu alle UND/ODER-Angaben eines nativen SQL-Query nachgebildet werden.

Einige Filterregeln haben die auswählbare Option, nur zugeordnete bzw. nur
verbleibende Filtereinträge anzuzeigen, um eine dynamische Anzeige des Filtersets zu
gewährleisten.

Die Filtersets können sowohl im Backend als auch im Frontend zum Einsatz kommen.

Die Filterregeln können zum Teil dynamisch z.B. über GET/POST-Parameter
beeinflusst werden, wodurch sich sehr umfangreiche Filterungen ergeben.


Typen von Filterregeln
----------------------

* **Vordefiniertes Itemset** (core): |br|
  Eingabe einer Liste mit IDs, nach denen gefiltert werden soll
* **Einfache Abfrage** (core): |br|
  erzeugt eine Filterung nach einem Attribut; für die Filterung kann ein URL-Parameter angegeben werden; mit Option
  "Statischer Parameter" kann in den Inhaltselementen/FE-Modulen aus einer Select-Liste ein Wert zum Filtern aktiviert
  werden
* **Eigenes SQL** (core): |br|
  eigene SQL-Bedingungen zur Filterung; den |img_help| Hilfe-Assistenten (Popup) beachten |br|
  siehe auch im "Kochbuch" :ref:`rst_cookbook_filter_custom-sql`
* **UND-Bedingung (AND)** (core): |br|
  Container für weitere Filterregeln mit UND-Verknüpfung
* **ODER-Bedingung (OR)** (core): |br|
  Container für weitere Filterregeln mit ODER-Verknüpfung; Option, dass nur erste Regel ausgeführt wird
  (Checkbox "Nach erstem Treffer beenden")
* **Checkbox-Status** (filter_checkbox): |br|
  prüft ein Attributwert auf 1; (ehem. "Veröffentlichungsstatus"); eigenes Template mm_filteritem_checkbox(.html5)
* **Übersetzter Checkbox-Status** (filter_checkbox): |br|
  prüft ein übersetzten Attributwert auf 1; (ehem. "Übersetzter Veröffentlichungsstatus"); eigenes Template
  mm_filteritem_checkbox(.html5)
* **Ja / Nein** (filter_checkbox): |br|
  Ja/Nein-Auswahl z.B. als Radio-Buttons
* **Wert von/bis für ein Feld** (filter_fromto): |br|
  von/bis-Auswahl für Werte eines Attributwerts
* **Wert von/bis für ein Datumsfeld** (filter_fromto): |br|
  von/bis-Auswahl für Datum eines Attributwerts; eigenes Template mm_filteritem_datepicker(.html5) - `Datum auf
  YYYY-MM-DD einstellen <https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/date>`_
* **Wert von/bis für zwei Felder** (filter_range): |br|
  zwei Felder mit Werten
* **Wert von/bis für zwei Datumsfelder** (filter_range): |br|
  zwei Felder mit Werten für Datum; eigenes Template mm_filteritem_datepicker(.html5) - `Datum auf YYYY-MM-DD einstellen
  <https://developer.mozilla.org/en-US/docs/Web/HTML/Reference/Elements/input/date>`_
* **Einzelauswahl** (filter_select): |br|
  einzelne Auswahl eines Wertes z. B. einer Select-Liste; Alternativ die Templates mm_filteritem_radiobutton(.html5) oder
  mm_filteritem_linklist(.html5)
* **Mehrfachauswahl** (filter_tags): |br|
  mehrfache Auswahl von Werten z. B. einer Checkbox-Liste; Alternativ das Template mm_filteritem_linklist(.html5)
* **Textfilter** (filter_text): |br|
  filtert nach einer Texteingabe
* **Umkreissuche** (filter_perimetersearch): |br|
  filtert nach einer Adresse/Geokoordinaten und einem Umkreis bezogen auf Lat/Long-Werte in den Datensätzen |br|
  siehe :ref:`extended_perimetersearch`
* **Register** (filter_register): |br|
  filtert nach Anfangsbuchstaben; generiert eine Liste mit allen oder vorhandenen Anfangsbuchstaben; eigenes Template
  mm_filteritem_register(.html5)
* **Levenshtein-gestützte Suche** (attribute_levenshtein): |br|
  erzeugt einen Volltext-Index von ausgewählten Attributen inkl. Ähnlichkeitssuche und Autovervollständigung; eigenes
  Template mm_filteritem_levenshtein(.html5)
* **Filter-by-related** (filter_by_related) [ab MM 2.4]: |br|
  ermöglicht Items mit Eigenschaften aus einem verknüpften (Relation) MetaModel zu filtern; Relationen können per
  Kindtabelle oder Einzelauswahl (Select) aufgebaut sein |br|
  siehe :ref:`rst_extended_filter_by_related`
* **Loupe** (filter_loupe) [ab MM 2.4]: |br|
  erzeugt einen Volltext-Index von ausgewählten Attributen in einer eigenen SQLite-DB - basiert auf
  `Loupe <https://github.com/loupe-php/loupe>`_; mehr dazu bei der :ref:`Filterregel Loupe <rst_extended_loupe>`
* **Expression-Regel** (filter_expression) [ab MM 2.4]: |br|
  damit kann die Ausführung weiterer Filterregeln an Bedingungen geknüpft werden. Es wird ein Knoten in der
  Regelliste erzeugt, der ein oder maximal zwei weitere Filterregeln als Kindknoten aufnehmen kann.; mehr dazu
  bei der :ref:`Filterregel Expression <rst_cookbook_filter_expression-rule>`


Einstellungsparameter
--------------------

Die unterschiedlichen Filterregeln können über spezifische Einstellungsmöglichkeiten an die
individuellen Vorgaben angepasst werden. Bei den meisten Filterregeln sind folgende Parameter
einstellbar:

* **URL-Parameter:** hiermit wird das Schlüsselwort (Key) für die URL definiert; ohne Angabe ist dies
  der Spaltenname des Attributes. Mit dem Schlüsselwort ``auto_item`` wird das Schlüsselwort nicht mit
  in die URL eingebaut, sondern nur der Wert ausgegeben - ``auto_item`` kann nur für eine Filterregel
  verwendet werden. Die Schlüsselwörter ``language`` und ``items`` sind von Contao reserviert - ab
  MM 2.3 werden diese automatisch umgeschrieben und ein ``__`` angehangen, sofern als Spaltenname angelegt.
* **URL-Typ für den Parameter:** (ab MM 2.4) hier kann eingestellt werden, ob der Filterparameter als Slug- oder
  als GET-Parameter an die URL übergeben wird. Zur Auswahl stehen "Nur Slug", "Nur GET" sowie "Slug oder GET erlaubt".
  Die letzte Einstellung ist deprecated und sollte auf einen der beiden eindeutigen Werte umgestellt werden; das
  Backend weist bei ihrer Verwendung darauf hin. Neu angelegte Filterregeln starten mit "Nur Slug", bereits
  bestehende wurden bei der Einführung der Einstellung auf "Slug oder GET erlaubt" gesetzt, damit sich ihr
  Verhalten nicht ändert. Wird ein Parameter über den jeweils anderen URL-Typ übergeben als eingestellt, bleibt er
  ab MM 2.4.25 unbeachtet - genau wie jeder andere unbekannte Parameter; zuvor führte das zu einem 404.
  Mehr dazu bei den :ref:`SEO-Tipps <rst_cookbook_tips_seo_filter-url>`
* **Template:** Auswahl des Widget-Templates für die FE-Anzeige; neben dem Template ``mm_filteritem_default`` bringen
  verschiedene Filterregeln ihre eigenen Templates mit wie z. B. Checkbox, Levenshtein, Register usw. Die
  Templates können auf dem üblichen Weg von Contao angepasst oder individualisiert werden. Das umschließende
  Template (Wrapper) wird im CE-/FE-Modul Filter ausgewählt.
* **CSS-ID/Klasse:** setzt eine ID bzw. CSS-Klasse in das auszugebende Widget; damit ist eine individuelle Steuerung
  der Ansicht/Formatierung möglich.


Ablauf
------

Ein neues Filterset wird über "|img_new| Neu" geöffnet und es muss ein Name vergeben werden.

Über das Icon "|img_filter_setting| Filterregeln" gelangt man zur Eingabeliste der
Filterregel, wo wiederum über "|img_new| Neu" eine neue Filterregel eingerichtet
werden kann. Über die "Klemmmappen-Icons" kann während der Erstellung einer Filterregel
die Hierarchie beeinflusst werden und die Filterregel z.B. innerhalb einer ODER-Regel
eingefügt werden.


.. seealso:: Im Kochbuch:

   * :ref:`rst_cookbook_checklists_filter`
   * :ref:`rst_cookbook_filter_exclusion`


.. _component_filter_list:
Details aller Filterregeln
--------------------------

.. toctree::
   :maxdepth: 1

   filter/idlist
   filter/simplelookup
   filter/customsql
   filter/condition-and
   filter/condition-or
   filter/expression-rule
   filter/checkbox
   filter/translated-checkbox
   filter/yes-no
   filter/fromto
   filter/fromto-date
   filter/range
   filter/range-date
   filter/select
   filter/tags
   filter/text
   filter/perimeter-search
   filter/register
   filter/levenshtein
   filter/by-related
   filter/loupe
   filter/parent


.. |svg_filter_32| image:: /_img/icons_svg/filter.svg
   :width: 32px
.. |img_filter_32| image:: /_img/icons/filter_32.png
.. |img_filter| image:: /_img/icons/filter.png
.. |img_filter_setting| image:: /_img/icons/filter_setting.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_about| image:: /_img/icons/about.png
.. |img_help| image:: /_img/icons/help.svg

.. |br| raw:: html

   <br />
