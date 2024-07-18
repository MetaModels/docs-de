.. _rst_cookbook_filter_custom-sql:

Eigenes SQL
===========

Die ersten Hinweise für die Möglichkeiten der Filterregel
"Eigenes SQL" sind über die |img_about| Hilfe zu finden.

Nochmal der Hinweis: Auch mit der Filterregel "Eigenes SQL"
werden nur IDs zur nächsten Filterregel bzw. zum Filterset
weiter gereicht. Es können keine "Attributwerte" hinzugefügt
oder berechnet werden, auch wenn das per SQL z.B. durch JOINs
oder mathematische Anweisungen möglich wäre.

Spaltennamen sollten immer in Backticks ` wie z.B. \`name\`
gesetzt oder mit dem Tabellennamen bzw. dessen Alias versehen werden (siehe `MySQL Identifier <https://dev.mysql.com/doc/refman/8.0/en/identifiers.html>`_).
Damit ist die Verwendung auch von in (My)SQL `reservierten Wörter <https://dev.mysql.com/doc/refman/8.0/en/keywords.html>`_
möglich.

Bei komplexeren Queries ist es ratsam, diese vor dem Einbau mit 
entsprechenden SQL-Tools wie phpMyAdmin, PHPStorm o. ä. zu testen
bzw. bei Verschachtelungen Stück für Stück aufzubauen und vorab mit
festen Werten zu arbeiten. Die entsprechenden Daten sollten dann natürlich
auch als Items in der DB vorhanden sein. Als letzten Schritt fügt man
ggf. notwendige dynamische Parameter mit den zur Verfügung stehenden
Inserttags hinzu. Die MM-SQL-Inserttags werden nur innerhalb der Verarbeitung
des Query aufgelöst und stehen daher auch nicht allgemein im FE zur
Verfügung.

Folgend einige SQL-Queries als "Zutat" für das eigene "SQL-Menü":


"LIKE"-Abfrage mit Defaultwert
******************************

"Suche Items für die Attribut 'name' wenn GET-Parameter 'name' 
gesetzt ist oder gebe alle Items aus (keine Filterung)."

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM {{table}} 
   WHERE `name` LIKE (CONCAT('%',{{param::get?name=name&default=%%}},'%')) 


Filterung nach Datum
********************

"Suche Items für die Attribut 'date_start' größer oder gleich dem 
heutigen Datum ist - also in der Zukunft liegt"

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM {{table}} 
   WHERE FROM_UNIXTIME(`date_start`) >= CURDATE()

oder

.. code-block:: php
   :linenos:
   
   SELECT `id` 
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
   
   SELECT `id` 
   FROM {{table}}
   WHERE
   ( DATE(FROM_UNIXTIME(`date_start`)) >= DATE(NOW()) )
   OR
   ( DATE(FROM_UNIXTIME(`date_start`)) <= DATE(NOW())
     AND 
     DATE(FROM_UNIXTIME(`date_end`)) >= DATE(NOW())
   )


Filterung nach Datum (start/stop)
*********************************

"Suche Items für die das Attribut 'start' größer dem aktuellen 
Unix-Zeitstempel ist und das Attribut 'stop' noch nicht erreicht ist. 
Leere Attributwerte werden als nicht relevant umgesetzt (dann nur 
'start' bzw. 'stop' relevant)." [von "Cyberlussi"]

.. code-block:: php
   :linenos:
   
   SELECT `id`
   FROM {{table}}
   WHERE (`date_start` IS NULL OR `date_start` = '' OR `date_start` < UNIX_TIMESTAMP())
   AND (`date_stop` IS NULL OR `date_stop` = '' OR `date_stop` > UNIX_TIMESTAMP())

Alternativ

.. code-block:: php
   :linenos:
   
   SELECT `id` FROM {{table}}
   WHERE (`date_start` IS NULL OR DATE(FROM_UNIXTIME(`date_start`)) <= DATE(now()))
   AND (`date_stop` IS NULL OR DATE(FROM_UNIXTIME(`date_stop`)) >= DATE(now()))


Filterung nach Datum (start) und Veröffentlichungsdatum mit Prüfung per GET
***************************************************************************

Zum Beispiel für Events, die nach Erreichen des Startdatums ausgeblendet werden sollen
aber erst ab einem bestimmten Datum angezeigt werden dürfen - sofern gesetzt.

