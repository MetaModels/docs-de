.. _component_relations:

Relationen in MetaModels
========================

Eines der Hauptaufgaben bei MM ist es, über einen geeigneten Aufbau der Models eine passende Datenstruktur zu erstellen.
Dazu gehört die Aufteilung gleichartiger Werte in separate Models und eine Relation (Verknüpfung) zwischen den Models
herzustellen. Üblicher Weise spricht man dann von einer
`Normalisierung <https://de.wikipedia.org/wiki/Normalisierung_(Datenbank)>`_ bei relationalen Datenbanken.

Zum Beispiel würde man den Namen einer Abteilung nicht im Datensatz eines Mitarbeiters mit abspeichern. Stattdessen
legt man eine eigene Tabelle "Abteilung" an und speichert in der Tabelle "Mitarbeiter" nur die Relation - also die ID
des entsprechenden Datensatzes aus "Abteilung".

So kann man z. B. den Namen der Abteilung (Werbung zu Marketing) an einer Stelle ändern und muss nicht alle Datensätze
der Mitarbeiter ändern.

MetaModels bietet für solche Verknüpfungen vorgefertigte Attribute und Einstellungen an. Folgend werden diese mit ihren
Einsatzmöglichkeiten und Besonderheiten vorgestellt.

Bei allen Varianten ist es zu empfehlen, sich die Daten in der Datenbank mit einem geeigneten Tool wie phpMyAdmin o. ä.
anzusehen.

.. _component_relations_database_structure:
Datenbankstruktur
-----------------

Die Gesamtzahl der MetaModels und deren Verknüpfungen ergeben eine Datenbankstruktur, mit der die Daten in gewünschter
Weise gespeichert, ausgegeben und gefiltert werden kann. Insbesondere bei komplexeren Aufgabenstellungen kann eine gute
Planung nachträgliche Änderungen vermeiden.

Es ist zu empfehlen, dass die Struktur der MetaModels und deren Verknüpfungen grafisch festgehalten wird. Das hilft sowohl
bei der Erstellung als auch bei der Dokumentation.

Im einfachsten Fall kann man das Schema mit Papier und Stift aufzeichnen - es gib aber auch diverse Tools wie z. B.
`yEd <https://www.yworks.com/products/yed>`_ oder die Online-Variante `yEd live <https://www.yworks.com/yed-live/>`_.

Als Beispiel eine Struktur für Mitarbeiten inkl. Verknüpfungen zu Abteilung und Projekten sowie eine Eigenreferenz
für eine Urlaubsvertretung:

|img_db-schema_01|


.. _component_relations_standard-relations:
Standard-Relationen
-------------------

Zu den Standard-Relationen einer relationalen Datenbank gehören Einfach- und Mehrfachverknüpfungen. Dafür gibt es in
MM entsprechende Attribute, welche man in seinem Basismodel einbindet.

Man kann damit sowohl Verknüpfung zu MM-Tabellen als auch zu allen anderen Tabellen von Contao wie zum Beispiel zur den
Mitgliedern (tl_member) oder Seiten (tl_pages) erstellen. Bei Verknüpfungen zu einem MM-Model kann das auch mehrsprachig
sein - MM kümmert sich um die passenden Übersetzungen.

In der Ausgabe im FE hat man im Knoten ``raw`` den Zugriff auf alle Attribute/Werte des verknüpften Datensatzes aus der
Relationstabelle - wenn diese eine MM-Tabelle mit weiteren Relationen ist, dann auch tiefergehend auch auf diese Daten.
Diese Struktur kann man im Debugmodus über eine :ref:`Dump-Ausgabe <rst_cookbook_debug_templates>` gut
analysieren.

Zum Beispiel: wenn man bei Mitarbeiter eine Relation zu Abteilung hat und Abteilung wiederum eine Relation zum
Abteilungsleiter (Model "Mitarbeiter"), so kann man in einer Liste aller Mitarbeiter neben dem Abteilungsnamen auch Name
Bild des Abteilungsleiters ausgeben - dazu sind keine weiteren Abfragen notwendig. Als Ausgabe im Template könnte
das i. E. so aussehen:

``<p><strong>Abteilungsleiter:</strong> <?= $item['raw']['division']['__SELECT_RAW__']['manager']['__SELECT_RAW__']['name'] ?></p>``

Zur einfachen Übernahme des "Array-Pfades" kann man sich eine Ausgabe über den
":ref:`rst_cookbook_frontend_array-helper`" generieren.

Im Backend können die Auswahlen der beiden Standard-Relationen Einzel- bzw. Mehrfachauswahl über Filter eingegrenzt
werden - zum Beispiel wenn man in der Eingabemaske eines Mitarbeiters die Urlaubsvertretung auswählen möchte und in
der Liste alle Mitarbeite aufgelistet sind. Die Auswahl könnte man eingrenzen auf Mitarbeiter der eigenen Abteilung und
sich selbst ausschließen. Ein weiteres Beispiel sind abhängige Relationen wie ein Select auf Land und ein weiteres auf
Bundesland, wobei dann bei den Bundesländern nur noch die zugehörigen Datensätze angezeigt werden sollen.

