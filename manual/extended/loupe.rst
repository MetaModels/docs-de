.. _rst_extended_loupe:

Loupe-gestützte Volltextsuche
#############################

.. note:: Steht ab MetaModels 2.4 zur Verfügung - benötigt mind. PHP 8.3.

`Loupe <https://github.com/loupe-php/loupe>`_ ist eine Volltextsuchmaschine auf der Basis von SQLite. Die
Implementierung orientiert sich u. a. an der Suchmaschine `Meilisearch <https://www.meilisearch.com/>`_ aber mit dem
Vorteil, relativ geringe technische Resourcen zu verlangen - PHP und SQLite reichen. `Loupe` hat verschiedene Features
wie Stemming, Ähnlichkeitssuche nach Damerau-Levenshtein, Ranking, Stopp-Wörter u.v.a.m implementiert -
`siehe Loupe <https://github.com/loupe-php/loupe>`_.

Für die Verwendung der Suchmaschine `Loupe` wurde für MetaModels eine eigene Filterregel gebaut. In den Einstellungen
können die zu indexierenden Attribute ausgewählt und Schwellenwerte für Tippfehler angegeben werden.

Die Reihenfolge der zu indexierenden Attribute geht in das `Ranking <https://github.com/loupe-php/loupe/blob/develop/docs/ranking.md#4-attribute-ranking>`_
mit ein, d. h. die Attribute sollten nach ihrer Wichtigkeit für die Suche sortiert werden. Diese Option kann mit der
Checkbox `Ranking nach Reihenfolge der Attribute deaktivieren` abgeschaltet werden.

Mit den Schwellenwerten für Tippfehler kann angegeben werden, bei welcher Wortlänge wie viele "Schreibfehler" enthalten
sein dürfen - typische Werte sind z. B. bei einer Wortlänge von fünf Buchstaben ein Schreibfehler und ab neun
Buchstaben zwei Schreibfehler.

Die Indexierung der Inhalte der Attribute erfolgt beim Speichern der Datensätze automatisch. Eine komplette Reindexierung
erfolgt über ein entsprechendes Icon in der Liste der Filterregeln. Der genaue Ablauf und die notwendigen Einstellungen
sind :ref:`folgend erklärt <indexing_loupe>`.

Die Filterregel sollte bei dem Filter an erste Stelle gesetzt werden, weil damit die Reihenfolge der Ergebnisse (Items)
bestimmt wird - die Reihenfolge spiegelt das Ranking der Fundstellen wieder (:ref:`s. u. <sorting_loupe>`).

Im Frontend gibt es eine Texteingabe für die Suche. Exakte Wortgruppen können beim Suchstring mit ``"`` abgegrenzt werden.
Mit ``-`` ist der Ausschluss von Wörtern oder Wortgruppen möglich.

Aktuell werden folgende Attribute indexiert:

- Text
- Langtext
- Übersetzter Text
- Übersetzter Langtext


.. _sorting_loupe:
Sortierung und Ausgabe
----------------------

Damit die Datensätze (Items) nach der Relevanz (Score) der Suche sortiert werden, muss die Filterregel im Filter an erster
Stelle stehen. Die erste Filterregel, die eine Liste mit Ids der Items liefert, bestimmt immer die grundlegende
Reihenfolge der auszugebenden Datensätze. Das bedeutet, dass man nach der Filterregel Loupe eine Filterregel "Eigenes
SQL" anlegen kann die eine Sortierung liefert, wenn Loupe gar nicht angesprochen wird - z. B. nach Name. Zudem darf in
der Listeneinstellung keine individuelle Sortierung eingestellt sein - diese würde die Reihenfolge immer überschreiben.

Ist die Filterung mit Loupe in dem Filter vorhanden, ist in dem Ausgabearray der Datensätze ein Key ``loupe`` vorhanden.
Bei einer Filterung mit Loupe ist in dem Knoten die berechnete Relevanz des Datensatzes als ``score`` angegeben.

.. code-block:: html
   :linenos:

   <?php if ($arrItem['loupe']['score'] ?? false): ?>
       <p>Score: <?= \Contao\System::getFormattedNumber($arrItem['loupe']['score'], 4) ?></p>
   <?php endif; ?>

Bei den Einstellungen der Filterregel kann die Option "Hervorhebung der Suchbegriffe" aktiviert werden. Ist dies der
Fall, wird zusätzlich zum Sore noch im Knoten ``formattedHits`` die Attribute ausgegeben, bei denen durch die Suche
Fundstellen ermittelt werden konnten. Die Fundstellen sind inklusive einer Markierung in dem Array vorhanden.

