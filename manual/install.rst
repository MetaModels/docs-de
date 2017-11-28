.. _manual_install:

MetaModels installieren und aktualisieren
=========================================

Für die Installation von MetaModels 2.0 für Contao 3 wird eine Contao-LTS-Version vorausgesetzt
- aktuell ist das Contao 3.5.x - sowie die `Systemvoraussetzungen analog der
Contao LTS <https://docs.contao.org/books/manual/3.5/de/01-installation/den-live-server-konfigurieren.html>`_.

Aktuell wird an einer Migration von MetaModels 2.0 für Contao 4 gearbeitet und steht mit
MetaModels 2.1 als Beta-Version bereit. Für einen Einsatz von MM 2.1 vor dem Abschluss
unseres Fundrasings kann unser "early adopter"-Programm genutzt werden.
`Mehr... <https://now.metamodel.me/de/unterstuetzer/fundraising#metamodels_2-1>`_


Installieren via Composer
-------------------------

MetaModels und alle seine Abhängigkeiten können mit der `Composer Paketverwaltung <https://c-c-a.org/ueber-composer>`_
im Contao-Backend installiert werden.

Wenn die Contao Installation bereits mit der neuen Composer Paketverwaltung versehen ist,
kann man MetaModels einfach installieren in dem das folgende Paket auswählt bzw.
in die Suchmaske des Composer eingegeben wird:

* `metamodels/bundle_all <https://packagist.org/packages/MetaModels/bundle_all>`_

Bei dem Bundle ist aktuell die Version "2.0.X" auszuwählen - diese installiert automatisch den kompletten
"MetaModels-Core" mit. Bei der Auswahl der Restriktionen kann zwischen verschiedenen Stufen wie "Bugfix Release",
"Feature Release" usw. ausgewählt werden - die aktuellen Funktionen von MetaModels werden mit "Feature Release"
aktiviert.

Werden nicht alle Attribute oder Filter gebraucht, können diese auch einzeln installiert
oder anderes `Bundle-Paket <https://github.com/MetaModels?query=bundle>`_ ausgewählt
werden. Die o.g. Pakete sind in Gruppen zusammen gefasst und sollten den meisten Ansprüchen genügen.

Im Composer-Client von Contao ("Paketverwaltung") ist über die Anzeige des Abhängigkeitsgraphen
(Checkbox) ein Überblick über die installierten Pakete möglich.

Installieren via Nightly build
------------------------------

Alternativ zur Installation via Composer ist die manuelle Installation per FTP möglich. Dazu wird
die aktuelle Version von MetaModels von der `Projektseite http://now.metamodel.me/ <http://now.metamodel.me/>`_
geladen, entpackt und per FTP auf den Server hoch geladen. Die meisten Ordner des Zip-Paketes
kommen in den Ordner `/system/module` - lediglich zwei PHP-Dateien für die Ajax-Funktionen
müssen in das Hauptverzeichnis (Root) von Contao.

Anschließend muss in der Erweiterungsverwaltung die Datenbank aktualisiert werden - kommt dabei eine Fehlermeldung
i.E. ``Fatal error: Class 'MetaModels\Helper\UpgradeHandler' ....!metamodels-tng-branch/config/runonce_0.php`` sollte
eine Leerung des internen Caches über die Contao-Systemwartung erfolgen.

Test von speziellen Paketen via Composer
----------------------------------------

Im Bundle 'bundle_all' sind die aktuell verfügbaren und frei gegebenen Pakete von MetaModels enthalten.
Zudem gibt es meist Pakete mit Bugfixes oder neuen Funktionen, die getestet werden können/müssen - das
könnte z.B. für den MetaModels-core das ein Paket "dev-hotfix-xyz" sein. Zu sehen sind die Pakete u.a.
auf Github im entsprechenden Repository (z.B. MetaModels/core) im Reiter
`'branches' <https://github.com/MetaModels/core/branches>`_.

Möchte man ein solches Paket testen, muss es separat in der Paketverwaltung ausgewählt und installiert
werden. Zur Auswahl in der Paketverwaltung die Checkbox "Abhängigkeiten installiert" anklicken und auf
entsprechende Paket z.B. 'metamodels/core' sowie in der anschließenden Auswahl auf z.B. auf 'dev-hotfix-xyz'.

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

MetaModels aktualisieren
------------------------

Wurde MetaModels über den Composer installiert, ist darüber auch die Aktualisierung durchzuführen.

Bei der manuellen Installation von MetaModels sind für ein Update verschiedene Aspekte zu beachten.
Das folgende Vorgehen hat sich bisher bewährt:

* alle alten Ordner von MetaModels löschen (welche das waren, kann im vorhergehenden Download des
  Nightly build ermittelt werden) - wirklich **ALLE**
* Contao Cache leeren -> /system/cache (alles da in dem Ordner)
* **KEIN** DB update machen (sonst ist alles weg)
* neue Nightly-build-Dateien wie bei Erstinstallation downloaden, entpacken und hoch laden (per FTP)
* DB-Update machen über die /contao/install.php

Aktuelle Informationen sind im
`Forum <https://community.contao.org/de/showthread.php?56725-MetaModels-aktualisieren-%28ohne-Composer%29>`_
zu finden.

MetaModels von "Nightly build" zu "Composer" wechseln
-----------------------------------------------------

Das Vorgehen ist ähnlich dem "MetaModels aktualisieren". Beim Wechsel auf Composer sollte beachtet
werden, dass der Composer für seine Arbeit einiges an RAM beansprucht - aus Erfahrungswerten sollten
es mindestens 100MB sein. Die genaue Größe hängt von den weiteren installierten Paketen sowie von den
Servereinstellungen des Providers ab.

Das folgende Vorgehen hat sich bisher bewährt:

* Composer installieren
* alle alten Ordner von MM löschen (welche das waren könnt ihr in euren Downloads vom Nightly sehen) - Wirklich ALLE
* Contao Cache leeren -> /system/cache (alles da drinn)
* **KEIN** DB update machen (sonst ist alles weg)
* in Composer dann die gewünschte MM Version auswählen zum Installieren vormerken und dann installieren
* das Datenbankupdate sollte dann von alleine vorgeschlagen und gemacht werden

Aktuelle Informationen sind im
`Forum <https://community.contao.org/de/showthread.php?59961-MetaModels-aktualisieren-%28von-Nightly-Build-zu-Composer%29>`_
zu finden.

.. |br| raw:: html

   <br />