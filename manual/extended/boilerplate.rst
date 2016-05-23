.. _rst_extended_boilerplate:

MetaModels "Boilerplate"
========================

Mit der Erweiterung "Boilerplate" wird ein Contao-Modul für die
Arbeit mit MetaModels installiert, die verschiedene Vorlagen
für die individuelle Anpassung von MetaModels beinhaltet.

In den Boilerplate-Dateien sind die meisten Anpassungen
auskommentiert und müssen je nach Wunsch "ent-kommentiert" 
sowie an die vorhandenen MetaModel angepasst werden. Als
Vorlagen sind die folgenden Punkte vorbereitet:

* eigener Navigationspunkt für das Backend (aktiv)
* Vorlage für eienen Contao-Hook (inaktiv)
* Vorlage für einen (MM/DCG) Event (inaktiv)
* Vorlage für Standardvorgaben der Eingabemaske (inaktiv)


Einbau der Erweiterung "Boilerplate"
------------------------------------

Eine Installation über die Erweiterungsverwaltung bzw. die
Paketverwaltung (Composer) ist nicht möglich, da bei einem Update
die eigenen Anpassungen und Einstellungen überschrieben werden
würden. Aus diesem Grund, muss die Erweiterung "manuell" per
FTP auf den Server übertragen werden.

Die Erweiterung ist auf Github unter `MetaModels/boilerplate/ <https://github.com/MetaModels/boilerplate/>`_
zu finden - siehe Button "Clone or download". Die Erweiterung
sollte man lokal speichern und nach den Anpassungen auf den Server
übertragen. Der Ordner "metamodelsboilerplate" muss dazu in den Ordner
"/system/modules/" kopiert werden.

.. warning:: Boilerplate noch in der Umstellung! |br|
   Aktuell bitte die Dateien des "`PullRequest #3 <https://github.com/MetaModels/boilerplate/pull/3>`_"
   einsetzen.

Die möglichen Anpassungen sind in den folgenden Abschnitten
beschrieben.


Eigener Navigationspunkt für das Backend
----------------------------------------

Als grundlegende Funktion des Moduls ist die Implementierung
eines eigenen Navigationspunkts aktiviert. Ist die Erweiterung
auf dem Server eingespielt, steht unter den Einstellungen der
Eingabemaske für den Integrationstyp "Unabhängig" ein neuer
Backendbereich zur Verfügung (siehe Screenshot).

|img_backend-integration|

Ist das erste MetaModel dem Backendbereich zugewiesen - und
erst dann - erscheint in der linken Navigation die neue
Navigationsgruppe.

Die Bezeichnung der Navigationsgruppe wird in den Sprachdateien
im Ordner "/laguages/de" bzw. "/languages/en" in der Datei "modules.php"
angepasst. Für einen Wechsel der Bezeichnung zu "Mitarbeiterliste"
ist der folgende Eintrag abzuändern:

.. code-block:: php
   :linenos:
   
   <?php
   /**
    * eigene Bezeichnung einer Navigationsgruppe im Backend
    */
   $GLOBALS['TL_LANG']['MOD']['metamodelsboilerplate'] = 'Mitarbeiter';

Die Position der neuen Navigationsgruppe wird in der Datei "config.php" im 
Ornder "/config" bestimmt. Mit dem folgenden Code

.. code-block:: php
   :linenos:
   
   <?php
   /**
    * NAVIGATION
    *
    * Add own navigation group at backend
    * include before e.g. "Design" 
    */
   $i = array_search('design', array_keys($GLOBALS['BE_MOD']));
   $GLOBALS['BE_MOD'] = array_merge(array_slice(
       $GLOBALS['BE_MOD'], 0, $i), 
       array('metamodelsboilerplate' => array()
       ), 
       array_slice($GLOBALS['BE_MOD'], $i)
   );

wird die Navigationsgruppe vor "design" (Bezeichnung "Layout") eingebunden.
Die Backend-Navigation könnte anschließend wie folgt aussehen:

|img_backend-navigation|

Bei der Backend-Integration kann dem MetaModel auch ein eigenes Icon
zugewiesen werden, sofern sich die Icon-Datei unter "/files/..." befindet.
Eine umfangreiches Icon-Set ist z.B. `"Fugue Icons" <http://p.yusukekamiyamane.com/>`_.


Vorlage für einen Contao-Hook
------------------------------

Eine Vorlage für einen Contao Hook ist im Ordner "/classes" mit der Datei "MyMetaModelClass.php"
zu finden.

Informationen über Contao Hooks: siehe `Contao-Handbuch <https://docs.contao.org/books/manual/3.4/de/07-contao-anpassen/contao-hooks.html>`_

Ein Beispiel im Zusammenspiel mit MetaModels: siehe :ref:`rst_cookbook_panels_regex`


Vorlage für einen (MM/DCG) Event
--------------------------------

Eine Vorlage für einen Contao Hook ist im Ordner "/config" mit der Datei "event_listeners.php"
zu finden.

Einen Einstieg für die Arbeit mit Events ist z.B. `"Event-Dispatcher" <https://github.com/contao-community-alliance/event-dispatcher>`_.


Vorlage für Standardvorgaben der Eingabemaske
---------------------------------------------

Eine Vorlage für Standardvorgaben der Eingabemaske ist im Ordner "/config" mit der Datei "config.php"
zu finden.

Mehr Informationen unter :ref:`rst_cookbook_panels_default-values`



.. |img_backend-integration| image:: /_img/screenshots/extended/boilerplate/backend-integration.png
.. |img_backend-navigation| image:: /_img/screenshots/extended/boilerplate/backend-navigation.png

.. |br| raw:: html

   <br />