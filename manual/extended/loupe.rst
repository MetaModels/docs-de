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

Die Reihenfolge der zu indexierenden Attribute geht in das Ranking mit ein, d. h. die Attribute sollten nach ihrer
Wichtigkeit für die Suche sortiert werden.

Mit den Schwellenwerten für Tippfehler kann angegeben werden, bei welcher Wortlänge wie viele "Schreibfehler" enthalten
sein dürfen - typische Werte sind z. B. bei einer Wortlänge von fünf Buchstaben ein Schreibfehler und ab neun
Buchstaben zwei Schreibfehler.

Die Indexierung der Inhalte der Attribute erfolgt beim Speichern der Datensätze automatisch. Eine komplette Reindexierung
erfolgt über ein entsprechendes Icon in der Liste der Filterregeln.

Im Frontend gibt es eine Texteingabe für die Suche. Exakte Wortgruppen können beim Suchstring mit ``"`` abgegrenzt werden.
Mit ``-`` ist der Ausschluss von Wörtern oder Wortgruppen möglich.

Aktuell werden folgende Attribute indexiert:

- Text
- Langtext
- Übersetzter Text
- Übersetzter Langtext
