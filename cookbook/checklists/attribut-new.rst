.. _rst_cookbook_checklists_attribut_new:

Attribut in vorhandenem MM hinzufügen
=====================================

Ist ein MM vorhanden und man möchte lediglich ein
weiteres Attribut für die Ausgabe im template hinzufügen,
sind die folgenden Punkte zu beachten:

Checkliste:

   |box| in entsprechendes MM gehen und Attribut anlegen (Typ, Spaltenname, Name, Bezeichnung usw)
   
   |box| bei Render-Einstellungen Ausgabe für das Frontend z.B. "FE Liste" Attributliste per Icon öffnen und Attribut hinzufügen z.B. per "Alle hinzufügen" - prüfen ob auf sichtbar gestellt
   
   |box| bei Eingabe-Masken entsprechende Eingabe wählen und Attributliste per Icon öffnen und Attribut hinzufügen z.B. per "Alle hinzufügen" - prüfen ob auf sichtbar gestellt
         
   |box| bei vorhandenem oder bei neuem Datensatz neues Attribut ausfüllen...
   
   |box| per :ref:`Debugausgabe <rst_cookbook_debug_templates>` prüfen, ob Attribut im Template "ankommt" und Template wie gewünscht anpassen

weitere Einstellungen:

   |box| soll Attribut auch in der Listenansicht im BE erscheinen, dann Attribut bei Render-Einstellungen Ausgabe für das Backend z.B. "BE Liste" hinzufügen (s.o.)

   |box| Einstellungen wie Bildvorschau, Template, CSS bei Render-Einstellung > Attribut vornehmen
   
   |box| Einstellungen wie Pflichtfeld, TinyMCE, Suchbar/Filterbar bei Eingabe-Maske > Attribut vornehmen
   

.. |box| raw:: html

   <span>&#9634;</span>



