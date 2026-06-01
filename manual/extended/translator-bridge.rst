.. _rst_extended_translator-bridge:

Translator-Bridge für MetaModels
=================================

Mit der Translator-Bridge werden Schaltflächen für **maschinelle Übersetzung wie z. B. DeepL** |deepl_icon| direkt in die
Bearbeitungsmaske des Contao-Backends integriert. Per Klick überträgt die Erweiterung den Feldinhalt der
Fallback-Sprache an den konfigurierten Übersetzungsanbieter und trägt das Ergebnis automatisch in das gerade
bearbeitete Übersetzungsfeld ein.

Mehr zum Thema :ref:`Mehrsprachigkeit in MetaModels <component_multi-language>`.

.. note:: Die Erweiterung Translator-Bridge ist noch im Fundraising und wird erst nach Erreichen der Zielsumme
   von aktuell 2.762,50 € frei geschaltet. |br|
   Eine Vorab-Installation über das "Early-Adopter-Programm" ist möglich –
   `siehe unten <#early-adopter-programm>`_

Aktuell wird **DeepL** als Übersetzungsanbieter unterstützt – sowohl die
kostenfreie Free-Tier-API als auch die Pro-API. Die Erweiterung ist offen
gestaltet, sodass weitere Anbieter (z. B. ChatGPT, LibreTranslate) als
eigene Symfony-Services ergänzt werden können –
`siehe unten <#eigene-ubersetzungsanbieter>`_.

Die Schaltfläche erscheint ausschließlich dann, wenn:

* ein mehrsprachiges MetaModel bearbeitet wird,
* die aktive Bearbeitungssprache **nicht** die Fallback-Sprache ist und
* das Attributfeld übersetzbar und nicht schreibgeschützt ist.

.. note:: Als Option kann die Übersetzung auch für Contao-Inhalte frei geschaltet werden -
   `siehe unten <#contao-inhaltselemente-ubersetzen>`_

Voraussetzungen
---------------

* MetaModels core 2.4
* Contao 5.3.x
* Gültiger API-Schlüssel des jeweiligen Übersetzungsanbieters
  (z. B. DeepL Free oder Pro)


Installation per Contao-Manager oder Composer
---------------------------------------------

.. code-block:: bash

   composer require metamodels/translator-bridge


Konfiguration
-------------

Nach der Installation wird der API-Schlüssel des Übersetzungsanbieters
in der Symfony-Konfiguration hinterlegt. Dazu legt man im Projektordner
die Datei ``config/config.yaml`` an oder bearbeitet diese:

.. code-block:: yaml

   meta_models_translator_bridge:
       deepl_api_key: '%env(DEEPL_API_KEY)%'

Den eigentlichen Schlüssel trägt man in die Datei ``.env.local`` ein
(nie direkt in die YAML-Datei, damit dieser nicht veröffentlicht wird z. B. über ein Repository):

.. code-block:: bash

   DEEPL_API_KEY=dein-deepl-schluessel-hier

.. note:: Free-Tier-Schlüssel von DeepL enden auf ``:fx`` und nutzen automatisch
   den kostenlosen API-Endpunkt ``api-free.deepl.com``. Pro-Schlüssel ohne
   dieses Suffix verwenden ``api.deepl.com``. Die Erweiterung erkennt den
   Schlüsseltyp selbstständig.


Verwendung in der Eingabemaske eines Datensatzes
------------------------------------------------

Sobald die Erweiterung konfiguriert ist, erscheint neben jedem
übersetzten Attributfeld eine kleine Schaltfläche mit dem Logo des
Übersetzungsanbieters (z. B. das DeepL-Logo).

Ein Klick auf die Schaltfläche |deepl_icon|:

1. liest den Inhalt des Feldes in der Fallback-Sprache aus,
2. sendet ihn an den Übersetzungsanbieter,
3. und trägt das übersetzte Ergebnis direkt in das aktuelle Eingabefeld ein.

|translator_01|

Felder mit HTML-Inhalt (z. B. TinyMCE- oder Textarea-Felder mit Tags) werden
automatisch erkannt und mit dem entsprechenden HTML-Modus übersetzt, sodass
die Markup-Struktur erhalten bleibt.

Contao-Inserttags (z. B. ``{{link::123}}`` oder ``{{env::request}}``) werden
vor der Übersetzung automatisch durch interne Platzhalter ersetzt und danach
wiederhergestellt – sie werden also **nicht** mit übersetzt und bleiben
unverändert im Ergebnis erhalten.

Das Ergebnis kann vor dem Speichern manuell nachbearbeitet werden –
die Erweiterung überschreibt niemals automatisch einen bereits gespeicherten
Wert; sie befüllt nur das Eingabefeld im Browser.

.. tip:: Mit dem Tastenkürzel :kbd:`Alt+T` (macOS: :kbd:`Option+T`) werden
   alle übersetzten Felder der aktuellen Bearbeitungsmaske auf einmal
   übersetzt – ohne jeden Button einzeln anklicken zu müssen.


