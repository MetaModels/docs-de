.. _rst_extended_xliff_ex-import:

XLIFF-Ex-Import für MetaModels
==============================

.. warning:: Das Tool XLIFF-Ex-Import ist noch im Fundraising 
   und wird erst nach Erreichen der Zielsumme von z.Z. 5.100,00 € frei
   geschaltet. |br|
   Eine Vorab-Installation über das "Early-Adopter-Programm" möglich – `siehe unten <#early-adopter-programm>`_


Mit dem Tool XLIFF-Ex-Import können die Inhalte einer Contao-Installation
für eine Übersetzung exportiert und wieder importiert werden. Neben den
normalen Inhalten von Contao werden auch die mehrsprachigen Inhalte von
MetaModels exportiert bzw. importiert.

Als Export wird eine `XLIFF-Datei <https://de.wikipedia.org/wiki/XML_Localization_Interchange_File_Format>`_
erzeugt, die von gängigen Übersetzungstools eingelesen werden kann. Zum
Beispiel mit dem Tool `Poedit <https://poedit.net/>`_. In der Zusammenarbeit
mit Übersetzungsbüros ist XLIFF Standard.

Sind die Übersetzungen in die exportierte XLIFF-Datei eingepflegt,
kann diese wieder importiert werden.

Der Export und Import erfolgt über Konsolenaufrufe - die Konfiguration
über eine selbst zu erstellende YAML-Datei.

Aktuell werden folgende Module unterstützt:

* Contao (Core)
* MetaModels (Daten)
* RockSolid Custom-Elements

Mehr zur weiteren Planung und Ausbau `siehe unten <#erweiterungsmoglichkeiten>`_


Early-Adopter-Programm
----------------------

Das Projekt ist in Version 1.0 fertig aber aktuell noch nicht frei verfügbar.
Die Refinanzierung erfolgt über ein "Early-Adopter-Programm", d.h. man kann
die Erweiterung(en) bei Zahlung einer Spende sofort einsetzen. Die Zahlung
berechtigt zum Einsatz für ein Projekt. Rechtsansprüche jedweder Art sind
nach Zahlung einer Spende ausgeschlossen.

Die Höhe der Spende sollte mindestens 350€*1 betragen.

Für die Spende wird eine Rechnung mit ausgewiesener MwSt. bzw. bei vorhandener
EU-Tax-ID für das EU-Ausland in Netto erstellt. |br|
Bei Interesse oder weiteren Fragen bitte eine E-Mail an info@e-spin.de

*1 Netto – ggf. zzgl. MwSt.


Installation per Composer
-------------------------

Voraussetzungen für die Installation:

* MetaModels core 2.1


Konfiguration
-------------

Nach der erfolgreichen Installation muss der Export und Import
entsprechend der eigenen Vorgaben und Wünsche konfiguriert werden.

Zunächst wird ein Ordner ``/translations`` im Installationsverzeichnis
von Contao anlegt. Dort ist die Ablage der Exportierten XLIFF-Dateien
bzw. von dort werden diese wieder beim Import eingelesen.

Weiterhin ist im Ordner ``/app`` oder ``/app/Resources`` eine Konfiguationsdatei
``.translation-jobs.yml`` anzulegen. Mit dieser Konfigurationsdatei wird
festgelegt, was exportiert bzw. importiert werden soll - z.B. nur Contao oder
nur MM oder beides - sowie werden hier einzelne Jobs definiert, die per
Konsolenaufruf gestartet werden. 

Somit ist die Konfigurationsdatei in die Bereiche ``dictionaries`` und
``jobs`` eingeteilt - die Parameter sind wie folgt (`siehe auch Beispiel <#beispiel>`_):

dictionaries
............

* ``*`` Quellenname: Bezeichnung für den Aufruf in Jobs bei ``source`` oder ``target`` oder bei Typ ``xliff`` ist das die Bezeichnung für die .xlf-Datei
* ``type`` Typ: ``contao``, ``metamodels``, ``compound``, ``memory`` oder ``xliff``
* ``name`` Name: Abhängig vom typ

  * ``contao``: ``contao``
  * ``metamodels``: ``<table_name>``
  * ``compound``: ``*`` frei vergebbar
  * ``memory``: ``*`` frei vergebbar
  * ``xliff``: ``*`` frei vergebbar

Dictionaries vom Typ ``compound`` können wiederum vorhandene Dictionaries beinhalten
und diese um weitere Quellen ergänzen - `siehe Beispiel <#beispiel>`_

jobs
....

* ``*`` Jobname: Bezeichnung für den Aufruf auf der Konsole oder in einem anderen Job
* ``type`` Typ: ``copy`` zum Kopieren der Übersetzungsdaten oder ``batch`` zum Aufruf/Zusammenfassen vorhandener Jobs

Typ ``copy``:

* ``source``: Quellenbezeichnung aus Dictionaries
* ``target``: Zielbezeichnung aus Dictionaries
* ``source_language``: Sprachkürzel z.B. ``en``, ``de`` für die Quellensprache
* ``target_language``: Sprachkürzel z.B. ``de``, ``en`` für die Zielsprache
* ``copy-source``: Bestimmt das Verhalten beim Kopieren von Quelle zu Ziel

  * ``true`` (default): Quelle zu Ziel immer kopiert
  * ``if-empty``: Quelle zu Ziel nur kopiert, wenn Ziel leer oder nicht vorhanden
  * ``false``: es wird nichts kopiert

