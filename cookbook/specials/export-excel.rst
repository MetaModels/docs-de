.. _rst_cookbook_specials_export-excel:

Daten in Tabellenkalkulation übernehmen
=======================================

Für Auswertungen wie eine grafische Aufbereitung mit Diagrammen oder verschiedene Berechnungen gibt es unter Umständen
die Anfrage nach einem Export zu einer Tabellenkalkulation wie Excel oder Google-Sheets.

Eine Möglichkeit ist, einen Export der aktuellen Daten in ein entsprechendes Format zu erstellen. Eine einfache
Möglichkeit ist es, die Daten dynamisch abzugreifen. Dazu ist es lediglich notwendig, die Daten als Tabelle auszugeben.

Die entsprechenden Programme können diese Tabelle mit den Daten übernehmen - nicht nur einmal sondern auch je nach
Typ beim Öffnen der Datei oder auch kontinuierlich nach einer vorgegebenen Zeitspanne.

Zur Vorbereitung der Datenübernahme müssen die Daten als Tabelle ausgegeben werden. Dazu kann eine eigene Seite
eingerichtet werden, bei der auf die üblichen Elemente wie Header, Footer usw. verzichtet wird. Über ein entsprechendes
Template werden die Daten als Tabelle ausgegeben - z. B.

.. code-block:: php
   :linenos:

    <?php
    if (count($this->data)): ?>
        <div class="layout_full">
            <table id="export">
                <thead>
                <tr>
                    <?php foreach ($this->data[0]['attributes'] as $attributeName): ?>
                        <th><?= $attributeName ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($this->data as $arrItem): ?>
                    <tr>
                        <?php foreach ($arrItem['attributes'] as $field => $strName): ?>
                            <td><?= $arrItem['text'][$field] ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <?php $this->block('noItem'); ?>
        <p class="info"><?= $this->noItemsMsg ?></p>
        <?php $this->endblock(); ?>
    <?php endif; ?>


Daten in Excel
--------------

Zur Übernahme in Excel kann die :download:`Beispieldatei </_download/download/Movie-Database.zip>` verwendet werden
oder man startet mit einer neuen Datei.

Im Tab "Daten" wählt man als Datenquelle das Web.

|img_excel-export_01|

Im nächsten Schritt wählt man die URL - im Beispiel https://a-movie-database.metamodel.me/de/excel-connect.html.

|img_excel-export_02|

Nach der Verbindungsart "Anonym" und "Verbinden" erscheint ein Wizard, mit dem man die entsprechende Tabelle auswählen
kann.

|img_excel-export_03|

Mit "Laden" werden die Einstellungen abgeschlossen und die Daten sind sichtbar.

|img_excel-export_04|


Daten in Google-Sheet
---------------------

Der Import in Google-Sheet erfolgt über eine Formel - dazu in Zelle A1 folgende Formel eintragen

``=importhtml("https://a-movie-database.metamodel.me/de/excel-connect.html"; "table"; 1)``

Der erste Parameter ist die URL, der zweite der Typ und er dritte die Tabellennummer (beginnend mit 1). Nach der Eingabe
der Formel werden die Daten eingeladen.

|img_google-sheet_01|


.. |img_excel-export_01| image:: /_img/screenshots/specials/excel-export_01.jpg
.. |img_excel-export_02| image:: /_img/screenshots/specials/excel-export_02.jpg
.. |img_excel-export_03| image:: /_img/screenshots/specials/excel-export_03.jpg
.. |img_excel-export_04| image:: /_img/screenshots/specials/excel-export_04.jpg
.. |img_google-sheet_01| image:: /_img/screenshots/specials/google-sheet_01.jpg