Unterstützte Attribute
----------------------

Die Schaltfläche wird für folgende übersetzte Attributtypen eingeblendet:

* :ref:`Übersetzter Text <component_attribute_translatedtext>`
* :ref:`Übersetzter Langtext <component_attribute_translatedlongtext>`
* :ref:`Übersetzter Alias <component_attribute_translatedalias>`
* :ref:`Übersetzte URL <component_attribute_translatedurl>`
* :ref:`Übersetzte Text-Tabelle <component_attribute_translatedtabletext>`
* :ref:`Übersetzte Multi-Tabelle (MCW) <component_attribute_translatedtablemulti>`
* :ref:`Übersetzter Inhaltsartikel <component_attribute_translatedcontentarticle>`
  – Schaltflächen erscheinen im Popup-Fenster des Inhaltselements


Inhaltselemente im Popup übersetzen
------------------------------------

Das Attribut *Übersetzter Inhaltsartikel* öffnet die Inhaltselemente in einem
Popup-Fenster. Auch dort werden die Übersetzungsschaltflächen automatisch neben
allen geeigneten Feldern eingeblendet. Die Zielsprache wird dabei direkt aus dem
``mm_lang``-Feld des Inhaltselements gelesen, die Quellsprache aus der
Fallback-Sprache des MetaModels.

.. note:: Das Inhaltselement im Popup muss nach dem Neuanlegen einmal gespeichert werden, damit die Sprachenzuordnung
   erstellt werden kann. Nach dem Speichern sind auch die Übersetzungsbuttons sichtbar.

Als geeignete Feldtypen gelten: ``text``, ``textarea``, ``inputUnit`` und
``listWizard``. Dabei gilt:

* Felder mit **technischem Validierungsausdruck** (``rgxp``) werden ausgeschlossen,
  sofern es sich um nicht-sprachlichen Inhalt handelt – z. B. Datum, E-Mail,
  Telefon, Zahlen oder Sprachkürzel. Alias-Felder (``rgxp=alias``) erhalten
  dagegen **immer** eine Schaltfläche.
* **ACE-Editor-Felder** (``rte=ace|…``) werden nur dann ausgeschlossen, wenn
  eine Code-Syntax hinterlegt ist (z. B. ``ace|php``, ``ace|css``,
  ``ace|json``). Die Syntaxen ``ace|html`` und ``ace|markdown`` gelten als
  übersetzbarer Inhalt – entsprechende Felder (z. B. CE *HTML* oder
  CE *Markdown*) erhalten ebenfalls eine Schaltfläche.


MetaModels-Administration mit mehrsprachigen Eingaben
-----------------------------------------------------

In der **MetaModels-Verwaltung** – z. B. beim Anlegen oder Bearbeiten von
Attributen – erscheinen Felder wie *Legende* oder *Beschreibungstext* als
Mehrsprachentabelle (MultiColumnWizard mit Sprachzeilen). Dort wird die
Übersetzungsschaltfläche direkt in jeder Nicht-Fallback-Sprachzeile eingebunden.

Ein Klick auf die Schaltfläche |deepl_icon| in einer Sprachzeile:

1. liest den Wert der **Fallback-Sprachzeile** desselben Feldes,
2. sendet ihn an den Übersetzungsanbieter,
3. und trägt das übersetzte Ergebnis in das Eingabefeld der jeweiligen
   Zielsprachzeile ein – die Fallback-Zeile bleibt unverändert.

|translation-attributes|

.. tip:: Das Tastenkürzel :kbd:`Alt+T` (macOS: :kbd:`Option+T`) übersetzt ebenfalls alle Zeilen
   solcher Mehrsprachentabellen auf der aktuellen Seite auf einmal.


Contao-Inhaltselemente übersetzen
---------------------------------

Standardmäßig erscheinen Übersetzungsschaltflächen nur in MetaModels-Attributfeldern.
Für das Attribut *Übersetzter Inhaltsartikel* (``attribute_translatedcontentarticle``)
werden die Schaltflächen **immer** eingeblendet – das Popup-Fenster des
Inhaltselements wird dabei automatisch unterstützt, ohne weitere Konfiguration.

Um die Schaltflächen zusätzlich auf allgemeine Contao-Tabellen auszuweiten
(``tl_content`` mit normalem Artikel-Parent, ``tl_article``, ``tl_page``),
setzt man den Schalter ``translate_contao``:

.. code-block:: yaml

   meta_models_translator_bridge:
     deepl_api_key: '%env(DEEPL_API_KEY)%'
     translate_contao: true   # Standard: false

Abschließend den Symfony-Cache leeren:

.. code-block:: bash

   php bin/console cache:clear

