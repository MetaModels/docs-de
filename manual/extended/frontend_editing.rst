.. _rst_extended_frontend_editing:

Frontend-Editing (FEE)
======================

.. warning:: Das FEE ist für MM 2.0, 2.1 und 2.2 einsetzbar, jedoch sind nicht alle
   Eingabewidgets nutzbar - siehe `Github <https://github.com/MetaModels/contao-frontend-editing/issues/15>`_.


Die Erweiterung Frontend-Editing (FEE) ermöglicht die Bearbeitung
von MetaModels-Daten im Frontend. Das bedeutet, dass Webseitenbesucher
neue Datensätze anlegen und bearbeiten können.

Üblicherweise wird die Bearbeitung nicht für alle Webseitenbesucher
zugänglich gemacht, sondern nur einer bestimmten Nutzergruppe. Dafür
werden die in Contao üblichen Module für den Login und die Zugangsberechtigungen
eingesetzt.

Außerdem ist es möglich, an Mitgliedergruppen individuelle Eingabemasken zuzuweisen, um
zum Beispiel im Frontend nur bestimmte Felder zur Bearbeitung frei zu geben. Diese
Zuweisungen der Bearbeitungsfreigaben erfolgen zurzeit ausschließlich auf Ebene der
Mitgliedergruppen.

Im Frontend werden dieselben Eingabewidgets ("Formularfelder") des DC_General
wie im Backend ausgegeben. Da im Frontend nicht so viele Restriktionen wie im
Backend vorliegen (z.B. MooTools als JavaScript-Framework), ist die Anzeige
der Widgets inklusive zugehöriger Picker wie Datum, Farbe oder dem RichTextEditor
keine direkte Aufgabe des FEE. Bei den entsprechenden Widget werden CSS-Klassen
ausgegeben, anhand derer man per JavaScript verschiedene Widgets einbinden kann.

Es stehen aktuell noch nicht alle Attribute für ein Frontend-
Editing wie im Backend zur Verfügung. Der Stand der Freigabe ist im folgenden Ticket
auf Github zusammengefasst: `FEE Issue #15 <https://github.com/MetaModels/contao-frontend-editing/issues/15>`_

Die erste Implementierung des Frontend-Editing wurde über ein
`Fundraising <https://now.metamodel.me/de/unterstuetzer/fundraising#frontend-editing>`_
finanziert. Für den weiteren Ausbau, Bugfixing und neue Funktionen ist die Mitarbeit am
Projekt und auch die `finanzielle Unterstützung <https://now.metamodel.me/de/unterstuetzer/spenden>`_
wichtig!


Installation
------------

Das FEE wird über den Contao-Manager oder Composer installiert.


Einrichtung im Backend
----------------------

In der folgenden Beschreibung wird davon ausgegangen, dass bereits ein MetaModel 
"Mitarbeiterliste" eingerichtet wurde. Es werden daher nur die Änderungen an
diesem MetaModel bzw. an den Modul-Einstellungen dargestellt.

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

Bei der Liste des MetaModels sind nun zwei neue Möglichkeiten hinzugekommen:

* einen Datensatz hinzuzufügen und 
* einen Datensatz zu bearbeiten.

Für die Anzeige des Links "Datensatz hinzufügen" muss im CE-/FE-Modul MM-Liste
das Template `ce_metamodel_list_edit.html5` ausgewählt werden - die Links
"Datensatz bearbeiten" werden über das Standardtemplate der Liste im Block
"action" hinzugefügt.

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

Die Erstellung der Eingabemaske erfolgt analog der Maske für das Backend.
Über die Auswahl bzw. Aktivierung der Attribute werden die
Formularfelder für die Bearbeitung definiert.

Die Eingabemaske kann nun über die "Eingabe-/Render-Zuordnungen" |img_dca_combine|
für das FE ausgewählt werden.

|img_fee-dca-zuordnung2|

