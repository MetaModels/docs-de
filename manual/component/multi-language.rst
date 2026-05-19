.. _component_multi-language:

Mehrsprachigkeit in MetaModels
==============================

MetaModels ist sehr gut auf mehrsprachige Inhalte ausgerichtet. MM stellt für die mehrsprachigen Inhalte eigene
Attribute wie z. B. `Übersetzter Text`, `Übersetzter Alias`, `Übersetzte Datei` usw. zur Verfügung. Für Attribute deren
Werte unabhängig von einer Sprachen sind, wie z. B. Zahlenwerte Produkt-IDs usw. , gibt es diese Varianten nicht.

Die Mehrsprachigkeit in MetaModels ist so konzipiert, dass die mehrsprachigen Felder neben der Fallback-Sprache auch in
den gewünschten Übersetzungen ausgefüllt werden. Sollte das bei einem Feld mal nicht der Fall sein, wird im Frontend
automatisch der Fallback-Wert ausgegeben. Im Template kann nicht unterschieden werden, ob ein Wert aus der Übersetzung
oder vom Fallback kommt.

Bevor man mit der Erstellung der Models startet gilt es gut zu überlegen, ob die Inhalte mehrsprachig abgelegt werden
sollen. Die mehrsprachigen Inhalte werden in separaten Tabellen gespeichert und nicht in der eigenen ``mm_*``, so dass
ein späterer Wechsel zu einer Mehrsprachigkeit mit entsprechender Nachpflege verbunden ist.

Wenn man einsprachige Werte hat, die man speichern möchte aber die in verschiedenen Sprachen im Frontend ausgegeben
werden sollen, ist eine Umstellung auf eine Mehrsprachigkeit unkritisch. Es werden lediglich die Attributsbezeichnungen
entsprechend den Sprachen erweitert - :ref:`siehe unten "Attribute" <component_multi-language_attribute>`.


Models
------

Die Mehrsprachigkeit eines Models wird beim Erstellen festgelegt. Mit Aktivierung der Option "Übersetzung" kann man
eine Liste mit zu pflegenden Sprachen pflegen. Aktiviert man auch die Option "Support für Territory-Angabe in der
Sprache", werden zu den Einträgen der Hauptsprachen wie ``de``, ``en``, ``fr`` auch die territorialen Zusätze
wie ``de_DE``, ``de_AT``, ``de_CH`` usw. in der Liste freigeschaltet.

Eine Sprache ist als Fallbacksprache festzulegen, für die dann auch immer alle Datensätze vorhanden sein müssen. Sollte
die Fallbacksprache später gewechselt werden, muss das entsprechend in der DB geprüft und korrigiert werden.

Legt man mehrere Models an, die auch noch durch Relationen verbunden sind, ist es ratsam, bei allen Models das selbe
Sprachenschema und die selbe Fallbacksprache zu definieren. Es ist auch sinnvoll nur die Sprachen anzulegen, die Contao
über seine Startpunkte definiert hat.

Die mehrsprachigen MetaModels sind mit einer farbigen Länderfahne hervorgehoben |img_locale|.


.. _component_multi-language_save:
Speicherung in Datenbank
------------------------

Gespeichert werden die übersetzten Werte in separaten Tabellen ``tl_metamodel_translated*`` - je nach Attributstyp
können das unterschiedliche Tabellen sein. Somit erscheinen die Werte nicht in der individuellen Tabelle des angelegten
Models ``mm_*``. Die Übersetzungstabellen haben eine Referenz zum Attribut ``att_id`` und zum Datensatz ``item_id``
sowie die Angabe der gespeicherten Sprache ``langcode``.

Die Daten in der definierten Fallbacksprache müssen vorhanden sein, damit auch bei nicht vorhandener Übersetzung eine
Ausgabe erfolgen kann. Seit MM 2.4 wird die Fallbacksprache in der Eingabemaske mit "|img_fallback|" im
Sprachenwechsler als auch in der Überschrift gekennzeichnet.

Wechselt man in der Eingabemaske von der Fallbacksprache zu einer Übersetzungssprache, werden in den Textfeldern die
Eingaben der Fallbacksprache ausgegeben. Damit wird eine Übersetzung der Texte erleichtert. Mehr zum Thema
Kennzeichnung im Abschnitt ":ref:`component_multi-language_input`".

