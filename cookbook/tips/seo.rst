.. _rst_cookbook_tips_seo:

Suchmaschinenoptimierung (SEO)
==============================

Damit die Inhalte aus MM in der Webseite gut gefunden bzw. indexiert werden können, kann man den "Bots" mit
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
Anlegen einer eigenen Indexierung erreichen - siehe :ref:`component_searchable-pages`.

Bei Seiten mit FE-Filter die Linklisten enthalten, sollte beachtet werden, :ref:`wie man die Links aus dem Crawling
ausschließt <rst_cookbook_filter_exclude-url-from-search-index>`.


SEO für Google & Co.
--------------------

.. _rst_cookbook_tips_seo_url:
"Sprechende" URLs
.................

Hier geht es in den meisten Fällen um die Verlinkung zur Detailseite z.B. von einer Listenseite. Üblicherweise
wird für die Filterung auf der Detailseite der Alias des Items verwendet. In den Einstellungen des Attributes
:ref:`Alias <component_attribute_alias>` bzw. :ref:`Übersetzter Alias <component_attribute_translatedalias>` kann
die gewünschte Kombination aus anderen Attributwerten definiert werden.


.. _rst_cookbook_tips_seo_metadata-title:
Meta-Daten Title und Description
................................

Diese Einstellungen beziehen sich wiederum vorwiegend auf die Einstellungen einer Detailseite. Im CE bzw. FE-Modul
MM-Liste gibt es jeweils eine Selectauswahl mit vorhandenen Attributen für Title und Description.

Die Description sollte den Inhalt der Seite prägnant beschreiben. Eine `maximale Zeichenanzahl gibt z.B. Google nicht
vor <https://developers.google.com/search/docs/appearance/snippet?hl=de#meta-descriptions>`_, aber auf vielen SEO-Seiten
wird eine Zeichenzahl von max. 150 bis 160 genannt - Contao selbst begrenzt das in der fe_page auf 320 Zeichen.

Möchte man individuellere Einstellungsmöglichkeiten, kann man für Title und Description eigene Textattribute anlegen.
Damit kann der Redakteur unabhängig von anderen Attributen die Angaben optimieren.

Als weitere Möglichkeit der Datenübergabe, kann man die Erstellung von Title und Description im Rendertemplate
vornehmen - siehe :ref:`component_templates`. Die Ausgabe kann z.B. mit folgendem Snippet im Template erfolgen:

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


.. _rst_cookbook_tips_seo_breadcrumb:
Breadcrumb (Navigationspfad)
............................

Der letzte Navigationspunkt der Breadcrumb wird automatisch aus dem Seitentitel generiert. Hat man bei einer Detailseite
den :ref:`Seitentitel dynamisch aus einem MM Attribut <rst_cookbook_tips_seo_metadata-title>` generiert, wird dieser
in der Breadcrumb nicht angezeigt. Das liegt darin begründet, dass das FE-Modul für die Breadrumb üblicherweise vor
der MM-Liste eingebaut ist und diese Information zu spät bzw. gar nicht erhält.

Abhilfe schafft ein "BreadcrumbController", der die Breadcrumb erst später dem Rendering der Seite hinzufügt. Aktuell
kann man `hier einen Beispielcode <https://gist.github.com/fritzmg/e7df2804365fe676b1d88f053a234707?permalink_comment_id=5698503#gistcomment-5698503>`_
finden - `in Contao 5.7 wird das Problem gefixt sein <https://youtu.be/nvIPd3OzXhs?t=1787>`_.


.. _rst_cookbook_tips_seo_metadata-hreflang:
Meta-Daten hreflang
...................

Gibt es bei einem mehrsprachigen Aufbau einer Seite die Ausgabe auch in einer oder mehrerer anderen Sprache, kann dies
mit der Angabe eines Links in ``hreflang`` der Suchmaschine mit auf den Weg gegeben werden. Um einen Wechsel der Sprache
dem Besucher im Frontend bereit zu stellen, gibt es verschiedene Erweiterungen - häufig wird hier
"`ChangeLanguage <https://github.com/terminal42/contao-changelanguage>`_" eingesetzt.

Diese Erweiterung erzeugt automatisch die Meta-Daten für ``hreflang``, sofern die entsprechenden Relationen in den
Seiteneigenschaften ausgewählt wurden.

Die im Quelltext ausgegebenen Links funktionieren ohne weitere Anpassungen, aber nur zum jeweiligen Seiten-Alias der anderen
Seiten ohne Übermittlung der Filterparameter z.B. der Detailseite.

Die Erweiterung "ChangeLanguage" bietet in den Seiteneinstellungen die Option "Query-Parameter beibehalten" mit Keys
zu befüllen. Die entsprechenden Key-Value-Pare werden dann auch mit an die anderen Sprachenlinks angehängt. Der Key
``auto_item`` wird per se aber nicht unterstützt.

Für einen Sprachenwechsel einer Detailseite kann man folgende Konfiguration einsetzen:

* Filter "Details" mit Filterregel "Einfache Abfrage" für Attribut "Alias" - "URL-Parameter" auf ``alias`` belassen und
  nicht auf ``auto_item`` setzen
