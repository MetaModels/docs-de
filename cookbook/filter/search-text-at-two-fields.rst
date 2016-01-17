.. _rst_cookbook_filter_search-text-at-two-fields:

Textsuche über zwei Felder
==========================

Möchte man eine Textsuche über zwei (oder mehr) Felder einbauen, gibt 
es die Möglichkeit, spezielle Filter wie `metamodelsfilter_textcombine
<https://github.com/cogizz/metamodelsfilter_textcombine>`_
einzusetzen oder dies mit "Boardmitteln" zu lösen.
 
Für die Lösung mit "Boardmitteln" müssen folgende Schritte als Filterregeln
angelegt werden:

* Filterregel "ODER" zur Kombination der Textfelder bzw. der Filterregeln
* in den Filterregeln der Textfelder muss der selbe URL-Parameter eingestellt werden

Als Beispiel ein Filterset für die gleichzeitige Suche in den Attributen "Name" und
"Vorname" - ein Hinweis zum Label: hier wird für die Frontend-Ausgabe das Label der
letzten Filterregel ausgegeben.

Filterset:

|img_multi-textfilter_01|

Einstellung des zweiten Textfilters:

|img_multi-textfilter_02|

Filterung im Frontend:

|img_multi-textfilter_03|

|img_multi-textfilter_04|



.. |img_multi-textfilter_01| image:: /_img/screenshots/cookbook/filter/multi-textfilter_01.jpg
.. |img_multi-textfilter_02| image:: /_img/screenshots/cookbook/filter/multi-textfilter_02.jpg
.. |img_multi-textfilter_03| image:: /_img/screenshots/cookbook/filter/multi-textfilter_03.jpg
.. |img_multi-textfilter_04| image:: /_img/screenshots/cookbook/filter/multi-textfilter_04.jpg