.. note:: Wird ein Fallbacktext nicht übersetzt, so wird dieser auch nicht in der Übersetzungssprache eingespeichert.
   Dies ist insbesondere zu beachten, wenn ein Begriff in der Fallbacksprache als auch in der Übersetzungssprache
   gleich ist wie z. B. "Marketing" in Englisch und Deutsch. |br|
   Wird eine Eingabe nach einer Übersetzung wieder auf den Fallback-Inhalt umgeschrieben, so wird der Eintrag für
   die Übersetzungssprache in der Datenbank wieder gelöscht.

.. note:: Ab MM 2.4 werden beim Kopieren eines Datensatzes alle Sprachen mit kopiert -
   `siehe Issue <https://github.com/MetaModels/core/issues/598#issuecomment-1912422061>`_

.. note:: Werden mehrsprachige Models oder Attribute gelöscht, werden nicht alle Inhalte mit gelöscht - :ref:`hier
   Hinweise zum Prüfen und Löschen <rst_cookbook_specials_delete-superfluous-data>`


.. _component_multi-language_attribute:
Attribute
---------

Ist die Option "Übersetzung" bei einem Model aktiviert, stehen beim Anlegen der Attribute auch die mehrsprachigen
Varianten zur Verfügung. Je nach Installation kann das wie folgt sein:

* :ref:`Übersetzter Alias <component_attribute_translatedalias>`
* :ref:`Übersetzte Checkbox <component_attribute_translatedcheckbox>`
* :ref:`Übersetzte Datei <component_attribute_translatedfile>`
* :ref:`Übersetzte Tabelle multi (MCW) <component_attribute_translatedtablemulti>`
* :ref:`Übersetzte Text-Tabelle <component_attribute_translatedtabletext>`
* :ref:`Übersetzte URL <component_attribute_translatedurl>`
* :ref:`Übersetzte kombinierte Werte <component_attribute_translatedcombinedvalues>`
* :ref:`Übersetzter Inhalt eines Artikels <component_attribute_translatedcontentarticle>`
* :ref:`Übersetzter Langtext <component_attribute_translatedlongtext>`
* :ref:`Übersetzter Text <component_attribute_translatedtext>`
* :ref:`Übersetzte Einzelauswahl [select] <component_attribute_translatedselect>` |*note|
* :ref:`Übersetzte Mehrfachauswahl [tags] <component_attribute_translatedtags>` |*note|

|*note|: die **nicht-übersetzten Attribute Einzelauswahl und Mehrfachauswahl unterstützen per se die Mehrsprachigkeit** bei
Relationen zu MetaModel-Tabellen. Die beiden hier aufgeführten Attribute sind für Spezialfälle wie z. B. Relationen
zu nicht-MM-Tabellen mit mehrsprachigen Inhalten. Diese Tabellen müssen aber eine Spalte mit dem Sprachschlüssel haben.
Man kann dafür auch einsprachige MetaModel-Tabellen verwenden mit einem Attribut für den Sprachenschlüssel. Damit ist
es möglich je Sprache nicht nur eine entsprechende Übersetzung zu liefern, sondern ganz andere Inhalte. Beispielsweise
könnte eine Wanderung für englischsprachige Besucher "linksrum" und für deutschsprachige Besucher "rechtsrum" gehen.

Bei einem mehrsprachigen MetaModel stehen bei allen Attributsdefinition für die Felder "Name" und "Beschreibung" je
Sprache ein Feld zur Verfügung - die Fallback-Sprache ist hervorgehoben dargestellt. Diese übersetzten Angaben werden
in der Eingabemaske automatisch in der Sprache ausgegeben wenn die passende Backendsprache im Benutzerprofil ausgewählt
ist.

Zudem kann im :ref:`Template des Renderings <component_templates_fe-list>` über den Knoten ``attributes`` auf
den übersetzten Wert "Name" zugegriffen werden - es wird automatisch die Sprache der Contao Frontendausgabe oder der
Fallbackwert ausgegeben. Im Template könnte eine Ausgabe wie folgt aussehen:

