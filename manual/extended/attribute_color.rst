.. _rst_extended_attribute_color:

Attribut Color
==============

Mit dem Attribut "`Color <https://github.com/MetaModels/attribute_color>`_"
wird ein Eingabefeld für einen Hex-Farbcode sowie ein Eingabefeld für
den Deckungsgrad zur Verfügung gestellt. Das Eingabefeld für den
Farbcode hat zusätzlich einen Farbpicker. Der Deckungsgrad wird als
Prozentangabe eingegeben - z.B. "50" für 50 Prozent.

|img_input_mask|

Die Installation erfolgt über die Paketverwaltung von Contao. Dazu in dem
Suchfeld "metamodels/attribute_color" eingeben und das Attribut installieren.

Nach der erfolgreichen Installation steht bei der Auswahl des Attribut-Typs der
Eintrag "Farbwähler" zur Verfügung. Weitere Einstellungen sind für das Attribut
nicht notwendig.

Die beiden Werte - Farbe und Deckungsgrad - werden im Text- und HTML5-Template
als Textwerte wie z.B. "fafa05 50" ausgegeben.

|img_output_text|

Mit Zugriff auf den [raw]-Knoten sind die beiden Werte als Array des Attributs
mit dem Key 0 für die Farbe und 1 für den Deckungsgrad abzugreifen. Mit den
Werten kann z.B. ein CSS-Inlinestyle beeinflusst werden. In dem Screenshot
der Auflistung wurde das Template entsprechend angepasst sowie ein
"Schachbrettmuster" als Hintergrund per CSS zur Verdeutlichung des
Deckungsgrades eingefügt.

|img_output_css-color|

Die Datensätze können aufgrund der Farbe und des Deckungsgrades sortiert werden.
Eine absteigende Sortierung bedeutet von Farbcode #FFFFFF (Weiß) zu #000000
(Schwarz) sowie vom Deckungsgrad 100% zu 0%. Im Anschluß kommen alle Datensätze
ohne Farbzuweisung.

.. |img_input_mask| image:: /_img/screenshots/extended/attribute_color/input_mask.png
.. |img_output_text| image:: /_img/screenshots/extended/attribute_color/output_text.png
.. |img_output_css-color| image:: /_img/screenshots/extended/attribute_color/output_css-color.png


