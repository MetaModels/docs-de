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

Möchte man individuellere Einstellungsmöglichkeiten, kann man für Title und Description eigene Textattribute anlegen.
Damit kann der Redakteur unabhängig von anderen Attributen die Angaben optimieren.

Als weitere Möglichkeit der Datenübergabe, kann man die Erstellung von Title und Description im Rendertemplate
vornehmen - siehe :ref:`component_templates`. Die Ausgabe kann z. B. mit folgenden Snippets im Template erfolgen:

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
