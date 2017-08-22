.. _rst_extended_notelist:

Merkliste für MetaModels
========================

.. warning:: Die Merkliste ist noch im Fundraising und wird erst nach
   Erreichen der Zielsumme von x.000€ frei geschaltet. |br|
   Eine Vorab-Installation ist nach Absprache möglich.
   Kontakt: info@e-spin.de

Die Merkliste (Notelist) erweitert MetaModels um die Möglichkeit, in der
FE-Ausgabe einzelne Datensätze (Items) einer Merkliste hinzuzufügen (add).

Einsatzmöglichkeiten für die Merkliste reichen von einer "normalen Merkliste"
über Vergleichslisten z.B. von Produkteigenschaften bis zu Warenkorbfunktionen.

Ist ein Datensatz in einer Merkliste gespeichert, kann der Datensatz natürlich
auch aus der Merkliste wieder entfernt werden (remove).

Mit der Merkliste gibt es eine neue Filterregel, mit der eine MetaModels-Liste
nach vorhandenen Merklist-Datensätzen gefiltert werden kann.

Für den Formulargenerator wurde ein neues Widget erstellt, mit dem die Datensätze
der Merkliste aufgelistet und in der E-Mail mit übertragen werden - eine Versendung
der E-Mail per Notification-Center ist auch möglich.

In jedem MetaModels können mehrere Merklisten angelegt werden. Damit ist es z.B.
möglich, einen Datensatz bei zwei Merklisten einzutragen wie "Favoriten" und "Bestellen"
oder man kann einen Datensatz von einer Merkliste wie "Vormerken" zu einer weiteren
Merkliste "Bestellen" übertragen.

In der Konfiguration einer Merkliste kann ein Filter gesetzt werden, so dass
nur noch bestimmte Datensätze in die Merkliste aufgenommen werden können - z.B.
nur Mitarbeiter aus der Abteilung "Vertrieb".

Die Merkliste arbeitet auch mit übersetzten MetaModels, so dass die Datensätze einer
Merkliste auch beim Wechsel der Sprache erhalten bleiben.


Installation per Composer
-------------------------

Voraussetzungen für die Installation:

* PHP 7.x
* Contao 3.5.x
* MetaModels core dev-hotfix/2.0.0-alpha16 (b326aed1) und DCG 2.0.0-beta39

In der Paketverwaltung in der Suche `metamodels/notelist` eingeben,
installieren und die Datenbank aktualisieren.


Merkliste anlegen
-----------------

Nach der erfolgreichen Installation der Merkliste erscheint ein neues Icon in der
Reihe der MetaModels-Icons, über welches man zum Anlegen und editieren der Merklisten
gelangt.

|img_notelist_icon|

Legt man eine neue Merkliste an, so kann ein Name für die Merkliste vergeben werden.
Als "Storage adapter" steht z.Z. nur die PHP-Session zur Verfügung - später kommen
noch Adapter wie z.B. die Contao-Session hinzu. Über die Filterauswahl kann die
Aufnahme auf Datensätze mit bestimmten Eigenschaften wie z.B. die "Abteilung"
eingeschränkt werden.

|img_nodelist_config|

Über die Listenansicht erhält man Zugriff auf alle angelegten Merklisten.

|img_notelist_overview|


Merkliste in MetaModels-Liste aktivieren
----------------------------------------

Im CE MetaModels-Liste bzw. FE-Modul gibt es einen neuen Abschnitt "Notelist", in dem
eine oder mehrere der angelegten Merklisten aktiviert werden kann.

|img_notelist_ce_mm-list|

Die Reihenfolge der "Action-Ausgaben" ist über die Sortrierung der Merklisten per
Drag&Drop veränderbar.

Wird für die Ausgabe das Standardtemplate verwendet müssen keine weiteren Änderungen
vorgenommen werden und in der FE-Listenansicht sollten die Datensätze einen weiteren
Link zum Hinzufügen zur Merkliste vorweisen.

Verwendet man ein eigenes Template, so ist für die neuen Links eine entsprechend
Anpassung notwendig. Die Links sind im Knoten `action` enthalten und können
z.B. mit dem folgenden Code ausgegeben werden:

.. code-block:: html
   :linenos:
   
   <?php foreach($arrItem['actions'] as $action): ?>
     <a href="<?= $action['href']; ?>"<?php if ($action['class']): ?> class="<?= $action['class']; ?>"<?php endif; ?><?php if ($action['title']): ?> title="<?= $action['title']; ?>"<?php endif; ?><?= $action['attribute']; ?>><?= $action['label']; ?></a>
   <?php endforeach; ?>

 |img_notelist_fe_list|


Ausgabe der Merkliste per Filter
--------------------------------

Die Ausgabe der Merkliste im FE erfolgt über eine normale MetaModels-Liste, die
auf die Elemente der Merkliste gefiltert wird. 

Für die Filterung muss ein Filter mit der neuen Filterregel "Notelist" angelegt
werden. In der Filterregel ist lediglich die Merkliste auszuwählen, dessen Elemente
ausgegeben werden sollen.

|img_notelist_filterrule|

In der FE-Ausgabe der gefilterten Liste, sieht man nur noch die Mitarbeiter der
Merkliste.

|img_notelist_filtered_list|

