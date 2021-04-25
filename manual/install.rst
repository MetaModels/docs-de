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

Weitere Module wie "Registerfilter", "Umkreissuche", "Bewertung" usw. sind als separate Pakete
hinzu zu fügen - siehe :ref:`extended_index`

.. seealso:: Erfolgt die Installtion über den Contao-Manager und es sind schon Pakete installiert, die
   noch ein altes Paket vom MultiColumnWizard (MCW) enthalten, kann der Manager (bzw. der Composer)
   das nicht austauschen und gleichzeitig installieren. Als "Trick" dazu, erst alle vorhandene Erweiterungspakete
   für eine Aktualisierung markieren und anschließend das oder die MM-Pakete hinzufügen und übernehmen;
   alternativ dazu, ein `composer update` auf der Konsole -
   siehe `'Forum' <https://community.contao.org/de/showthread.php?72871-MCW-MultiColumnWizard-als-Bundle-f%C3%BCr-Contao-4-(stable)&p=502709&viewfull=1#post502709>`_.


Neben dem Contao-Manager ist die Installation der Pakete und Bundles direkt über die Konsole per
Composer möglich - z.B. mit

``php web/contao-manager.phar.php composer require metamodels/core``

bzw.

``php web/contao-manager.phar.php composer require metamodels/bundle_start``

Statt `php` ist ggf. der Pfad zum entsprechenden PHP-Binary anzugeben -
siehe :ref:`rst_cookbook_symfony_mm-2-1-tips`.

Nach der Installation ist über das Install-Tool von Contao ein **Update der Datenbank nicht zu vergessen!**

Es folgen weitere Informationen zu den einzelnen Versionen von MetaModels.


Installation von MM 2.2 für Contao 4.9
--------------------------------------

MetaModels 2.2 bringt eine volle Kompatibilität zu Contao 4.9 mit sowie verschiedene Features und
Optimierungen. Zum Beispiel ist MM 2.2 kompatibel zum `strict mode` von höheren MySQL-Versionen oder
aktueller MariaDB oder die manuelle Dateisortierung.

Die Installationsvoraussetzungen für MetaModels 2.2 sind:

* ein laufendes Contao 4.9.x (LTS) und
* PHP 7.2/7.3/7.4
* MySQL ab 5.5.5 (InnoDB), MariaDB

Höhere Versionen von Contao und/oder PHP sind möglich, werden aber nicht ofiziell supportet.

.. seealso:: Der DCG 2.2.0 wird nun auch über PackDis! ausgeliefert. Dabei haben wir festgestellt,
   dass der Composer ab und an damit nicht zurecht gekommen ist – warum auch immer… |br|
   Bei Update kommt z.B. die Meldung |br|
   ``[InvalidArgumentException]
   Unknown downloader type: . Available types: git, svn, fossil, hg, perforce, zip, rar, tar, gzip, xz, phar, file, path.`` |br| 
   Wenn das auftritt, bitte den Ordner vendor/contao-community-alliance/dc-general (ggf. auch
   /vendor/contao-community-alliance/dc-general-contao-frontend) löschen und das Update neu starten.

   Bei HostEurope gab es zudem noch das Problem, dass der Composer kein Cache-Verzeichnis anlegen konnte.
   Man kann das mit einer eigenen Umgebungsvariable zu einem Pfad, der für den eigenen User erreichbar und
   beschreibbar ist, umgehen. Dazu einen Ordner .cache anlegen und den kompletten (absolut) Pfad wie folgt mit
   in den Aufruf einbauen: |br|
   ``COMPOSER_HOME=/is/htdocs/kunde_xyz/www/mein_projekt/.cache /usr/bin/php7.4 -d memory_limit=-1 -d max_execution_time=900 web/contao-manager.phar.php update -v`` |br|
   Inwieweit die Probleme auch ein Update über den Contao-Manager betrifft, haben wir noch keine Rückmeldung.

**MetaModels 2.2 ist ab sofort einsatzbereit** und kann über den Composer (Konsole) oder den
Contao-Manager installiert werden. Zugang zu dem aktuell noch geschütztem Repository erhält
man über unser "early adopter Programm" - mehr dazu unter Fundrasing auf der
`MM Webseite <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-2>`_.

**Weitere Features von MM 2.2:**
Wir haben eine :ref:`Übersichtsseite mit den Änderungen und Funktionen zu MM 2.2 <new_in_mm220>` zusammengestellt.

.. seealso:: Beim Update der DEV-Version zu beachten: |br|
   Während der Entwicklungsphase bekommen die über git zur Verfügung gestellten Pakete bei einer Änderung
   immer neue Dateinamen. Diese sind in der composer.lock mit abgespeichert. Dadurch kann es vorkommen, dass
   bei einem `composer install` die Pakete nicht gefunden werden können und eine Fehlermeldung kommt. |br|
   In dem Fall, bitte ein `composer update` zum Aktualisieren der composer.lock aufrufen. |br|
   |br|
   In den Paketen werden die Abhängigkeiten der Pakete nicht auf die DEV-Version eingetragen - das kann bedeuten,
   dass man z. B. `attribute_numeric` für `attribute_timestamp` selbständig in die composer.json eintragen muss.
   Bei Fragen steht der Support zur Seite.

Das MM-Team unterstützt mit der Arbeit/Finanzierung auch die Arbeiten am
`DC_General <https://github.com/contao-community-alliance/dc-general/>`_, der u.A. bei MM für die Anzeigen
im Backend zuständig ist und viele tolle Funktionen mitbringt.

.. seealso:: Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um finanzielle
   Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
   und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzten Zuwendungen, sind
   das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
   ausgestellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/spenden>`_


Installation von MM 2.1 für Contao 4.4
--------------------------------------

Die Installationsvoraussetzungen für MetaModels 2.1 sind:

* ein laufendes Contao 4.4.x (LTS) und
* PHP 7.1/7.2
* MySQL ab 5.5.5 (InnoDB), MariaDB (ohne `strict mode`)

Höhere Versionen von Contao und/oder PHP sind möglich, werden aber nicht ofiziell supportet.


Hinweise und Anleitungen für ältere Contao- und MM-Versionen
------------------------------------------------------------

* :ref:`cookbook_move_mm2.0_to_2.1`
* :ref:`cookbook_install_mm2.0-and-older`


Umstellung von `metamodels/bundle_*` auf separate Module
--------------------------------------------------------

Bei einer Umstellung z.B. von 2.0 auf eine neuere Version oder Neuinstalltion ist es eine gute Gelegenheit, nur noch
die Attribute und Filter zu installieren, die für das Projekt notwendig sind. War zuvor z.B. `metamodels/bundle_start`
oder `metamodels/bundle_all` im Einsatz, kann man mit den folgenden SQL-Befehlen die wirklich verwendeten Attribute
und Filter abfragen:

.. code-block:: sql
   :linenos:
   
   -- Attribute
   SELECT type FROM `tl_metamodel_attribute` GROUP BY type ORDER BY type
   
   -- Filter
   SELECT type FROM `tl_metamodel_filtersetting` GROUP BY type ORDER BY type

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
           "metamodels/attribute_alias": "dev-master#a97ec461ae1254fa616811c3ce234515238fb3c7",
           ...


.. |br| raw:: html

   <br />
