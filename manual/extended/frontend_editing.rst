Frontend-Editing
================

Installation
------------

Um ein MetaModel nicht nur im Backend bearbeiten zu können, sondern es auch Contao-Mitgliedergruppen im Frontend zu ermöglichen, müssen wir eine zusätzliche Erweiterung installieren.

Dazu wechseln wir in die Paketverwaltung (Composer)

|img_paketverwaltung|

In der Suche der Paketverwaltung geben wir "metamodels/contao-frontend-editing" ein.
Anschließend klicken wir auf "Suchen"

|img_paket|

Als Suchergebnis sollte sich nun folgende Erweiterung zeigen.
Wir klicken auf das Icon rechts, um das Paket zur Installation vorzumerken.

|img_paketzwei|

Bitte den dev-master auswählen und dann auf "Paket für die Installation vormerken" klicken.

|img_paketvormerken|

Zurück in der Liste der Paketverwaltung klicken wir auf "Pakete aktualisieren".
Nun wird die Erweiterung installiert.

|img_paketaktualisieren|

Einrichtung im Backend
----------------------

Wir gehen in diesem Kapitel davon aus, dass bereits ein MetaModel "Mitarbeiterliste" eingerichtet wurde. Wir werden daher nur die Änderungen an diesem MetaModel bzw. an den Modul-Einstellungen durchgehen.

Wir haben uns für unseren Test-Aufbau drei Seiten in Contao gebaut.
Eine Startseite mit einem Login.
Eine Listen-Seite, auf der eine Mitarbeiterliste zu sehen sein wird.
Eine Detail-Seite, auf der die Bearbeitung eines Mitarbeiter-Datensatzes stattfinden wird.

|img_seitenstruktur|

Auf der Listenseite haben wir ein Element vom Typ "Metamodel List" eingesetzt. Dies haben wir entsprechend der Anleitung "Erstes MetaModel" konfiguriert - mit zwei entscheidenden Ergänzungen, die uns die neue Erweiterung ermöglicht.

Wir haben die Frontend-Bearbeitung aktiviert und eine Editor-Seite ausgewählt.

|img_metamodellist|

|img_metamodellistedit|

Auf der Detail-Seite haben wir ein Element "Metamodels Frontend Editing" eingesetzt.

In diesem haben wir das MetaModel ausgewählt, was bearbeitet werden soll.

|img_metamodellistfee|

|img_metamodellistfeeedit|

Das war es im Backend.
Wir können nun ins Frontend wechseln, um unsere Mitarbeiter zu bearbeiten.

Arbeiten im Frontend
--------------------

Wir loggen uns also im Frontend ein und gelangen zur Mitarbeiter-Liste.

|img_login|

Bei der Liste unseres MetaModels sind zwei neue Möglichkeiten hinzugekommen: Einen Datensatz hinzuzufügen und einen Datensatz zu bearbeiten.

|img_liste|

Die Maske zum Anlegen eines neuen Datensatzes enthält standardmäßig alle Felder des MetaModels. Nach dem Speichern haben wir einen Eintrag mehr in der Liste.

|img_newfile|

Beim Bearbeiten des Datensatzes können wir alle Felder des MetaModels ändern. "Speichern" bringt uns zurück zur Liste.

|img_editfile|



.. |img_paketverwaltung| image:: /_img/screenshots/extended/frontend_editing/fee-paketverwaltung.png
.. |img_paket| image:: /_img/screenshots/extended/frontend_editing/fee-paket.png
.. |img_paketzwei| image:: /_img/screenshots/extended/frontend_editing/fee-paket2.png
.. |img_paketvormerken| image:: /_img/screenshots/extended/frontend_editing/fee-paketvormerken.png
.. |img_paketaktualisieren| image:: /_img/screenshots/extended/frontend_editing/fee-paketaktualisieren.png

.. |img_seitenstruktur| image:: /_img/screenshots/extended/frontend_editing/fee-seitenstruktur.png
.. |img_metamodellist| image:: /_img/screenshots/extended/frontend_editing/fee-metamodellist.png
.. |img_metamodellistedit| image:: /_img/screenshots/extended/frontend_editing/fee-metamodellistedit.png
.. |img_metamodellistfee| image:: /_img/screenshots/extended/frontend_editing/fee-metamodellistfee.png
.. |img_metamodellistfeeedit| image:: /_img/screenshots/extended/frontend_editing/fee-metamodellistfeeedit.png

.. |img_login| image:: /_img/screenshots/extended/frontend_editing/fee-login.png
.. |img_liste| image:: /_img/screenshots/extended/frontend_editing/fee-liste.png
.. |img_newfile| image:: /_img/screenshots/extended/frontend_editing/fee-newfile.png
.. |img_editfile| image:: /_img/screenshots/extended/frontend_editing/fee-editfile.png
