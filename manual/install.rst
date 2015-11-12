.. _manual_install:

MetaModels installieren und aktualisieren
=========================================

Für die Installation von MetaModels wird eine Contao-LTS-Version empfohlen
- aktuell ist das Contao 3.5.x

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

Test von speziellen Bundles via Composer
----------------------------------------

Soll eine spezielles Bundle für Metamodels z.B. zum Testen von Paket "dev-hotfix-xyz"
installiert werden, so muss zusätzlich nach Auswahl des entsprechenden Paketes per
"Paket für die Installation vormerken" noch die Anpassung der Composer-JSON erfolgen.

Dazu in der Paketverwaltung auf "Einstellungen" und anschließend auf "Expertenmodus" klicken - die
angezeigte JSON-Datei muss im Knoten "require" um den Eintrag "as 2.0.0" erweitert bzw. ergänzt werden.

zum Beispiel: |br|
``"metamodels/core": "dev-hotfix-xyz"`` ändern zu |br|
``"metamodels/core": "dev-hotfix-xyz as 2.0.0"``

Nach der Installation per "Pakete aktualisieren" sollte der Composer-Cache über "Einstellungen"
der Paketverwaltung gelöscht werden.

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