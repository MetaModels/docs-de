.. _manual_install:

MetaModels installieren und aktualisieren
=========================================

Allgemeine Informationen zur Installation
-----------------------------------------

MetaModels besteht aus mehreren Modulen, die je nach Aufgabenstellung installiert werden müssen.

Im Contao-Manager werden bei `Pakete` über die Eingabe `metamodels/ <https://extensions.contao.org/?q=metamodels>`_
alle zur Verfügung stehenden Pakete von MetaModels aufgelistet. Das Basispaket `metamodels/core <https://extensions.contao.org/?p=metamodels%2Fcore>`_
muss installiert werden - darüber hinaus sind weitere `Attribute und Filter <https://extensions.contao.org/?q=metamodels>`_
je nach Aufgabenstellung notwendig. Für den ersten Start mit MetaModels steht eine :ref:`Checkliste <rst_cookbook_checklists_mm-start>`
zur Verfügung.

Neben den einzelnen Paketen gibt es `Bundles`, die verschiedene Pakete für eine vereinfachte Installation
zusammenfassen.

Für den Einstieg in MetaModels ist das Bundle `metamodels/bundle_start <https://extensions.contao.org/?p=metamodels%2Fbundle_start>`_
zu empfehlen - hiermit werden der Core sowie die wichtigsten Attribute und Filter installiert.

Zudem gibt es auch das Bundle `metamodels/bundle_all <https://extensions.contao.org/?p=metamodels%2Fbundle_all>`_,
welches neben dem `bundle_start` auch die mehrsprachigen Pakete mit installiert (Hinweis: die Pakete `translatedselect`
`translatedtags` sind hier seit MM 2.1 nicht mehr inkludiert, da diese nur für Spezialfälle einzusetzen sind).

Die beiden Bundles sind nur für die Evaluation oder ersten Gehversuche gedacht - in einem Live-System sollten aber nur
der Core und die notwendigen Attribute und Filter als separate Pakete installiert werden.

Weitere Module wie "Registerfilter", "Umkreissuche", "Bewertung" usw. sind als separate Pakete
hinzu zu fügen - siehe :ref:`extended_index`

.. seealso:: Erfolgt die Installation über den Contao-Manager und es sind schon Pakete installiert, die
   noch ein altes Paket vom MultiColumnWizard (MCW) enthalten, kann der Manager (bzw. der Composer)
   das nicht austauschen und gleichzeitig installieren. Als "Trick" dazu, erst alle vorhandene Erweiterungspakete
   für eine Aktualisierung markieren und anschließend das oder die MM-Pakete hinzufügen und übernehmen;
   alternativ dazu, ein `composer update` auf der Konsole -
   siehe `'Forum' <https://community.contao.org/de/showthread.php?72871-MCW-MultiColumnWizard-als-Bundle-f%C3%BCr-Contao-4-(stable)&p=502709&viewfull=1#post502709>`_.

Neben dem Contao-Manager ist die Installation der Pakete und Bundles direkt über die Konsole per
Composer möglich - z.B. mit

``php public/contao-manager.phar.php composer require metamodels/core``

bzw.

``php public/contao-manager.phar.php composer require metamodels/bundle_start``

Statt `php` ist ggf. der Pfad zum entsprechenden PHP-Binary anzugeben -
siehe :ref:`rst_cookbook_symfony_mm-2-1-tips`.

Nach der Installation ist über das Install-Tool von Contao ein **Update der Datenbank nicht zu vergessen!**

Es folgen weitere Informationen zu den einzelnen Versionen von MetaModels.


Übersicht der Versionen
-----------------------

* C 5.x/6.x + MM 3.0 + PHP 8.x - aktuell in Planung...
* :ref:`C 5.3 + MM 2.4 + PHP 8.2 <install_mm240>` - Zugang per "EAP"
* :ref:`C 4.13 + MM 2.3 + PHP 8.1 <install_mm230>` - Zugang per "EAP"
* :ref:`C 4.9 + MM 2.2 + PHP 7.4 <install_mm-old>`
* :ref:`C 4.4 + MM 2.1 + PHP 7.2/7.4 <install_mm-old>`
* :ref:`C 3.5 + MM 2.0 + PHP 5.6 <install_mm-old>`

