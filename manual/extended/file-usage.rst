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
* Multi-Table (MCW)
* Übersetzter Inhalt eines Artikels (ContentArticle)
* Übersetzte Datei
* Übersetzter Langtext
* übersetzte Multi-Table (MCW)

Je nach Attribut wird nach der/den gespeicherten UUID(s) der Datei bzw. Dateien gesucht oder nach vorhandenen Inserttags
mit Dateieinbindungen (`file`, `picture`, `figure`).

Wie in `File-Usage ab Version 3.1.0 <https://github.com/inspiredminds/contao-file-usage/releases/tag/3.1.0>`_, werden
textuellen Pfadangaben wie `/file/content/my_file.jpg` in den HTML-Attributen `href` und `src` z. B. in Texten gesucht.

Für MetaModels gibt es eigene Ausgaben mit dem Namen des Models, des Attributes und bei mehrsprachigen Attributen
auch die Sprache. Über den Stift kommt man direkt zu dem entsprechenden Datensatz - siehe Screenshot. Bei mehrsprachigen
MetaModels wird die Sprache der Eingabemaske über einen GET-Parameter entsprechend gesetzt.

|img_mm_file-usage|


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an (Zielsumme 2.613,75€):

* `GUTcert <https://www.gut-cert.de/>`_: 340 €
* `AntwortInternet <https://www.antwortinternet.com/>`_: 340 €
* `AntwortInternet <https://www.antwortinternet.com/>`_: 340 €
* `P KREATIV <https://p-kreativ.at/>`_: 250 €

(*Spenden in Netto)


.. |manual@metamodel.me| raw:: html

   <a href="mailto:manual@metamodel.me">auf Nachfrage</a>

.. |img_mm_file-usage| image:: /_img/screenshots/extended/file-usage/mm_file-usage.png


