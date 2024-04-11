.. _rst_cookbook_symfony_mm-2-1-tips:

Symfony und MM 2.x Tipps
========================

Für die Arbeit mit MM 2.x unter Symfony einige Tipps für den Start
oder als "Merkzettel".

Die Aufrufe auf der Konsole gehen immer vom Installationsverzeichnis von
Contao aus - also da, wo die composer.json liegt, d.h. vor allen Aufrufen
erstmal in das Verzeichnis wechseln:

``cd /var/www/mein-contao``

Anschließend sollte man sicher gehen, dass auf der Konsole die selbe
PHP-Version läuft, wie für die Webseite (siehe im Contao-Manager bei Tools > PHPINFO).
Auf der Konsole kann man das abfragen mit:

``php -v``

Ist die PHP-Version nicht gleich, muss man jeweils mit einem Pfad zum PHP-Binary
die Befehle aufrufen. Den Pfad erhlt man z.B. beim Systemcheck des
Contao-Managers mit angezeigt oder aus der Doku/Wiki des Providers.

``/usr/bin/php82 -v``


Composer-Update
---------------

Mit folgendem Befehl wird ein Update eingeleitet:

``/usr/bin/php82 web/contao-manager.phar.php composer update -v``

oder mit Speicher- und Laufzeitzuweisung

``/usr/bin/php82 -d memory_limit=-1 -d max_execution_time=900 public/contao-manager.phar.php composer update -v``

bzw. bei älteren Instalationen mit dem Pfad `web`

``/usr/bin/php82 -d memory_limit=-1 -d max_execution_time=900 web/contao-manager.phar.php composer update -v``

Mit dem Parameter "-v" bzw. "-vv" oder "-vvv" erhalt man verschiedene Detailstufen der Ausgabe. Mit dem
zusätzlichen Parameter "--dry-run" wird ein "Trockenlauf" als Test durchegführt.

Nach einem Update ggf. das Installtool aufrufen, damit Datenbankänderungen
durchgeführt werden (wird gern vergessen :D).

Die composer.phar sollte regelmäßig aktualisiert werden - dazu folgenden Befehl aufrufen:

``/usr/bin/php82 web/contao-manager.phar.php self-update``

Die Migration der Datenbank kann wie folgt angestoßen werden - :ref:`siehe Schemamanager <component_schema-manager>`

``/usr/bin/php82 vendor/bin/contao-console contao:migrate``

Paketversion ermitteln
----------------------

Bei Fehlermeldungen oder Nachfragen bei Entwicklern ist die Auskunft über die installierte Version
einer Erweiterung wichtig. Das kann man über den Paketnamen ermitteln z.B. für den DC_General

``/usr/bin/php82 public/contao-manager.phar.php composer show | grep dc-general``

Mit

``/usr/bin/php82 public/contao-manager.phar.php composer show``

werden alle Pakete ausgegeben.

Bei einer Entwicklungsversion z. B. bei Bezug aus dem "EAP" gibt es noch keine Versionsnummer - man kann aber
die Nummer des aktuellen Commits aus der `composer.lock` ermitteln. Man kann in der Datei z. B. nach 
`"name": "metamodels/core"` suchen. In dem Knoten `reference` steht die Commit-Nummer - die Angabe ersten
acht Zeichen reicht z. B. `8da81418`.


Cache leeren
------------

Bei Anpassungen den Contao-Cache leeren:

"Soft" (Empfehlung):

``/usr/bin/php82 vendor/bin/contao-console cache:clear --env=prod`` |br|
``/usr/bin/php82 vendor/bin/contao-console cache:warmup``

oder die "harte Tour":

``rm -rf var/cache/{dev,prod}``

und löscht "alles" aus dev und prod.


Symfony-Toolbar
---------------

Die Symfony-Toolbar erleichtert die Anzeige von Templatewerten und das Debugging während
der Erstellung eines Projektes mit MetaModels.

Den Debugmodus kann man aus dem Backend oder Contao-Manager aktivieren oder dauerhaft über
einen Eintrag Environment-Datei `.env` bzw. `.env.local` mit dem Eintrag

``APP_ENV=dev``

Die dauerhafte Aktivierung sollte nur lokal oder bei anderweitig geschützten Seiten erfolgen.

Im Debugmodus wird auch das Caching von Contao unterbunden und man muss den Cache nicht
so häufig leeren - bedeutet aber auch, dass die Seite ggf. "anders aussieht". Zudem wird
die Debug-Toolbar von Symfony im Browser eingeblendet.

|img_symfony-toolbar|

Muss im Quelltext mal was debugt werden, dann die Debug-Funktion ``debug()`` von Symfony verwenden
- die Ausgabe erfolgt dann in der Debug-Toolbar und kann über das "Fadenkreuz-Icon" eingesehen
werden.

Für das Debugging der Templates gibt es hier eine Beschreibung: :ref:`rst_cookbook_debug_templates`

Möchte man die SQL-Aufrufe z.B. einer Filterregel "Eigenes SQL" untersuchen, so kann man auf der
Debug-Toolbar auf "Doctrine" gehen - dort werden alle SQL-Aufrufe aufgelistet. Über die Suche im
Browser und einigen Bestandteilen wie der Tabellenname o.ä. ist das Query meist schnell gefunden.
Die Toolbar bietet den SQL-Code in verschiedenen Formatierungen an, so dass das Query einfach in
phpMyAdmin übernommen und getestet werden kann.


Abschalten der Warnings im Debugmode
------------------------------------

Möchte man sich eine Debugausgabe ansehen kann es vorkommen, dass durch eine Warning-Meldung die Anzeige
nicht zustande kommt. Die Warning-Meldung kann z. B. aus einem Theme oder einer anderen Erweiterung kommen
und mit MetaModels nichts weiter zu tun haben. Damit man dennoch seine gewünschte Anzeige über die
Symfony-Toolbar angezeigt bekommt, kann man die Warnings unterdrücken. Dazu in der `config.yml` folgenden
Eintrag einfügen:

.. code-block:: php
   :linenos:

    // config/config.yml
    framework:
      profiler:
        only_exceptions: true
    # oder
    contao:
        error_level: 8181


.. |img_symfony-toolbar| image:: /_img/screenshots/cookbook/debug/symfony-toolbar.jpg

.. |br| raw:: html

   <br />