.. note:: Die Quellsprache wird automatisch anhand des Contao-Seitenbaums ermittelt:
   Die Erweiterung liest die Spracheinstellung des als **Fallback-Startpunkt**
   markierten Wurzelknotens aus und übergibt sie als explizite Quellsprache
   an den Übersetzungsanbieter.
   Schaltflächen erscheinen nur in Seiten- oder Artikelbäumen, die **nicht**
   der Fallback-Baum selbst sind – im Fallback-Baum gibt es nichts zu übersetzen.


Fehlermeldungen
---------------

Schlägt eine Übersetzung fehl, erscheint eine rote Hinweismeldung direkt unterhalb
des betroffenen Feldes. Sie verschwindet nach 8 Sekunden automatisch oder durch
einen Klick darauf. Die technische Meldung wird zusätzlich in der Browser-Konsole
protokolliert.

Typische Ursachen und Meldungen:

.. list-table::
   :header-rows: 0
   :widths: 50 50

   * - Kein oder falscher API-Schlüssel
     - *DeepL: Autorisierung fehlgeschlagen – bitte API-Schlüssel prüfen.*
   * - Zu viele Anfragen (Rate-Limit)
     - *DeepL: Zu viele Anfragen – bitte kurz warten.*
   * - Übersetzungskontingent aufgebraucht
     - *DeepL: Übersetzungskontingent aufgebraucht.*
   * - Server nicht erreichbar
     - *DeepL: Verbindung zum Übersetzungsdienst nicht möglich.*


Eigene Übersetzungsanbieter
---------------------------

Die Erweiterung ist über einen Symfony-Service-Tag erweiterbar. Eigene
Anbieter implementieren das Interface
``MetaModels\TranslatorBridge\Api\TranslatorProviderInterface`` und werden
über den Tag ``metamodels.translator_provider`` registriert:

.. code-block:: yaml

   # config/services.yaml
   App\Translation\MyProvider:
       tags:
           - { name: metamodels.translator_provider }

Das Interface verlangt folgende Methoden:

* ``getIdentifier(): string`` – eindeutiger Bezeichner (z. B. ``'myprovider'``)
* ``getLabel(): string`` – Anzeigename für die Schaltfläche
* ``isAvailable(): bool`` – gibt an, ob der Anbieter einsatzbereit ist
* ``translate(string $text, string $sourceLang, string $targetLang): string`` –
  führt die eigentliche Übersetzung durch; im Fehlerfall muss eine
  ``\RuntimeException`` mit einer **nutzerlesbaren** Meldung geworfen werden
  (keine rohen HTTP-Exceptions)
* ``getSupportedLanguages(): array`` – Liste der unterstützten Zielsprachkürzel


Reihenfolge bei mehreren Anbietern
----------------------------------

Sind mehrere Anbieter aktiv, erscheint für jeden eine eigene Schaltfläche je Feld.
Die Reihenfolge lässt sich über das Attribut ``priority`` steuern –
ein höherer Wert erscheint weiter links (Standardwert: ``0``):

.. code-block:: yaml

   App\Translation\MyProvider:
       tags:
           - { name: metamodels.translator_provider, priority: 10 }

Das Icon des Providers wird über eine CSS-Anweisung in die Eingabemaske eingespielt:

.. code-block:: css

   button.mm-translate[data-provider="myprovider"]::after {
       background-image: url(../mypath/icons/myprovider.svg);
   }

   html[data-color-scheme="dark"] button.mm-translate[data-provider="myprovider"]::after {
       background-image: url(../mypath/icons/myprovider--dark.svg);
   }


Early-Adopter-Programm
-----------------------

Das Projekt ist fertiggestellt, aber aktuell noch nicht frei verfügbar.
Die Refinanzierung erfolgt über ein "Early-Adopter-Programm", d. h. man kann
die Erweiterung bei Zahlung einer Spende sofort einsetzen. Die Zahlung
berechtigt zum Einsatz für ein Projekt. Rechtsansprüche jedweder Art sind
nach Zahlung einer Spende ausgeschlossen.

Die Höhe der Spende sollte mindestens 200€*1 betragen.

Für die Spende wird eine Rechnung mit ausgewiesener MwSt. bzw. bei vorhandener
EU-Tax-ID für das EU-Ausland in Netto erstellt. |br|
Bei Interesse oder weiteren Fragen bitte eine E-Mail an info@e-spin.de

*1 Netto – ggf. zzgl. MwSt.


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

* `AntwortInternet <https://www.antwortinternet.com/>`_: 680€


(Spenden in Netto)

.. |deepl_icon| image:: /_img/screenshots/extended/translator-bridge/deepl.svg
   :width: 16px
   :height: 16px

.. |translator_01| image:: /_img/screenshots/extended/translator-bridge/translator_01.png
.. |translation-attributes| image:: /_img/screenshots/extended/translator-bridge/translation-attributes.png

.. |br| raw:: html

   <br />
