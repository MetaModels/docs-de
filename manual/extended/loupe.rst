.. _rst_extended_loupe:

Loupe-gestützte Volltextsuche
#############################

.. note:: Steht ab MetaModels 2.4 zur Verfügung - benötigt mind. PHP 8.3.

`Loupe <https://github.com/loupe-php/loupe>`_ ist eine Volltextsuchmaschine auf der Basis von SQLite. Die
Implementierung orientiert sich u. a. an der Suchmaschine `Meilisearch <https://www.meilisearch.com/>`_ aber mit dem
Vorteil, relativ geringe technische Resourcen zu verlangen - PHP und SQLite reichen. `Loupe` hat verschiedene Features
wie Stemming, Ähnlichkeitssuche nach Damerau-Levenshtein, Ranking u.v.a.m implementiert -
`siehe Loupe <https://github.com/loupe-php/loupe>`_.

Für die Verwendung der Suchmaschine `Loupe` wurde für MetaModels eine eigene Filterregel gebaut. In den Einstellungen
können die zu indexierenden Attribute ausgewählt und Schwellenwerte für Tippfehler angegeben werden.

Die Reihenfolge der zu indexierenden Attribute geht in das `Ranking <https://github.com/loupe-php/loupe/blob/develop/docs/ranking.md#4-attribute-ranking>`_
mit ein, d. h. die Attribute sollten nach ihrer Wichtigkeit für die Suche sortiert werden.

Mit den Schwellenwerten für Tippfehler kann angegeben werden, bei welcher Wortlänge wie viele "Schreibfehler" enthalten
sein dürfen - typische Werte sind z. B. bei einer Wortlänge von fünf Buchstaben ein Schreibfehler und ab neun
Buchstaben zwei Schreibfehler.

Die Indexierung der Inhalte der Attribute erfolgt beim Speichern der Datensätze automatisch. Eine komplette Reindexierung
erfolgt über ein entsprechendes Icon in der Liste der Filterregeln. Der genaue Ablauf und die notwendigen Einstellungen
sind :ref:`folgend erklärt <indexing_loupe>`.

Die Filterregel sollte bei dem Filter an erste Stelle gesetzt werden, weil damit die Reihenfolge der Ergebnisse (Items)
bestimmt wird - die Reihenfolge spiegelt das Ranking der Fundstellen wieder.

Im Frontend gibt es eine Texteingabe für die Suche. Exakte Wortgruppen können beim Suchstring mit ``"`` abgegrenzt werden.
Mit ``-`` ist der Ausschluss von Wörtern oder Wortgruppen möglich.

Aktuell werden folgende Attribute indexiert:

- Text
- Langtext
- Übersetzter Text
- Übersetzter Langtext


.. _indexing_loupe:
Ablauf der Indexierung und Einstellungen
––––––––––––––––––––––––––––––––––––––––

Wenn ein Datensatz mit geänderten Inhalten der zu indexierenden Attribute gespeichert oder in der Filterregel die
Reindexierung gestartet wird, erfolgt eine Meldung an den `Symfony-Messenger <https://symfony.com/doc/6.4/messenger.html>`_.
Gespeichert werden die "Messanger-Aufträge" in der Tabelle ``messenger-messages`` - ggf. wird diese neu erzeugt.

Für die Verarbeitung der Messenger-Jobs sind verschiedene Einstellungen in der ``config.yml`` abzulegen - folgend ein
Beispiel:

.. code-block:: yaml
   :linenos:

   # config/config.yml
   framework:
     messenger:
       failure_transport: failed
       transports:
         failed:
           dsn: 'doctrine://default?queue_name=failed'
         async:
           dsn: 'doctrine://default'
           retry_strategy:
             max_retries: 3
             delay: 30000
             multiplier: 2
             max_delay: 0
             # jitter: 0.1
       routing:
         '*': async

Der Messenger wiederum wartet darauf, für die weitere Verarbeitung angestoßen zu werden. Das erfolgt mit dem Befehl
``messenger:consume``, dem weitere Parameter mit auf den Weg gegeben werden können. Es ist zu empfehlen, die
Verarbeitung asynchron zu starten, damit gleichzeitig mehrere Jobs abgearbeitet werden können. Zudem sollte ein
Zeitlimit in Sekunden mit ``-t <n>`` gesetzt werden. Zusammen dann

``php bin/console messenger:consume async -t 50``

Dieser Befehl kann kontinuierlich per Cronjob ausgeführt werden. Zwischen der Startzeit des Cronjobs z. B. jede Minute
und dem Zeitlimit sollte es ein Puffer geben. Die genauen Einstellungen hängen von den zu verarbeitenden Daten und von
der Servergeschwindigkeit ab.

Während der Indexierung wird für jede Filterregel ein eigener Index als SQLite-DB angelegt - bei mehrsprachigen Models
bzw. mehrsprachigen Attributen gibt es wiederum für jede Sprache einen eigenen Index. Die Daten liegen unter
``var/mm_loupe_index/<id-Loupe-Filterregel>/``.

Bei einer kompletten Reindexierung wird die Index-Datenbank vorher geleert.