Zur Prüfung kann im FE an die URL ein GET-Parameter angehangen werden - Datumsformat ist
"YYYY-MM-DD" z. B. "domain.tld/meine-liste.html?now=2023-07-10".

.. code-block:: php
   :linenos:
   
   SELECT id FROM {{table}}
   WHERE DATE(FROM_UNIXTIME(`date_start`)) >= DATE(now())
   AND (`date_published` IS NULL
   	OR DATE(FROM_UNIXTIME(`date_published`)) <= DATE(now())
   	OR DATE(FROM_UNIXTIME(`date_published`)) <= {{param::get?name=now}}
   )

Filterung nach Datum (start) letzen 12 Monate
*********************************************
Archivfilter für vergangene Items der letzten 12 Monate:

.. code-block:: php
   :linenos:
   
   SELECT id FROM {{table}}
   WHERE DATE(FROM_UNIXTIME(`date_start`)) < DATE(now())
   AND DATE(FROM_UNIXTIME(`date_start`)) >= DATE(now() - INTERVAL 12 month)

Filterung nach Kind-Elementen eines Eltern-Elements
***************************************************

"Suche alle Kind-Elemente für ein gegebens Eltern-Element über den Alias-Parameter
- z.B. um auf einer Detailseite alle zugehörigen 'Kind-Elemente' auszugeben."

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM mm_child
   WHERE `pid` = (
     SELECT `id` 
     FROM mm_parent
     WHERE
     `parent_alias` = {{param::get?name=auto_item}}
     LIMIT 1
   )  


Filterung nach Eltern-Element eines Kind-Elements
*************************************************

"Suche das Eltern-Element für ein gegebens Kind-Element über den Alias-Parameter
- z.B. um auf einer Detailseite das zugehörige 'Eltern-Element' auszugeben."

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM mm_parent
   WHERE `id` = (
     SELECT `pid` 
     FROM mm_child
     WHERE
     `child_alias` = {{param::get?name=auto_item}}
     LIMIT 1
   )  

oder kürzer

.. code-block:: php
   :linenos:
   
   SELECT `pid` as id
   FROM mm_child
   WHERE `child_alias` = {{param::get?name=auto_item}}


.. _rst_cookbook_filter_custom-sql_sortierung-der-ausgabe-nach-mehr-als-einem-attribut-fest:
Sortierung der Ausgabe nach mehr als einem Attribut (fest)
**********************************************************

"Sortiere 'Mannschaften' nach Punkte absteigend + Spiele aufsteigend +
Priorität absteigend."
siehe auch `Forum <https://community.contao.org/de/showthread.php?62625-Zweite-Sortierung>`_

Zu beachten ist, dass diese SQL-Regel im Filter als *erste Regel* eingebaut wird. In der
ersten Regel wird die "Basismenge" und die Reihenfolge der Items festgelegt und in den
weiteren Regeln wird diese Menge nur noch gekürzt. Die Sortierrichtung ist bei MySQL
immer ASC - möchte man eine andere Richtung, dann die Angabe bei jeder angegebenen 
Sortierspalte mit angeben.

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM mm_mannschaft
   ORDER BY `punkte` DESC, `spiele` ASC, `prio` DESC


Sortierungen der Ausgabe nach einer Nummer und NULL-Werten oder Zufall
**********************************************************************

Zu beachten ist, dass diese SQL-Regel im Filter als *erste Regel* eingebaut wird.
Anzeige der Items nach einer eigenen Sortierungsnummer aber alle Items ohne Nummer (NULL) ans Ende:

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM mm_sv_categories
   ORDER BY ISNULL(`sort_number`), `sort_number` ASC

Man kann auch einzelne Items als Erste anzeigen lassen (Attribut "Prio-Slider" = 1) und
den Rest per Zufall:

.. code-block:: php
   :linenos:
   
   SELECT `id` 
   FROM mm_sv_trainings
   ORDER BY `prio_slider` DESC, rand()


Sortierung der Ausgabe referenziertem MM und Name
************************************************

Hat man z. B. ein MM Produkte, in denen jeweils ein Partner per Einfachauswahl [select]
referenziert ist und man möchte die Produkte so ausgeben, dass diese erst nach der
manuellen Sortierung (sorting) der Partner sortiert ist und anschließend nach dem eigentlichen
Produktnamen, kann man das mit den folgenden Code erreichen:

