.. _component_attribute_checkbox:

|img_checkbox| Kontrollkästchen (Checkbox)
==========================================

Das Attribut "Kontrollkästchen (Checkbox)" speichert einen booleschen Wert (0 oder 1).
Typische Einsatzbereiche:

* Veröffentlichungsstatus eines Datensatzes (aktiv/inaktiv)
* Ja/Nein-Felder (z. B. "Empfehlung", "Auf Startseite zeigen")
* Binäre Zustandswerte wie "Verfügbar", "Abonniert" o. ä.

Der gespeicherte Wert in der Datenbank ist ``'1'`` (aktiv) oder ``''`` (leer = inaktiv).
Im Backend erscheint das Attribut als Checkbox-Widget. Bei aktivierter Veröffentlichungsoption
wird zusätzlich ein Umschalter ("Auge-Icon") in der Datensatzliste angezeigt.

.. seealso:: Für mehrsprachige MetaModels steht das Attribut
   :ref:`component_attribute_translatedcheckbox` zur Verfügung.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_checkbox


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Checkbox-Attribut folgende spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Wechselicon
     - Ist diese Option gesetzt, wird ein zusätzliches Icon ("Auge") in der
       Listenansicht des Backends eingefügt. Damit kann der Veröffentlichungsstatus
       eines Datensatzes direkt per Klick umgeschaltet werden. Als Spaltenname wird
       hierfür üblicherweise ``published`` verwendet. Die eigentliche Filterung der
       veröffentlichten Datensätze im Frontend muss separat über ein Filterset mit
       der Filterregel "Checkbox-Status" eingerichtet werden.
   * - Invertierte Anzeigeoption
     - Kehrt den Umschaltstatus des Icons um: Ein aktiviertes Kontrollkästchen
       (Wert ``1``) zeigt dann das inaktive Symbol, ein deaktiviertes zeigt das
       aktive Symbol; Sinnvoll z. B. für ein "Verbergen"-Feld analog beim Contao Contentelement.
   * - Benutzerdefiniertes Icon
     - Aktiviert die Auswahl eigener Icons für die Backend-Listenansicht. Wird
       diese Option gesetzt, erscheinen zwei weitere Felder:

       * **Icon Aktiv** – Icon, das bei Wert ``1`` angezeigt wird (Bild-Datei auswählen)
       * **Icon Inaktiv** – Icon, das bei leerem Wert angezeigt wird (Bild-Datei auswählen)

       Unterstützte Formate: jpg, jpeg, gif, png, tif, tiff, svg.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Checkbox-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Checkbox-Wertes. Wird
       kein Template angegeben, erfolgt die Ausgabe als einfacher Text (``1`` bei Aktiv
       oder ```` bei Inaktiv).

       Primär für die Listenanzeige im BE ist das Template ``mm_attr_checkbox_icon``, welches den
       Staus mit UTF8-Icons als ☐ bzw. ☑ angezeigt (ab MM 2.4)
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Checkbox-Attribut einer Eingabemaske hinzugefügt, stehen folgende Optionen
zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``w50`` für halbe Breite, ``cbx m12`` für Checkbox-typische Abstände).
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.
   * - Template für das Frontend
     - Auswahl eines eigenen Widget-Templates für das Frontend-Editing
       (nur verfügbar, wenn die Erweiterung "Frontend Editing" installiert ist).

**Funktionen**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Pflichtfeld
     - Macht das Feld zu einem Pflichtfeld (selten sinnvoll bei Checkboxen, da
       ein nicht gesetzter Haken bereits einem definierten Wert entspricht).
   * - Beim Ändern speichern
     - Die Eingabemaske wird per Ajax neu geladen, sobald die Checkbox umgeschaltet
       wird (``submitOnChange``). Die Daten werden dabei noch nicht gespeichert.

**Übersicht (Backend-Filter)**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Filterbar
     - Das Attribut steht im Backend als Filterkriterium zur Verfügung.


Filterregeln
------------

Das Checkbox-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Checkbox-Status
     - Prüft, ob der Checkbox-Wert gleich ``1`` ist. Wird typischerweise für die
       Veröffentlichungssteuerung eingesetzt. Die Filterregel bietet zwei
       Zusatzoptionen:

       * **Überschreiben erlauben** – Ein URL-Parameter kann die Filterregel
         außer Kraft setzen (z. B. für Vorschaulinks).
       * **Filter nicht in Frontendvorschau nutzen** – Die Filterregel wird
         übersprungen, wenn ein Backend-Benutzer die Contao-Frontend-Vorschau
         nutzt.
   * - Einfache Abfrage
     - Filtert nach einem bestimmten Checkbox-Wert über einen URL-Parameter;
       sinnvoll wenn Besucher selbst nach aktiv/inaktiv filtern sollen.


Sonderfunktionen
-----------------

**Veröffentlichungsstatus (Wechselicon)**

Ist "Wechselicon" aktiv, registriert MetaModels eine Toggle-Operation in der
Backend-Listenansicht. Ein Klick auf das Icon wechselt den Wert des Datensatzes
direkt zwischen ``1`` und ``''``, ohne das Bearbeitungsformular öffnen zu müssen.
Die Filterung der veröffentlichten Datensätze im Frontend muss über ein eigenes
Filterset mit der Filterregel "Checkbox-Status" (Paket ``filter_checkbox``) erfolgen.

**Invertierter Modus**

Die Option "Invertierte Anzeigeoption" dreht nur die *Anzeige* des Icons um —
der gespeicherte Wert bleibt unverändert (``1`` = aktiv, ``''`` = inaktiv).
Dies ist nützlich, wenn die Semantik eines Feldes umgekehrt formuliert ist
(z. B. "Verborgen" statt "Sichtbar") analog beim Contao Contentelement.

**Datenbank-Speicherung**

Der Wert wird als ``char(1) NOT NULL default ''`` gespeichert:
``'1'`` steht für aktiv, ``''`` (leerer String) für inaktiv.


.. |img_checkbox| image:: /_img/icons/checkbox.png

.. |br| raw:: html

   <br />