* ``copy-target``: Bestimmt das Verhalten beim Kopieren von Ziel zu Quelle

  * ``true`` (default): Ziel zu Quelle immer kopiert
  * ``if-empty``: Ziel zu Quelle nur kopiert, wenn Quelle leer oder nicht vorhanden
  * ``false``: es wird nichts kopiert

* ``remove-obsolete``: Bestimmt das Löschen eines Textknotens

  * ``false`` (default): es wird nichts gelöscht
  * ``true``: der Textknoten wird gelöscht, wenn Quelle leer oder nicht mehr vorhanden

* ``filter``: Liste mit RegEx-Filtern auf die ``id`` im Knoten ``trans-unit`` zum Ausschließen von Inhalten

Type ``batch``

* ``jobs``: Liste mit Jobbezeichnungen, die abgearbeitet werden sollen


Export
------

Der Export erfolgt über einen Konsolenaufruf mit einem Jobnamen
als Parameter - z.B.

``php vendor/bin/contao-console i18n:process export-all``

Es kann aber auch eine einzelne Sprache exportiert werden, wenn
ein entsprechender Job definiert wurde - z.B.

``php vendor/bin/contao-console i18n:process export-en-ru``

Mit dem Parameter ``--help`` werden alle Parameter ausgegeben z.B.
der Verbose-Parameter (``-v, -vv -vvv``) für genauere weitere Informationen
des Aufrufs oder ``--dry-run`` für einen "Trockenlauf".


Import
------

Der Import erfolgt analog dem Export - z.B. 

``php vendor/bin/contao-console i18n:process import-all``

oder

``php vendor/bin/contao-console i18n:process import-en-ru``


Debug
-----

Es besteht die Möglichkeit, das Mapping der Übersetzung auf Probleme
hin zu untersuchen. Dazu wird der Debugbefehl mit den Parametern der
Tabelle der Quellsprache sowie der Zielsprache aufgerufen. Über den
Parameter ``--help`` kann ein Hilfetext ausgegeben werden.

Ein Debugaufruf kann z.B. wie folgt aussehen:

``php vendor/bin/contao-console debug:i18n-map tl_article.tl_content en de``

Es folgt eine tabelarische Auflistung des Mappings. Gegebenfalls werden
vorweg Hinweise auf Probleme ausgegeben wie z.B.

``WARNING   [app] Article 17 (index: 0) has no fallback set, expect problems, I guess it is 13
["id" => 17,"index" => 0,"guessed" => 13,"msg_type" => "article_fallback_guess"]``

Hier sollte man den Artikel mit der ID 17 im Backend aufsuchen und
die Angabe des Fallbackartikels prüfen.

Beispiel
--------

.. code-block:: yaml
   :linenos:

    dictionaries:
      contao_all:
        type: contao
        name: contao
    
      combined-content:
        type: compound
        name: content
        dictionaries:
          content: contao_all
          my_staff_export:
            type: metamodels
            name: mm_staff
          # Shorthand version: name as key
          # mm_staff:
          #   type: metamodels
          mm_division:
            type: metamodels
          mm_projects:
            type: metamodels
    
      mmworkshop:
        type: xliff
    
    jobs:
      ## Export
    
      # EN => DE
      export-en-de:
        type: copy
        source: combined-content
        target: mmworkshop
        source_language: en
        target_language: de
        copy-source: true
        copy-target: if-empty
        remove-obsolete: true
        filter:
          - /^content\.tl_article\.[0-9]+\.title$/
          - /^content\.tl_article\.[0-9]+\.alias$/
    
      # Export all.
      export-all:
        type: batch
        jobs:
          - export-en-de
    
      ## Import
    
      # EN => DE
      import-en-de:
        type: copy
        source: mmworkshop
        target: combined-content
        source_language: en
        target_language: de
        copy-source: false
        copy-target: true
        remove-obsolete: false
        filter:
          - /^content\.tl_article\.[0-9]+\.title$/
          - /^content\.tl_article\.[0-9]+\.alias$/
    
      # Import all.
      import-all:
        type: batch
        jobs:
          - import-en-de
    
      all:
        type: batch
        jobs:
          - export-all
          - import-all

Die Dictionaries ``mm_staff``, ``mm_division`` und ``mm_projects`` sind die
übersetzten MetaModels - aus ``mmworkshop`` wird der Dateiname ``mmworkshop.xlf``
gebildet. Mit den Jobnamen z.B. ``export-all`` oder ``import-all`` werden
die Jobs auf der Konsole aufgerufen.

Eine exportierte XLIFF-Datei kann in einem XLIFF-Editor wie z.B. `Poedit <https://poedit.net/>`_
geöffnet und bearbeitet werden - siehe Screenshot:

|img_poedit|


Erweiterungsmöglichkeiten
-------------------------

Ausgabetypen

* po
* csv
* xml

Unterstüzung anderer Erweiterungen

* MetaModels Backend
* Isotope


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* N.N.: 2.700 €


(Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_poedit| image:: /_img/screenshots/extended/xliff_ex-import/poedit.png