.. code-block:: html
   :linenos:

    <p><strong><?= $arrItem['attributes']['name'] ?>:</strong> <?= $arrItem['text']['name'] ?></p>
    <p><strong><?= $arrItem['attributes']['city'] ?>:</strong> <?= $arrItem['text']['city'] ?></p>
    <p><strong><?= $arrItem['attributes']['description'] ?>:</strong> <?= $arrItem['text']['description'] ?></p>

Damit ist eine bequeme Handhabung der mehrsprachigen "Labels" in einem Template möglich.


.. _component_multi-language_input:
Eingabemaske / Eingabe
----------------------

In der Eingabemaske im Backend haben die Widgets der mehrsprachigen Attribute zur Unterscheidung ein farbiges
Flaggen-Icon |img_locale|. Die Umschaltung der Sprachen erfolgt direkt im Header der Eingabemaske. Die Fallbacksprache
ist sowohl im Sprachenwechsler als auch in der Überschrift entsprechend gekennzeichnet.

Beim Neuanlegen eines Datensatzes wird immer erst die Fallbacksprache befüllt - wenn in der Maske noch eine andere
Sprache als die Fallbacksprache eingestellt ist, wird mit dem Speichern auf die Fallbacksprache umgeschaltet.

.. warning:: Das Speichern eines Datensatzes bzw. einer Eingabe erfolgt nicht automatisch bei der Umschaltung zu einer
   anderen Sprache - vor dem Umschalten müssen die Eingaben mit "Speichern" gesichert werden!

.. warning:: Die folgenden Anzeigen wurden in MM 2.4 eingebaut bzw. angepasst.

Nachdem die Felder in der Fallbacksprache befüllt und gespeichert sind, kann auf eine beliebige andere Sprache
gewechselt werden. In den mehrsprachigen Feldern ist zunächst Inhalt aus der Fallbacksprache zu sehen. Zusätzlich wird
bei dem Titel der Hinweis |img_fallback| eingeblendet, solange kein Inhalt gespeichert wurde, der sich von den
Fallbackwerten unterscheidet. Damit soll der Status der Übersetzung leichter erkennbar werden.

Diese angezeigten Fallback-Inhalte werden aber beim Speichern nicht in der jeweiligen Übersetzungssprache in der DB
gespeichert - siehe ":ref`component_multi-language_save`".

Werden Inhalte in der Übersetzungssprache angelegt und gespeichert, wechselt der Hinweis bei den entsprechenden
Eingabefeldern auf |img_translated|.

**Erweiterungen zum Übersetzen:**

Für kontinuierliche Übersetzungen bietet sich die Erweiterung ":ref:`rst_extended_xliff_ex-import`" an. Hiermit
erfolgt der Austausch über das `XLIFF-Format <https://de.wikipedia.org/wiki/XML_Localization_Interchange_File_Format>`_.

Die Dateien werden über die Erweiterung exportiert und nach der Übersetzung wieder importiert - für die
Übersetzung können entsprechende Agenturen oder Tools eingebunden werden.

Für die Übersetzung im Backend steht die Erweiterung "Translator-Bridge" an, welche verschiedene Übersetzungsprovider
wie `DeepL <https://www.deepl.com>`_ einbindet. Eine Übersetzung kann je Eingabefeld erfolgen oder über einen Short-Cut
für die aktive Eingabemaske.


BE-Listenansicht
----------------

In der Listenansicht im Backend gibt es im Header auch einen Umschalter für die Sprache - werden in der Liste
mehrsprachige Attribute ausgegeben, ist dann die Anzeige entsprechend der Sprache.


Filter
------

Die meisten Filterregeln suchen in der Sprache, die im Frontend gerade die aktive (Contao-)Sprache ist. Bei einigen
Filterregeln wie "Einfache Abfrage", "Einzelauswahl", "Mehrfachauswahl", "Textfilter" gibt es die Option
"Alle Sprachen durchsuchen", sofern ein mehrsprachiges Attribut ausgewählt wurde. Diese Option kann man z. B. bei der
Detailseite (s. u.) einsetzen.

Für das Attribut "Übersetzte Checkbox" gibt es eine eigene Filterregel "Übersetzter Checkbox-Status".

Bei der Filterregel "Levenshtein-gestützte Suche" ist es bei der Attributseinstellung "Attribute zum Indexieren" auch
möglich, mehrsprachige Attribute auszuwählen.