.. _install_mm240:
Installation von MM 2.4 für Contao 5.3 und PHP 8
-------------------------------------------------

MetaModels 2.4 bringt eine volle Kompatibilität zu Contao 5.3 und PHP 8.2. MM 2.4 ist eine Anpassung der
Version 2.3 an die neue Contao- und PHP-Versionund bringt natürlich
:ref:`alle Änderungen und Features aus MM 2.3 mit <new_in_mm230>`.

Die Installationsvoraussetzungen für MetaModels 2.4 sind:

* ein laufendes Contao 5.3.x (LTS)
* ab PHP 8.2
* MySQL ab 5.5.5 (InnoDB), MariaDB (inkl. "strict mode")
* ``memory_limit`` 512MB oder mehr (Empfehlung)
* bis zur Veröffentlichung Zugangskey über das `EAP <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-4>`_

Höhere Versionen von Contao und/oder PHP können möglich sein, werden aber nicht offiziell supportet.

Bei einem Upgrade oder Neuinstallation, sind die :ref:`Änderungen und neuen Funktionen von MM 2.4 <new_in_mm240>` zu
beachten sowie die Arbeitsweise mit dem :ref:`Schemamanager <component_schema-manager>` und XLIFF-Übersetzungen
:ref:`component_translations`.

.. seealso::
   Während der Entwicklungsphase bekommen die über git zur Verfügung gestellten Pakete bei einer Änderung
   immer neue Dateinamen. Diese sind in der composer.lock mit abgespeichert. Dadurch kann es vorkommen, dass
   bei einem `composer install` die Pakete nicht gefunden werden können und eine Fehlermeldung kommt. |br|
   In dem Fall, bitte ein `composer update` zum Aktualisieren der composer.lock aufrufen. |br|
   |br|
   In den Paketen werden die Abhängigkeiten der Pakete nicht auf die DEV-Version eingetragen - das kann bedeuten,
   dass man z. B. `attribute_numeric` für `attribute_timestamp` selbständig in die composer.json eintragen muss.
   Bei Fragen steht der Support zur Seite.

   Kommt beim Update die Meldung |br|
   ``The checksum verification of the file failed...`` |br|
   bitte die ``composer.lock`` löschen und das Update neu starten.

   Bei Problemen eines Updates kann es helfen den Composer-Cache zu leeren ``composer clearcache``.

   Kommt eine Meldung |br|
   ``... Failed to connect to packages.cyberspectrum.de port 443: Connection refused...`` |br|
   oder |br|
   ``... The "https://token:XXX@packages.cyberspectrum.de/r/packages.json" file could not be downloaded (HTTP/2 404 )...`` |br|
   dann ist sehr wahrscheinlich der Packagist-Server down und composer kann die Pakete nicht ziehen. Dann bitte das
   Update nach einigen Minuten erneut probieren oder das MM-Team kontaktieren.

   Wenn ein Upgrade gemacht wurde, bitte bei dem Benutzer im BE die Sessiondaten löschen um Anzeige von
   "Pseudo-Fehlern" zu vermeiden. Wer das für alle Benutzer machen möchte, kann in der Tabelle `tl_user` die Spalte
   `session` auf `NULL` setzen. Die Fehlermeldung sieht i. E. so aus:|br|
   ``Cannot assign null to property ContaoCommunityAlliance\DcGeneral\Panel\DefaultLimitElement::$intAmount of type int``

