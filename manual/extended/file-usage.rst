.. _rst_extended_file-usage:

File-Usage Integration
######################

.. note:: Steht ab MetaModels 2.3 zur Verfügung - für die Aktivierung bitte eine E-Mail an mail@metamodel.me senden.

Mit der Erweiterung `File-Usage <https://github.com/inspiredminds/contao-file-usage>`_ kann man in der Dateiverwaltung
sehen, ob und wo eine Datei in Contao eingebunden ist. Der Support für MM ist ab Version 3.0.1 von File-Usage
gegeben.

Für die Anzeige der Bilder, die in den Datensätzen von MetaModels eingebunden sind, wurden entsprechende Provider
erstellt. Aktuell werden folgende Attribute unterstützt:

* Inhalt eines Artikels (ContentArticle)
* Datei
* Langtext
* Übersetzter Inhalt eines Artikels (ContentArticle)
* Übersetzte Datei
* Übersetzter Langtext

Je nach Attribut wird nach der/den gespeicherten UUID(s) der Datei bzw. Dateien gesucht oder nach vorhandenen Inserttags
mit Dateieinbindungen. Wie in File-Usage werden keine textuellen Pfadangaben wie `/file/content/my_file.jpg`
z. B. in Texten gesucht.

Für MetaModels gibt es eigene Ausgaben mit dem Namen des Models, des Attributes und bei mehrsprachigen Attributen
auch die Sprache. Über den Stift kommt man direkt zu dem entsprechenden Datensatz. Aktuell gibt es noch keine
automatische Umschaltung der Sprache in der Eingabemaske anhand eines GET-Parameters - die Sprache muss entsprechend
manuell umgestellt werden - siehe Screenshot.

|img_mm_file-usage|

.. |img_mm_file-usage| image:: /_img/screenshots/extended/file-usage/mm_file-usage.png


