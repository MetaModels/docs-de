.. _rst_cookbook_specials_delete-superfluous-data:

Löschen von überflüssigen Daten
===============================

.. note:: Vor dem Löschen unbedingt eine Datensicherung durchführen! - |br|
   z. B. mit ``php vendor/bin/contao-console contao:backup:create``

Werden Models oder Attribute gelöscht, kann es vorkommen, dass nicht alle Datensätze mitgelöscht werden. Das ist bei
allen Attributen der Fall, die ihre Daten nicht direkt in der MetaModel-Tabelle ``mm_*`` speichern, sondern eigene
Tabellen verwenden. Das ist bei folgenden Attributen der Fall:

* Bewertung [tl_metamodel_rating]
* Tabelle multi (MCW) [tl_metamodel_tablemulti]
* Text-Tabelle [tl_metamodel_tabletext]
* Mehrfachauswahl (tags) [tl_metamodel_tag_relation]
* Übersetzte Checkbox [tl_metamodel_translatedcheckbox]
* Übersetzte Datei [tl_metamodel_translatedlongblob]
* Übersetzter Langtext [tl_metamodel_translatedlongtext]
* Übersetzte Tabelle multi (MCW) [tl_metamodel_translatedtablemulti]
* Übersetzte Text-Tabelle [tl_metamodel_translatedtabletext]
* Übersetzter Text [tl_metamodel_translatedtext]
* Übersetzte URL [tl_metamodel_translatedurl]

Zum Anzeigen und Löschen gibt es ein :download:`Shell-Script (check-mm-values.sh) zum Download <_download/check-mm-values.sh>`.

Das Script muss in den Basisordner von Contao geladen und ausführbar gemacht werden. Dazu die Berechtigungen auf ``755``
stellen - per SFTP-Programm oder auf Konsole mit ``chmod 755 check-mm-values.sh``.

Vor der Verwendung sollte in der Datei im Abschnitt Konfiguration der PHP-Pfad geprüft und ggf. angepasst werden.

.. code-block:: shell

   ...
   # Doctrine-Aufruf (ggf. PHP-Aufruf anpassen)
   DOCTRINE_BIN="php vendor/bin/contao-console doctrine:query:sql"
   ...

Auf der Konsole kann das Script mit den Parametern ``show`` oder ``delete`` aufgerufen werden - ``show`` zeigt alle
überflüssigen Daten je Tabelle an und ``delete`` löscht diese nach einer Bestätigung. Der Aufruf ist dann

* ``./check-mm-values.sh show`` bzw.
* ``./check-mm-values.sh delete``

In der Konfiguration des Scripts können weitere Tabellen mit aufgenommen oder entfernt werden.

Das Script ist so geschrieben, dass es auch mit einer einfachen Shell wie die in BusyBox läuft.

.. note:: Der Check und die Bereinigung wird ggf. in die Migration des jeweiligen Attributs überführt.

.. |br| raw:: html

   <br />