Vor einem Produktiveinsatz sollte die Seite vollständig durchgetestet werden. MM 2.4 kann über den Composer (Konsole)
oder den Contao-Manager installiert werden. Zugang zu dem aktuell noch geschütztem Repository erhält man über unser
"**early adopter Programm**" - mehr dazu unter Fundraising auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-4>`_.

**Weitere Features von MM 2.4:** |br|
Wir haben eine :ref:`Übersichtsseite mit den Änderungen und Funktionen zu MM 2.4 <new_in_mm240>` zusammengestellt - bitte
beachtet bei einem Upgrade die :ref:`Checkliste <check_upgrade_mm240>`.


.. _install_mm230:
Installation von MM 2.3 für Contao 4.13 und PHP 8
-------------------------------------------------

MetaModels 2.3 bringt eine volle Kompatibilität zu Contao 4.13 und PHP 8.1. MM 2.3 ist eine Anpassung der
Version 2.2 an die neue Contao- und PHP-Version und bringt natürlich
:ref:`alle Änderungen und Features aus MM 2.2 mit <new_in_mm220>`.

Mit dem neuen Schemamanager und den XLIFF-Dateien muss der Workflow mit MM angepasst werden - siehe
:ref:`Schemamanager <component_schema-manager>` und :ref:`component_translations`.

Die Installationsvoraussetzungen für MetaModels 2.3 sind:

* ein laufendes Contao 4.13.x (LTS)
* ab PHP 8.1
* MySQL ab 5.5.5 (InnoDB), MariaDB (inkl. "strict mode")
* ``memory_limit`` 512MB oder mehr (Empfehlung)
* bis zur Veröffentlichung Zugangskey über das `EAP <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-3>`_
  - `MM Core <https://github.com/MetaModels/core/tree/release/2.3.0>`_ ist schon frei verfügbar

Höhere Versionen von Contao und/oder PHP können möglich sein, werden aber nicht offiziell supportet.

Wir haben eine :ref:`Übersichtsseite mit den Änderungen und Funktionen zu MM 2.3 <new_in_mm230>` zusammengestellt - bitte
beachtet bei einem Upgrade die :ref:`Checkliste <check_upgrade_mm230>`.

Das MM-Team unterstützt mit der Arbeit/Finanzierung auch die Arbeiten am
`DC_General <https://github.com/contao-community-alliance/dc-general/>`_, der u. a. bei MM für die Anzeigen
im Backend zuständig ist und viele tolle Funktionen mitbringt.

.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


.. _install_mm-old:
Hinweise und Anleitungen für ältere Contao- und MM-Versionen
------------------------------------------------------------

* :ref:`Übersichtsseite mit den Änderungen und Funktionen zu MM 2.2 <new_in_mm220>`
* :ref:`cookbook_move_mm2.0_to_2.1`
* :ref:`cookbook_install_mm2.0-and-older`


Umstellung von `metamodels/bundle_*` auf separate Module
--------------------------------------------------------

Bei einer Umstellung z.B. von 2.0 auf eine neuere Version oder Neuinstallation ist es eine gute Gelegenheit, nur noch
die Attribute und Filter zu installieren, die für das Projekt notwendig sind. War zuvor z.B. `metamodels/bundle_start`
oder `metamodels/bundle_all` im Einsatz, kann man mit den folgenden SQL-Befehlen die wirklich verwendeten Attribute
und Filter abfragen:

.. code-block:: sql
   :linenos:
   
   -- Attribute
   SELECT type FROM `tl_metamodel_attribute` GROUP BY type ORDER BY type
   -- Attribut "levensthein" wurde umbenannt nach "levenshtein"
   
   -- Filter
   SELECT type FROM `tl_metamodel_filtersetting` GROUP BY type ORDER BY type
   -- Filterregeln "conditionand, conditionor, customsql, idlist, simplelookup" sind im MM-Core enthalten
   -- Filterregel "checkbox_published" im Attribut Checkbox

Die daraus sich ergebende Liste kann dann über den Contao Manager oder die Konsole installiert werden und nicht genutzte
Module bleiben außen vor.


Test von speziellen Paketen
---------------------------

