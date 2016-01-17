.. _mm_special_visibility-conditions:

|img_dca_condition| Anzeigeeigenschaften / Sub-Paletten
=======================================================

Die Anzeigeeigenschaften werden auch unter dem Begriff "Sub-Paletten" geführt,
da es hiermit möglich ist, ein Eingabewidget eines Attributs in einer Eingabemaske
gezielt ein- oder auszublenden.

Ein Beispiel soll das verdeutlichen: in einer Eingabemaske es gibt eine Checkbox
"Rechnungsadresse" und man möchte, dass wenn diese gesetzt ist, drei weitere
Eingabefelder (Straße, PLZ, Ort) in der Eingabemaske erscheinen - und nur
wenn die Checkbox gesetzt ist.

In diesem Fall reagieren die drei Felder (Straße, PLZ, Ort) auf den Wert der
Checkbox "Rechnungsadresse" (Wert = 1) und werden bei gesetzter Checkbox angezeigt
und nur dann werden auch die Daten gespeichert.

Die Idee, die Felder über eine Legende ("grüne Trennlinie") ein- bzw. auszublenden,
greift zu kurz - hier wird lediglich die aktuelle Sichtbarkeit in Form eines
Akkordeons eingestellt und nicht die die Speicherung beeinflusst. Zudem ist es
über die Anzeigeeigenschaften/Sub-Paletten auch möglich, komplexe Regeln
aufzustellen, unter welcher Bedingung ein Eingabewidget sichtbar sein soll
oder nicht.

Es gilt zu beachten, dass die Anzeigeeigenschaften nicht wie bei einem
Akkordeon mit zwei umschließenden "Umschlagelementen" erstellt wird, welche
mehrere Eingabewidget umschließt, sondern die Bedingungen müssen für jedes
Widget separat gesetzt werden. Nur damit ist es möglich, sehr komplexe und
voneinander abhängige Anzeigeregeln aufzustellen.

Hat man für ein Eingabewidget eine komplexe Regel erstellt und möchte diese
auf einfache Weise weiteren Eingabewidgets zuweisen, kann man den Eigenschaftstyp
"Eigenschaft ist sichtbar..." verwenden (s.u.).

Zum Erstellen einer Anzeigeeigenschaft klickt man in der Attributsauflistung
einer Eingabemaske auf das Icon |img_dca_condition| "Ansichtsbedingungen des 
Eingabefeldes ID n". In der sich öffnenden Übersicht der Anzeigeeigenschaften
wird eine neue Anzeigeeigenschaft über Klick auf den Button |img_new| "Neu"
und Einfügen über das Klemmbrett hinzugefügt.

In der sich öffnenden Eingabemaske muss im ersten Schritt in der Basiskonfiguration
der Bedingungsstyp ausgewählt werden. Es stehen zwei Gruppen von Bedingungsstypen
zur Verfügung:

* Bedingungen, die sich auf ein Attribut bzw. ein Eingabewidget beziehen
* Bedingungen als logische Operatoren (UND/ODER/NICHT)

Als kleine Merkhilfe sind die Typen und ihre Verwendung im |img_about| Hilfe-Assistent 
abgelegt.

Folgende Typen von Bedingungen sind implementiert:

* **Eigenschaftswert ist...** |br|
  Die Bedingung ist erfüllt, wenn der Attributwert gleich dem festgelegten Wert ist.
  Als Attribute können diejenigen mit Einfachauswahl wie z.B. Select oder Checkbox
  ausgewählt werden.
* **Eigenschaftswert kann beinhalten...** |br|
  Die Bedingung ist erfüllt, wenn ein beliebiger Attributwert gleich dem jeweils
  festgelegten Wert ist (Schnittmenge bzw. ODER). Als Attribute können diejenigen
  mit Mehrfachauswahl wie z.B. Tags ausgewählt werden.
* **Eigenschaft ist sichtbar...** |br|
  Die Bedingung ist erfüllt, wenn alle Bedingungen für ein ausgewähltes Attribut
  erfüllt sind. Mit anderen Worten, das Attribut ist sichtbar, und nur dann, wenn
  das ausgewählte (oder "referenzierte") Attribut auch sichtbar ist. Mit diesem
  Bedingungstyp erspart man sich das Duplizieren von erstellten Ansichtsbedingungen
  eines Attributs.
* **ODER** |br|
  Eine beliebige Bedingung muss erfüllt sein.
* **UND** |br|
  Alle Bedingungen müssen erfüllt sein.
* **NICHT** |br|
  Kehrt das Ergebnis einer vorgegebenen Bedingung um.


.. |img_dca_condition| image:: /_img/icons/dca_condition.png
.. |img_new| image:: /_img/icons/new.gif
.. |img_about| image:: /_img/icons/about.png

.. |br| raw:: html

   <br />