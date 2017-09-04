.. _rst_extended_frontend_editing:

Frontend-Editing
================

Installation
------------

Um ein MetaModel nicht nur im Backend bearbeiten zu können, sondern es auch Contao-Mitgliedergruppen im Frontend zu ermöglichen, muss man eine zusätzliche Erweiterung installieren.

Dazu wechselt man in die Paketverwaltung (Composer)

|img_paketverwaltung|

In der Suche der Paketverwaltung gibt man "metamodels/contao-frontend-editing" ein.
Anschließend klickt man auf "Suchen".

|img_paket|

Als Suchergebnis sollte sich nun folgende Erweiterung zeigen.
Man klickt auf das Icon rechts, um das Paket zur Installation vorzumerken.

|img_paketzwei|

Bitte den dev-master auswählen und dann auf "Paket für die Installation vormerken" klicken.

|img_paketvormerken|

Zurück in der Liste der Paketverwaltung klickt man auf "Pakete aktualisieren".
Nun wird die Erweiterung installiert.

|img_paketaktualisieren|

Einrichtung im Backend
----------------------

Es wird in diesem Kapitel davon ausgegangen, dass bereits ein MetaModel "Mitarbeiterliste" eingerichtet wurde. Es werden daher nur die Änderungen an diesem MetaModel bzw. an den Modul-Einstellungen dargestellt.

Für den Test-Aufbau gibt es drei Seiten in Contao.
Eine Startseite mit einem Login.
Eine Listen-Seite, auf der eine Mitarbeiterliste zu sehen sein wird.
Eine Detail-Seite, auf der die Bearbeitung eines Mitarbeiter-Datensatzes stattfinden wird.

|img_seitenstruktur|

Auf der Listenseite setzt man ein Element vom Typ "Metamodel List" ein. Dies wurde entsprechend der Anleitung "Erstes MetaModel" konfiguriert - mit zwei entscheidenden Ergänzungen, die einem die neue Erweiterung ermöglicht.

Man kann die Frontend-Bearbeitung aktivieren und eine Editor-Seite auswählen.

|img_metamodellist|

|img_metamodellistedit|

Auf der Detail-Seite setzt man ein Element "Metamodels Frontend Editing" ein.

In diesem wählt man das MetaModel aus, welches bearbeitet werden soll.

|img_metamodelfee|

|img_metamodelfeeedit|

Das war es im Backend.
Man kann nun ins Frontend wechseln, um die Mitarbeiter zu bearbeiten.

Arbeiten im Frontend
--------------------

Man loggt sich also im Frontend ein und gelangt zur Mitarbeiter-Liste.

|img_login|

Bei der Liste des MetaModels sind zwei neue Möglichkeiten hinzugekommen: Einen Datensatz hinzuzufügen und einen Datensatz zu bearbeiten.

|img_liste|

Die Maske zum Anlegen eines neuen Datensatzes enthält standardmäßig alle Felder des MetaModels. Nach dem Speichern hat man einen Eintrag mehr in der Liste.

|img_newfile|

Beim Bearbeiten des Datensatzes kann man alle Felder des MetaModels ändern. "Speichern" bringt einen zurück zur Liste.

|img_editfile|



.. |img_paketverwaltung| image:: /_img/screenshots/extended/frontend_editing/fee-paketverwaltung.png
.. |img_paket| image:: /_img/screenshots/extended/frontend_editing/fee-feepaket.png
.. |img_paketzwei| image:: /_img/screenshots/extended/frontend_editing/fee-feepaket2.png
.. |img_paketvormerken| image:: /_img/screenshots/extended/frontend_editing/fee-feepaketvormerken.png
.. |img_paketaktualisieren| image:: /_img/screenshots/extended/frontend_editing/fee-feepaketaktualisieren.png

.. |img_seitenstruktur| image:: /_img/screenshots/extended/frontend_editing/fee-seitenstruktur.png
.. |img_metamodellist| image:: /_img/screenshots/extended/frontend_editing/fee-metamodellist.png
.. |img_metamodellistedit| image:: /_img/screenshots/extended/frontend_editing/fee-metamodellistedit.png
.. |img_metamodelfee| image:: /_img/screenshots/extended/frontend_editing/fee-metamodelfee.png
.. |img_metamodelfeeedit| image:: /_img/screenshots/extended/frontend_editing/fee-metamodelfeeedit.png

.. |img_login| image:: /_img/screenshots/extended/frontend_editing/fee-login.png
.. |img_liste| image:: /_img/screenshots/extended/frontend_editing/fee-liste.png
.. |img_newfile| image:: /_img/screenshots/extended/frontend_editing/fee-newfile.png
.. |img_editfile| image:: /_img/screenshots/extended/frontend_editing/fee-editfile.png
