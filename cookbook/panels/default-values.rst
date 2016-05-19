.. _rst_cookbook_panels_default-values:

Eingabemaske: automatische Wertevorgaben
========================================

Die Eingabefelder der Eingabemasken können mit Standardwerten
automatisch vorbelegt werden. Damit kann das Ausfüllen der
Eingabemasken erleichtert werden, wenn ein Datensatz neu
angelegt wird.

Die Eingabefelder von MetaModels sind (fast) identisch den
Feldern vom Contao-Core oder den üblichen Erweiterungen zu
behandeln, die mit einem DCA-Array erstellt wurden. Unterschiede
ergeben sich teilweise durch die dynamische Generierung der Felder
in MetaModels durch den DC-General.

Die Vorgaben für die Felder können durch die Ergänzung des DC-Array
mit dem Key "default" erreicht werden. Ergänzt kann das Array entweder
durch eine Eingabe in der Datei "dcaconfig.php" in dem Ordner
"/system/config/" oder wenn es einen eigenen Modulorder gibt, in der
Datei "config.php". 

In dem Modul `"Metamodels-Boilerplate" <https://github.com/MetaModels/boilerplate>`_
sind entsprechende Eingaben in der Datei "config.php" schon vorbereitet.

Für einen Eintrag einer Vorgabe muss der (interne) Name des MetaModel
und der Spaltenname des Attributes bekannt sein. Diese Angaben können
in einem Arrayeintrag mit der allgemeinen Form

.. code-block:: php
   :linenos:
   
   <?php
   $GLOBALS['TL_DCA']['<MM-Table-Name>']['fields']['<Field-Column-Name>']['default'] = <Value>;

ergänzt werden.

Für ein das E-Mail-Feld ([text]) aus :ref:`mm_first_index` könnte die Vorgabe wie folgt aussehen:

.. code-block:: php
   :linenos:
   
   <?php
   $GLOBALS['TL_DCA']['mm_mitarbeiterliste']['fields']['email']['default'] = '@mmtest.com';

Für die einzelnen Attributarten gibt es spezifische Vorgaben, in welcher Form die Werte
erwartet werden:

* Text: Text in Hochkomma z.B. '@mmtest.com'
  ...['default'] = '@mmtest.com';
* Timestamp: Integer für den Timestamp z.B. 1463657005 oder PHP-Funktion time()
  ...['default'] = 1463657005;
  ...['default'] = time();
* Auswahl: Integer der ID des Wertes in Hochkomma
  ...['default'] = '2';
* Mehfachauswahl: Array mit den Alias-Werten aus der eingestellten Alias-Spalte
  ...['default'] = array('einkauf', 'marketing');
* Kontrollkästchen (Checkbox): true
  ...['default'] = true;



