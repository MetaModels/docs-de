.. _rst_extended_notelist:

Merkliste für MetaModels
========================

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


Installation per Contao-Manager oder Composer
---------------------------------------------

Voraussetzungen für die Installation:

**Contao 5.3:**

.. warning:: Die Merkliste ist sofort einsatzbereit wird aber erst nach Erreichen der aktuellen
   Fundrasingsumme von 2.300€ frei geschaltet. |br|
   Für einen Zugang bitte eine E-Mail an info@e-spin.de

* ^PHP 8.2
* MetaModels 2.4
* Notelist 2.4
* optional Notification Center 2.3
* Zugang zum geschützten Repository - Daten nach Spende

**Contao 4.13:**

* ^PHP 8.1
* MetaModels 2.3
* Notelist 2.3
* optional Notification Center 1.7 oder 2.3


Merkliste anlegen
-----------------

Nach der erfolgreichen Installation der Merkliste erscheint ein neues Icon in der
Reihe der MetaModels-Icons, über welches man zum Anlegen und editieren der Merklisten
gelangt.

|img_notelist_icon|

Legt man eine neue Merkliste an, so kann ein Name für die Merkliste vergeben werden.
Als "Storage adapter" stehen z.Z. die PHP-Session und die Contao-Session zur Verfügung.
Bei der Contao-Session werden die Werte einer Merkliste bei eingeloggten Mitgliedern
automatisch in den Sessionwerten der Datenbank gespeichert und stehen bei erneutem
Login wieder zur Verfügung.

Über die Filterauswahl kann die Aufnahme auf Datensätze mit bestimmten Eigenschaften
wie z.B. die "Abteilung" oder Mitgliedergruppen eingeschränkt werden. Die Filterung
auf Mitgliedergruppen ist z.B. über die Erweiterung "`condition membergroup filter
<https://github.com/cboelter/metamodels-filter_condition_membergroup>`_" möglich.

|img_nodelist_config|

Über die Listenansicht erhält man Zugriff auf alle angelegten Merklisten.

|img_notelist_overview|


Merkliste in MetaModels-Liste aktivieren
----------------------------------------

Im CE MetaModels-Liste bzw. FE-Modul gibt es einen neuen Abschnitt "Notelist", in dem
eine oder mehrere der angelegten Merklisten aktiviert werden kann.

|img_notelist_ce_mm-list|

Die Reihenfolge der "Action-Ausgaben" ist über die Sortierung der Merklisten per
Drag&Drop veränderbar.

Wird für die Ausgabe das Standardtemplate verwendet müssen keine weiteren Änderungen
vorgenommen werden und in der FE-Listenansicht sollten die Datensätze einen weiteren
Link zum Hinzufügen zur Merkliste vorweisen.

Verwendet man ein eigenes Template, so ist für die neuen Links eine entsprechend
Anpassung notwendig. Die Links sind im Knoten `action` enthalten und können
z.B. mit dem folgenden Code ausgegeben werden (Ziffer entspricht der ID der Merkliste):

.. code-block:: html
   :linenos:

   <a href="<?= $arrItem['actions']['notelist_1']['href'] ?>" class="<?= $arrItem['actions']['notelist_1']['class'] ?>"><?= $arrItem['actions']['notelist_1']['label'] ?></a>

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

Im Formulargenerator steht ein neues Widget `MetaModels note list` zur Verfügung.
Mit den Einstellungen wird sowohl die Anzeige im Formular als auch in der E-Mail
gesteuert.

Dazu kann eine oder mehrere Merklisten aktiviert und jeweils eine Render-Einstellung
für die FE-Ausgabe und die E-Mail-Ausgabe ausgewählt werden. Zusätzlich kann für
jede Merkliste über die Checkbox "Clear list" bestimmt werden, ob nach der
Formularverarbeitung die Liste geleert werden soll.

|img_nodelist_form_widget|

Für die unterschiedlichen Ausgabebereiche gibt es entsprechende Templates, die ineinander verschachtelt sind.

Für die Ausgabe der Merkliste im Formularwidget bildet das Template in "Formularfeld-Template"
``form_metamodels_notelist.html5`` den Wrapper für alle auszugebenden Merklisten und gibt je Liste den Namen und alle Items
aus. Die Liste der Items wird über die Auswahl in "Form rendersettings" gesteuert - über das Rendersetting ist das
übliche MM-Listentemplate (``metamodels_prerendered.html5``) eingebunden.

Analog erfolgt die Ausgabe für die E-Mail. Das Wrapper-Template für alle auszugebenden Merklisten kann in "Email template"
ausgewählt werden ``email_metamodels_notelist.text.html.twig``. Die Liste der Items wird über die Auswahl in
"Email rendersettings" gesteuert - über das Rendersetting ist das übliche MM-Listentemplate eingebunden - aber hier wird
die Text-Variante verwendet - also ``metamodels_prerendered.text``.

