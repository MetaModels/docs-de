FAQ
===

.. _faq-searchable-pages:

Searchable Pages
----------------

| Q: Kann ich die Sitemap und den Suchindex voneinander unabhängig Konfigurieren?
| A: Nein beide werden über die gleiche Funktion, mit Informationen versorgt. Dies ist im Contao Core hinterlegt. Daher gelten für beide die gleichen Konfigurationen.

| Q: Kann ich Geo-Protection benutzten?
| A: Generell sollten keine Filter benutzt werden, welche den Browser, die IP oder andere Benutzer Daten für das Filter benutzten. Vielmehr sollte ein Filter benutzt werden der allgemein gültig ist.

| Q: Wann wird die Funktion benutzt?
| A: Sobald eine Seite gespeichert wird, wird die Sitemap neu erstellt, genau hier springt die neue Funktion mit ein. Genauso beim Suchindex erstellen.

.. _faq-allgemein:

Allgemein
---------

| Q: Ich habe zwei MetaModels Filter. Einen auf der Startseite, einen auf der Suchergebnisseite. Leider bekomme ich es nicht hin, dass der Filter auf der Ergebnisseite über die Startseite gesteuert werden kann. Beide filter sind an sich identisch.
| A: Wenn ich den Filter als Modul anlege und an beiden stellen nutze, klappt es. Der post hat die form id mit drin, dadurch kann nur dieser filter auch die post daten bearbeiten. Sobald alles über die GET Daten geht ist es egal.