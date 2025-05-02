.. _rst_cookbook_tips_seo:

Suchmaschinenoptimierung (SEO)
==============================

Damit die Inhalte, die aus MM in der Webseite gut gefunden bzw. indexiert werden können, kann man den "Bots" mit
verschiedenen Einstellungen unter die Arme greifen.

Contao-Suche
------------

Für die `Contao-Suche <https://docs.contao.org/manual/de/layout/modulverwaltung/website-suche>`_ werden die Inhalte auf
verschiedene Weise indexiert. Das kann beim Besuch einer Seite durch einen User sein oder durch den
`Contao-Crawler <https://docs.contao.org/manual/de/cli/crawl/>`_, der den Links in den Webseiten folgt und die Angaben
der ``sitemap.xml`` auswertet.

Für eine Indexierung müssen in den Einstellungen der Seite die üblichen Freigaben erteilt bzw. die Suche nicht
ausgeschlossen sein.

Möchte man die Indexierung der Detailseiten über die ``sitemap.xml`` unterstützen, so kann man das in MM mit dem
Anlegen einer eigenen Indexierung - siehe :ref:`component_searchable-pages`.

Bei Seiten mit FE-Filter die Linklisten enthalten, sollte beachtet werden, :ref:`wie man die Links aus dem Crawling
ausschließt <rst_cookbook_filter_exclude-url-from-search-index>`.


SEO für Google & Co.
--------------------

"Sprechende" URLs
.................

Hier geht es in den meisten Fällen um die Verlinkung zur Detailseite z. B. von einer Listenseite. Üblicher Weise
wird für die Filterung auf der Detailseite der Alias des Items verwendet. In den Einstellungen des Attributes `Alias`
bzw. `Übersetzter Alias` kann die gewünschte Kombination aus anderen Attributwerten definiert werden.


Meta-Daten Title und Description
................................

Diese Einstellungen beziehen sich wiederum vorwiegend auf die Einstellungen einer Detailseite. Im CE bzw. FE-Modul
MM-Liste gibt es jeweils eine Selectauswahl mit vorhandenen Attributen für Title und Description.

Die Description sollte den Inhalt der Seite prägnant beschreiben. Eine `maximale Zeichenanzahl gibt z. B. Google nicht
vor <https://developers.google.com/search/docs/appearance/snippet?hl=de#meta-descriptions>`_, aber auf vielen SEO-Seiten
wird eine Zeichenzahl von max. 150 bis 160 genannt - Contao selbst begrenzt das in der fe_page auf 320 Zeichen.

Möchte man individuellere Einstellungsmöglichkeiten, kann man für Title und Description eigene Textattribute anlegen.
Damit kann der Redakteur unabhängig von anderen Attributen die Angaben optimieren.

Als weitere Möglichkeit der Datenübergabe, kann man die Erstellung von Title und Description im Rendertemplate
vornehmen - siehe :ref:`component_templates`. Die Ausgabe kann z. B. mit folgendem Snippet im Template erfolgen:

.. code-block:: php
   :linenos:

   <?php
   // templates/metamodels_prerendered_details.html5
   use Contao\CoreBundle\Routing\ResponseContext\HtmlHeadBag\HtmlHeadBag;
   use Contao\StringUtil;
   use Contao\System;

   $container       = System::getContainer();
   $htmlDecoder     = $container->get('contao.string.html_decoder');
   $responseContext = $container->get('contao.routing.response_context_accessor')->getResponseContext();
   $htmlHeadBag     = $responseContext->get(HtmlHeadBag::class);
   ?>
   ...
   <?php
   $htmlHeadBag->setTitle($htmlDecoder->inputEncodedToPlainText($arrItem['text']['title'] . ' - ' $arrItem['text']['art_no']));
   $htmlHeadBag->setMetaDescription(StringUtil::substr($htmlDecoder->inputEncodedToPlainText($arrItem['text']['title'] . ' - ' $arrItem['text']['description']), 160));
   ?>

Den ``$htmlHeadBag`` könnte man auch über eine Helper-Klasse zur Verfügung stellen und die eingebundenen Services
injecten.


Meta-Daten hreflang
...................

Gibt es bei einem mehrsprachigen Aufbau einer Seite die Ausgabe auch in einer oder mehrerer anderen Sprache, kann dies
mit der Angabe eines Links in ``hreflang`` der Suchmaschine mit auf dem Weg gegeben werden. Um einen Wechsel der Sprache
dem besucher im Frontend bereit zu stellen, gibt es verschiedene Erweiterungen - häufig wird hier
"`ChangeLanguage <https://github.com/terminal42/contao-changelanguage>`_" eingesetzt.

