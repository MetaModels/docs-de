.. _manual_install:

MetaModels installieren und aktualisieren
=========================================

Das aktuelle MetaModels 2.1 für Contao 4 wird wie gehabt für die aktuelle LTS (4.4)
ausgiebig getestet und dafür frei gegeben - nach den bisherigen Tests, läuft MM 2.1
aber auch problemlos unter 4.6.

Die Installation von MM 2.1 setzt PHP von mind. Version 7.1 voraus - empfohlen wird PHP 7.2.

MetaModels 2.1 kann über den Contao-Manager oder über die Konsole per Composer installiert werden - 
siehe folgender Abschnitt.

Für eine Re-Finanzierung der umfangreichen Arbeiten, bittet das MM-Team um eine finanzielle
Zuwendung. Als Richtgröße sollte der Umfang des zu realisierenden Projektes genommen werden
und etwa 10% einkalkuliert werden - aufgrund der Erfahrung der letzen Zuwendungen, sind
das Beträge zwischen 100€ und 500€ (Netto) - eine Rechnung inkl. MwSt wird natürlich immer
erstellt. `Mehr... <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-1>`_

Hinweise zu älteren Versionen von MetaModels und Versionswechsel sind am `Ende der Seite
<#hinweise-und-anleitungen-fur-altere-contao-und-mm-versionen>`_ zu finden.


Installation von MM 2.1
-----------------------
Die Installtionsvoraussetzungen für MetaModels 2.1 sind ein laufendes Contao 4.4. oder höher und
PHP 7.1 oder höher.

Im Contao-Manager werden über die Eingabe `metamodels/` alle zur Verfügung stehenden Pakete
aufgelistet. Neben dem Basispaket `metamodels/core` können darüber weitere Attribute und Filter
installiert werden.

Neben den einzelnen Paketen gibt es verschiedene `Bundles`, die verschiedene Pakete für eine
Installation zusammen fassen.

Für den Einstieg in MetaModels ist das Bunde `metamodels/bundle_start` zu empfehlen - Hiermit
wird der Core sowie die wichtigsten Attribute und Filter ohne z.B. die Pakete für die Mehrsprachigkeit
installiert.

Wie in MetaModesls 2.0 gibt es auch das Bundle `metamodels/bundle_all`, welches neben dem
`bundle_start` auch die mehrsprachigen Pakete mit installiert (Hinweis: die Pakete `translatedselect`
`translatedtags` sind hier nicht mehr inkludiert, da diese nur für Spezialfälle einzusetzen sind).

Neben dem Contao-Manager ist die Installation der Pakete und Bundles direkt über die Konsole per
Composer möglich - z.B. mit

``php web/contao-manager.phar.php composer require metamodels/core``

Statt `php` ist ggf. der Pfad zum entsprechenden PHP-Binary anzugeben -
siehe :ref:`rst_cookbook_symfony_mm-2-1-tips`.

Nach der Installation ist ein Update der Datenbank nicht zu vergessen!


Test von speziellen Paketen
---------------------------

Neben den aktuell verfügbaren und frei gegebenen Pakete von MetaModels, gibt es teilweise
Pakete mit Bugfixes oder neuen Funktionen, die getestet werden können/müssen - das
könnte z.B. für den MetaModels-core das ein Paket "dev-hotfix-xyz" sein. Zu sehen sind die Pakete u.a.
auf Github im entsprechenden Repository (z.B. MetaModels/core) im Reiter
`'branches' <https://github.com/MetaModels/core/branches>`_.

Möchte man ein solches Paket testen, muss es explizit im Contao-Manger oder in der composer.json mit seiner
Version angegeben werden.

Nach "Paket für die Installation vormerken" muss noch die Anpassung der Composer-JSON erfolgen. Dazu in
der Paketverwaltung auf "Einstellungen" und anschließend auf "Expertenmodus" klicken - die
angezeigte JSON-Datei muss im Knoten "require" um den Eintrag "as 2.0.0" erweitert bzw. ergänzt werden
(bei mehreren Extra-Paketen natürlich bei jedem Eintrag).

zum Beispiel: |br|
``"metamodels/core": "dev-hotfix-xyz"`` ändern zu |br|
``"metamodels/core": "dev-hotfix-xyz as 2.0.0"``

Nach der Installation per "Pakete aktualisieren" sollte der Composer-Cache über "Einstellungen"
der Paketverwaltung gelöscht werden.

Da MetaModels eng mit dem DC_General (DCG) verzahnt ist, muss zum Testen häufig auch hier
auf eine neuere Version geupdatet werden. Das Vorgehen ist das gleiche wie bei MetaModels
inklusive der Anpassung des JSON-Eintrages mit "as 2.0.0".

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
           "contao-community-alliance/dc-general": "dev-hotfix/beta-39 as 2.0.0",
           "metamodels/bundle_all": ">=2.0.0.0,<3-dev",
           "metamodels/core": "dev-hotfix/alpha-15 as 2.0.0",
           ...
       },
       ...
   }

Um auf den ursprünglichen Stand zurück zu gelangen, kann das Paket im Paketmanager einfach gelöscht
werden.

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
           "contao-community-alliance/dc-general": "dev-hotfix/beta-39 as 2.0.0",
           "metamodels/bundle_all": ">=2.0.0.0,<3-dev",
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
           "contao-community-alliance/dc-general": "dev-hotfix/beta-39 as 2.0.0",
           "metamodels/bundle_all": ">=2.0.0.0,<3-dev",
           "metamodels/attribute_alias": "dev-master#a97ec461ae1254fa616811c3ce234515238fb3c7",
           ...



Hinweise und Anleitungen für ältere Contao- und MM-Versionen
------------------------------------------------------------

:ref:`cookbook_install_mm2.0-and-older`

* :ref:`cookbook_move_mm2.0_to_2.1`
* :ref:`cookbook_install_mm2.0-and-older`

.. |br| raw:: html

   <br />