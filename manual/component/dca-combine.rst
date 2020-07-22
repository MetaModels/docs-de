.. _component_dca-combine:

|img_dca_combine_32| Eingabe-/Render-Zuordnungen
================================================

.. note:: Zugriffsoptionen auf die Render-Einstellungen und Eingabemasken definieren;
  Zugriff der BE-Eingabe(n) sollte mindestens für Benutzergruppe 'Administrator'
  freigeschaltet sein

Einleitung
----------

Mit den Eingabe-/Render-Zuordnungen werden die Rechte für die angelegten Render-Einstellungen
gesetzt. Für jeden Eintrag stehen die folgenden Selectfelder zur Verfügung:

* Mitgliedergruppe
* Benutzergruppe
* Render-Einstellung
* Eingabemaske

Für die Anzeige und den Zugriff im Backend sollten als Standard eine Eingabemaske und
eine Render-Einstellung für die Benutzergruppe "Administrator" freigeschaltet werden.

Es ist möglich, mehrere Zuordnungen anzulegen und damit die Zugriffe auf die Listenausgabe
und Eingabemasken zu steuern. Die Eingabemasken für die Mitglieder sind nur beim Frontend-Editing
relevant.

Werden mehrere Zuordnungen (Zeilen) angelegt, so werden diese "von oben nach unten" abgearbeitet, d.h.
für die Mitglieder- oder Benutzergruppe wird die erste angegebene Gruppe als gültig ausgewertet. Dabei
ist zu beachten, dass der Eintrag "*" ein "catch all" darstellt und die Einstellungen für alle
verbliebenen Gruppen darstellt.

Möchte man, dass z.B. in einer Zeile kein "catch all" vollzogen wird bzw. keine Gruppe zum Zuge kommt,
kann man eine Mitglieder- oder Benutzergruppe anlegen z.B. "empty", zu der kein Mitglied bzw. Benutzer
zugewiesen wird.


Ablauf
------

In den vorgebenden Spalten der Eingabe-/Render-Zuordnungen die Auswahlen treffen und speichern. Nun
sollten die Eingabemöglichkeiten der MetaModel im Backend sichtbar sein.


.. |img_dca_combine_32| image:: /_img/icons/dca_combine_32.png
.. |img_dca_combine| image:: /_img/icons/dca_combine.png
