.. _rst_cookbook_filter_custom-sql:

Eigenes SQL
===========

Die ersten Hinweise für die Möglichkeiten der Filterregel
"Eigenes SQL" sind über die |img_about| Hilfe zu finden.

Nochmal der Hinweis: Auch mit der Filterregel "Eigenes SQL"
werden nur IDs zur nächsten Filterregel bzw. zum Filterset
weiter gereicht. Es können keine "Attributwerte" hinzugefügt
werden, auch wenn das per SQL z.B. durch JOINs möglich wäre.

Folgend einige SQL-Queries als "Zutat" für das eigene "SQL-Menü":


"LIKE"-Abfrage mit Defaultwert
******************************

"Suche Items für die Attribut 'name' wenn GET-Parameter 'name' 
gesetzt ist oder gebe alle Items aus (keine Filterung)."

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM {{table}} 
   WHERE name LIKE (CONCAT('%',{{param::get?name=name&default=%%}},'%')) 


Filterung nach Datum
********************

"Suche Items für die Attribut 'date_start' größer oder gleich dem 
heutigen Datum ist - also in der Zukunft liegt"

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM {{table}} 
   WHERE FROM_UNIXTIME(`date_start`) >= CURDATE()

oder

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM {{table}} 
   WHERE DATE(FROM_UNIXTIME(`date_start`)) >= DATE(now())


Filterung nach Datum (start oder "laufend")
*******************************************

"Suche Items für die Attribut 'date_start' größer oder gleich dem 
heutigen Datum ist - also in der Zukunft liegt - oder die Items bei
denen das aktuelle Datum zwischen 'date_start' und 'date_end' liegt
(laufend)"

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM {{table}}
   WHERE
   ( DATE(FROM_UNIXTIME(`date_start`)) >= DATE(NOW()) )
   OR
   ( DATE(FROM_UNIXTIME(`date_start`)) <= DATE(NOW())
     AND 
     DATE(FROM_UNIXTIME(`date_startend`)) >= DATE(NOW())
   )


Filterung nach Datum (start/stop)
*********************************

"Suche Items für die das Attribut 'start' größer dem aktuellen 
Unix-Zeitstempel ist und das Attribut 'stop' noch nicht erreicht ist. 
Leere Attributwerte werden als nicht relevant umgesetzt (dann nur 
'start' bzw. 'stop' relevant)." [von "Cyberlussi"]

.. code-block:: php
   :linenos:
   
   SELECT id
   FROM {{table}}
   WHERE (
     {{table}}.start IS NULL OR {{table}}.start = ''
     OR
     {{table}}.start<UNIX_TIMESTAMP())
     AND ({{table}}.stop IS NULL
     OR 
     {{table}}.stop=''
     OR {{table}}.stop > UNIX_TIMESTAMP()
   )


Filterung nach Kind-Elementen eines Eltern-Elements
***************************************************

"Suche alle Kind-Elemente für ein gegebens Eltern-Element über den Alias-Parameter
- z.B. um auf einer Detailseite alle zugehörigen 'Kind-Elemente' auszugeben."

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM mm_child
   WHERE pid = (
     SELECT id 
     FROM mm_parent
     WHERE
     parent_alias={{param::get?name=auto_item}}
   )  

Filterung nach Eltern-Element eines Kind-Elements
*************************************************

"Suche das Eltern-Element für ein gegebens Kind-Element über den Alias-Parameter
- z.B. um auf einer Detailseite das zugehörige 'Eltern-Element' auszugeben."

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM mm_parent
   WHERE id = (
     SELECT pid 
     FROM mm_child
     WHERE
     child_alias={{param::get?name=auto_item}}
   )  

oder kürzer

.. code-block:: php
   :linenos:
   
   SELECT pid as id
   FROM mm_child
   WHERE child_alias={{param::get?name=auto_item}}


Sortierung der Ausgabe nach mehr als einem Attribut (fest)
**********************************************************