.. code-block:: php
   :linenos:
   
   SELECT pro.id FROM mm_products AS pro
   LEFT JOIN mm_partners AS part ON pro.partner = part.id
   WHERE pro.published = 1
   ORDER BY part.sorting, pro.product_code 

In der Ausgabeliste könnte man damit z. B. bei jedem neuen Partner eine Zwischenüberschrift
ausgeben. Dazu die aktuelle Partner.ID in einer temp. Variable abspeichern und in jedem
Schleifendurchgang auf Gleichheit prüfen - wenn Ungleich, dann Ausgabe "Partnername".


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
   
   SELECT `id` FROM mm_monate 
   WHERE FROM_UNIXTIME(`von_datum`) <= IF(
      {{param::get?name=von_datum}},
      {{param::get?name=von_datum}}, 
      CURDATE()
   ) 
   ORDER BY `von_datum` DESC

Defaultwert ''
**************

Bei dem eigenen SQL sind Defaultwerte per 'default=<wert>' möglich,
die verwendet werden, wenn der Filterparameter nicht gesetzt ist. Im Param-Tag
ist aktuell wird akltuell die Eingabe von `''` oder `""` gecastet, so dass die
Filterung nicht korrekt erfolgt; anzuwenden ist dies z.B. bei Checkboxwerten.

.. code-block:: php
   :linenos:
   
   SELECT `id` FROM mm_mitarbeiter 
   WHERE `driver_licence` = IF(
      {{param::get?name=driver_licence}},
      {{param::get?name=driver_licence}}, 
      ''
   )

Übergabe mehrerer Werte für `IN()`
**********************************

Mehrere Werte können an das Query als kommaseparierte Liste oder Array übergeben werden - je nach Typ der Übergabe
gibt es für den Parameter `aggregate` den Wert `list` oder `set`.

.. code-block:: sql
   :linenos:

   -- als Liste
   -- domain.tld/de/liste?id=13,15,19
   SELECT id FROM {{table}}
   WHERE id IN ({{param::get?name=id&aggregate=list}})

   -- als Array
   -- domain.tld/de/liste?id[]=13&id[]=15&id[]=19
   SELECT id FROM {{table}}
   WHERE id IN ({{param::get?name=id&aggregate=set}})

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
   
   SELECT DISTINCT(rel.value_id) as id FROM mm_mitarbeiter as ma
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
   
   SELECT `id` FROM mm_mitarbeiter
   WHERE `abteilung` IN (
      SELECT `id` FROM mm_abteilung
      WHERE `score` > 99
   )

oder

.. code-block:: php
   :linenos:
   
   SELECT ma.id FROM mm_mitarbeiter ma
   LEFT JOIN mm_abteilung rel ON (ma.abteilung = rel.id)
   WHERE rel.score > 99


Mitarbeiter für eine per Mehrfachauswahl [tags] zugeordnete Seite filtern
*************************************************************************

Die Mitarbeiter haben ein Attribut Mehrfachauswahl auf die Tabelle `tl_page`,
um auf einzelnen Seiten einen Mitarbeiter als Verantwortlichen darzustellen. Auf den
entsprechenden Seiten kann ein MM-Listenelement eingefügt werden, der die zugehörigen
Mitarbeiter ausgibt. Für die Filterung kann das folgende Query verwendet werden:

.. code-block:: php
   :linenos:
   
   SELECT ma.id FROM mm_mitarbeiter ma
   LEFT JOIN tl_metamodel_tag_relation rel ON (ma.id = rel.item_id)
   WHERE
   rel.att_id = 79 AND             -- 79 ID des Attributes [tags]
   rel.value_id = {{page::id}} AND -- variable Seiten-ID
   ma.published = 1
   ORDER BY ma.name


Filterung einer Select-Auswahl im BE für eine nicht-MM-Tabelle
**************************************************************

Hat man für das Attribut Einzelauswahl [select] eine Tabelle ausgewählt,
die keine MM-Tabelle ist, steht als Filtermöglichkeit die Eingabe einer "WHERE-Eingrenzung"
zur Verfügung. Möchte man z.B. bei seinem Datensatz eine Verbindung zur Mitglieder-Tabelle
"tl_member" haben aber die Eingrenzung, dass ein Mitglied nur einmal ausgewählt werden darf,
dann folgenden String einsetzen:

