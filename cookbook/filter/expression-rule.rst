.. _rst_cookbook_filter_expression-rule:

Filterregel "Expression"
========================

.. note:: Ab Version 2.4 vorhanden - aktuell noch experimentelles Feature!

Mit der Filterregel "Expression" kann die Ausführung weiterer Filterregeln an Bedingungen geknüpft werden. Es wird ein
Knoten in der Regelliste erzeugt, der ein oder maximal zwei weitere Filterregeln als Kindknoten aufnehmen kann.

Die Bedingung wird in der Filterregel als
`Symfony-Expression <https://symfony.com/doc/current/reference/formats/expression_language.html>`_ angelegt - ist die
Bedingung erfüllt, wird die erste Filterregel der Kindknoten ausgeführt und wenn die Bedingung nicht erfüllt ist,
die zweite Filterregel der Kindknoten.

Die zweite Filterregel der Kindknoten ist optional - ist diese nicht vorhanden, werden keine Item-Ids an die Liste
weiter gereicht, d. h. in der Liste werden keine Daten ausgegeben.

Der Aufbau könnte wie folgt aussehen:

|img_expression_01|

Gibt es eine Sammlung von Filterregeln, die im ersten Kindknoten zum Tragen kommen sollen, können diese in einer
UND-Bedingung zusammengefasst werden.

|img_expression_02|

In der Expression-Syntax stehen aktuell folgende Parameter zur Verfügung, die zur Prüfung herangezogen werden können:

* ``filterUrl``: Array mit den URL-Filterparametern
* ``request``: der aktuelle Request-Stack

.. note:: Die Ansicht von Filter-Widgets im Frontend wird durch diese Filterregel nicht beeinflusst - ggf. kommt diese
   Feature noch hinzu.


Beispiele zum Aufbau:
*********************

Aufgabe: Zeige Liste erst an, wenn ein Filterwert gesetzt ist.
Expression: ``filterUrl != []``
Aufbau:

* Filterregel Expression
    * Filterregel zum Filtern z. B. Mehrfachauswahl, oder Einfachauswahl

Hier muss keine zweite Filterregel als Kindknoten angelegt werden.

Aufgabe: Zeige gefilterte Liste erst an, wenn ein Filterwert gesetzt ist - wenn kein Filter gesetzt ist zeige einen
festen Datensatz an.
Expression: ``filterUrl != []``
Aufbau:

* Filterregel Expression
    * Filterregel zum Filtern z. B. Mehrfachauswahl, oder Einfachauswahl
    * Filterregel "Vordefinierter Satz von Items" mit der gewünschten ID des Datensatzes bzw. den IDs der Datensätze


Beispiele der Expressions:
**************************

* Filterparameter mit URL-Parameter ``kategorien`` muss Wert enthalten: ``(filterUrl['kategorien'] ?? '') != ''``
* GET-Parameter ``foo`` darf nicht ``1`` sein: ``(!request.query.has('foo') || request.query.get('foo') !== '1')``

Mögliche Operatoren sind im
`Handbuch von Symfony <https://symfony.com/doc/current/reference/formats/expression_language.html#supported-operators>`_
zu finden.


.. |img_expression_01| image:: /_img/screenshots/cookbook/filter/expression_01.png
.. |img_expression_02| image:: /_img/screenshots/cookbook/filter/expression_02.png