Für diese Eingrenzungen eignet sich die Filterregel "Eigenes SQL" sehr gut - im Handbuch finden sich weitere Tipps:

   - :ref:`rst_cookbook_inputmask_manipulate-select-values`
   - :ref:`rst_cookbook_filter_custom-sql`


.. _component_relations_standard-relation-1ton:
Einzelauswahl [Select] - "1:n"
..............................

Möchte man eine Relation zu einem Wert wie z. B. Mitarbeiter zu einer Abteilung aufbauen, so fügt man bei dem Model
"Mitarbeiter" das Attribut "Einzelauswahl [Select]" ein und wählt die passenden Einstellungen beim Attribut aus.

In der Eingabemaske im BE wird mit dem Attribut standardmäßig eine Selectauswahl erzeugt - es gibt aber auch noch
weitere Optionen bei den Einstellungen des Attributs bei der Eingabemaske.

Es gibt auch noch das Attribut "Übersetzte Einzelauswahl [Select]" - dieses ist hauptsächlich für die Anbindung von
Tabellen bestimmt, die nicht zu MetaModels gehören und ein eigenständiges Feld für die Sprachvariante besitzen - oder
für den Spezialfall, dass bei dem referenzierten MetaModel je nach Sprache unterschiedliche Items ausgewählt werden sollen.


.. _component_relations_standard-relation-mton:
Mehrfachauswahl [Tags] - "m:n"
..............................

Möchte man eine Relation zu mehreren Werten wie z. B. Mitarbeiter zu mehren Sprachen aufbauen, so fügt man bei dem Model
"Mitarbeiter" das Attribut "Mehrfachauswahl [Tags]" ein und wählt die passenden Einstellungen beim Attribut aus.

In der Eingabemaske im BE wird mit dem Attribut standardmäßig eine Checkboxliste erzeugt - es gibt aber auch noch
weitere Optionen bei den Einstellungen des Attributs bei der Eingabemaske.

Bei dem Attribut gibt es zu beachten, dass die Werte wie bei m:n-Relationen in einer separaten Relationstabelle
``tl_metamodels_tag_relations`` gespeichert werden. Bei eigenen SQL-Queries muss man diese Tabelle mit
einbinden.

Es gibt auch noch das Attribut "Übersetzte Mehrfachauswahl [Tags]" - dieses ist hauptsächlich für die Anbindung von
Tabellen bestimmt, die nicht zu MetaModels gehören und ein eigenständiges Feld für die Sprachvariante besitzen - oder
für den Spezialfall, dass bei dem referenzierten MetaModel je nach Sprache unterschiedliche Items ausgewählt werden sollen.


Spezial-Relationen bei MetaModels
---------------------------------

Zusätzlich zu den Standard-Relationen gibt es weitere Implementierungen in MetaModels, die aufgrund von Anwenderwünschen
implementiert wurden.

.. _component_relations_child-tables:
Kind-Tabellen - "n:1"
.....................

Die Relation von "Kind-Tabellen" folgt dem klassischen Aufbau wie bei Contao z. B. bei News oder Events. Dabei gibt es
eine Tabelle (Kind), die in ihrer Hierarchie einer übergeordneten Tabelle (Eltern) zugewiesen ist. Als Beispiel für die
Mitarbeiter könnten Dienstreisen als Kindtabelle angelegt werden. Die Daten sind üblicher Weise immer einem Mitarbeiter
zugeordnet und werden als alleinstehende Eingabeliste gepflegt.

Die Relation erfolgt über die Systemspalten ``pid`` und ``id``, wobei die ``pid`` der Kinddatensätze die ``id`` des
Elterndatensatzes beinhalten.

Die Verknüpfung wird über die Einstellungen der Eingabemaske konfiguriert indem bei "Integration: Als Kind-Tabelle" und
"Name der Elterntabelle" die entsprechende Tabelle ausgewählt wird - als Elterntabelle können auch andere Contao-Tabellen
ausgewählt werden.

Zudem ist bis auf Sonderfälle bei "Render-Modus: Elternelement vorhanden" auszuwählen - damit wird die gewünschte Relation
von ``pid`` zu ``id`` beim Anlegen des Kinddatensatzes erzeugt.

Der Zugriff auf die Liste der Kinddatensätze erfolgt über ein Icon in der Zeile der Elterndatensätze bei den
Bearbeitungsicons - optional ist die Auswahl eines eigenen Icons möglich.

Bei der Arbeit mit Kind-Tabellen ist zu beachten, dass "Eltern nicht wissen, dass sie Kinder haben", d. h. in der
Ausgabe im FE gibt es keine automatische Ausgabe der Kinddaten. Man kann die Kinddatensätze eines Elterndatensatzes
aber anhand der "id-pid-Relation" filtern - z. B. mit Filterregel "Eigenes SQL".