.. code-block:: php
   :linenos:
   
   (SELECT tl_member.id FROM tl_member
    LEFT JOIN mm_member
           ON mm_member.memberId=tl_member.id
      WHERE
            mm_member.memberId IS NULL
      AND 
            tl_member.id=sourceTable.id)


ID aus GET-Parameter nach '::' abtrennen
****************************************

Bei Filterungen im Backend oder für das Frontend-Editing benötigt man ggf. Zugriff
auf die ID aus dem GET-Parameter der URL. Dieser ist aber mit '::' an einen
Tabellennamen gekoppelt und muss für die Verwendung in einem eigenen SQL-Query
separiert werden. Das erfolgt z.B. über den den Befehl `SUBSTRING_INDEX` im Query,
wie das folgende Beispiel zeigt:

.. code-block:: php
   :linenos:
   
   -- URL: ....&id=mm_mitarbeiter::51&...
   SELECT * FROM mm_mitarbeiter
   WHERE `id` = SUBSTRING_INDEX({{param::get?name=id}},'::',-1)


Filter für ein Select/Tags in der Eingabemaske
**********************************************

Die Attribute Einfach- und Mehrfachauswahl (Select und Tags) können für die
Eingabemaske mit einem Filter versehen werden. Soll dieser Filter dynamisch
auf ein anderes Attribut der Eingabemaske reagieren, kann man mit der Filterregel
"Eigenes SQL" arbeiten und die dynamischen Parameter verwenden.

Als dynamischer Parameter kann z.B. die URL mit den GET-Parametern oder bei einem
`submitonchange` eines Attributes in der Eingabemaske die POST-Parameter ausgewertet
werden. Bei GET startet man bei der ID des Datensatzes und bei Post, mit dem Wert/Werten
des zu triggernden Attributes.

Zum Beispiel soll auf die Select-Auswahl der Abteilung die Liste der auswählbarer
Mitarbeiter auf die eingeschränkt werden, die zur selben Abteilung gehören. "Gelauscht"
wird auf den POST-Parameter der Abteilung und anschließend kann mit QUERY-P (POST)
oder QUERY-G (GET) die Mitarbeiterliste eingegrenzt werden.

.. code-block:: php
   :linenos:
   
   SELECT `id` FROM  mm_mitarbeiter
   WHERE IF (
         {{param::post?name=abteilung}} != 'NULL', (QUERY-P), (QUERY-G)
    )

Man kann damit auch zwei Select-Auswahlen voneinander abhängig gestalten. Wenn man eine
Tabelle für Kategorien hat ``mm_markt_kategorie`` und eine Kind-Tabelle mit Unterkategorien
``mm_markt_unterkategorie`` sowie eine Tabelle ``mm_markt_maschine`` in der beide Tabellen
als Einzelauswahl eingebunden sind. Wird in der Eingabemaske der Maschinen eine Kategorie
ausgewählt, sollen bei dem Select der Unterkategorien nur noch die zugehörigen Elemente auftauchen.
Dazu wäre bei dem Model der Unterkategorien folgende SQL-Filterregel einzubauen:

.. code-block:: php
   :linenos:
   
   SELECT unterkategorie.id FROM mm_markt_unterkategorie AS unterkategorie
   WHERE IF (
       {{param::post?name=category}} != 'NULL',
       unterkategorie.pid = (
           SELECT kategorie.id FROM mm_markt_kategorie AS kategorie 
           WHERE kategorie.alias = {{param::post?name=category}} 
           LIMIT 1
       ),
       unterkategorie.pid = (
           SELECT markt.category
           FROM mm_markt_maschine AS markt
           WHERE markt.id = SUBSTRING_INDEX({{param::get?name=id}},'::',-1)
           LIMIT 1
       )
   )

Bei der Eingrenzung einer Mehrfachauswahl muss man etwas tricksen, da die Bedingung
mit IF in den Sub-Queries keine mehrfachen Werte als Rückgabe zulässt. Es ist aber möglich,
mit GROUP_CONCAT einen einzelnen String mit den IDs zu erzeugen, der von IN ausgewertet
werden kann.

