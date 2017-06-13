.. _rst_cookbook_frontend_output-item-count:

Ausgabe der Anzahl der Items
============================

Möchte man die Anzahl der Items im FE-Template ausgeben, stehen
zwei Variablen zur Verfügung:

* `count($this->data)` - gibt die aktuelle Anzahl der Items wieder,
  die im Template ausgegeben werden, d.h. es werden nur die Items gezählt,
  die aktuell ausgegeben werden; ist eine Paginierung eingestellt,
  wird ggf. maximal die Paginierungsgröße ausgegeben
* `$this->total` - gibt die gesamte Anzahl der Items wieder, die im Template
  ausgegeben werden; eine Paginierung hat auf die Ausgabe keinen Einfluss

Das jeweilige Template kann z.B. mit den folgenden Ausgaben ergänzt werden:

.. code-block:: php
   :linenos:

    <?php if (count($this->data)): ?>
    
    <div class="layout_full">
        <div class="count_data">Anzahl data: <?= count($this->data) ?></div>
        <div class="count_total">Anzahl total: <?= $this->total ?></div>
        <?php foreach ($this->data as $arrItem): ?>
        <div class="item <?= $arrItem['class'] ?>">
    //....