Für die Filterung der Kinddatensätze gibt es weiterhin eine Sonderfilterregel ":ref:`Elternfilter <rst_extended_filter_by_related>`.
Damit können alle Kinddatensätze nach Eigenschaften der Elterndaten gefiltert werden - z. B. "Filtere alle Dienstreisen
nach Mitarbeitern aus Abteilung Vertrieb".

Wird ein Elterndatensatz gelöscht, so werden nicht automatisch auch die Kinddatensätze mit gelöscht. Möchte man dieses
Verhalten, so kann man das einstellen - siehe :ref:`rst_cookbook_tips_delete_child_items`.

Ebenso gibt es keinen Automatismus, dass die Kinddatensätze mit kopiert werden, wenn Elterdatensätze kopiert werden. Möchte
man dieses Verhalten, so kann man das z. B. mit dem PostDuplicateModelEvent des DC_G erreichen - siehe
`"MM DeepCopy Feature" <https://github.com/w3scout/mm-deepcopy-eventlistener>`_.

Bitte bei Verwendung von Varianten oder Hierarchie/Baumstruktur in Kindtabellen den aktuellen Stand prüfen (s. u.).


.. _component_relations_variants:
Varianten
.........

Der Aufbau mit Varianten ist dann anzuwenden, wenn es zu einem Datensatz bei einzelnen Attributen
Abweichungen/Variationen gibt. Das könnten zum Beispiel ein Produktkatalog sein, in dem es einzelne Produkte in
unterschiedlichen oder abweichenden Farben oder Materialien gibt aber die meisten Attribute identisch bleiben.

Um Varianten für ein Model zu aktivieren, muss man die die entsprechende Checkbox bei dem Model setzen. Anschließend
ist bei den Attributen die Checkbox "Variant" aktiv und kann gesetzt werden. Für alle Attribute die variant/variable
sein sollen, ist die Checkbox zu setzen - in dem Beispiel oben die Farbe und/oder Material.

Wenn die Elterndatensätze wie gehabt ausgefüllt wurden erscheint in der BE-Liste der Datensätze bei Varianten ein zusätzliches
Icon, um Kinddatensätze anzulegen. Die Eingabemaske zum Editieren eines Kinddatensatzes ist soweit identisch mit der
Maske des Elterndatensatzes, jedoch sind nur die Attribute bearbeitbar, die als Variant spezifiziert wurden - alle
anderen (invarianten) Widgets sind automatisch nur-lesend (readonly).

Das besondere an Varianten ist, dass alle nicht-varianten Werte aus dem Elterndatensatz automatisch an die
Kinddatensätze übertragen werden - und das nicht nur beim Erstellen, sondern auch bei Änderungen. In den Kinddatensätzen
sind somit immer die aktuellen Werte des Elterndatensatzes vorhanden und müssen von dort nicht extra abgefragt werden.

Dadurch muss man Attributen, die eindeutige Werte (unique) enthalten (z. B. Alias) etwas mehr Beachtung schenken. Die
Prüfung auf Eindeutigkeit bezieht sich auf alle Datensätze in der Tabelle und nicht nur auf Elterndatensätze. Bei
nicht unterstützten Kombinationen aus "Variant" und "Eindeutige Werte" erfolgt eine entsprechende Fehlermeldung.

Diese zweistufige Hierarchie wird durch die Systemspalten ``varbase`` und ``vargroup`` gesteuert:

* Elterndatensätze haben bei ``varbase`` eine ``1`` und bei ``vargroup`` die eigene ID
* Kinddatensätze haben bei ``varbase`` eine ``0`` und bei ``vargroup`` die ID des Elterndatensatzes

In der :ref:`MM-API <ref_api_interf_mm>` gibt es verschiedene Abfragemöglichkeiten nach den Variantentypen.

Mit MM 2.3 können Varianten auch in Kindtabellen verwendet werden.


Hierarchie / Baumstruktur
.........................

Um eine Baumstruktur wie z. B. der Seitenbaum von Contao zu erstellen, kann man in den Einstellungen der Eingabemaske
bei "Render-Modus: Hierarchie" wählen. Zudem muss die Standardsortierung auf "Manuell" gesetzt werden.

Die Relation in der hierarchischen Struktur wird klassisch über ``id`` ``pid`` aufgebaut, wobei jede tiefergelegene
Ebene bei ``pid`` die jeweilige ``id`` der übergeordneten Ebene enthält.

Wird ein Model mit Hierarchie von einem anderen Model über eine Relation eingebunden (Einzel- oder Mehrfachauswahl),
so spiegelt sich die Hierarchie nicht im Aufbau der Selectauswahl oder Checkboxliste wieder.

Models mit einer Hierarchie / Baumstruktur können (aktuell) nicht als Kind-Tabelle eingesetzt werden, da die ``pid``
als Relation zum Elterndatensatz verwendet wird.


.. |br| raw:: html

   <br />

.. |img_db-schema_01| image:: /_img/screenshots/metamodel_first/db-schema_01.png
   :width: 400px

