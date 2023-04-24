.. _rst_cookbook_filter_filter-with-forwarding:

Filter mit Weiterleitung
========================

Möchte man die Filterung einer MM-Liste auf mehrere Seiten verteilen, so kann man die Option
"Weiterleitung" verwenden und dort die Zielseite angeben. Zum Beispiel könnte man bei einer
Reiseseite die Abfrage nach Reisestart und Personen als "Vorfilterung" auf verschiedenen Seiten
einbauen und damit auf die eigentliche Listenseite mit weiteren Abfragen weiterleiten.

In MM ist ein Filterelement auch dafür zuständig, dass aus den POST-Parametern, welche mit dem
Filter-Formular gesendet werden, eine Umwandlung zu GET-Parameter für die Listenfilterung
erfolgt. Aus dem Grund ist es notwendig, dass auf der Zielseite ein Filter eingebaut ist,
der diese Aufgabe übernimmt.

Die Zuständigkeit der Formularverarbeitung wird von Contao über den Wert des Feldes "FORM_SUBMIT"
geregelt - dieser Wert muss identisch sein. Es gibt zwei Möglichkeiten das zu erreichen:

**FE-Modul MM-Filter**

Legt man ein FE-Modul MM-Filter an und bindet diesen in die gewünschten Seiten über die CE-Modul-Auswahl
ein, so ist der Wert für "FORM_SUBMIT" immer gleich. Nachteil ist, dass die Auswahl der Filterwidgets
aud der Moduleinstellung auch überall gleich ist. Den Nachteil kann man beheben, in dem man auf der
Zielseite einen weiteren Filter für weitere Optionen einbaut. Wenn die URL-Parameter der Filterwidgets
zwischen den Filtern gleich ist, reagiert der zweite Filter auch auf vorhandene GET-Parameter.

**CE MM-Filter und angepasste Formular-ID**

.. note:: Die Formular-ID kann ab MM 2.3 angepasst werden.

Man kann auf Startseite(n) und Zielseite CE MM-Filter anlegen und im Feld Formular-ID den gleichen Wert
eintragen. Der Filter auf der Zielseite übernimmt dann die entsprechende Verarbeitung der POST-Parameter.
Vorteil hierbei ist, dass bei den CE MM-Filter leichter die anzuzeigenden Filterwidgets ausgewählt werden
können.

Der Filter, egal ob FE-Modul oder CE, der die Umwandlung "POST-zu-GET" übernimmt, muss auf der Zielseite
nicht zwingend sichtbar sein und kann auch bei Bedarf ausgeblendet werden.


