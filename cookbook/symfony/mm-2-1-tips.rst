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

``/usr/bin/php74 -v``


Composer-Update
---------------

Mit folgendem Befehl wird ein Update eingeleitet:

``/usr/bin/php74 web/contao-manager.phar.php composer update -v``

oder mit Speicher- und Laufzeitzuweisung

``/usr/bin/php74 -d memory_limit=-1 -d max_execution_time=900 web/contao-manager.phar.php composer update -v``

Mit dem Parameter "-v" bzw. "-vv" oder "-vvv" erhalt man verschiedene Detailstufen der Ausgabe. Mit dem
zusätzlichen Parameter "--dry-run" wird ein "Trockenlauf" als Test durchegführt.

Nach einem Update ggf. das Installtool aufrufen, damit Datenbankänderungen
durchgeführt werden (wird gern vergessen :D).

Die composer.phar sollte regelmäßig aktualisiert werden - dazu folgenden Befehl aufrufen:

``/usr/bin/php74 web/contao-manager.phar.php self-update``


Paketversion ermitteln
----------------------

Bei Fehlermeldungen oder Nachfragen bei Entwicklern ist die Auskunft über die installierte Version
einer Erweiterung wichtig. Das kann man über den Paketnamen ermitteln z.B. für den DC_General

``/usr/bin/php74 web/contao-manager.phar.php composer show | grep dc-general``

Mit

``/usr/bin/php74 web/contao-manager.phar.php composer show``

werden alle Pakete ausgegeben.


Cache leeren
------------

Bei Anpassungen den Contao-Cache leeren:

"Soft" (Empfehlung):

``vendor/bin/contao-console cache:clear --env=prod`` |br|
``vendor/bin/contao-console cache:warmup``

bzw. mit dem Parameter ``--env=dev`` wenn man die Seite mit "app_dev.php" 
im Entwicklungsmodus aufruft. Muss der Pfad zu PHP mit aufgerufen werden,
ist dieser (z.B. ``/usr/bin/php73``) vor das "vendor" zu setzen.

oder die "harte Tour":

``rm -rf var/cache/{dev,prod}``

und löscht "alles" aus dev und prod.

In einem Script als Kombination - `siehe Gist von Sven Baumann <https://gist.github.com/baumannsven/dabcc9fa16ca89007103b5795c1e031e>`_


Symfony-Toolbar
---------------

Die Symfony-Toolbar erleichtert die Anzeige von Templatewerten und das Debugging während
der Erstellung eines Projektes mit MetaModels.

Ab Contao 4.9 kann diese über den Debugmodus aus dem Backend oder Contao-Manager aktiviert
werden, oder über Environment-Datei `.env` mit dem Eintrag

``APP_ENV=dev``

In Contao 4.4 ist der Debugmodus per `app_dev` zu aktivieren - der Seitenaufruf ist dann
"domain.tld/app_dev.php/...". Dazu muss ein Zugang für app_dev eingerichtet werden über

``vendor/bin/contao-console contao:install-web-dir --user=ichbins --password=totalgeheim``

oder ab Contao 4.5 über den Contao-Manager.

Für den app_dev-Zugang kann aber nur ein User angelegt werden.

Achtung: sofern der Zugang zur Seite über htaccess geschützt ist, müssen user+passwort
für htaccess und app_dev die selben sein!

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

Möchte man sich eine Debugausgabe ansehen kann es vorkommen, dass durch eine Warning die Anzeige nicht
zustande kommt. Die Warning kann z. B. aus einem Theme oder einer anderen Erweiterung kommen und mit
MetaModels nichts weiter zu tun haben. Damit man dennoch seine gewünschte Anzeige über die Symfony-Toolbar
angezeigt bekommt, kann man die Warnings unterdrücken. Dazu in der `config.yml` folgenden Eintrag
einfügen:

.. code-block:: php
   :linenos:

    // config/config.yml
    framework:
      profiler:
        only_exceptions: true


.. |img_symfony-toolbar| image:: /_img/screenshots/cookbook/debug/symfony-toolbar.jpg

.. |br| raw:: html

   <br />
