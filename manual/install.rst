MetaModels installieren und aktualisieren
-----------------------------------------

Installieren via Composer
^^^^^^^^^^^^^^^^^^^^^^^^^

MetaModels und alle seine Abhängigkeiten können mit der `Composer Erweiterung <https://c-c-a.org/ueber-composer>`_
im Contao-Backend geladen bzw. installiert werden.

Wenn die Contao Installation bereits mit der neuen Paketverwaltung Composer versehen ist,
kann man MetaModels
einfach installieren in dem folgende Pakete auswählt werden:

* `MetaModels/core <https://packagist.org/packages/MetaModels/core>`_ (~2.0)
* `MetaModels/bundle_all <https://packagist.org/packages/MetaModels/bundle_all>`_ (~1.0)

Werden nicht alle Attribute oder Filter gebraucht, können diese auch einzeln installiert
oder anderes `Bundle-Paket <https://github.com/MetaModels?query=bundle>`_ ausgewählt
werden. Die Pakete sind in Gruppen zusammen gefasst und sollten den meisten Ansprüchen genügen.

Installieren via Nightly build
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Alternativ zur Installation via Composer ist die manuelle Installation per FTP möglich. Dazu wird
die aktuelle Version von MetaModels von der `Projektseite http://now.metamodel.me/ <http://now.metamodel.me/>`_
geladen, entpackt und per FTP auf den Server hoch geladen. Die meisten Ordner des Zip-Paketes
kommen in den Ordner `/system/module` - lediglich zwei PHP-Dateien für die Ajax-Funktionem
müssen in das Hauptverzeichnis (Root) von Contao.

MetaModels aktualisieren
^^^^^^^^^^^^^^^^^^^^^^^^

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
