.. _rst_cookbook_checklists_attribut_change:

Attribut nach Änderung wird nicht angezeigt
===========================================

Nach Änderung eines Attributs (z.B. Attributtyp) wird wird 
dies auf der Webseite nicht (mehr) angezeigt.

Achtung: Bei Änderung des Attributtyps werden die vorhandenen
Daten in der DB gelöscht!

Checkliste:

   |box| Attributlistings bei Render-Einstellungen und Eingabemasken prüfen 
   
   |box| bei Render-Einstellungen Attribut ggf. löschen und neu hinzufügen
   
   |box| prüfen ob bei Render-Einstellungen und Eingabemasken auf sichtbar gestellt
   
   |box| Werte in Eingabemaske nach Änderung ggf. neu eingeben   
   
   |box| per :ref:`Debugausgabe <rst_cookbook_debug_templates>` prüfen, ob Attribut im Template "ankommt"


.. |box| raw:: html

   <span>&#9634;</span>