* in Seiteneigenschaften "Query-Parameter beibehalten" auf allen Detailseiten "alias" eintragen

Das Ergebnis sieht dann i. E. wie folgt aus:

.. code-block:: html
   :linenos:

   <link rel="alternate" hreflang="de" href="http://my-domain.tld/de/details/alias/mayer-herbert">
   <link rel="alternate" hreflang="x-default" href="http://my-domain.tld/de/details/alias/mayer-herbert">
   <link rel="alternate" hreflang="en" href="http://my-domain.tld/en/details/alias/mayer-herbert">

Möchte man Verlinkungen mit ``auto_item`` erstellen oder von mehrsprachigen Attributen die Key und Values in übersetzter
Fassung in die URL einbringen, so muss das mit einer eigenen Anpassung z.B. über den Hook
"`changelanguageNavigation <https://extensions.terminal42.ch/docs/changelanguage/en/developers/>`_" erfolgen.

:ref:`Mehr zur Mehrsprachigkeit in MM. <component_multi-language>`


.. _rst_cookbook_tips_seo_filter-url:
Slug- vs. GET-Parameter in Filter-URLs
......................................

Ab MM 2.4 kann in jeder Filterregel über die Einstellung "URL-Typ für den Parameter" gewählt werden, ob ein
Filterparameter als Teil des URL-Pfads (Slug) oder als klassischer GET-Parameter übergeben wird - siehe
:ref:`Einstellungsparameter der Filterregel <component_filter>`.

**Slug-Parameter (sprechende URL-Pfade)** erzeugen saubere, gut lesbare URLs – z. B.
``/produkte/kategorie/mit-akku`` statt ``/produkte?kategorie=mit-akku``. Sie sind in der Regel die bevorzugte
Variante für indexierbare Inhalte, da Suchmaschinen diese Form als eigenständige Seite behandeln. Diese Form eignet
sich besonders dann, wenn Filterkombinationen als eigenständige, indexierbare Landingpages dienen sollen. Allerdings
kann dies schnell zu einer großen Anzahl potenzieller URL-Varianten führen, was sorgfältig über Canonical-Tags oder
Indexierungsregeln gesteuert werden sollte. Bei Slug-Parameter kann bei der Angabe ``auto_item`` als URL-Parameter der
Key ausgeblendet werden z. B. für Kategorie ``/produkte/mit-akku`` - ``auto_item`` geht aber nur für einen
URL-Parameter.

**GET-Parameter** (z. B. ``?farbe=rot``) werden von Suchmaschinen zwar ebenfalls verarbeitet, gelten jedoch
als weniger "sprechend" und werden oft als technische Varianten derselben Seite interpretiert. Sie eignen sich daher
besonders für rein funktionale Filter, die keine eigene SEO-Relevanz haben sollen und typischerweise nicht indexiert
werden müssen. In Kombination mit geeigneten Canonical-URLs kann so verhindert werden, dass unnötig viele
Duplicate-Content-Varianten entstehen. Zudem ist es für Trackings wie Google-Analytic möglich, bestimmte GET-Parameter
aus dem Tracking auszuschließen.

**Empfehlung:** |br|
Slug-Parameter sollten für filterbare, suchmaschinenrelevante Kombinationen verwendet werden, während GET-Parameter
besser für rein interaktive oder nicht indexierbare Filter geeignet sind. Die Entscheidung hängt letztlich davon ab,
ob eine Filterkombination als eigenständige Landingpage funktionieren soll oder lediglich zur internen Navigation dient.

Hinweis: wenn ein Parameter sowohl als Slug als auch als GET vorhanden ist, liefert Contao ein 404 zurück.


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
dort die Meta-Angaben ergänzen - z.B. mit

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

.. _rst_cookbook_tips_seo_structured-data:
Strukturierte Daten
...................

Für die semantische Zuordnung der ausgegebenen Inhalte können zusätzlich s.g. "`Strukturierte Daten
<https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data>`_" im Quelltext
mit ausgegeben werden.

Mit diesen "Hilfsdaten" kann eine Suchmaschine die Inhalte z.B. einer FAQ-Ausgabe, einem Event, Jobsuche,
Wohnungsanzeige, Kochrezept usw. zuordnen.

Wie diese Daten eingebaut werden können, steht im Artikel ":ref:`rst_cookbook_templates_fe_template_schema_org`".

Möchte man die Bilder aus Attribut Datei - wie bei Contao üblich - auch mit in den JSON-LD-Daten aufgeführt haben,
stehen ein entsprechendes Template ``mm_attr_file_contao_image.html5`` zur Verfügung - das muss in den Rendereinstellungen
für das Attribut ausgewählt oder in das eigene Template übernommen werden.

Zudem gibt es ein Template ``mm_attr_file_contao_image_ofpage.html5``, welches zusätzlich das erste Bild als
``primaryImageOfPage`` mit in den JSON_LD-Daten mit einpflegt. Ist diese Bildangabe vorhanden, wird dieses Bild z. B.
bei den Ergebnissen der Contao-Suche mit ausgegeben. Dies erfolgt analog der Detailansichten der News und Events von
Contao.

.. |br| raw:: html

   <br />
