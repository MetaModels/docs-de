.. _rst_extended_health-check:

MetaModels Health-Check
========================

Findet und bereinigt inkonsistente MetaModels-Daten im Backend - z. B. Zeilen, die in den
Attribut-eigenen Speichertabellen (Tags, Mehrfach-/Tabellentext, Bewertungen und deren übersetzte
Varianten) zurückbleiben, nachdem ein Attribut oder ein Datensatz gelöscht wurde, weil der DCG
diese Zusatztabellen nie zu Gesicht bekommt - ein Risiko, das bei komplexen Datenstrukturen
zunimmt und solange nicht vollständig über Fremdschlüssel (Foreign-Keys) auf Datenbankebene
verhindert wird.


Voraussetzungen
----------------

* ab MetaModels 2.5
* eigenes Composer-Paket, keine Abhängigkeit von anderen Erweiterungen außer MetaModels selbst


Installation per Contao-Manager oder Composer
----------------------------------------------

.. code-block:: bash

   composer require metamodels/health-check


Aufruf
------

Nach der Installation erscheint in der Liste "Alle MetaModels" oben rechts ein zusätzlicher
Menüpunkt "Health-Check" neben "Mehrere bearbeiten".

|img_health-button|

Wie die gesamte MetaModel-Administration ist auch der **Health-Check nur für Admins erreichbar**
- serverseitig durchgesetzt, nicht nur in der Navigation versteckt.


Die Ansicht
-----------

|img_health-overview|

**Prüfungen:** Jede Prüfung erscheint als eigene Zeile mit einer Checkbox links, Name und
Beschreibung, dem Ergebnis der letzten Ausführung, dem Zeitpunkt der letzten Prüfung sowie eigenen
Schaltflächen. Über die Checkbox links oben in der Kopfzeile lassen sich alle Prüfungen auf einmal
an- oder abwählen; "Prüfungen durchführen" führt dann nur die angehakten Prüfungen aus. Eine
einzelne Prüfung lässt sich unabhängig davon jederzeit über ihre eigene "Prüfen"-Schaltfläche
anstoßen. Die Seite führt beim Öffnen keine Prüfung automatisch aus - angezeigt wird das Ergebnis
der letzten tatsächlichen Ausführung (oder "Noch nicht geprüft").

.. warning:: Über der Prüfungsliste steht ein Hinweis, die Daten vor einer Bereinigung genau zu
   prüfen und vorher ein Backup anzulegen - eine Bereinigung lässt sich nicht rückgängig machen.

Mitgeliefert werden folgende Prüfungen:

* Verwaiste Zeilen in den Attribut-eigenen Speichertabellen (Mehrfach-Tabellenwerte, Tabellentext,
  Tags-Zuordnungen, Bewertungen, übersetzte URL-Werte sowie deren übersetzte Varianten) - Zeilen,
  deren Attribut oder zugehöriger Datensatz nicht mehr existiert.
* Kaputte Eltern-Kind-Referenzen: Kind-Datensätze (:ref:`Kind-Tabellen
  <component_relations_child-tables>`), deren Eltern-Datensatz nicht mehr existiert.
* Verwaiste Datei-Referenzen: Attribute vom Typ "Datei" oder "Übersetzte Datei", deren
  gespeicherter Verweis auf keine Datei in der Dateiverwaltung mehr zeigt - vergleichbar mit einer
  Datei, die direkt im Dateisystem statt über Contao gelöscht wurde. Diese Prüfung ist **rein
  informativ und wird nicht automatisch behoben**, da eine Korrektur hier einen (teils
  serialisierten) Wert gezielt umschreiben müsste statt nur eine Zeile zu löschen - dafür ist das
  Risiko einer automatischen Bereinigung zu hoch.

