# Mitwirken am MM-Handbuch

Eine Mitarbeit am MM-Handbuch ist herzlich willkommen. Die Daten werden hier auf Github verwaltet und nach Freigabe
automatisch bei [Readthedocs](https://about.readthedocs.com) zu einer HTML-Seite konvertiert.

Die einfachste Art am Handbuch mitzuarbeiten ist über ein Github-Account mit dem man Änderungen oder komplett neue
Seiten als "Pull-Request" (PR) anfügen kann.

Bei kleineren Änderungen der im Handbuch angezeigte Seite kann man dem Link oben rechts "Auf GitHub bearbeiten" folgen
und den Text direkt im Browser anpassen und einen PR erstellen.

Bei umfangreicheren Änderungen bzw. komplett neuen Artikeln ist es zu empfehlen, einen Fork des Handbuchs zu erstellen
und einen Clone lokal zu bearbeiten.

Alternativ kann man auch seinen Artikel an mail@metamodels.me senden.

Die Texte sind in [reStructuredText](https://de.wikipedia.org/wiki/ReStructuredText) ausgezeichnet, welches Ähnlich
wie [Markdown](https://de.wikipedia.org/wiki/Markdown) aufgebaut ist. Die Konvertierung auf der Seite Readthedocs
übernimmt das Tool "[Sphinx](https://www.sphinx-doc.org/)".

## Hinweise zum Schreiben der Texte

Der Text sollte in einer neutralen Ansprache des Lesers erfolgen - üblicherweise mit "man".

Bitte Schachtelsätze vermeiden und längere Absätze in logische Blöcke unterteilen.

### Überschriften:

```
H1 Überschrift
==============

H2 Überschrift
--------------

H3 Überschrift
..............
```
 
### Bilder
 
Bilder sind im Ordner ``_img/screenshots/..``

Im Text per "Ersetzungstoken" einfügen z.B. Lorem ipsum |img_multi-textfilter_01| bla bla...

und unten auf der Seite
.. |img_multi-textfilter_01| image:: /_img/screenshots/cookbook/filter/multi-textfilter_01.jpg

### Code

Inline: als `` :code:`das ist mein code` ``

Block:

```
.. code-block:: php
   :linenos:

   // redirect if data empty
   if (count($this->data) == 0) {
       $pageId  = 192; // Page id 
       $page    = \PageModel::findByPK($pageId);
       $pageURL = $page->getFrontendUrl();
       \Controller::redirect($pageURL);
   }
```

Bitte beachten, dass die erste Einrückung drei Leerzeichen sind. Bei der Angabe "code-block" sind auch andere Angaben
wie css, yaml, xml möglich.

### Verlinkungen

oberhalb der zu verlinkenden Überschrift
```.. _rst_features:```

als Link einfügen z.B. per
```:ref:`rst_features````

oder mit eigenem Linktext
```:ref:`Neue Funktionen <rst_features>````

Bei den neueren Verlinkungen habe ich die Form <dateiname>_<überschrift-mit-bindestrich> gewählt - z.B.
```.. _introdution_was-ist-metamodels:```


externe Verlinkungen:
``` `Google <https://www.google.de>`_ ```
offensichtlich gibt es keine Möglichkeit das Attribut "target" anzugeben :-(
