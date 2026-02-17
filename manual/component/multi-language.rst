.. _component_multi-language:

Mehrsprachigkeit in MetaModels
==============================

MetaModels ist sehr gut auf mehrsprachige Inhalte ausgerichtet. MM stellt für die mehrsprachigen Inhalte eigene
Attribute wie z. B. `Übersetzter Text`, `Übersetzter Alias`, `Übersetzte Datei` usw. zur Verfügung. Für Attribute deren
Werte unabhängig von einer Sprachen sind, wie z. B. die Zahlenwerte, gibt es diese Varianten nicht.

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

Die mehrsprachigen MetaModels sind mit einer farbigen Länderfahne hervorgehoben.


.. _component_multi-language_attribute:
Attribute
---------

Ist die Option "Übersetzung" bei einem Model aktiviert, stehen beim Anlegen der Attribute auch die mehrsprachigen
Varianten zur Verfügung. Je nach Installation kann das wie folgt sein:

* Übersetzte Checkbox
* Übersetzte Datei
* *Übersetzte Einzelauswahl [select]* *
* *Übersetzte Mehrfachauswahl [tags]* *
* Übersetzte Tabelle multi (MCW)
* Übersetzte Text-Tabelle
* Übersetzte URL
* Übersetzte kombinierte Werte
* Übersetzter Alias
* Übersetzter Inhalt eines Artikels
* Übersetzter Langtext
* Übersetzter Text

\*: die **nicht-übersetzten Attribute Einzelauswahl und Mehrfachauswahl unterstützen per se die Mehrsprachigkeit** bei
Relationen zu MetaModel-Tabellen. Die beiden hier aufgeführten Attribute sind für Spezialfälle wie z. B. Relationen
zu nicht-MM-Tabellen mit mehrsprachigen Inhalten. Diese Tabellen müssen aber eine Spalte mit dem Sprachschlüssel haben.
Man kann dafür auch einsprachige MetaModel-Tabellen verwenden mit einem Attribut für den Sprachenschlüssel. Damit ist
es möglich je Sprache nicht nur eine entsprechende Übersetzung zu liefern, sondern ganz andere Inhalte. Beispielsweise
könnte eine Wanderung für englischsprachige Besucher "linksrum" und für deutschsprachige Besucher "rechtsrum" gehen.

Bei einem mehrsprachigen MetaModel stehen bei allen Attributsdefinition für die Felder "Name" und "Beschreibung" je
Sprache ein Feld zur Verfügung. Diese übersetzten Angaben werden in der Eingabemaske automatisch in der Sprache
ausgegeben wenn die passende Backendsprache im Benutzerprofil ausgewählt ist.

Zudem kann im :ref:`Template des Renderings <component_templates_fe-list>` über den Knoten ``attributes`` auf
den übersetzten Wert "Name" zugegriffen werden - es wird automatisch die Sprache der Contao Frontendausgabe oder der
Fallbackwert ausgegeben. Im Template könnte eine Ausgabe wie folgt aussehen:

.. code-block:: html
   :linenos:

    <p><strong><?= $arrItem['attributes']['name'] ?>:</strong> <?= $arrItem['text']['name'] ?></p>
    <p><strong><?= $arrItem['attributes']['city'] ?>:</strong> <?= $arrItem['text']['city'] ?></p>
    <p><strong><?= $arrItem['attributes']['description'] ?>:</strong> <?= $arrItem['text']['description'] ?></p>

Damit ist eine bequeme Handhabung der mehrsprachigen "Labels" in einem Template möglich.


Eingabemaske / Eingabe
----------------------

In der Eingabemaske im Backend haben die Widgets der mehrsprachigen Attribute zur Unterscheidung ein farbiges
Flaggen-Icon. Die Umschaltung der Sprachen erfolgt direkt im Header der Eingabemaske.

Beim Neuanlegen eines Datensatzes wird immer erst die Fallbacksprache befüllt - wenn in der Maske noch eine andere
Sprache als die Fallbacksprache eingestellt ist, wird mit dem Speichern auf die Fallbacksprache umgeschaltet.