In der Listenausgabe wäre es z.B. möglich, eine weitere Merkliste zu aktivieren,
um die Elemente von einer merkliste zu einer weiteren zu übernehmen - z.B. von
"Vormerken" zu "Bestellen".

In den Einstellungen der Merkliste kann optional ein Filter für die Aufnahme zu
einer Merkliste gesetzt werden. Sind z.B. nur Mitarbeiter erlaubt, die zum Vertrieb
gehören, sieht die Liste wie folgt aus:

|img_notelist_fe_list_with_filter|


Datenanzeige und Übernahme im Formular
--------------------------------------

Im Formulargeneratorsteht ein neues Widget `MetaModels note list` zur Verfügung.
Mit den Einstellungen wird sowohl die Anzeige im Formular als auch in der E-Mail
gesteuert.

Dazu kann eine oder mehrere Merklisten aktiviert und jeweils für die FE-Ausgabe
und die E-Mail-Ausgabe eine Render-Einstellung ausgewählt werden.

|img_nodelist_form_widget|

Im Formular werden die entsprechenden Datensätze ausgegeben mit der Möglichkeit, die gesamte Liste
oder einzelne Items zu löschen.

|img_nodelist_form_fe_list|

Die Daten werden per E-Mail übertragen und können über das E-Mail-Template in der Ausgabe
angepasst werden.

|img_notelist_email_list|


Known Issues and Next Features
------------------------------

* nach Absenden des Formulars sind Elemente nicht aus Merkliste entfernt
* optionale Angabe einer Anzahl fehlt


InsertTags
----------

Für die Ausgabe der Anzahl der Items in den Merklisten sind verschiedene
InsertTags implementiert. Diese geben die Anzahl wie folgt aus ('mm_mitarbeiterliste' 
ist das entsprechende MetaModels):

* Anzahl aller Items: {{metamodels_notelist::sum::mm_mitarbeiterliste}}
* Anzahl aller Items der Merkliste ID 1: {{metamodels_notelist::sum::mm_mitarbeiterliste::1}}
* Anzahl aller Items der Merkliste ID 1 und 2: {{metamodels_notelist::sum::mm_mitarbeiterliste::1,2}}

Ist kein Item in der Merkliste, wird 0 (Null) ausgebeben.


Events
------

Soll die Manipulation einer Notelist (add, remove, clear) überwacht werden,
steht dafür ein Eventlistener zur Verfügung.

Mit dem Eventlistener kann z.B. ein Rückmeldung an die Webseite erfolgen oder
ein Logging/Tracking der Aktionen.

Als Beispiel für eine Rückmeldung kann in einem eigenen Contao-Modul z.B. unter
``/system/modules/myModule/config/event_listeners.php`` folgender Code eingetragen
werden:

.. code-block:: php
   :linenos:

   <?php
   
   use MetaModels\NoteList\Event\ManipulateNoteListEvent;
   use MetaModels\NoteList\Event\NoteListEvents;
   
   return [
       NoteListEvents::MANIPULATE_NOTE_LIST => [
           function (ManipulateNoteListEvent $event) {
               // Only handle note list "1".
               if ('1' !== ($listId = $event->getNoteList()->getStorageKey())) {
                   return;
               }
   
               switch ($event->getOperation()) {
                   case ManipulateNoteListEvent::OPERATION_ADD:
                       Message::addConfirmation('Added ' . $event->getItem()->get('id') . ' to ' . $listId);
                       break;
                   case ManipulateNoteListEvent::OPERATION_REMOVE:
                       Message::addConfirmation('Removed ' . $event->getItem()->get('id') . ' to ' . $listId);
                       break;
                   case ManipulateNoteListEvent::OPERATION_CLEAR:
                       Message::addConfirmation('Cleared ' . $listId);
                       break;
                   default:
                       throw new \RuntimeException('Unknown note list operation: ' . $event->getOperation());
               }
           }
       ]
   ];

Auf der Webseite kann in einem Template die Rückmeldung über die Ausgabe der Contao-Message
erfolgen - z.B.

.. code-block:: php
   :linenos:
   
   <?php
   echo Message::generate();
   ?>




.. |br| raw:: html

   <br />


.. |img_notelist_icon| image:: /_img/screenshots/extended/notelist/notelist_icon.png
.. |img_nodelist_config| image:: /_img/screenshots/extended/notelist/nodelist_config.png
.. |img_notelist_overview| image:: /_img/screenshots/extended/notelist/notelist_overview.png
.. |img_notelist_ce_mm-list| image:: /_img/screenshots/extended/notelist/notelist_ce_mm-list.png
.. |img_notelist_fe_list| image:: /_img/screenshots/extended/notelist/notelist_fe_list.png
.. |img_notelist_filterrule| image:: /_img/screenshots/extended/notelist/notelist_filterrule.png
.. |img_notelist_filtered_list| image:: /_img/screenshots/extended/notelist/notelist_filtered_list.png
.. |img_notelist_fe_list_with_filter| image:: /_img/screenshots/extended/notelist/notelist_fe_list_with_filter.png
.. |img_nodelist_form_widget| image:: /_img/screenshots/extended/notelist/nodelist_form_widget.png
.. |img_nodelist_form_fe_list| image:: /_img/screenshots/extended/notelist/nodelist_form_fe_list.png
.. |img_notelist_email_list| image:: /_img/screenshots/extended/notelist/notelist_email_list.png