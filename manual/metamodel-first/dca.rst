.. _mm_first_dca:

|img_dca| Eingabemasken
=========================

In diesem Schritt wird die Eingabemasken für das MetaModel
"Telefonliste" angelegt, über welche die Daten der Attribute in der
Datenbank gespeichert werden.

Zum Aufruf der Eingabemasken wird wieder die Übersicht MetaModels aktiviert,
so dass der Eintrag der "Telefonliste" zu sehen ist. Nun erfolgt ein Klick
auf das Icon "|img_dca| Eingabemasken" und die Ansicht wechselt zur 
Übersicht der Eingabemasken - diese ist aktuell noch leer.

Nach einem Klick auf "|img_new| Neue Eingabemaske" öffnet sich sofort die Maske
für die Einstellungen der Eingabemaske. Im Eingabefeld "Name" wird eine
Bezeichnung wie z.B. "Eingabe" eingegeben. Eine weitere wichtige Eingabe ist
die Auswahl "Integration", bei der "Unabhängig" und bei der sich darauf hinzu
gefügten Auswahl "Backend-Bereich" der Eintrag "MetaModels" ausgewählt werden
sollte. Zudem sollten alle drei Checkboxen des Blocks "Data manipulation
permissions" aktiviert werden - siehe Screenshot. Mit "Speichern und
schließen" die Eingabe gesichert.

|img_dca_01|

In der Übersicht der Eingabemasken sollte nun der erste Eintrag mit
"Eingabe" zu sehen sein - siehe Screenshot.

|img_dca_02|

Über einen Klick auf das Icon "|img_dca_setting| Einstellungen"
wird die nächste Ebene für die Attribute geöffent. An dieser Stelle werden 
die in der Eingabemaske anzuzeigenden Attribute ausgewählt bzw. aktiviert.

Wie bei den Rendereinstellungen können auch hier die angelegten Attribute
in einem Schritt hinzu gefügt werden. Dazu ist das Icon in der Kopfzeile
"|img_dca_add| Alle hinzufügen" zu klicken und anschließend die Buttons
"Weiter" und "Speichern und schließen" zu bestätigen. Nun sind alle
vorhandenen Attribute der Eingabemaske hinzu gefügt. Per Standard sind die
Attribute nicht aktiviert - dies kann leicht über das "Auge-Icon" erfolgen.

In diesem Beispiel werden alle Attribute aktiviert - die Attributauflistung
sollte nun wie im Screenshot aussehen.

|img_dca_03|

Die Eingabemaske ist im Backend immer noch nicht sichtbar. Dies erfolgt erst,
wenn der Punkt :ref:`component_dca-combine` abgeschlossen ist.


.. |img_dca| image:: /_img/icons/dca.png
.. |img_dca_setting| image:: /_img/icons/dca_setting.png
.. |img_dca_setting_add| image:: /_img/icons/dca_setting_add.png
.. |img_dca_add| image:: /_img/icons/dca_add.png
.. |img_dca_groupsortsettings| image:: /_img/icons/dca_groupsortsettings.png
.. |img_dca_condition| image:: /_img/icons/dca_condition.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_edit| image:: /_img/icons/edit.gif

.. |img_dca_01| image:: /_img/screenshots/metamodel_first/dca_01.png
.. |img_dca_02| image:: /_img/screenshots/metamodel_first/dca_02.png
.. |img_dca_03| image:: /_img/screenshots/metamodel_first/dca_03.png