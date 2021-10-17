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
mit dem Key "default" erreicht werden - `siehe Contao-Handbuch <https://docs.contao.org/dev/reference/dca/fields/>`.

Für einen Eintrag einer Vorgabe muss der (interne) Name des MetaModel
und der Spaltenname des Attributes bekannt sein. Diese Angaben können
in einem Arrayeintrag mit der allgemeinen Form

.. code-block:: php
   :linenos:
   
   <?php
   // contao/dca/<MM-Table-Name>.php
   $GLOBALS['TL_DCA']['<MM-Table-Name>']['fields']['<Field-Column-Name>']['default'] = <Value>;

ergänzt werden.

Für ein das E-Mail-Feld ([text]) aus :ref:`mm_first_index` könnte die Vorgabe wie folgt aussehen:

.. code-block:: php
   :linenos:
   
   <?php
   // contao/dca/mm_mitarbeiterliste.php
   $GLOBALS['TL_DCA']['mm_mitarbeiterliste']['fields']['email']['default'] = '@mmtest.com';

Für die einzelnen Attributarten gibt es spezifische Vorgaben, in welcher Form die Werte
erwartet werden:

* **Text**: Text in Hochkomma z.B. '@mmtest.com' |br|
  ``...['default'] = '@mmtest.com';``
* **Timestamp**: Integer für den Timestamp z.B. 1463657005 oder PHP-Funktion time() |br|
  ``...['default'] = 1463657005;`` oder |br|
  ``...['default'] = time();``
* **Auswahl**: Integer der ID des Wertes in Hochkomma |br|
  ``...['default'] = '2';``
* **Mehfachauswahl**: Array mit den Alias-Werten aus der eingestellten Alias-Spalte |br|
  ``...['default'] = ['einkauf', 'marketing'];``
* **Kontrollkästchen (Checkbox)**: true |br|
  ``...['default'] = true;``

Wie man an dem Attribut "Timestamp" sieht, sind auch dynamische Vorgaben umsetzbar. So wäre
es auch möglich, auf vorhandene Werte aus MetaModels zurück zu greifen und diese - ggf.
mit einer Berechnung - als Standard auszugeben. Für einen Zugriff auf MetaModels stehen die
Methoden der API (:ref:`ref_api_interf_mm`) zur Verfügung.


.. |br| raw:: html

   <br />
