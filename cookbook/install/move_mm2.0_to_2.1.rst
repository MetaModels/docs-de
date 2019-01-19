.. _cookbook_move_mm2.0_to_2.1:

Umzug von MetaModels 2.0 zu 2.1
===============================

Der Umzug von MetaModels 2.0 (Contao 3.5) zu MetaModels 2.1 (Contao 4.4)
erfolgt in dem gleichen Umzugsschema, wie allgemein von C3 auf C4 umgestellt wird.

Dazu gibt es verschiedene Wege - einer davon ist:

* Contao 3.5 mit MM 2.0 aktualisieren - alle anderen Erweiterungen auch
* Contao 4 komplett installieren
* alle Erweiterungen, die es als C4-Bundle gibt per Contao-Manager oder direkt per Composer installieren
* alle Erweiterungen, zu denen es kein Bundle gibt, in /system/modules kopieren
* Datenbank von C3 in C4 kopieren - oder die MySQL-Zugangsdaten auf die alte DB anpassen

Anschließend sollte die Webseite wieder laufen - ggf. nochmal ein `composer update` machen bzw. den Cache löschen
und die Datenbank über das Install-Tool aktualisieren.