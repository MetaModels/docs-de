.. _mm_first_contentelements:

Inhaltselemente/Module für die Frontendausgabe
==============================================

Nachdem alle Komponenten für die Dateneingabe konfiguriert sind,
kann die Datenausgabe bearbeitet werden. Für die Datenausgabe
stehen verschiedene Möglichkeiten zur Verfügung - in dem
Beispiel soll die Ausgabe über das Artikel-Inhaltselement
"MetaModel-Liste" erfolgen.

Als Vorbereitung für die Ausgabe muss eine entsprechende Seite
in Contao angelegt sein mit einem Artikel, der das Inhaltelement
aufnimmt. Ein neues Inhaltselement wird angelegt und folgende
Einstellungen aktiviert (siehe Screenshot):

* Elementtyp: MetaModel-Liste
* Sortieren nach: Name
* Anzuwendende  Filtereinstellungen: Veröffentlicht
* Anzuwendende Renderingeinstellungen: FE Liste

|img_contentelements_01|

Nach "Speichern und schließen" steht das Inhaltselement zur Verfügung
und die Anzeige kann im Frontend geprüft werden.

Die Anzeige sollte nun den Satz "Ihre Suche lieferte keine passenden
Ergebnisse." hervorbringen, da noch keine Daten eingeben wurden.

Für den Test der Anzeige ist es notwendig, einige Datensätze in der Telefonliste
anzulegen. Dazu klickt man in der linken Navigation des Backends unter "MetaModels"
auf das Icon "|img_metamodels| Telefonliste" und anschließend auf das Icon
"|img_new| Neuer Datensatz".

Es öffnet sich die Eingabemaske mit den vorgegebenen Feldern (Attributen), welche
mit den ersten Daten gefüllt werden kann (siehe Screenshot).

|img_contentelements_02|

Nach "Speichern und schließen" ist der Datensatz mit den aktivierten Attributen
der Renderingeinstellung "BE Liste" (Name und Vorname) zu sehen (siehe Screenshot).

|img_contentelements_03|

Der Datensatz kann über das Stift-Icon wieder bearbeitet werden und über das "Auge"
wird der Status "Veröffentlicht" gewechselt (alternativ zur Checkbox der Eingabemaske).

Die Ausgabe im Frontend sollte nun etwa wie folgt aussehen (Screenshot).

|img_contentelements_04|

Spielt man einige Testdaten in die Datenbank - oder gibt diese manuell ein - sieht die
Telefonliste im Backend in etwa so wie in dem Screenshot aus

|img_contentelements_05|

und wie folgt im Frontend

|img_contentelements_06|

Für die Ausgabe im Frontend werden die Attribute über das Standard-Template in einzelne
HTML-DIV-Container inklusive spezifischer CSS-Klassen ausgegeben. Eine Formatierung kann
entweder über ein CSS erfolgen oder über eine Anpassung des Templates, so dass hier die
Ausgabe als HTML-Tabelle erfolgt.

Mit einige CSS-Angaben wie z.B. die folgenden

.. code-block:: html
   :linenos:
	
	.ce_metamodel_content .item {
	    display: table;
	    width: 100%;
	}
	.ce_metamodel_content .item.even {
	    background-color: #f4f2f0;
	    border-bottom: 1px solid #d4cbc5;
	    border-collapse: collapse;
	}
	.ce_metamodel_content .item.odd {
	    background-color: #f6f6f6;
	    border-bottom: 1px solid #d4cbc5;
	    border-collapse: collapse;
	}
	.ce_metamodel_content .item .field {
	    display: table-cell;
	}
	.ce_metamodel_content .item .field.name {
	    width: 20%;
	}
	.ce_metamodel_content .item .field.vorname {
	    width: 20%;
	}
	.ce_metamodel_content .item .field.email {
	    width: 40%;
	}
	.ce_metamodel_content .item .field.abteilung {
	    width: 20%;
	}

sieht die Ausgabe schon besser aus - siehe Screenshot

|img_contentelements_07|

.. |img_new| image:: /_img/icons/new.gif
.. |img_metamodels| image:: /_img/icons/metamodels.png

.. |img_contentelements_01| image:: /_img/screenshots/metamodel_first/contentelements_01.png
.. |img_contentelements_02| image:: /_img/screenshots/metamodel_first/contentelements_02.png
.. |img_contentelements_03| image:: /_img/screenshots/metamodel_first/contentelements_03.png
.. |img_contentelements_04| image:: /_img/screenshots/metamodel_first/contentelements_04.png
.. |img_contentelements_05| image:: /_img/screenshots/metamodel_first/contentelements_05.png
.. |img_contentelements_06| image:: /_img/screenshots/metamodel_first/contentelements_06.png
.. |img_contentelements_07| image:: /_img/screenshots/metamodel_first/contentelements_07.png