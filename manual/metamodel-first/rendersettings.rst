.. _mm_first_rendersettings:

|img_rendersettings_32| Render-Einstellungen
============================================

In diesem Schritt werden die Render-Einstellungen für das MetaModel
"Mitarbeiterliste" angelegt. Es wird eine Render-Einstellung für das Backend
(Dateneingabe) und für das Frontend (Datenausgabe) benötigt.

Zum Aufruf der Render-Einstellungen wird die Übersicht MetaModels aktiviert,
so dass der Eintrag der "Mitarbeiterliste" zu sehen ist. Nun erfolgt ein Klick
auf das Icon "|img_rendersettings| Render-Einstellungen" und die Ansicht
wechselt zur Übersicht der Render-Einstellungen - diese ist aktuell noch leer.

Nach einem Klick auf "|img_new| Neu" öffnet sich sofort die Eingabemaske der
ersten Render-Einstellung. Im Eingabefeld "Name" wird eine treffende Bezeichnung
wie z.B. "BE Liste" eingegeben (siehe Screenshot), die Checkbox "Standard"
gesetzt und mit "Speichern und schließen" die Eingabe gesichert.

|img_rendersettings_01|

In der Übersicht der Render-Einstellungen sollte nun der erste Eintrag mit
"BE Liste" zu sehen sein - siehe Screenshot.

|img_rendersettings_02|

Über einen Klick auf das Icon "|img_rendersetting| Render-Einstellungen der Attribute"
wird die nächste Ebene für die Attribute geöffnet. An dieser Stelle werden 
die in der jeweiligen Liste der Render-Einstellungen die anzuzeigenden
Attribute ausgewählt bzw. aktiviert.

Ein einfacher Weg, um die angelegten Attribute hinzu zu fügen ist über Icon
in der Kopfzeile "|img_rendersettings_add| Alle hinzufügen" - nach Klick auf
die Buttons "Weiter" und "Speichern und schließen" sind alle vorhandenen
Attribute der Render-Einstellung hinzu gefügt. Per Standard sind die
Attribute nicht aktiviert - dies kann leicht über das "Auge-Icon" erfolgen.
In diesem Beispiel werden die Attribute "Name" und "Vorname" aktiviert - die
Attributauflistung sollte nun wie im Screenshot aussehen.

|img_rendersettings_03|

Die Render-Einstellungen für die Anzeige im Backend ist damit abgeschlossen.
Nachfolgend kann die Render-Einstellungen für die Anzeige im Frontend folgen.

Das Vorgehen ist Analog dem für die "BE Liste" - in den Render-Einstellungen
kann als Name könnte "FE Liste" eingetragen werden. Zusätzlich wird eine
Anzeige der Attribut-Labels per Checkbox "Labels verbergen" abgewählt (siehe
Screenshot).

|img_rendersettings_04|

Für die Anzeige im Frontend werden alle notwendigen Attribute aktiviert
also alle bis auf das Attribut "Veröffentlicht", welches für den Filter
benötigt wird und nicht mit ausgegeben werden muss bzw. soll (siehe
Screenshot).

|img_rendersettings_05|

Damit sind die Vorbereitungen Auflistungen im Backend und Frontend abgeschlossen
und die Übersicht der Render-Einstellungen sollte nun die zwei Listen anzeigen
(siehe Screenshot).

|img_rendersettings_06|


.. |img_rendersettings_32| image:: /_img/icons/rendersettings_32.png
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