Als Vorlage für die Rendersettings stehen mit der Erweiterung die Dateien ``metamodel_prerendered_notelists_form.html5``
und ``metamodel_prerendered_notelists_form.text`` zur Verfügung. Mit den Templates werden auch automatisch die Daten mit
ausgegeben, die zusätzlichen jedem Datensatz der Merkliste mitgegeben werden können (Payload). Das ist über ein
:ref:`"Mini"-Formular <rst_extended_notelist_additional_form>` oder :ref:`Event-Listener <rst_extended_notelist_additional_events>`
möglich.

In den Listentemplates ist neben den üblichen Knoten ``raw`` ``text`` auch ``notelists_names`` als Liste der
Notelist-Namen vorhanden.

Der Payload wird über die Knoten ``notelists_payload_values`` ``notelists_payload_labels`` übermittelt.

Mite den Werten ist eine individuelle Gestaltung der Ausgabe im Formular-Widget als auch in der E-Mail möglich. Die
vorhandenen Templates können wie üblich mit eigenen Varianten überschrieben werden.

.. note:: Eine Bearbeitung z. B. Löschen der Elemente der Merkliste ist im Formular nicht möglich, da bei einem Reload
   der Seite die schon im Formular eingegebene Daten verloren gehen würden.

Man kann vor der Ausgabe des Formulars eine Liste mit allen Elementen der Merkliste
ausgeben und dort diese einzeln bearbeiten oder die gesamte Liste löschen - siehe Link.

.. code-block:: html
   :linenos:

   <p><a href="de/metamodels/note-list-contact-form.html?notelist_2_action=clear">Clear List 2</a></p>

|img_nodelist_form_fe_list_edit_items|

Die Daten werden per E-Mail übertragen und können über das E-Mail-Template in der Ausgabe
angepasst werden. Für die Versendung stehen die Contao-Formularoption oder auch das
"Notification Center (NC)" zur Verfügung.

|img_notelist_email_list|

.. _rst_extended_notelist_additional_form:
Übermittlung zusätzlicher Daten für jedes Item
----------------------------------------------

Als Option können für jedes Item zusätzliche Daten an die Merkliste wie z.B. eine Anzahl, Freitext
o.ä. übermittelt werden. Dafür erstellt man über den Formulargenerator ein Formular, welches die
anzuzeigenden Felder beinhaltet z.B. Auswahlfeld für eine Anzahl und Textfeld für eine kurze Info -
ein Absendefeld ist nicht notwendig und wird automatisch generiert.

Dieses angelegte Formular steht nun in den Einstellungen der Merkliste zur Verfügung - Formulare,
die schon ein Merkliste-Formularelement beinhalten, werden nicht angezeigt (Rekursion!).

In der Listendarstellung wird bei jedem Item nun das Formular inkl. einem "Add/Edit-Button"
angezeigt. Die Daten werden vom Formular auch mit verarbeitet und z.B. per E-Mail mitgesendet.

|img_notelist_fe_list_with_form|


InsertTags
----------

Für die Ausgabe der Anzahl der Items in den Merklisten sind verschiedene
InsertTags implementiert. Diese geben die Anzahl wie folgt aus ('mm_mitarbeiterliste' 
ist das entsprechende MetaModels):

* Anzahl aller Items: {{metamodels_notelist::sum::mm_mitarbeiterliste}}
* Anzahl aller Items der Merkliste ID 1: {{metamodels_notelist::sum::mm_mitarbeiterliste::1}}
* Anzahl aller Items der Merkliste ID 1 und 2: {{metamodels_notelist::sum::mm_mitarbeiterliste::1,2}}

Ist kein Item in der Merkliste, wird 0 (Null) ausgegeben.


.. _rst_extended_notelist_additional_events:
Events
------

Soll die Manipulation einer Notelist (add, remove, clear) überwacht werden,
steht dafür ein Eventlistener zur Verfügung.

Mit dem Eventlistener kann z.B. ein Rückmeldung an die Webseite erfolgen oder
ein Logging/Tracking der Aktionen.

Als Beispiel für eine Rückmeldung ein Listener wie folgt erstellt werden:

