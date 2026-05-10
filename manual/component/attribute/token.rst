.. _component_attribute_token:

Token (ab MM 2.4)
=================

Das Attribut "Token" erzeugt beim erstmaligen Speichern eines Datensatzes eine
kryptographisch zufällige, unveränderliche Zeichenfolge (Token). Typische Einsatzbereiche:

* Eindeutige Bestellnummern oder Vorgangsnummern (z. B. ``TKN-aB3xYq``)
* Zugangsschlüssel oder Freigabe-Links im Frontend
* Interne Referenz-IDs, die stabil bleiben müssen

Das Token wird genau einmal generiert — beim ersten Speichern, solange das Feld noch
leer ist. Jede weitere Speicherung des Datensatzes lässt den bestehenden Token
unverändert. Auch ein direkter Aufruf von ``setDataFor()`` überschreibt einen
vorhandenen Token nicht (Write-once-Schutz auf Datenbankebene).

.. note:: Das Token ist immer eindeutig. Die Option "Eindeutige Werte" in den
   allgemeinen Attribut-Einstellungen ist deshalb fest aktiv und kann nicht
   deaktiviert werden.

.. warning:: Beim Duplizieren (Kopieren) eines Datensatzes im Backend wird kein
   Token übernommen. Das neue Item erhält beim Speichern automatisch einen eigenen,
   neuen Token.


Einstellungen beim Anlegen des Attributs
-----------------------------------------

Neben den allgemeinen Attribut-Einstellungen (Name, Spaltenname, Beschreibung,
Varianten überschreiben) bietet das Token-Attribut folgende spezifische Optionen:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Zeichensatz für Token
     - Zeichen, die für die zufällige Generierung verwendet werden. Mögliche
       Eingaben:

       * Einfache Zeichen: ``ABC123`` (jedes Zeichen einzeln)
       * Bereichsangabe in eckigen Klammern: ``[a-z][A-Z][0-9]``
       * Sonderzeichen direkt: ``$%=``
       * Kombiniert: ``[A-F][0-9]`` (Hexadezimal)

       Standard: ``[a-z][A-Z][0-9]`` (alphanumerisch). Wird das Feld leer
       gelassen, greift ebenfalls dieser Standard.
   * - Zeichenlänge des Tokens
     - Anzahl der zufällig generierten Zeichen (Mindestwert: 3, Standard: 8).
   * - Präfix des Tokens
     - Optionaler fester Text, der jedem Token vorangestellt wird
       (z. B. ``TKN-`` ergibt ``TKN-aB3xYq``). |br|
       Das Präfix wird nicht zur Tokenlänge hinzugerechnet.


Einstellungen bei den Render-Einstellungen
-------------------------------------------

Das Token-Attribut besitzt keine eigenen Render-Einstellungen. In der Attributliste
einer Render-Einstellung stehen die üblichen Optionen zur Verfügung:

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Template
     - Auswahl eines eigenen Templates für die Ausgabe des Token-Wertes. Wird kein
       Template angegeben, erfolgt die Ausgabe als einfacher Text.
   * - CSS-Klasse
     - Optionale CSS-Klasse, die dem Ausgabeelement hinzugefügt wird.


Einstellungen bei der Eingabemaske
------------------------------------

Wird das Token-Attribut einer Eingabemaske hinzugefügt, ist das Feld im Backend
grundsätzlich schreibgeschützt (``readonly``). Folgende Optionen stehen zur Verfügung:

**Darstellung**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Backend-Klasse
     - CSS-Klassen für die Darstellung des Feldes im Backend-Formular (z. B.
       ``w50`` für halbe Breite, ``clr`` für Zeilenumbruch, ``long`` für volle
       Breite).

**Übersicht (Backend-Suche)**

.. list-table::
   :header-rows: 1
   :widths: 25 75

   * - Option
     - Beschreibung
   * - Suchbar
     - Das Attribut steht im Backend als Suchfeld zur Verfügung.

