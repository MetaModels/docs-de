Vorstellung von MetaModels
==========================

Was ist MetaModels?
-------------------

MetaModels are data models you can configure in the Contao Backend.
Every MetaModel consists of various attributes of certain data types
(attribute types are available as extensions and get registered upon
installation).

To present the data on the screen (i.e. website, RSS feed, etc.), you
define render settings for the MetaModel which define how the various
attribute output shall look like (image sizes, use lightboxes, etc.).

Filtering data in list views needs configuration of filter settings.
Filter settings are a very complex topic, as they can be nested (AND/OR
conditions i.e.) and be of various nature.

Die Geschichte von MetaModels
-----------------------------

MetaModels wurde entwickelt, um den in den Jahren gekommen Catalog zu ersetzten.

Dadurch das der Catalog von "vielen" Programmieren weiterentwickelt wurde
und jeder dieser Programmiere einen eigenen Style hatte Quellcode zu schreiben wurde
es immer schwerer den Catalog, so wie es war, weiterzuentwickeln bzw. zu warten.

Daher haben wir uns entschlossen, alles was wir aus dem Catalog 1 und dem Catalog 2
gelernt hatten zu nehmen, in einen großen Topf zu schmeißen und daraus einen ganz
neuen Catalog 3 zu erstellen.

Diese neue, bessere Catalog sollte nicht nur mit den alten Funktionen daher kommen,
sondern auch neue Möglichkeiten bieten, wie ein modular erweiterbares, flexibles System.

Währen der Entwicklung von dieser neuen Erweiterung wurde uns aber klar, dass es nicht einfach
werden würde eine Migration das alte System auf diese neue Erweiterung zu vollziehen. Dies galt nicht
nur für den Quellcode sondern auch für die Lernkurve.

Die Flexibilität, welches das neue System nun besaß, ging mit viele Einstellungsmöglichkeiten daher. Dies zu lernen
und einen richtigen Workflow zu entwickeln würde dauern.

Daher haben wir uns dazu entschlossen, neben dem neuen Quellcode auch einen neuen Name für die
Erweiterung zu finden. So entstand MetaModels. Wie der Phönix aus der Asche der alten Catalogs.


Resources
---------

* `MetaModels Contao Wiki <http://de.contaowiki.org/MetaModels>`_
* `MetaModels Contao Community Subforum <https://community.contao.org/de/forumdisplay.php?149-MetaModels>`_
* `MetaModels IRC Channel on freenode #contao.mm <irc://chat.freenode.net/#contao.mm>`_