Zum Beispiel sollen beim Attribut "Reisebausteine" die möglichen Auswahlen auf die Auswahl
des Attributes "Reiseziele" eingegrenzt werden. Die folgende Vorlage soll als Anregung
dienen - ggf. gibt es elegantere Lösungen.

.. code-block:: php
   :linenos:
   
   SELECT rb.id FROM mm_reisebausteine AS rb
   WHERE rb.region IN (
       SELECT IF(
           {{param::post?name=reiseziele}} != 'NULL',
           (SELECT GROUP_CONCAT(rz.id) FROM mm_reiseziele AS rz 
               WHERE rz.alias IN ({{param::post?name=reiseziele}}) GROUP BY rz.pid),
           (SELECT GROUP_CONCAT(rel.value_id) AS id FROM tl_metamodel_tag_relation AS rel
               WHERE rel.att_id = '42'
               AND rel.item_id = SUBSTRING_INDEX({{param::get?name=id}},'::',-1) GROUP BY rel.att_id)
       ) as id
   )

Filter für Mehrfachauswahl in der Eingabemaske: nur unausgewählte Items
***********************************************************************

Hat man z. B. eine Tabelle Regionen und dort eine Mehrfachauswahl auf Länder und möchte die Auswahl
auf die Länder begrenzen, die noch nicht zugewiesen wurden, kann man bei dem Attribut Mehrfachauswahl
(ID: 42) auf die Länder einen Filter aktivieren. In dem Filter kann man eine Filterregel "Eigenes SQL"
wie folgt anlegen:

.. code-block:: php
   :linenos:

   SELECT `id`
   FROM mm_countries
   WHERE `id` NOT IN (
       SELECT `value_id` as id
       FROM tl_metamodel_tag_relation
       WHERE `att_id` = '42'
   ) OR id IN (
       SELECT `value_id` as id
       FROM tl_metamodel_tag_relation
       WHERE `att_id` = '42'
       AND `item_id` = SUBSTRING_INDEX({{param::get?name=id}},'::',-1)
   )

Filterunterscheidung von Frontend und Backend
*********************************************

Bei den Filterungen mit eigenem SQL kann es notwendig sein, eine Unterscheidung zwischen
Frontend und Backend zu erreichen. Seit MM 2.2 werden die beim Attribut Select und Tags
eingestellten Filter auch im Frontend angewendet, so dass es Problemen mit Filterregeln
kommen kann, die nur in der Eingabemaske zum Tragen kommen sollen.

Man kann eine Abfrage auf den aktuellen Request-String setzen und dort nach dem eigenen Modelnamen wie z. B.
"mm_employees" als erstes Wort suchen.

.. code-block:: php
   :linenos:

   SELECT artd.id FROM mm_article_details artd
   LEFT JOIN tl_metamodel_tag_relation rel ON (artd.id = rel.item_id)
   WHERE
   IF (SUBSTRING_INDEX(SUBSTRING_INDEX('{{env::request}}', '/', -1), '?', 1) = 'mm_employees',
      rel.att_id = 43 AND                                             -- 43 ID des Attributes [tags]
      rel.value_id = SUBSTRING_INDEX({{param::get?name=id}},'::',-1), -- variable ID aus URL für Artikel/Produkt
      1=1
   )

.. note:: Mit MM-Version 2.3-beta1 hat sich das Routing im BE geändert - statt ``domain.de/contao?do=metamodel_mm_employees&act=edit...``
   kommt nun ein ``domain.de/contao/metamodel/mm_employees?act=edit``, d. h. vor der Änderung wurde bei der Abfrage
   ``SUBSTRING_INDEX(SUBSTRING_INDEX('{{env::request}}', '/', -1), '?', 1)`` der Wert "contao" geliefert.

Kommentare im SQL-Query
***********************

Die SQL-Queries können unter Umständen recht komplex werden und einige
feste Werte wie Attribut-IDs usw. enthalten. Um für einen späteren Zeitpunkt
oder die Arbeit im Team den Überblick nicht zu verlieren, können auch hier
Kommentare eingefügt werden - mehr dazu im `MySQL reference manual <https://dev.mysql.com/doc/refman/5.6/en/comments.html>`_.

Beispiel:
|img_sql-comment|


.. |img_about| image:: /_img/icons/about.png
.. |img_sql-comment| image:: /_img/screenshots/cookbook/filter/sql-comment.jpg

