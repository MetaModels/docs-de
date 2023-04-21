.. _rst_cookbook_tips_set-route-priority:

Setzen der Routenpriorität
==========================

.. note:: Die Routenpriorität ist ab Contao 4.13 implementiert und wird ab MM 2.3 mit behandelt.

Contao und MetaModels müssen aus einer gegebenen URL die Seite über den Alias und ggf. enthaltene
Slug-Parameter (Key-Value-Pärchen) extrahieren und darauf reagieren. Dabei kann es zu Überschneidungen
und entsprechende "Interpretationsmöglichkeiten" bei der Bedeutung der URL-Elemente geben. Mit der Routenpriorität
kann auf die Reihenfolge der Abarbeitung Einfluss genommen werden. Folgende Beispiele sollen einen Einblick
in die Möglichkeiten geben.


Filterung mit "auto_item"
-------------------------

Ein typischer Aufbau in der Darstellung von Daten mit MM, ist eine Listen- und Detailseite. Häufig wird bei der
Detailseite der Key für die Filterung per URL-Parameter "auto_item" ausgeblendet. Zudem ist die Detailseite
oft eine Unterseite der Listenseite. Mit aktivem ``folderurl`` könnten die Seiten wie folgt aufgebaut sein:

* Listenseite-Alias: ``projekte``
* Detailseite-Alias: ``projekte/projekt``

Mit einem MM-Filterwert ``test`` wäre die vollständige URL ``projekte/projekt/test`` (ohne Domain und Postfix).

Nun könnte das interpretiert werden als

* Alias: ``projekte`` mit Key: ``projekt`` und Value: ``test`` - oder
* Alias: ``projekte/projekte`` mit Key: ``auto_item`` und Value: ``test``

Ohne eine Priorisierung der Auflösung wäre es mehr oder weniger dem Zufall überlassen, welche Variante aufgelöst wird.
Stellt man in den Seiteneigenschaften der Detailseite eine höhere Routenpriorität (10) als auf der Listenseite (0)
ein, ist die Abarbeitung eindeutig und wird sauber abgearbeitet.

Ist der Alias der Detailseite z. B. nur ``projekt-details`` ist die Auflösung kein Problem und die Routenpriorität
nicht notwendig.


Listen- und Detailseite mit selbem Alias
----------------------------------------

Wenn man die Listen- und die Detailseite mit denselben Alias erstellen, kann man das mit folgenden Einstellungen
erreichen:

**Listenseite:**

* Titel: Liste
* Alias: liste
* Routenpriorität: 0
* Element erforderlich: aus
* MM Liste - in Rendersettings Weiterleitungseinstellungen auf Seite "Details" + Filter

**Detailseite:**

* Titel: Details
* Alias: liste
* Routenpriorität: 10
* Element erforderlich: ein
* MM-Liste mit Filterregel "Einfache Abfrage" und URL-Parameter "auto_item"

Die Liste ist dann z. B. über den Alias ``projekte`` und eine Detaildarstellung über ``projekte/test`` erreichbar.


Link zu einer Detailseite in der Navigation
-------------------------------------------

Möchte man ein oder mehrere MM-Detailseiten in der normalen Contao-Seitennavigation einbauen, sollte man hierzu
mit entsprechenden Erweiterungen arbeiten und deren Hooks oder Events verwenden.

Eine schnelle Lösung ist das Anlegen einer normalen Contao-Seite z. B. mit Alias ``projekte/test`` wenn es die
Detailseite mit Alias ``projekte`` gibt und die Details über ``projekte/test`` aufgerufen werden können.

Gibt man der MM-Detailseite eine höhere Routenpriorität (10) als der normalen Contao-Seite (0), wird der Link
sauber aufgelöst.
