.. _rst_cookbook_specials_helper-models:

Verschiedene Auswahldaten in einem MetaModel zusammen fassen
============================================================

Beim Aufbau einer Datenstruktur kommt es häufig vor, dass man einfache Auswahlen wie z. B. Anrede, Akad. Titel,
Geschlecht, Farben, Maßeinheiten, Rabatte, usw. benötigt. Diese müsste man als einzelne Models anlegen und bei dem
gewünschten Model als Relation per Einzel- oder Mehrfachauswahl einbinden.

Dies hätte zur Folge, dass man eine Vielzahl an Models anlegen müsste, die letztendlich jeweils nur aus zwei Attributen
bestehen als Name und Alias.

Den Aufbau und die Pflege dieser "Hilfsangaben" kann man vereinfachen, in dem die Daten in einem bzw. zwei Models
gepflegt werden und in der Eingabemaske über eine Filterung nur die passenden Werte anzeigt.

Nachteil dieser Variante ist aber, dass man bei Anpassungen unflexibel ist und ggf. einzelne Wertebereiche wieder in
ein separates Model überführen muss. Zum Beispiel, wenn zu einem späteren Zeitpunkt die Einträge "Rabatte" neben der
Bezeichnung auch noch numerischen Rabattwert bekommen sollen.

Ein Beispiel für einen möglichen Aufbau ist wie folgt: Man erstellt zwei MetaModel - eins für die Bezeichnungen der
Bezeichnungsgruppen z. B. "Taxo-Gruppen" und ein MetaModel für die Bezeichnungswerte z. B. "Taxo-Werte". In dem Model,
wo die Werte als Auswahl benötigt werden, legt man eine Referenzierung als Einfach- oder Mehrfachauswahl auf das
Model "Taxo-Werte" an, sowie einen Filter, der nur die Werte der gewünschten Taxo-Gruppe anzeigt. Als Einzelschritte
wäre das:

**1. MetaModel "Taxo-Gruppen" anlegen**

* Attribut Text oder Übersetzter Text mit "Name", Pflichtfeld
* Attribut Alias mit "Alias" auf "Name", Eindeutige Werte und Neuerstellung erzwingen

**2. MetaModel "Taxo-Werte" anlegen**

* Attribut Einzelauswahl mit "Taxo Gruppen" auf Model "Taxo-Gruppen", Pflichtfeld
* Attribut Text oder Übersetzter Text mit "Name", Pflichtfeld
* Attribut Alias oder Übersetzter Alias mit "Alias" auf "Name", Eindeutige Werte und Neuerstellung erzwingen
* Sortierung auf "Taxo Gruppen", Gruppierungstyp "Anfangsbuchstabe" und Gruppierungslänge 0
* Filter "Auswahl Gruppe" mit Filterregel "Einfache Auswahl" auf Attribut "Taxo Gruppen" und Checkbox "Statischer
  Parameter" setzen

|img_helper-models_01|

**3. Einbindung in MetaModel mit Auswahl**

* Attribut Einfach- oder Mehrfachauswahl auf Model "Taxo-Werte", Filter "Auswahl Gruppe" und bei Filterparameter in der
  Auswahl eine Gruppe z. B. "Anrede" auswählen.

|img_helper-models_02|

Neben dieser Variante mit zwei Tabellen ist es auch möglich, mit einer Tabelle zu arbeiten z. B. mit den Optionen
Varianten oder Render-Modus "Hierarchie" - die Filtereinstellungen müssen dann entsprechend angepasst werden.


.. |img_helper-models_01| image:: /_img/screenshots/cookbook/specials/helper-models_01.png
.. |img_helper-models_02| image:: /_img/screenshots/cookbook/specials/helper-models_02png