"Sortiere 'Mannschaften' nach Punkte absteigend + Spiele aufsteigend +
Priorität absteigend."
siehe auch `Forum <https://community.contao.org/de/showthread.php?62625-Zweite-Sortierung>`_

.. code-block:: php
   :linenos:
   
   SELECT id 
   FROM mm_mannschaft
   ORDER BY punkte DESC, spiele ASC, prio DESC

Dynamischer Defaultwert
***********************

Bei dem eigenen SQL sind Defaultwerte per 'default=<wert>' möglich,
die verwendet werden, wenn der Filterparameter nicht gesetzt ist. Im Param-Tag
ist aktuell noch keine Verschachtelung von Insert-Tags oder der Einsatz von
MySQL-Funktionen möglich, so dass man bei dynamischen Defaultwerten auf
einen Workaround per "SQL-IF" zurückgreifen muss.
siehe auch `Github #880 <https://github.com/MetaModels/core/issues/880>`_

.. code-block:: php
   :linenos:
   
   SELECT id FROM mm_monate 
   WHERE FROM_UNIXTIME(von_datum) <= IF(
      {{param::get?name=von_datum}},
      {{param::get?name=von_datum}}, 
      CURDATE()
   ) 
   ORDER BY von_datum DESC

Defaultwert ''
**************

Bei dem eigenen SQL sind Defaultwerte per 'default=<wert>' möglich,
die verwendet werden, wenn der Filterparameter nicht gesetzt ist. Im Param-Tag
ist aktuell wird akltuell die Eingabe von `''` oder `""` gecastet, so dass die
Filterung nicht korrekt erfolgt; anzuwenden ist dies z.B. bei Checkboxwerten.

.. code-block:: php
   :linenos:
   
   SELECT id FROM mm_mitarbeiter 
   WHERE driver_licence = IF(
      {{param::get?name=driver_licence}},
      {{param::get?name=driver_licence}}, 
      ''
   )

Tags für ein Item filtern
*************************

Die Mitarbeiter haben eine Mehrfachauswahl [tags] zum MetaModels "Softskills".
Für die Detailansicht eines Mitarbeiters, sollen diese ermittelt werden - die
Detailansicht wird über das "auto_item" per Alias gefiltert.

Die Softskills werden als eigene Liste auf der Detailseite angezeigt, müssen aber
entsprechend gefiltert werden. Für die Ermittlung der Daten, muss man über die
Relationstabelle "tl_metamodel_tag_relation" gehen. Wichtig ist die Ermittlung
der Attribut-ID für "rel.att_id", d.h. in den Attributen von "Mitarbeitern"
hat die Mehrfachauswahl z.B. die ID 5 (zu ermitteln über den i-Button).

.. code-block:: php
   :linenos:
   
   SELECT DISTINCT(rel.value_id) as id FROM mm_mitarbeiter ma
   LEFT JOIN tl_metamodel_tag_relation rel ON (ma.id = rel.item_id AND rel.att_id=5)
   WHERE
   ma.alias = {{param::get?name=auto_item}}

Items nach Einfachauswahl-Eigenschaft filtern
*********************************************

Die Mitarbeiter haben eine Einfachauswahl zum MetaModels "Abteilung".
Für eine Listnsicht der Mitarbeiter, sollen nur diejenigen ausgegeben
werden, die in einer Abteilung arbeiten deren "Score" größer als 99 ist.


.. code-block:: php
   :linenos:
   
   SELECT id FROM mm_mitarbeiter
   WHERE abteilung IN (
      SELECT id FROM mm_abteilung
      WHERE score > 99
   )

oder

.. code-block:: php
   :linenos:
   
   SELECT ma.id FROM mm_mitarbeiter ma
   LEFT JOIN mm_abteilung rel ON (ma.abteilung = rel.id)
   WHERE rel.score > 99


.. |img_about| image:: /_img/icons/about.png