Das Speichern eines Datensatzes bzw. einer Eingabe erfolgt nicht automatisch bei der Umschaltung zu einer anderen
Sprache vor dem Umschalten müssen die Eingaben mit Speichern gesichert werden.

Nachdem die Felder in der Fallbacksprache befüllt und gespeichert sind, kann auf eine beliebige anderer gewechselt
werden. In den mehrsprachigen Textfeldern ist zunächst der Text aus der Fallbacksprache zu sehen. Damit soll eine
Übersetzung erleichtert werden.

Diese angezeigten (Hilfs-)Texte werden aber beim Speichern nicht mit in die DB übertragen. Zum Speichern eines Textes
in einer nicht-Fallbacksprache, muss sich dieser von der Fallbackeingabe unterscheiden. Wenn z. B. ein Abteilungsname
"Marketing" ist und Deutsch die Fallbacksprache, würde das Wort "Marketing" nicht als Wort bei Englisch gespeichert
werden.

.. note:: Achtung beim Kopieren von mehrsprachigen Datensätzen: aktuell werden nicht alle Sprachen mit kopiert.
   Die Sprache im BE sollte beim Duplizieren gleich der Fallback-Sprache sein. Anschließend müssen die weiteren Sprachen
   nachgepflegt werden. |br|
   `Siehe Issue <https://github.com/MetaModels/core/issues/598#issuecomment-1912422061>`_


BE-Listenansicht
----------------

In der Listenansicht im Backend gibt es im Header auch einen Umschalter für die Sprache - werden in der Liste
mehrsprachige Attribute ausgegeben, ist dann die Anzeige entsprechend der Sprache.


Filter
------

Die meisten Filterregeln suchen in der Sprache, die im Frontend gerade die aktive (Contao-)Sprache ist. Bei einigen
Filterregeln wie "Einfache Abfrage", "Einzelauswahl", "Mehrfachauswahl", "Textfilter" gibt es die Option
"Alle Sprachen durchsuchen", sofern ein mehrsprachiges Attribut ausgewählt wurde.

Diese Option kann z. B. verwendet werden, wenn man bei einer Detailseite einen
:ref:`Sprachenwechsler wie "ChangeLanguage" <rst_cookbook_tips_seo_metadata-hreflang>` hat und den Filterwert nicht für
andere Sprachen anpassen möchte. Man kann bei der Filterregel "Einfache Abfrage" die Option "Alle Sprachen durchsuchen"
aktivieren und die Detailseite kann dann sowohl mit |br|
``https://my-domain.tld/en/dessert/details/marinated-strawberries`` als auch mit |br|
``https://my-domain.tld/en/dessert/details/marinierte-erdbeeren`` |br|
aufgerufen werden.

Möchte man die Option "Alle Sprachen durchsuchen" nicht aktivieren, so kann man bei dem Sprachenwechsler
"ChangeLanguage" für jede Sprache der Filterparameter (z. B. Alias) über einen Hook passend ausgetauscht werden - `siehe
Doku <https://extensions.terminal42.ch/docs/changelanguage/en/developers/#rewriting-an-url-parameter>`_

Als Einstieg das Snippet: man muss prüfen, ob man sich auf der passenden Detailseite befindet z. B. ID 3, 15, 36 für
die einzelnen Sprachen. Mit dem aktuellen Wert und der aktuellen Sprache kann der passende Wert ermittelt werden.
Der Hook wird für jede Sprache in dem Sprachenwechsler einmal aufgerufen.

.. code-block:: php

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

Für das Attribut "Übersetzte Checkbox" gibt es eine eigene Filterregel "Übersetzter Checkbox-Status".

Bei der Filterregel "Levenshtein-gestützte Suche" ist es bei der Attributseinstellung "Attribute zum Indexieren" auch
möglich, mehrsprachige Attribute auszuwählen.

Die Filterregel ":ref:`Loupe-gestützte Volltextsuche <rst_extended_loupe>`" unterstützt aktuell die mehrsprachigen
Attribute Text und Langtext.


.. |br| raw:: html

   <br />