Als Beispiel der folgende Screenshot - hier wurde nach "Moin" gesucht und es gab zwei Fundstellen. Obwohl beide
Datensätze das Wort "Moin" in der selben Schreibweise beinhalten, ist das Scoring beim zweiten Datensatz niedriger.
Das ergibt sich aus der eingestellten Reihenfolge der Attribute in der Filterregel erst Vorname (firstname) und
dann Name (name).

|img_item_output|


.. _indexing_stop-words:
Einstellung von Stopp-Wörtern
-----------------------------

Bei der Suche können einzelne Wörter definiert werden, die bei der Suche und Ranking übergangen werden sollen - mehr
dazu bei `Loupe <https://github.com/loupe-php/loupe/blob/main/docs/searching.md#stop-words>`_.

Die Behandlung der Stopp-Wörter bezieht auch die Behandlung von Wörtern mit ein, die z. B. per
`Stemming <https://github.com/loupe-php/loupe/blob/main/docs/tokenizer.md#stemming>`_ gebildet werden. Möchte man zum
Beispiel vermeiden, dass bei der Sucheingabe von ``forms`` auch nach dem häufig vorkommenden ``for`` gesucht wird,
sollte man ``for`` in der Liste der Stopp-Wörter eintragen.

Die Stopp-Wörter werden nicht beim Indexieren ausgeschlossen, sondern erst bei der Suche. Wenn ein Stopp-Wort allein
als solches eingegeben wird wie ``for``, wird aber dennoch danach gesucht.

Die Liste der Stopp-Wörter legt man in der eigenen ``config.yml`` ab. Für jede Sprache die in dem MetaModel angelegt
ist, kann ein eigener Bereich definiert werden - für alle einsprachigen Model kommt die Liste unter ``default``.

Folgend ein Beispiel:

.. code-block:: yaml
   :linenos:

   # config/config.yml
   meta_models_filter_loupe:
     stop_words:
       default:
         - ein
         - der
         - die
         - das
         - für
       en:
         - a
         - an
         - by
         - for
       de:
         - der
         - die
         - das
         - ein
         - für


.. _indexing_loupe:
Ablauf der Indexierung und Einstellungen
----------------------------------------

Wenn ein Datensatz mit geänderten Inhalten der zu indexierenden Attribute gespeichert oder in der Filterregel die
Reindexierung gestartet wird, erfolgt die Abarbeitung nicht direkt in dem Web-Aufruf (synchron), sondern es wird
eine Meldung an den `Symfony-Messenger <https://symfony.com/doc/6.4/messenger.html>`_ für die asynchrone Verarbeitung
übergeben. Mehr zu dem Thema im `Contao-Handbuch <https://docs.contao.org/dev/framework/async-messaging>`_ oder
`Vortrag zur CK23 <https://www.youtube.com/watch?v=bm9rTe2w1-M>`_.

Gespeichert werden die "Messenger-Aufträge" in der Tabelle ``tl_message_queue`` - ggf. wird diese neu erzeugt.

Aktuell muss für die Verarbeitung der Messenger-Jobs eine
`"Transportkonfiguration" <https://docs.contao.org/dev/framework/async-messaging/#the-transport-configuration>`_
in der ``config.yml`` angelegt sein - folgend für Loupe:

.. code-block:: yaml
   :linenos:

   # config/config.yml
   framework:
     routing:
       '*': contao_prio_normal

In einer der folgenden Versionen nehmen wir eine vollständige Anbindung an die Contao-Implementierung vor, so dass
das nicht mehr notwendig sein wird.

Der Messenger wiederum wartet darauf, für die weitere Verarbeitung angestoßen zu werden. Das erfolgt mit dem Cron-Job
von Contao - dieser sollte entsprechend `eingerichtet <https://docs.contao.org/manual/de/performance/cronjobs/>`_ sein.

Während der Indexierung wird für jede Filterregel ein eigener Index als SQLite-DB angelegt - bei mehrsprachigen Models
bzw. mehrsprachigen Attributen gibt es wiederum für jede Sprache einen eigenen Index. Die Daten liegen unter
``var/mm_loupe_index/<id-Loupe-Filterregel>/``.

Bei einer kompletten Reindexierung wird die Index-Datenbank vorher geleert.


.. |img_item_output| image:: /_img/screenshots/extended/loupe/item_output.png
