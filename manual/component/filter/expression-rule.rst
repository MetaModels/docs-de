.. _component_filter_expression-rule:

|img_filter_expression| Expression-Regel
=========================================

Die Filterregel "Expression-Regel" (ab MM 2.4) ermöglicht es, die Ausführung
weiterer Filterregeln an eine Bedingung zu knüpfen. Es wird ein Knoten in der
Regelliste erzeugt, der ein oder maximal zwei weitere Filterregeln als Kindknoten
aufnehmen kann. Ist die Bedingung erfüllt, wird die erste Unterregel ausgeführt;
ist sie nicht erfüllt, wird – sofern vorhanden – die zweite Unterregel
ausgeführt (if/else-Prinzip).

Diese Filterregel hat keine eigenständige Frontend-Widgetausgabe. Die Option
"Nur verbleibende Werte" beeinflusst, welche Optionen in anderen Filterwidgets
angezeigt werden.

.. seealso:: Praktische Beispiele zur Expression-Regel finden sich im Kochbuch:
   :ref:`rst_cookbook_filter_expression-rule`


Installation
------------

Diese Filterregel ist Bestandteil von ``metamodels/core`` und nach der
MetaModels-Grundinstallation ohne weitere Pakete verfügbar.


Einstellungen beim Anlegen der Filterregel
------------------------------------------

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Einstellung
     - Beschreibung
   * - Typ
     - Auswahl des Filterregeltyps – hier: "Expression-Regel".
   * - Aktiviert
     - Aktiviert oder deaktiviert diese Filterregel.
   * - Kommentar
     - Freitextfeld zur Beschreibung des Zwecks dieser Filterregel.
   * - Expression-Regel
     - Die auszuwertende Bedingung als Ausdruck. Wird zur Laufzeit ausgewertet;
       liefert der Ausdruck ``true``, wird die erste Unterregel ausgeführt,
       andernfalls die zweite (falls vorhanden).
   * - Nur verbleibende Werte
     - Zeigt in anderen Filterwidgets nur Werte an, für die nach Anwendung dieser
       Expression-Regel noch Ergebnisse vorhanden sind.


Passende Attribute
------------------

Die Expression-Regel ist nicht direkt attributgebunden. Die in den Unterregeln
verwendeten Filterregeln können beliebige Attribute ansprechen.


.. |img_filter_expression| image:: /_img/icons/filter_expression.png

.. |br| raw:: html

   <br />
