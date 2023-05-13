.. _rst_cookbook_specials_export-excel:

Daten in Tabellenkalkulation übernehmen
=======================================

Für Auswertungen wie eine grafische Aufbereitung mit Diagrammen oder verschiedene Berechnungen gibt es unter Umständen
die Anfrage nach einem Export zu einer Tabellenkalkulation wie MS Excel, OpenOffice Calc oder Google-Sheets.

Eine Möglichkeit ist, einen Export der aktuellen Daten in einem entsprechenden Format (XLSX, ODS, XLS) zu erstellen.
Eine andere und einfache Möglichkeit ist es, die Daten dynamisch abzugreifen. Dazu ist es lediglich notwendig, die
Daten als Tabelle auszugeben und somit für einen Import bereit zu stellen.

Die entsprechenden Programme können diese Tabelle mit den Daten übernehmen - nicht nur einmal sondern auch je nach
Typ beim Öffnen der Datei oder auch kontinuierlich nach einer vorgegebenen Zeitspanne.

Zur Vorbereitung der Datenübernahme müssen die Daten als Tabelle ausgegeben werden. Dazu kann eine eigene Seite
eingerichtet werden, bei der auf die überflüssige Elemente wie Header, Footer usw. verzichtet wird. Über ein
entsprechendes Template werden die Daten als Tabelle ausgegeben - z. B.

.. code-block:: php
   :linenos:

    <?php
    // templates/metamodel_pre_movies_table.html5
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

In den Einstellungen des CE/FE-Moduls MM-Liste sollte keine Paginierung eingerichtet werden. Bei vielen Datensätzen
kann die Laufzeit der Tabellenausgabe mit setzten der Checkbox "Keine geparsten Items über "$data" ausgeben"
beschleunigt werden oder mit  Setzen eines Index in der MM-Tabelle - mehr dazu unter :ref:`rst_cookbook_tips_speedup_backend`


Daten in Excel
--------------

Zur Übernahme in Excel kann die :download:`Beispieldatei </_download/Movie-Database.xlsx.zip>` verwendet werden
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


Daten in Calc
--------------

Zur Übernahme in Calc kann die :download:`Beispieldatei </_download/Movie-Database.ods.zip>` verwendet werden
oder man startet mit einem neuen Tabellendokument.

Unter "Einfügen" erstellt man eine "Verknüpfung zu externen Daten".

|img_oo-export_01|

Im nächsten Schritt wird die URL eingegeben - sofern sich nach der Eingabe keine Anzeige im Feld
"Verfügbare Tabellen/Bereiche" ergibt, auf den Button "..." klicken und die URL bei "Dateiname" einfügen sowie "Öffnen"
klicken. Anschließend die Tabelle "HTML_export" (Tabellen-ID "export") auswählen und Button "OK" klicken.

|img_oo-export_02|

Anschließend stehen die Daten in dem Tabellenblatt zur verfügung.

|img_oo-export_03|


Daten in Google-Sheet
---------------------

Der Import in Google-Sheet erfolgt über eine Formel - dazu in Zelle A1 folgende Formel eintragen

``=importhtml("https://a-movie-database.metamodel.me/de/excel-connect.html"; "table"; 1)``

Der erste Parameter ist die URL, der zweite der Typ und er dritte die Tabellennummer (beginnend mit 1). Nach der Eingabe
der Formel werden die Daten eingeladen.

|img_google-sheet_01|


.. |img_excel-export_01| image:: /_img/screenshots/cookbook/specials/excel-export_01.jpg
.. |img_excel-export_02| image:: /_img/screenshots/cookbook/specials/excel-export_02.jpg
.. |img_excel-export_03| image:: /_img/screenshots/cookbook/specials/excel-export_03.jpg
.. |img_excel-export_04| image:: /_img/screenshots/cookbook/specials/excel-export_04.jpg
.. |img_oo-export_01| image:: /_img/screenshots/cookbook/specials/oo-export_01.jpg
.. |img_oo-export_02| image:: /_img/screenshots/cookbook/specials/oo-export_02.jpg
.. |img_oo-export_03| image:: /_img/screenshots/cookbook/specials/oo-export_03.jpg
.. |img_google-sheet_01| image:: /_img/screenshots/cookbook/specials/google-sheet_01.jpg