**Details:** Jede Prüfung, die dahinter tatsächlich Datensätze prüft (bei der reinen
Datei-Referenzen-Prüfung genauso wie bei den bereinigbaren), hat eine eigene
"Details"-Schaltfläche, die die betroffenen Datensätze in einer Tabelle zeigt - noch bevor man
sich für eine Bereinigung entscheidet. Bei den generischen "Verwaiste Zeilen"-Prüfungen (und der
Eltern-Kind-Prüfung) werden dafür alle Spalten der jeweiligen Tabelle automatisch aus dem
Datenbankschema ermittelt - das funktioniert generisch für jede angebundene Tabelle, auch für
eigene Prüfungen; lange oder binäre Werte (z. B. eine Blob-Spalte) werden dabei als "(N bytes)"
zusammengefasst statt roh ausgegeben. Bei der Datei-Referenzen-Prüfung ist die Tabelle stattdessen
kuratiert: MM-Tabelle, Attribut, Datensatz-ID, Sprache (bei "Übersetzte Datei") und Anzahl (wie
viele verwaiste Referenzen dieser eine Datensatz beisteuert - die Spalte summiert sich zur
Gesamtzahl der Prüfung auf, auch wenn ein Datensatz mit mehreren verwaisten Dateien in einem
Mehrfach-Feld weniger Tabellenzeilen als Gesamttreffer erzeugt). Die Tabelle im Popup zeigt
maximal 50 Zeilen mit einem Hinweis "... und N weitere" bei mehr Treffern; auf der Konsole (siehe
unten) gibt es diese Begrenzung nicht.

Bei den bereinigbaren Prüfungen gibt es zwei weitere Schaltflächen: **"Fix Vorschau"** zeigt, wie
viele Zeilen entfernt würden, ohne etwas zu löschen; **"Fix Run"** löscht tatsächlich. Beide öffnen
dazu ein Popup mit einer eigenen "Start"-Schaltfläche - dieser bewusste Zwischenschritt ersetzt
eine zusätzliche "Wirklich?"-Rückfrage - und zeigen darin zusätzlich zur Anzahl dieselbe
Detail-Tabelle wie oben; bei "Fix Run" wird sie vor dem Löschen erfasst, damit sie danach noch
zeigt, was entfernt wurde. "Fix Vorschau"/"Fix Run"/"Details" sind erst nutzbar, nachdem "Prüfen"
tatsächlich etwas gefunden hat - vorher sind sie ausgegraut. Jede tatsächlich ausgeführte
Bereinigung wird im Bereinigungs-Protokoll unten auf der Seite festgehalten (Datum, Prüfung,
Anzahl entfernter Zeilen, ausführender Benutzer).

Eine Prüfung erscheint nur dann in der Liste, wenn sie für die aktuelle Installation überhaupt
zutreffen kann - z. B. taucht die Prüfung für Mehrfach-Tabellenwerte nur auf, wenn
``metamodels/attribute_tablemulti`` installiert ist. So wird nie fälschlich "keine Probleme
gefunden" für eine Tabelle angezeigt, die es in der eigenen Installation gar nicht gibt.

Unter der Beschreibung jeder Prüfung steht außerdem ihre Konsolen-Id (siehe unten,
:ref:`rst_extended_health-check_console`) - der Wert, der ``metamodels:health:run`` übergeben
wird.

**Sicherung:** Über "Jetzt Backup erstellen" lässt sich direkt von der Seite aus eine
Datenbank-Sicherung anstoßen - über denselben Mechanismus, den Contao auch selbst nutzt
(System > Wartung > Sicherung). Das Rückspielen einer Sicherung erfolgt bewusst **nicht** auf
dieser Seite, sondern wie gewohnt über den Contao-Manager oder das Konsolenkommando
``contao:backup:restore``.


.. _rst_extended_health-check_console:

Konsolenkommandos
------------------

Jede Prüfung lässt sich auch über die Konsole aufrufen - z. B. für Cronjobs oder CI.

.. code-block:: bash

   # Verfügbare Prüfungen mit ihrer Id, letztem Prüfzeitpunkt und letztem Ergebnis auflisten
   php bin/console metamodels:health:list

   # Eine einzelne Prüfung anhand ihrer Id ausführen (Id siehe "metamodels:health:list")
   php bin/console metamodels:health:run orphaned_tag_relation

   # Alle Prüfungen auf einmal ausführen
   php bin/console metamodels:health:run --all

   # Zusätzlich jeden betroffenen Datensatz auflisten - anders als im Backend-Popup ohne
   # jede Begrenzung, lässt sich also z. B. auch in eine Datei umleiten
   php bin/console metamodels:health:run orphaned_tag_relation --details

   # Vorschau: wie viele Zeilen würde eine Bereinigung entfernen?
   php bin/console metamodels:health:repair orphaned_tag_relation --dry-run

   # Tatsächlich bereinigen
   php bin/console metamodels:health:repair orphaned_tag_relation --force

