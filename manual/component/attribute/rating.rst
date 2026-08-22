.. _component_attribute_rating:

|svg_attr_rating_22| |img_star_full| Bewertung
===============================================

Das Attribut "Bewertung" stellt ein Sternchen-Bewertungssystem bereit. Besucher
können Items über ein AJAX-Widget im Frontend bewerten. Im Backend werden
Bewertungsanzahl und Durchschnittswert angezeigt. Typische Einsatzbereiche:

* Produktbewertungen in Shops
* Bewertung von Artikeln, Rezepten oder Veranstaltungen
* Nutzerbefragungen mit Sterneskala

Die eigentliche Bewertung erfolgt ausschließlich über AJAX aus dem Frontend —
das Feld ist im Backend schreibgeschützt. Je Besucher und Item wird eine
Session-basierte Sperrung vorgenommen, um Mehrfachbewertungen zu verhindern.


Installation
------------

Das Attribut wird über den **Contao Manager** oder **Composer** installiert:

.. code-block:: bash

   composer require metamodels/attribute_rating


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen bietet das Attribut folgende
spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Maximalwert
     - Legt fest, wie viele Sterne maximal vergeben werden können (z. B. ``5``
       für eine Fünf-Sterne-Bewertung).
   * - Halbe Wertungen
     - Aktiviert 0,5-Schritte anstatt ganzer Zahlen, so dass z. B. 3,5 von 5
       Sternen möglich ist.
   * - Bild für "leeren Stern"
     - Eigenes Bild, das als nicht ausgefüllter Stern angezeigt wird. Wird kein
       Bild gewählt, wird das Standard-Icon der Erweiterung verwendet.
   * - Bild für "voller Stern"
     - Eigenes Bild, das als ausgefüllter Stern angezeigt wird.
   * - Bild für Hovereffekt
     - Eigenes Bild, das beim Überfahren mit der Maus angezeigt wird.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Attribut besitzt eine eigene Render-Einstellung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Abstimmung deaktivieren
     - Deaktiviert die Möglichkeit der Abstimmung im Frontend für diese
       Render-Einstellung. Das Ergebnis wird dann nur angezeigt, ohne dass
       eine neue Bewertung abgegeben werden kann.
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe der Bewertungsanzeige.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Das Attribut ist im Backend schreibgeschützt — Bewertungen können ausschließlich
über das Frontend-AJAX-Widget abgegeben werden. Wird es einer Eingabemaske
hinzugefügt, wird der aktuelle Bewertungsdurchschnitt und die Anzahl der Stimmen
angezeigt.

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung im Backend-Formular.
   * - Template für das Backend
     - Auswahl eines eigenen Widget-Templates für das Backend-Formular.


Filterregeln
------------

Das Bewertungs-Attribut unterstützt keine eigenen Filterregeln — Bewertungsdaten
können nicht direkt als Filterkriterium im Frontend genutzt werden. Eine Sortierung
nach Bewertung (Durchschnittswert, dann Anzahl der Stimmen) ist jedoch möglich.


Sonderfunktionen
-----------------

**Speicherung**

Die Bewertungsdaten werden **nicht** in der MetaModel-Tabelle gespeichert, sondern
in der eigenen Tabelle ``tl_metamodel_rating`` mit den Spalten:

* ``mid`` – MetaModel-ID
* ``aid`` – Attribut-ID
* ``iid`` – Item-ID
* ``votecount`` – Anzahl der abgegebenen Stimmen
* ``meanvalue`` – berechneter Durchschnittswert als Prozentzahl (``double``)

**Abstimmungslogik**

Jede abgegebene Stimme wird über AJAX verarbeitet. MetaModels prüft anhand
der Besucher-Session, ob für dieses Item bereits abgestimmt wurde. Die Berechnung
des Durchschnittswerts erfolgt nach folgender Formel:

``(1 / (rating_max × votecount)) × (vorheriger Gesamtwert + neue Stimme)``

Der Wert wird als Prozentwert (0–1) gespeichert.

**Standard-Icons**

Wird kein eigenes Bild für Stern-Symbole gewählt, verwendet die Erweiterung
Standardbilder aus dem Bundle: ``star-empty.png``, ``star-full.png``,
``star-hover.png``.

**Sortierung**

Items werden nach Durchschnittswert absteigend sortiert; bei Gleichstand
entscheidet die Anzahl der Stimmen. Items ohne Bewertung werden am Ende der
Liste eingereiht.


.. |svg_attr_rating_22| image:: /_img/icons_svg/star.svg
   :width: 22px
.. |img_star_full| image:: /_img/icons/star-full.png
.. |br| raw:: html

   <br />
