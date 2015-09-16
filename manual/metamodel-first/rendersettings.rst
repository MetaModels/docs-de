.. _mm_first_rendersettings:

|img_rendersettings| Rendereinstellungen
========================================

In diesem Schritt werden die Rendereinstellungen für das MetaModel
"Telefonliste" angelegt. Es wird eine Renderingeinstellung für das Backend
(Dateneingabe) und für das Frontend (Datenausgabe) benötigt.

Zum Aufruf der Rendereinstellungen wird die Übersicht MetaModels aktiviert,
so dass der Eintrag der "Telefonliste" zu sehen ist. Nun erfolgt ein Klick
auf das Icon "|img_rendersettings| Rendereinstellungen" und die Ansicht
wechselt zur Übersicht der Rendereinstellungen - diese ist aktuell noch leer.

Nach einem Klick auf "|img_new| Neu" öffnet sich sofort die Eingabemaske der
ersten Rendereinstellung. Im Eingabefeld "Name" wird eine treffende Bezeichnung
wie z.B. "BE Liste" eingegeben (siehe Screenshot), die Checkbox "Standard"
gesetzt und mit "Speichern und schließen" die Eingabe gesichert.

|img_rendersettings_01|

In der Übersicht der Rendereinstellungen sollte nun der erste Eintrag mit
"BE Liste" zu sehen sein - siehe Screenshot.

|img_rendersettings_02|

Über einen Klick auf das Icon "|img_rendersetting| Attributeinstellungen"
wird die nächste Ebene für die Attribute geöffent. An dieser Stelle werden 
die in der jeweiligen Liste der Rendereinstellungen die anzuzeigenden
Attribute ausgewählt bzw. aktiviert.

Ein einfacher Weg, um die angelegten Attribute hinzu zu fügen ist über Icon
in der Kopfzeile "|img_rendersettings_add| Alle hinzufügen" - nach Klick auf
die Buttons "Weiter" und "Speichern und schließen" sind alle vorhandenen
Attribute der Renderingeinstellung hinzu gefügt. Per Standard sind die
Attribute nicht aktiviert - dies kann leicht über das "Auge-Icon" erfolgen.
In diesem Beispiel werden die Attribute "Name" und "Vorname" aktiviert - die
Attributauflistung sollte nun wie im Screenshot aussehen.

|img_rendersettings_03|

Die Rendereinstellungen für die Anzeige im Backend ist damit abgeschlossen.
Nachfolgend kann die Rendereinstellungen für die Anzeige im Frontend folgen.

Das Vorgehen ist Analog dem für die "BE Liste" - in den Rendereinstellungen
kann als Name könnte "FE Liste" eingetragen werden. Zusätzlich wird eine
Anzeige der Attribut-Labels per Checkbox "Labels verbergen" abgewählt (siehe
Screenshot).

|img_rendersettings_04|

Für die Anzeige im Frontend werden alle notwendigen Attribute aktiviert
also alle bis auf das Attribut "Veröffentlicht", welches für den Fiter
benötigt wird und nicht mit ausgegeben werden muss bzw. soll (siehe
Screenshot).

|img_rendersettings_05|

Damit sind die Vorbereitungen Auflistungen im Backend und Frontend abgeschlossen
und die Übersicht der Rendereinstellungen sollte nun die zwei Listen anzeigen
(siehe Screenshot).

|img_rendersettings_06|


.. |img_rendersettings| image:: /_img/icons/rendersettings.png
.. |img_rendersetting| image:: /_img/icons/rendersetting.png
.. |img_rendersettings_add| image:: /_img/icons/rendersettings_add.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_edit| image:: /_img/icons/edit.gif

.. |img_rendersettings_01| image:: /_img/screenshots/metamodel_first/rendersettings_01.png
.. |img_rendersettings_02| image:: /_img/screenshots/metamodel_first/rendersettings_02.png
.. |img_rendersettings_03| image:: /_img/screenshots/metamodel_first/rendersettings_03.png
.. |img_rendersettings_04| image:: /_img/screenshots/metamodel_first/rendersettings_04.png
.. |img_rendersettings_05| image:: /_img/screenshots/metamodel_first/rendersettings_05.png
.. |img_rendersettings_06| image:: /_img/screenshots/metamodel_first/rendersettings_06.png