Die Reihenfolge der Zuordnungseinstellung ist wichtig, da diese "von oben nach unten"
abgearbeitet wird. Dabei wird beispielsweise die im Backend für die Benutzergruppe "Administrator" 
definierte Eingabemaske als erstes gefunden und entsprechend angezeigt. Für die Mitgliedergruppe
"general Members" wird als erstes die Maske "FEE Eingabe" gefunden und angezeigt.

Der Eintrag "*" (bis MM 2.1 "-") bei den Gruppen ist ein "catch all", d.h. dieser Eintrag gilt für
alle Gruppen, sofern nicht schon vorher in der Abarbeitung ein Eintrag zum Zuge gekommen ist.

Manchmal gibt es Konstellationen, bei denen man in einer Spalte bei der Abarbeitung eine Zeile
"überspringen" möchte - z.B. um in der ersten Zeile bei Mitgliedergruppe kein "catch all *" zu haben.
Dafür kann man sich eine Gruppe anlegen, zu der es keinen zugewiesenen Benutzer/Mitglied gibt - z. B.
als "Anonymous" oder "empty".


Individuelle Buttons in FE-Maske
--------------------------------

.. note:: Das Feature steht ab MM 2.2 zur Verfügung.

Über die Konfiguration der Eingabemaske kann die Ausgabe und Arbeitsweise der im FE ausgegebenen
Buttons konfiguriert werden. Als Standard wird "Speichern" und "Speichern und neu" als Button ausgegeben.

Mit der Konfiguration kann sowohl die Beschriftung der Button als auch die Aktion geändert werden. So ist
zum Beispiel "Speichern und zurück", "Speichern und neu" oder auch "Speichern" mit einer Weiterleitung
auf eine "Danke-Seite" ähnlich wie beim Formulargenerator möglich.

|img_fee-eigene-buttons|


Benachrichtigungen über das Notification Center
-----------------------------------------------

.. note:: Das Feature steht ab MM 2.2 zur Verfügung.

Ist die Erweiterung `Notification Center <https://github.com/terminal42/contao-notification_center>`_ (NC)
installiert, kann auf die Veränderung eines Datensatzes getriggert (reagiert) und eine "Benachrichtigung"
über das NC erstellt werden - z.B. die Versendung einer E-Mail.

Als Trigger stehen zur Verfügung:

* Erstellen
* Ändern
* Kopieren
* Löschen

Im NC steht dazu unter der Gruppe "MetaModels frontendenditing" für jeden Trigger ein Benachrichtigungstyp bereit.
Für eine neue Benachrichtigung muss zunächst für den gewünschten Trigger eine Benachrichtigung angelegt werden.

Für die Information der Benachrichtigung gibt es eigne "Simple Tokens" mit den Pre-/Postfix "##" als

* model_* - alle eingegeben Attributwerte
* model_original_* - alle vorher gespeicherten Attributwerte (nur bei Ändern und Kopieren)
* member_* - alle Mitgliederdaten, sofern eingeloggt
* property_label_* - alle Bezeichnungen der Attribute
* data - alle Daten
* admin_email - E-Mail aus der Contao-Konfiguration

z.B. ##model_name## der Inhalt des Attributes "name".

Ist für einen Triggertyp oder für mehrere eine Benachrichtigung erstellt, kann diese in den Einstellungen
der Eingabemaske ausgewählt werden.


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

.. |img_fee-dca-zuordnung| image:: /_img/screenshots/extended/frontend_editing/fee-dca-zuordnung.png
.. |img_fee-dca-zuordnung2| image:: /_img/screenshots/extended/frontend_editing/fee-dca-zuordnung2.png

.. |img_dca_combine| image:: /_img/icons/dca_combine.png

.. |img_fee-eigene-buttons| image:: /_img/screenshots/extended/frontend_editing/fee-eigene-buttons.png

.. |br| raw:: html

   <br />
