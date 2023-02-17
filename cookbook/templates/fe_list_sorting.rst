.. _rst_cookbook_templates_fe_list_sorting:

Links für die Umschaltung der Sortierung einer MM-Liste
=======================================================

.. note:: Das Feature steht ab MM 2.2 zur Verfügung.

In den Einstellungen der Listenausgabe (CE/FE-Modul) gibt es die Option, dass die Standardsortierung überschrieben
werden kann ("Überschreiben der Sortierung erlauben"). Aktiviert man die Option, können verschiedene Parameter gesetzt
werden:

* Slug/Get-Key zum Überschreiben von ``orderBy`` als Key für das zu sortierende Attribut
* Slug/Get-Key zum Überschreiben von ``orderDir`` als Key für die Sortierrichtung
* URL-Fragment wenn mit dem Link zu einer bestimmten Anker-Stelle auf der Seite gesprungen werden soll

|img_sorting_options|

Die gewünschten Links für die individuelle Sortierung können im MM-Listen-Template oder auch an anderer Stelle
eingebracht werden.

.. note:: Das Feature steht ab MM 2.3 zur Verfügung.

Um die Verwendung im MM-Listen-Template zu vereinfachen ist es möglich, für jedes Attribut verschiedene Links
für die Umsortierung zu generieren. Es gibt einen "Toggle-Link" der jeweils in die andere Sortierrichtung
umschaltet sowie jeweils für Ab- und Aufsteigend einen Link - entsprechende CSS-Klassen und ein Aktiv-Parameter
wird auch übergeben. Man kann sich den kompletten Link inkl. CSS-Klassen direkt auch generieren lassen.

Folgendes Snippet als Beispiel für die Aufrufe:

.. code-block:: php
   :linenos:

   <?php
   <?php $sortingLinkToggle = $this->generateSortingLink('name', 'toggle');?>
   <a href="<?= $sortingLinkToggle['href'] ?>" class="<?= $sortingLinkToggle['class'] ?>"><?= $sortingLinkToggle['label'] ?> (toggle)</a><br>
   <?php $sortingLinkAsc = $this->generateSortingLink('name', 'asc'); ?>
   <a href="<?= $sortingLinkAsc['href'] ?>" class="<?= $sortingLinkToggle['class'] ?>"><?= $sortingLinkAsc['label'] ?> (asc)</a><br>
   <?php $sortingLinkDesc = $this->generateSortingLink('name', 'desc'); ?>
   <a href="<?= $sortingLinkDesc['href'] ?>" class="<?= $sortingLinkToggle['class'] ?>"><?= $sortingLinkDesc['label'] ?> (desc)</a><br>
   <?= $this->renderSortingLink('name', 'toggle') ?> (toggle)<br>
   <?= $this->renderSortingLink('name', 'asc') ?> (asc)<br>
   <?= $this->renderSortingLink('name', 'desc') ?> (desc)<br>

Bitte beachten, dass bei dem Link mit den Einstellungen der Standardsortierung die Slug/Get-Parameter entfernt werden -
lediglich das URL-Fragment bleibt bestehen.

Der Aufruf von ``generateSortingLink`` mit den Parametern "Spaltenname" des Attributs und Sortierungstyp liefert die
folgenden Werte zurück:

* "attribute": Attribut
* "name": Name des Attributs
* "href": Link zum Sortieren
* "direction": Aktuelle Sortierrichtung
* "active": aktuelles Attribut der Sortierung
* "class": CSS-Klasse
* "label": Label


.. |img_sorting_options| image:: /_img/screenshots/cookbook/templates/sorting_options.jpg



