.. _rst_cookbook_filter_exclude-url-from-search-index:

Filter-URLs vom Contao-Suchindex ausschließen
=============================================

Möchte man, dass eine MM-Liste in den Suchindex aufgenommen wird aber nicht den Listenaufruf mit Filterparametern,
so kann das aus dem Backend nicht konfiguriert werden.

Ein FE-Filter erzeugt für die "Datenübergabe" an eine MM-Liste verschiedene URLs mit den "Key-Value-Pärchen" für die
Filterung. Die Aufnahme dieser URLs in den Suchindex ist in den meisten Fällen überflüssig bzw. nicht erwünscht, da
der Index nur aufgebläht wird ohne ein substantielles Suchergebnis zu beinhalten.

Bei Filterwidgets, die direkt eine URL generieren z. B. Linkliste, ist die Aufnahme dieser URL in den Index üblicher
Weise mit Angabe des Attributes ``data-escargot-ignore`` im Widgettemplate unterbunden.

Durch Aufruf der Filter-URLs vom Webseitenbesucher werden diese aber dennoch in den Suchindex aufgenommen, sofern
die Basisseite der Liste nicht von der Suche ausgeschlossen wurde. Bei wenigen Filtern ist die Aufnahme unproblematisch.
Wenn jedoch viele Filterkombinationen möglich sind, kann dies zu einem stetig wachsenden Suchindex und wenig
hilfreichen Suchergebnissen führen.

Um dies zu vermeiden, kann z. B. mit dem folgende Code die Indexierung unterbunden werden, wenn eine Filterung
gesetzt ist. Das Code-Spippet muss im Template der MM-Liste eingefügt werden.

.. code-block:: php
   :linenos:

    <?php
    if (!empty($this->filterParams)) {
        global $objPage;
        $objPage->noSearch = true;
    }
    ?>