.. code-block:: php
   :linenos:

   <?php
   // src/EventListener/ManipulateNoteListListener.php
   namespace App\EventListener;
   
   use Contao\Message;
   use MetaModels\NoteListBundle\Event\ManipulateNoteListEvent;
   use Terminal42\ServiceAnnotationBundle\Annotation\ServiceTag;
   
   /**
    * @ServiceTag("kernel.event_listener", event="metamodels.note-list.manipulate")
    */
   class ManipulateNoteListListener
   {
       public function __invoke(ManipulateNoteListEvent $event)
       {
           // Only handle note list "1".
           if ('1' !== ($listId = $event->getNoteList()->getStorageKey())) {
               return;
           }
   
           switch ($event->getOperation()) {
               case ManipulateNoteListEvent::OPERATION_ADD:
                   Message::addConfirmation('Added ' . $event->getItem()->get('id') . ' to ' . $listId);
                   // Add your own notes in metaData.
                   $metaData = $event->getNoteList()->getMetaDataFor($event->getItem());
                   $metaData['tstamp'] = time();
                   $event->getNoteList()->updateMetaDataFor($event->getItem(), $metaData);
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
   }

Auf der Webseite kann in einem Template die Rückmeldung über die Ausgabe der Contao-Message
erfolgen - z. B. mit folgenden Code in einem eigenen Template als ce_html_message.html5

.. code-block:: php
   :linenos:
   
   <?php
   $message = \Message::generateUnwrapped(TL_MODE, true);
   ?>
   <?php if ($message): ?>
   <div class="alert alert-primary" role="alert">
       <p class="mb-0"><?= $message?></p>
   </div>
   <?php endif; ?>

Zudem können über diesen Event auch zusätzliche Informationen abgespeichert werden - siehe bei
`OPERATION_ADD`.


Known Issues and Next Features
------------------------------

* Seite(n) mit Notelist dürfen nicht gecached werden
* Datenübergabe an Formular als HTML (z.Z. nur als Text möglich)
* in Contao ab 4.9 können die Templates mit den Extensions ``.text`` und ``.twig`` nicht mehr im Bereich Templates
  erzeugt werden, da Contao das nicht mehr unterstützt - die Dateien per SSH/SFTP oder Lokal anlegen


Spenden
-------

Ein Dank für die Spenden* für die Erweiterung an:

**Version 2.4:**

* noch keine


**Version 2.0 bis 2.3:**

* `Sebastian Krull <http://www.sebastiankrull.de>`_: 350 €
* `Westwerk GmbH & Co. KG <https://www.westwerk.ac>`_: 350 €
* `Carsten Merz <http://www.fitkurs.de>`_: 350 €
* Next Home Creation: 350 €
* `Niels Hegmanns <http://www.heimseiten.de>`_: 350 €
* `Hofer Werbung <http://www.hofer-werbung.de>`_: 350 €
* `Nationalfonds AT <https://www.nationalfonds.org>`_: 350 €
* `AFM-Werbestudio <https://www.afm-werbestudio.de>`_: 350 €
* `PITSol <https://www.pitsol.de/>`_: 350 €
* `ghost.company <https://www.ghostcompany.com/>`_: 350 €
* Druckhaus S+F: 350 €
* w3scout: 350 €
* `Nationalfonds AT <https://www.nationalfonds.org>`_: 350 €
* `Nationalfonds AT <https://www.nationalfonds.org>`_: 350 €
* `AFM-Werbestudio <https://www.afm-werbestudio.de>`_: 350 €
* `Ulf Spethmann <https://derdigitalist.de>`_: 350 €
* `Sienos <https://www.sineos.de>`_: 350 €


(*Spenden in Netto)


.. |br| raw:: html

   <br />


.. |img_notelist_icon| image:: /_img/screenshots/extended/notelist/notelist_icon.png
.. |img_nodelist_config| image:: /_img/screenshots/extended/notelist/nodelist_config.png
.. |img_notelist_overview| image:: /_img/screenshots/extended/notelist/notelist_overview.png
.. |img_notelist_ce_mm-list| image:: /_img/screenshots/extended/notelist/notelist_ce_mm-list.png
.. |img_notelist_fe_list| image:: /_img/screenshots/extended/notelist/notelist_fe_list.png
.. |img_nodelist_form_fe_list_edit_items| image:: /_img/screenshots/extended/notelist/nodelist_form_fe_list_edit_items.png
.. |img_notelist_filterrule| image:: /_img/screenshots/extended/notelist/notelist_filterrule.png
.. |img_notelist_filtered_list| image:: /_img/screenshots/extended/notelist/notelist_filtered_list.png
.. |img_notelist_fe_list_with_filter| image:: /_img/screenshots/extended/notelist/notelist_fe_list_with_filter.png
.. |img_nodelist_form_widget| image:: /_img/screenshots/extended/notelist/nodelist_form_widget.png
.. |img_nodelist_form_fe_list| image:: /_img/screenshots/extended/notelist/nodelist_form_fe_list.png
.. |img_notelist_email_list| image:: /_img/screenshots/extended/notelist/notelist_email_list.png
.. |img_notelist_fe_list_with_form| image:: /_img/screenshots/extended/notelist/notelist_fe_list_with_form.png