Diese Erweiterung erzeugt automatisch die Meta-Daten für ``hreflang`` sofern die entsprechenden Relationen in den
Seiteneigenschaften ausgewählt wurden.

Die im Quelltext ausgegebenen Links gehen ohne weitere Anpassungen aber nur zum jeweiligen Seiten-Alias der anderen
Seiten ohne übermittlung der Filterparameter z. B. der Detailseite.

Die Erweiterung "ChangeLanguage" bietet in den Seiteneinstellungen die Option an "Query-Parameter beibehalten" mit Keys
zu befüllen. Die entsprechenden Key-Value-Pare werden dann auch mit an die anderen Sprachenlinks angehangen. Der Key
``auto_item`` wird per se aber nicht unterstützt.

Für einen Sprachenwechsel einer Detailseite kann man folgende Konfiguration einsetzen:

* Filter "Details" mit Filterregel "Einfache Abfrage" mit Attribut "Alias" - "URL-Parameter" auf ``alias`` belassen und
  nicht auf ``auto_item`` setzen
* in Seiteneigenschaften "Query-Parameter beibehalten" auf allen Detailseiten "alias" eintragen

Das Ergebnis sieht dann i. E. wie folgt aus:

.. code-block:: html
   :linenos:

   <link rel="alternate" hreflang="de" href="http://my-domain.tld/de/details/alias/mayer-herbert">
   <link rel="alternate" hreflang="x-default" href="http://my-domain.tld/de/details/alias/mayer-herbert">
   <link rel="alternate" hreflang="en" href="http://my-domain.tld/en/details/alias/mayer-herbert">

Möchte man Verlinkungen mit ``auto_item`` erstellen oder von mehrsprachigen Attributen die Key und Values in übersetzter
Fassung in die URL einbringen, so muss man das mit einer eigenen Anpassung z. B. über den Hook
"`changelanguageNavigation <https://extensions.terminal42.ch/docs/changelanguage/en/developers/>`_" erfolgen.


Paginierung der Listenausgabe
.............................

Längere Ausgabelisten sollten paginiert werden - zum einen, weil die Seite für den User besser zu überblicken ist und
schneller läd, als auch für ein besseres Ranking bei der Performancebewertung durch die Suchmaschinen.

Die Ausgabeseite sollte in den Metadaten eine Angabe zur
`kanonischen URL <https://developers.google.com/search/docs/crawling-indexing/consolidate-duplicate-urls>`_ haben - das
kann man in den Seiteneigenschaften aktivieren. Google macht die Einschränkung, dass die erste Seite (Basisseite) nicht
als kanonische Seite ausgezeichnet werden soll, sondern nur alle weiteren Paginierungsseiten -
`siehe Google "URLs richtig verwenden" <https://developers.google.com/search/docs/specialty/ecommerce/pagination-and-incremental-page-loading?hl=de#use-urls-correctly>`_

Die Angabe von ``rel="next"`` und ``rel="prev"`` wird
`lt. Google nicht mehr beachtet <https://developers.google.com/search/docs/specialty/ecommerce/pagination-and-incremental-page-loading?hl=de#use-urls-correctly>`_ -
andere Suchmaschinen wie Bing scheinen das noch auszuwerten und einige Browser verwenden die Links in den Meta-Daten zum
Vorladen der Seite.

Wer die Angaben im ``head`` der Seite ausgeben möchte, kann ein eigenes Template ``mm_pagination.html5`` anlegen und
dort die Meta-Angaben ergänzen - z. B. mit

.. code-block:: php
   :linenos:

   <?php
   // templates/mm_pagination.html5
   ...
   <?php if ($this->hasPrevious): ?>
      <?php $GLOBALS['TL_HEAD'][] = '<link rel="prev" href="' . $this->previous['href'] . '" />' ?>
   ...
   <?php if ($this->hasNext): ?>
      <?php $GLOBALS['TL_HEAD'][] = '<link rel="next" href="' . $this->next['href'] . '" />' ?>
   ...


Strukturierte Daten
...................

Für die semantische Zuordnung der ausgegebenen Inhalte können zusätzlich s.g. "`Strukturierte Daten
<https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data>`_" im Quelltext
mit ausgegeben werden.

Mit diesen "Hilfsdaten" kann eine Suchmaschine die Inhalte z. B. einer FAQ-Ausgabe, einem Event, Jobsuche,
Wohnungsanzeige, Kochrezept usw. zuordnen.

Wie diese Daten eingebaut werden können, steht im Artikel ":ref:`rst_cookbook_templates_fe_template_schema_org`".


.. |br| raw:: html

   <br />