``metamodels:health:list`` und ``metamodels:health:run`` sind rein lesend - jeder Lauf wird aber
genauso wie ein Lauf über das Backend im "Letzte Prüfung"-Feld hinterlegt.
``metamodels:health:run`` beendet sich mit einem Exit-Code ungleich 0, sobald mindestens eine
Prüfung Probleme gefunden hat - damit lässt sich der Befehl direkt als Monitoring-Check einbinden.

``metamodels:health:repair`` ist das Konsolen-Äquivalent zu "Bereinigung als Vorschau (dry-run)"
und "Jetzt bereinigen": genau eine der beiden Optionen ``--dry-run``/``--force`` ist Pflicht, es
gibt bewusst keinen stillen Standardfall. Eine per ``--force`` tatsächlich ausgeführte Bereinigung
landet im selben Bereinigungs-Protokoll wie eine über das Backend ausgeführte - als Benutzer steht
dort "-", da es hier (z. B. bei einem Cronjob) keinen angemeldeten Backend-Benutzer gibt. Ein
``--all`` gibt es hier bewusst nicht: eine Bereinigung soll immer eine bewusste Entscheidung pro
Prüfung sein.


Eigene Prüfungen implementieren
--------------------------------

Die Prüfungen sind modular aufgebaut - eigene Prüfungen lassen sich ergänzen, ohne dieses Paket
selbst zu verändern. **Es gibt dafür keinen EventListener**, sondern einen regulären
Symfony-Service, der über einen DI-Tag registriert wird - genau wie z. B. Contaos eigene
Migrationen (``Contao\CoreBundle\Migration\MigrationInterface``) funktionieren.

Eine Prüfung implementiert
``MetaModels\HealthCheckBundle\HealthCheck\HealthCheckInterface``:

.. code-block:: php

   interface HealthCheckInterface
   {
       public function getId(): string;
       public function getLabel(): string;
       public function getDescription(): string;
       public function check(): HealthCheckResult;
   }

``check()`` ist immer rein lesend und liefert ein ``HealthCheckResult`` mit einer Liste von
``HealthCheckIssue`` (jeweils Beschreibung + Anzahl betroffener Zeilen). Soll die Prüfung auch
selbst bereinigen können, zusätzlich
``MetaModels\HealthCheckBundle\HealthCheck\RepairableHealthCheckInterface`` implementieren:

.. code-block:: php

   interface RepairableHealthCheckInterface extends HealthCheckInterface
   {
       public function repair(bool $dryRun): HealthCheckRepairResult;
   }

``repair()`` ermittelt die betroffenen Zeilen bei jedem Aufruf frisch (nicht anhand einer
möglicherweise veralteten Liste aus einem vorherigen ``check()``) und löscht sie nur, wenn
``$dryRun`` false ist.

Registriert wird die eigene Prüfung in der eigenen ``services.yml`` mit dem Tag
``metamodels_health_check.check``:

.. code-block:: yaml

   services:
     App\HealthCheck\MyCustomCheck:
       arguments:
         - '@database_connection'
         - '@translator'
       tags: ['metamodels_health_check.check']

Damit taucht die eigene Prüfung automatisch in der Liste auf der Health-Check-Seite auf - ganz
ohne Änderung an ``metamodels/health-check`` selbst.

Die Reihenfolge in der Liste (Backend wie ``metamodels:health:list``) folgt der ``priority`` des
Tags - eine reguläre Symfony-DI-Funktion, keine Eigenentwicklung dieses Pakets. Höhere Priorität
steht weiter oben, Standard ist 0, bei gleicher Priorität entscheidet die Registrierungsreihenfolge.
Die mitgelieferten Prüfungen nutzen die Werte 100 bis 10 (in Zehnerschritten, von "Verwaiste
Mehrfach-Tabellenwerte" bis "Verwaiste Datei-Referenzen"); eine eigene Prüfung ohne Angabe landet
also automatisch dahinter:

.. code-block:: yaml

   services:
     App\HealthCheck\MyCustomCheck:
       arguments:
         - '@database_connection'
         - '@translator'
       tags:
         - { name: 'metamodels_health_check.check', priority: 50 }


.. |img_health-button| image:: /_img/screenshots/extended/health-check/health-button.png
.. |img_health-overview| image:: /_img/screenshots/extended/health-check/health-overview.png