.. note:: Die Optionen "Pflichtfeld", "Immer speichern" und "Filterbar" stehen für
   das Token-Attribut nicht zur Verfügung, da das Feld intern immer gespeichert
   wird und schreibgeschützt ist.


Filterregeln
------------

Das Token-Attribut kann mit folgenden Filterregeln verwendet werden:

.. list-table::
   :header-rows: 1
   :widths: 30 70

   * - Filterregel
     - Hinweis
   * - Einfache Abfrage
     - Filtert Datensätze nach einem exakten Token-Wert; sinnvoll für
       URL-basierte Zugangsprüfungen |br|
       (z. B. ``?token=TKN-aB3xYq``).
   * - Eigenes SQL
     - Für komplexere Filterungen, z. B. wenn ein Token nur für bestimmte
       Mitglieder sichtbar sein soll.


Sonderfunktionen
-----------------

**Konfiguration per config.yaml**

Die maximale Anzahl der Generierungsversuche, bevor eine Ausnahme ausgelöst wird,
kann projektspezifisch in der ``config/config.yaml`` angepasst werden:

.. code-block:: yaml

   meta_models_attribute_token:
       max_retries: 5   # Standard: 3

Bei jedem Versuch wird geprüft, ob der generierte Token bereits in der Datenbank
vorhanden ist. Schlägt die Eindeutigkeitsprüfung dreimal (oder so oft wie konfiguriert)
fehl, wird eine ``RuntimeException`` geworfen.

**Eigene Token-Generierung per Event**

Über den Event ``MetaModels\AttributeTokenBundle\Event\GenerateTokenEvent`` kann die
Token-Generierung durch eigenen Code ersetzt oder erweitert werden. Wird im Listener
``setToken()`` aufgerufen, überspringt MetaModels die eingebaute Zufallsgenerierung.

Beispiel-Listener:

.. code-block:: php

   use MetaModels\AttributeTokenBundle\Event\GenerateTokenEvent;

   class MyTokenListener
   {
       public function onGenerateToken(GenerateTokenEvent $event): void
       {
           $prefix = $event->getAttribute()->get('token_prefix') ?? '';
           $event->setToken($prefix . strtoupper(bin2hex(random_bytes(8))));
       }
   }

Registrierung in ``config/services.yaml``:

.. code-block:: yaml

   App\EventListener\MyTokenListener:
       tags:
           - name: kernel.event_listener
             event: MetaModels\AttributeTokenBundle\Event\GenerateTokenEvent
             method: onGenerateToken

Die verfügbaren Methoden des Events:

.. list-table::
   :header-rows: 1
   :widths: 40 60

   * - Methode
     - Beschreibung
   * - ``getAttribute(): Token``
     - Gibt das Token-Attribut zurück (Zugriff auf Zeichensatz, Länge, Präfix).
   * - ``getItem(): IItem``
     - Das MetaModel-Item, das gerade gespeichert wird.
   * - ``setToken(string $token)``
     - Setzt einen eigenen Token; verhindert die eingebaute Generierung.
   * - ``getToken(): ?string``
     - Gibt den vom Listener gesetzten Token zurück, oder ``null``.
   * - ``isTokenProvided(): bool``
     - ``true``, wenn ein Listener bereits ``setToken()`` aufgerufen hat.

**Write-once-Schutz auf Datenbankebene**

Auch wenn ``setDataFor()`` direkt aufgerufen wird, überschreibt MetaModels einen
bereits vorhandenen Token-Wert nicht. Die UPDATE-Abfrage enthält eine Bedingung
``WHERE spalte IS NULL OR spalte = ''``, sodass ein befülltes Feld immer unverändert
bleibt.

**Datenbank-Speicherung**

Der Token wird als ``varchar(255) NULL`` in der MetaModel-Tabelle gespeichert. Ein
leerer Wert wird als ``NULL`` abgelegt (kompatibel mit MySQL Strict Mode).


.. |br| raw:: html

   <br />