Die Filterregel ":ref:`Loupe-gestützte Volltextsuche <rst_extended_loupe>`" unterstützt aktuell die mehrsprachigen
Attribute Text und Langtext.


FE-Liste / Detailansicht
------------------------

Hat man eine Detailseite bei der man üblicher Weise ein Datensatz per Alias anzeigen lassen möchte, soll man mit dem
Sprachenwechsler zu der Detailseite in einer anderen Sprache wechseln können.

Erweiterungen wie `"ChangeLanguage" <https://github.com/terminal42/contao-changelanguage>`_ "sieht" nur die in
Contao angelegte Seite - z. B. ``https://my-domain.tld/en/dessert/details`` - ohne den Alias der Filterung.

Um der Erweiterung den Wert für die anderen Sprachen mit auf den Weg zu geben und entsprechend zu filtern, gibt
es mehrere Möglichkeiten:

**1. Filterregel "Einfache Abfrage" die Option "Alle Sprachen durchsuchen"**

Zunächst müssen alle Detailseiten der einzelnen Sprachen über die Seiteneigenschaften verknüpft werden - Button
"Seite in Hauptsprache". Zudem muss im Feld "Query-Parameter beibehalten" der "URL-Parameter" aus der Filterregel
eingetragen werden (alias). Als URL-Parameter darf nicht "auto_item" eingetragen werden, da ChangeLanguage damit nicht
arbeiten kann.

Zudem wird die Filterregel "Einfache Abfrage" erstellt oder angepasst. Der URL-Parameter darf nicht als "auto_item"
eingetragen sein und die Option "Alle Sprachen durchsuchen" muss aktiviert sein. Damit kann die Filterung mit allen
Sprachvarianten erfolgen also mit

``https://my-domain.tld/en/dessert/details/alias/marinated-strawberries`` als auch mit |br|
``https://my-domain.tld/de/dessert/details/alias/marinated-strawberries`` bzw.

``https://my-domain.tld/en/dessert/details/alias/marinierte-erdbeeren`` als auch mit |br|
``https://my-domain.tld/de/dessert/details/alias/marinierte-erdbeeren``.


**2. Hook "changelanguageNavigation"**

Möchte man die Option "Alle Sprachen durchsuchen" nicht aktivieren oder mit "auto_item" als "URL-Parameter" arbeiten,
so kann man bei dem Sprachenwechsler "ChangeLanguage" für jede Sprache der Filterparameter (z. B. Alias) über einen
Hook passend austauschen - `siehe
Doku <https://extensions.terminal42.ch/docs/changelanguage/en/developers/#rewriting-an-url-parameter>`_

Als Einstieg das Snippet: man muss prüfen, ob man sich auf der passenden Detailseite befindet z. B. ID 3, 15, 36 für
die einzelnen Sprachenseiten. Mit dem aktuellen Wert des Filterparameters und der aktuellen Sprache kann der passende
Wert für die jeweilige andere Sprache ermittelt werden. Diese Abfrage hängt vom jeweiligen Aufbau der MetaModels ab.
Der Hook wird für jede Sprache in dem Sprachenwechsler einmal aufgerufen.

.. code-block:: php

   public function __invoke(ChangelanguageNavigationEvent $event)
   {
       // ...

       // Right page?
       if (!\in_array($targetPageId = $event->getNavigationItem()->getTargetPage()->id, [3, 15, 36], true)) {
           return;
       }

       // Get alias value.
       $currentAliasValue = Input::get('auto_item');

       // Search for attribute value in target language.
       // $newAliasValue = ....

       // Set alias value for target language/page.
       $event->getUrlParameterBag()->setUrlAttribute('auto_item', $newAliasValue);
   }

Mit dieser Variante werden auch die Angaben für ``hreflang`` in den Meta-Daten korrekt gesetzt -
:ref:`siehe SEO <rst_cookbook_tips_seo_metadata-hreflang>`.


.. |img_locale| image:: /_img/icons/locale.png
.. |img_fallback| image:: /_img/icons/fallback.png
.. |img_translated| image:: /_img/icons/translated.png

.. |br| raw:: html

   <br />

.. |*note| raw:: html

   <strong>*</strong>
