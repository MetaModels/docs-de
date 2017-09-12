.. _rst_extended_frontend_editing:

Frontend-Editing (FEE)
======================

.. warning:: Noch im Aufbau!

Die Erweiterung Frontend-Editing (FEE) ermöglicht die Bearbeitung
der MetaModels-Daten im Frontend, d.h. die Webseitenbesucher können
neue Datensätze anlegen, bearbeiten oder auch löschen.

Üblicher Weise wird die Bearbeitung nicht für alle Webseitenbesucher
zugänglich gemacht, sondern nur einer bestimmten Nutzergruppe. Dafür
werden die in Contao üblichen Module für den Login und die Zugangsberechtigungen
eingesetzt.

Zudem ist es möglich, Mitgliedergruppen individuelle Eingabemasken zuzuweisen, um
zum Beispiel im Frontend nur bestimmte Felder zur Bearbeitung frei zu geben. Diese
Zuweisung der Bearbeitungsfreigabe erfolgt zurzeit ausschließlich auf Ebene der
Mitgliedergruppe.

Im Frontend werden dieselben Eingabewidgets ("Formularfelder") des DC_General
wie im Backend ausgegeben. Da im Frontend nicht so viele Restriktionen wie im
Backend vorliegen (z.B. MooTools als JavaScript-Framework), ist die Anzeige
der Widgets inklusive zugehöriger Picker wie Datum, Farbe oder dem RichTextEditor
eine schwierige Aufgabe.

Aus diesem Grund, stehen aktuell noch nicht alle Attribute für ein Frontend-
Editing zur Verfügung. Der Stand der Freigabe ist im folgenden Ticket
auf Github zusammengefasst: `FEE Issue #15 <https://github.com/MetaModels/contao-frontend-editing/issues/15>`_


Installation
------------

Das FEE wird über die Paketverwaltung  (Composer) von Contao installiert - eine
"Nightly-Build-Version" steht nicht zur Verfügung.

Für die Installation wechselt man in die Paketverwaltung

|img_paketverwaltung|

In der Suche der Paketverwaltung gibt man "metamodels/contao-frontend-editing" ein
und klickt man auf den Button "Suchen".

|img_paket|

Als Suchergebnis sollte sich nun folgende Erweiterung zeigen.
Man klickt auf das Icon rechts, um das Paket zur Installation vorzumerken.

|img_paketzwei|

Als Pakettyp ist "dev-master" auswählen und über den Button "Paket für die
Installation vormerken" die Installation vorzubereiten..

|img_paketvormerken|

Zurück in der Liste der Paketverwaltung klickt man auf "Pakete aktualisieren" und
die Erweiterung wird installiert.

|img_paketaktualisieren|


Einrichtung im Backend
----------------------

In der folgenden Beschreibung wird davon ausgegangen, dass bereits ein MetaModels 
"Mitarbeiterliste" eingerichtet wurde. Es werden daher nur die Änderungen an
diesem MetaModels bzw. an den Modul-Einstellungen dargestellt.

Für den Test-Aufbau gibt es zwei Seiten in Contao:

* eine Listen-Seite, auf der eine Mitarbeiterliste zu sehen sein wird
* eine Detail-Seite, auf der die Bearbeitung eines Mitarbeiter-Datensatzes stattfindet

|img_seitenstruktur|

Auf der Listenseite setzt man ein Inhalts-Element vom Typ "Metamodel List" ein. Dies
wurde entsprechend der Anleitung :ref:`first_index` konfiguriert - mit zwei
Ergänzungen, die einem die neue Erweiterung ermöglicht:

* die Frontend-Bearbeitung aktivieren und
* eine Editor-Seite auswählen.

|img_metamodellist|

|img_metamodellistedit|

Auf der Detail-Seite setzt man ein neues Inhalts-Element "Metamodels Frontend Editing" ein.

|img_metamodelfee|

In diesem wählt man das MetaModel aus, welches bearbeitet werden soll.

|img_metamodelfeeedit|

Als letzter Schritt, muss die Eingabemaske, die für das Backend konfiguriert wurde,
noch für das Frontend freigeschaltet werden. Dazu öffnet man im Backend die 
Seite der "Eingabe-/Render-Zuordnungen" |img_dca_combine| und wählt in der
Spalte "Mitgliedergruppe" den Eintrag "Anonymous" (`PR #1189 beachten <https://github.com/MetaModels/core/pull/1189>`_)

|img_fee-dca-zuordnung|

Damit sind die Einstellungen im Backend abgeschlossen und man
kann nun im Frontend die Einstellungen bzw. die Bearbeitung der
Mitarbeiter prüfen.


Arbeiten im Frontend
--------------------

Bei der Liste des MetaModels sind zwei neue Möglichkeiten hinzugekommen:

* einen Datensatz hinzuzufügen und 
* einen Datensatz zu bearbeiten.

|img_liste|

Die Maske zum Anlegen eines neuen Datensatzes enthält standardmäßig 
alle Felder des MetaModels. Nach dem Speichern hat man einen Eintrag
mehr in der Liste.

|img_newfile|

Beim Bearbeiten des Datensatzes kann man alle Felder des MetaModels
ändern. "Speichern" bringt einen zurück zur Liste.

|img_editfile|


Einstellen der Zugangsberechtigung für die Bearbeitung
------------------------------------------------------

In den meisten Fällen soll die Bearbeitung der Daten nicht für
alle Webseitenbesucher zur Verfügung stehen. Die Detailseite
kann über die üblichen Zugangsberechtigungen von Contao
geschützt werden und die Bearbeitung nur einer oder mehreren
freigegebenen Mitgliedergruppen ermöglicht werden.


Einrichtung unterschiedlicher Eingabemasken für BE/FE
-----------------------------------------------------

Möchte man für die Bearbeitung im FE nur bestimmte Felder frei
geben, so muss hierfür eine separate Eingabemaske erstellt werden.

Die Erstellung der Eingabemaske erfolgt analog der für das Backend
und über die Auswahl bzw. Aktivierung der Attribute werden die
Formularfelder für die Bearbeitung definiert.

Die Eingabemaske kann nun über die "Eingabe-/Render-Zuordnungen" |img_dca_combine|
für das FE ausgewählt werden.

|img_fee-dca-zuordnung2|

Die Reihenfolge der Zuordnungseinstellung ist wichtig, da diese "von oben nach unten"
abgearbeitet wird, d.h. im BE wird für die Benutzergruppe "Administrator" als erstes
die Maske "Eingabe" gefunden und entsprechend angezeigt und für die Mitgliedergruppe
"general Members" wird als erstes die Maske "FEE Eingabe" gefunden.


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

.. |img_fee-dca-zuordnung| image:: /_img/screenshots/extended/fee-dca-zuordnung.png
.. |img_fee-dca-zuordnung2| image:: /_img/screenshots/extended/fee-dca-zuordnung2.png

.. |img_dca_combine| image:: /_img/icons/dca_combine.png