Neben den aktuell verfügbaren und freigegebenen Pakete von MetaModels, gibt es teilweise
Pakete mit Bugfixes oder neuen Funktionen, die getestet werden können/müssen - das
könnte z.B. für den MetaModels-core das ein Paket ``hotfix/2.1.25`` sein. Zu sehen sind die Pakete u.a.
auf Github im entsprechenden Repository (z.B. MetaModels/core) im Reiter
`'branches' <https://github.com/MetaModels/core/branches>`_. Die dort angegebene Bezeichnung wie
``hotfix/2.1.25`` muss um den Präfix ``dev-`` ergänzt werden, sowie um ein ``as 2.1.25`` am Ende.

Eine Übersicht zu den Angaben in der composer.json `hier <https://devhints.io/composer>`_.

Möchte man ein solches Paket testen, muss es explizit im Contao-Manger mit 

``dev-hotfix/2.1.25 as 2.1.25``

oder in der composer.json

``"metamodels/core": "dev-hotfix/2.1.25 as 2.1.25"``

mit seiner Version angegeben werden.

Anschließend über den Contao-Manager oder auf der Konsole ein Update machen.

Da MetaModels eng mit dem DC_General (DCG) verzahnt ist, muss zum Testen häufig auch hier
auf eine neuere Version geupdatet werden. Das Vorgehen ist das gleiche wie bei MetaModels
inklusive der Anpassung des JSON-Eintrages mit "as 2.1.x".

Die Composer-JSON sollte für die Implementierung der Pakete für Core und DCG in etwa die
folgenden Einträge im Knoten "require" aufweisen (Zeile 8 und 10):

.. code-block:: json
   :linenos:
   
   {
       "name": "local/website",
       "description": "A local website project",
       "type": "project",
       "license": "proprietary",
       "require": {
           "contao-community-alliance/composer-client": "~0.12",
           "contao-community-alliance/dc-general": "dev-hotfix/2.1.42 as 2.1.42",
           "metamodels/bundle_all": "^2.1",
           "metamodels/core": "dev-hotfix/2.1.25 as 2.1.25",
           ...
       },
       ...
   }

Um auf den ursprünglichen Stand zurück zu gelangen, die Pakete wieder auf ihren ursprünglichen Aufruf
z.B. "^2.1" zurücksetzen und ein Update inkl. Datenbank machen..

Wichtig ist nach einem Test die Rückmeldung zum Entwickler bzw. an das MetaModels-Team über
`Github <https://github.com/MetaModels>`_.

Zwei weitere Möglichkeiten sind die Installation eines Forks oder eines Pull-Requests (PR).
Hier muss für die Installation die composer.json angepasst werden.

Bei einem Fork (ggf. in den Einstellungen der Paketverwaltung den eigenen Github oAuth Token
eintragen) z.B.

.. code-block:: json
   :linenos:
   
   {
       "name": "local/website",
       "description": "A local website project",
       "type": "project",
       "license": "proprietary",
       "require": {
           "contao-community-alliance/composer-client": "~0.12",
           "contao-community-alliance/dc-general": "^2.1",
           "metamodels/bundle_all": "^2.1",
           "byteworks/metamodelsattribute_multi": ">=1.0.5.0,<1.1-dev",
           ...
       },
       ...
       "repositories": [
           ...
           {
               "type": "vcs",
               "url": "https://github.com/byteworks-ch/contao-metamodelsattribute_multi.git"
           },
           {
               "type": "git",
               "url": "git@gitlab.com:MetaModels/filter_parent.git"
           }
       ],
       ...
   }

oder für einen PR mit dem Hash des Commits - diesen findet man unter Github bei dem PR beim
Reiter "Commits".

.. code-block:: json
   :linenos:
   
   {
       "name": "local/website",
       "description": "A local website project",
       "type": "project",
       "license": "proprietary",
       "require": {
           "contao-community-alliance/composer-client": "~0.12",
           "contao-community-alliance/dc-general": "^2.1",
           "metamodels/bundle_all": "^2.1",
           "metamodels/attribute_alias": "dev-master#a97ec461ae1254fa616811c3ce234515238fb3c7 as 2.1.42",
           ...


.. |br| raw:: html

   <br />
