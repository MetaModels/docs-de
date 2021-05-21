.. _ref_api_interf_mm:

MetaModels Interfaces
=====================

Die MetaModels Interfaces bilden die Basis der Interfaces und
ermöglichen den Zugriff auf ein MetaModel bis hin zum einzelnen
Item.

Viele Arbeiten bei dem Einsatz bzw. Verwendung der Interfaces konzentrieren
sich auf die Abfrage vorhandener Daten eines MetaModel. Hier folgt der
Aufbau analog dem Aufbau einer Abfrage oder Auflistung über das Contentelement
bzw. Frontend-Modul mit


* Verbindung zu MetaModels; z.B. um außerhalb eines MetaModel-Templates eine Verbindung
  herzustellen - siehe :ref:`ref_api_interf_mm_metamodelsservicecontainer`
* Verbindung zum MetaModel - siehe :ref:`ref_api_interf_mm_factory`
* Abfrage eines MetaModels unter Berücksichtigung von Filterregeln 
  - siehe :ref:`ref_api_interf_mm_metamodel`
* Abfragen und setzen der aktiven Sprache bei übersetzten MetaModels - siehe
  :ref:`ref_api_interf_mm_translatedmetamodel`
* Zugriff auf alle Items; ggf. Parsing der Items mit Angabe des Ausgabeformats
  (Text, HTML5) und der Render-Einstellung) - siehe :ref:`ref_api_inteface_items`
* Zugriff auf ein Item bzw. Ausgabe (Raw, Text, HTML5) - siehe :ref:`ref_api_interf_mm_item`

Zudem können über die Interfaces eines MetaModel auch verschiedene Objekte (MetaModel,
Attribut, Item) auch erstellt, die Werte verändert oder Eigenschaften abgefragt werden wie
Anzahl oder Sprache.


.. _ref_api_interf_mm_metamodelsservicecontainer:

MetaModelsServiceContainer Interface:
.....................................

Mit dem MetaModelsServiceContainer Interface kann eine Verbindung zu
MetaModels aufgebaut werden. Dies ist zum Beispiel notwendig, wenn
auf MetaModel außerhalb eines MetaModel-Templates zugegriffen werden
soll.

Für einen Zugriff benötigt man einen "Service Container", den man sich
z.B. im globalen Scope holen kann

``$container = $this->getContainer();``

Anschließend kann mit einem Interface darauf zugegriffen werden - z.B.:

``$factory = $container->getFactory();`` |br|
bzw. |br|
``$factory = $this->getContainer()->get('metamodels.factory');``

Mit dem Zugriff über $GLOBALS kann in eigenen Templates und Programmierungen
leicht auf den Service-Container zugegriffen werden. Andere Möglichkeiten
wären über Events wie z.B. "\MetaModelsEvents::SUBSYSTEM_BOOT".

Aktuelle Informationen unter: `IMetaModelsServiceContainer <https://github.com/MetaModels/core/blob/master/src/IMetaModelsServiceContainer.php>`_

**Interfaces:**

``getFactory()`` |br|
gibt den Zugriff auf MetaModels zurück

``getAttributeFactory()`` |br|
gibt den Zugriff auf die Attribute zurück

``getFilterFactory()`` |br|
gibt den Zugriff auf die Filter zurück

``getRenderSettingFactory()`` |br|
gibt den Zugriff auf die Render-Einstellungen zurück

``getEventDispatcher()`` |br|
gibt den Zugriff auf die Event-Dispatcher zurück

``getDatabase()`` |br|
gibt den Zugriff auf die Datenbank zurück

``getCache()`` |br|
gibt den Zugriff auf die Cache zurück

``setService($service, $serviceName = null)`` |br|
fügt einen eigenen Service dem Container hinzu

``getService($serviceName)`` |br|
gibt den Zugriff auf einen Service mit dem übergebenen Namen zurück


.. _ref_api_interf_mm_servicecontaineraware:

ServiceContainerAware Interface:
................................

Mit dem ServiceContainerAware Interface kann man Zugriff auf den 
Service-Container erhalten oder einen neuen Service-Container
zuweisen.

Aktuelle Informationen unter: `IServiceContainerAware <https://github.com/MetaModels/core/blob/master/src/IServiceContainerAware.php>`_

**Interfaces:**

``setServiceContainer(IMetaModelsServiceContainer $serviceContainer)`` |br|
setzt den zu verwendenden Service-Container

``getServiceContainer()`` |br|
gibt den Service-Container zurück


.. _ref_api_interf_mm_factory:

Factory Interface:
..................

Mit dem Factory Interface können Instanzen eines MetaModel erstellt und bestimmte
Eigenschafen abgefragt werden.

Die Erstellung eines neuen MetaModel ist nicht vorgesehen - wenn auch möglich - da
für die Erstellung sehr komplexe Parameter mit übergeben werden müssten und die 
Erstellung auf die Arbeit aus dem Backend ausgerichtet ist.

Aktuelle Informationen unter: `IFactory <https://github.com/MetaModels/core/blob/master/src/IFactory.php>`_

**Interfaces:**

``getMetaModel($modelName);`` |br|
erstellt eine MetaModel-Instanz mit dem übergebenen Namen

``translateIdToMetaModelName($modelId);`` |br|
gibt den Namen zu einer MetaModel-ID zurück
  
``collectNames();`` |br|
gibt alle MetaModel-Namen als Array zurück

``getServiceContainer();`` |br|
gibt den Service-Container zurück

.. warning:: Die Methoden `byTableName`, `byId` und `getAllTables`
   wurden in der Version 2.0 entfernt

``byTableName($strTableName);`` |br|   
Methode ``getMetaModel($modelName);`` verwenden

``byId($intMetaModelId);`` |br|
Methode ``getMetaModel($modelName);`` mit 
``translateIdToMetaModelName($modelId);`` verwenden

``getAllTables();`` |br|
Methode ``collectNames();`` verwenden
 


.. _ref_api_interf_mm_metamodel:

MetaModel Interface:
....................

Mit dem MetaModel-Interface können Eigenschaften einer MetaModel-Instanz abgefragt bzw.
beeinflusst werden.

Zunächst muss eine MetaModels-Instanz über die ID bzw. den Namen eines MetaModel erzeugt
werden siehe :ref:`ref_api_interf_mm_factory`)

``$model = \MetaModels\IFactory::getMetaModel($modelName);``

bzw. inklusive des Service-Containers:

.. code-block:: php
   :linenos:
   
   <?php
   $metaModelId = 42;
   
   /** @var $container */
   $factory   = $this->getContainer()->get('metamodels.factory');
   $modelName = $factory->translateIdToMetaModelName($modelId);
   $model     = $factory->getMetaModel($modelName);


Anschließend kann eine Eigenschaft abgefragt oder gesetzt werden - z.B. die Abfrage
aller vorhandenen Attribute:

``$attributes = $metaModel->getAttributes();``

Aktuelle Informationen unter: `IMetaModel <https://github.com/MetaModels/core/blob/master/src/IMetaModel.php>`_

**Interfaces:**

``getServiceContainer()`` |br|
gibt den Service-Container zurück

``get($strKey)``  |br|
gibt die Konfigurationseinstellungen zurück

``getTableName()``  |br|
gibt die Tabellen-Namen des instanzierten MetaModel zurück

``getName()``  |br|
gibt die Namen des instanzierten MetaModel zurück

``isTranslated()``  |br|
prüft, ob das instanzierten MetaModel Übersetzungen erstellen kann 

``hasVariants()``  |br|
prüft, ob das instanzierten MetaModel Varianten erstellen kann

``getAvailableLanguages()``  |br|
gibt alle Sprachcodes als Array des instanzierten MetaModel zurück

``getFallbackLanguage()``  |br|
gibt den Sprachcode der Fallbacksprache des instanzierten MetaModel zurück

``getActiveLanguage()``  |br|
gibt den Sprachcode der aktiven Sprache des instanzierten MetaModel zurück

``addAttribute(IAttribute $attribute)``  |br|
fügt ein Attribut in die interne Liste der Attribute ein

``hasAttribute($attributeName)``  |br|
prüft, ob ein Attribut mit dem gegebenen Namen in der internen Liste der
Attribute vorhanden ist

``getAttributes()``  |br|
gibt ein Array mit allen Attributen des instanzierten MetaModel zurück

``getInVariantAttributes()``  |br|
gibt ein Array mit den Attributen des instanzierten MetaModel zurück
welche nicht als Varianten definiert sind

``getAttribute($attributeName)``  |br|
gibt die Instanz des Attributes mit dem gegebenen Attributnamen zurück

``getAttributeById($id)``  |br|
gibt die Instanz des Attributes mit der gegebenen Attribut-ID zurück

``findById($id, $attrOnly = [])``  |br|
gibt das Item mit der gegebenen ID zurück; optional kann ein Array mit 
Attributnamen angegben werden, deren Werte zurück zu gegeben werden sollen

``getEmptyFilter()``  |br|
erzeugt ein "leeres" Filterobjekt ohne Filterregeln

``prepareFilter($filterSettings, $filterUrl)``  |br|
erzeugt ein Filterobjekt aus einer gegebenen Filter-ID und einem optionalen
Array mit Filterparametern z.B. für die Übernahme von GET-Werten aus einer
URL

``findByFilter(
$filter,
$sortBy = '',
$offset = 0,
$limit = 0,
$sortOrder = 'ASC',
$attrOnly = []
)``  |br|
gibt die Items zurück, welche mit einem gegebenen Filter in dem instanzierten
MetaModel ermittelt werden - neben den Parametern der Sortierung, Offset, Limit
und Sortierrichtung, kann ein Array mit Attributnamen angegeben werden, deren
Werte zurück zu gegeben werden sollen

``getIdsFromFilter(
$filter, 
$sortBy = '',
$offset = 0,
$limit = 0,
$sortOrder = 'ASC'
)``  |br|
gibt die IDs der Items zurück, welche mit einem gegebenen Filter in dem instanzierten
MetaModel ermittelt werden - die Parametern der Sortierung, Offset, Limit
und Sortierrichtung können angegeben werden

``getCount($filter)``  |br|
gibt die Anzahl der Items zurück, die nach einem gegebenen Filter ermittelt werden

``findVariantBase($filter)``  |br|
gibt alle Items einer Varianten-Basis zürück, die nach einem gegebenen Filter ermittelt werden

``findVariants($ids, $filter)``  |br|
gibt alle Varianten-Items eines Arrays mit IDs und einem gegebenen Filter zurück

``findVariantsWithBase($ids, $filter)``  |br|
gibt alle Varianten-Items eines Arrays mit IDs und einem gegebenen Filter zurück;
die Abfrage unterscheidet nicht zwischen Items einer Varianten-Basis und -Items

``getAttributeOptions($attribute, $filter = null)``  |br|
gibt alle Optionen eines gegebenen Attributs zurück; Optional kann
ein Filter angegeben werden

``saveItem($item)``  |br|
speichert ein gegebenes Item bzw. es wird ein neues Item erzeugt, wenn keine ID mit
übergeben wurde

``delete($item)``  |br|
löscht ein gegebenes Item

``getView($viewId = 0)``  |br|
gibt die Instanz der Render-Einstellungen des instanzierten MetaModel zurück


.. _ref_api_interf_mm_translatedmetamodel:

Translated MetaModel Interface:
....................

.. note:: Das Feature steht ab MM 2.2 zur Verfügung.

Mit dem Translated-MetaModel-Interface können die Sprachvorgaben eines übersetzten
MetaModel abgefragt oder gesetzt werden.

Bis zur Version MM 2.1 konnte aktuelle Sprache eines übersetzten MetaModel nur über
das (temporäre) Setzen von ``$GLOBALS['TL_LANGUAGE']`` erreicht werden. Mit dem Interface
ist das Setzen der Sprache des MetaModel unabhängig von der Backendsprache von Contao
möglich.

Soll zum Beispiel bei einem übersetzten MetaModel ein Item in einer bestimmten Sprache
gespeichert werden, kann die Sprache über den Sprachcode (de, en, fr, ..) wie folgt
gesetzt werden:

``$model->selectLanguage('de');``

Eine Typprüfung kann wie folgt implementiert werden:

.. code-block:: php
   :linenos:
   
   <?php

   use MetaModels\ITranslatedMetaModel;
   
   if ($model instanceof ITranslatedMetaModel) {
       // make anything...
   }

Ab MetaModels 2.2 müssen die folgenden Interfaces verwendet werden:

**Interfaces:**

``getLanguages()``  |br|
ermittelt alle Sprachcodes, die in diesem MetaModel als für die Übersetzung verfügbar markiert wurden

``getMainLanguage()``  |br|
ermittelt den Sprachcode, der in diesem MetaModel als Fallback-Sprache markiert wurde

``getLanguage()``  |br|
ermittelt den aktuellen Sprachcode

``selectLanguage($activeLanguage)``  |br|
setzt die neue, aktive Sprache und gibt den vorherigen Sprachcode zurück


.. _ref_api_inteface_items:

Items Interface:
................

Mit dem Items-Interface können Eigenschaften der Items abgefragt werden.

Zunächst muss eine MetaModels-Instanz über die ID oder dem Namen eines MetaModel
erzeugt und anschließend z.B. über einen Filter eine Liste von Items ermittelt werden.

``$items = $model->findByFilter($filter);``

Anschließend kann eine Eigenschaft abgefragt werden - z.B. die Abfrage
zur Anzahl aller vorhandenen Items:

``$amountItems = $items->getCount();``

Aktuelle Informationen unter: `IItems <https://github.com/MetaModels/core/blob/master/src/IItems.php>`_

**Interfaces:**

``getItem()``  |br|
gibt das aktuelle Item zurück

``getCount()``  |br|
gibt die Anzahl der Items zurück

``first()``  |br|
setzt den Zeiger auf das erste Element der Items

``prev()``  |br|
setzt den Zeiger auf das nächste Element der Items

``last()``  |br|
setzt den Zeiger auf das letzte Element der Items

``reset()``  |br|
resettet das aktuelle Ergebnis

``getClass()``  |br|
gibt die CSS-Klasse des aktuellen Items zurück (first, last, even, odd)

``parseValue($outputFormat = 'text', $settings = null)``  |br|
parst das aktuelle Item und gibt das Ergebnis als Array der Attribute zurück;
für die Ausgaben in HTML5 müssen die Render-Einstellungen als
$objSettings übergeben werden z.B. $metaModel->getView(3)

``parseAll($outputFormat = 'text', $settings = null)``  |br|
parst alle Items und gibt das Ergebnis als Array der Items mit dessen Attributen zurück;
für die Ausgaben in HTML5 müssen die Render-Einstellungen als
$objSettings übergeben werden z.B. $metaModel->getView(3)


.. _ref_api_interf_mm_item:

Item Interface:
...............

Mit dem Item-Interface können Eigenschaften eines Item abgefragt werden.

Zunächst muss eine MetaModels-Instanz über die ID oder dem Namen eines MetaModel
erzeugt und anschließend z.B. über einen Filter (ggf. auch leerer Filter)eine
Liste von Items ermittelt werden.

``$items = $model->findByFilter($filter);``  |br|

Anschließend kann eine Eigenschaft abgefragt werden - z.B. die Abfrage
des Wertes eines Attributs:

``$attribute = $items->getItem()->get($attributeName);``  |br|

Ein neues Item wird wie folgt erzeugt:

``$item = new \MetaModels\Item($model, []);``

In dem übergebenen Array können "Key-Value-Paare" übergeben werden - dies
ist aber nur bei einfachen Item-Typen wie Text sinnvoll.

Aktuelle Informationen unter: `IItem <https://github.com/MetaModels/core/blob/master/src/IItem.php>`_

**Interfaces:**

``get($attributeName)``  |br|
gibt den Wert eines Attributes bei gegebenem Attributnamen zurück

``set($attributeName, $value)``  |br|
setzt den Wert eines Attributes bei gegebenem Attributnamen

``getMetaModel()``  |br|
gibt die Instanz des Items zurück

``getAttribute($attributeName)``  |br|
gibt die Instanz eines Attributes bei gegebenem Attributnamen zurück

``isVariant()``  |br|
ermittelt, ob das Item eine Variante eines anderen Items ist

``isVariantBase()``  |br|
ermittelt, ob das Item eine Variantenbasis ist

``getVariants($filter)``  |br|
gibt ein Array mit den Varianten des Items zurück oder null, wenn das Item
keine Varianten beherrscht

``getVariantBase()``  |br|
gibt das Item der Variantenbasis zurück; für ein Item ohne Varianten ist
die Variantenbasis das Item selbst

``parseValue($outputFormat = 'text', $settings = null)``  |br|
rendert das Item im vorgegebenen Format; als Rohdaten [raw]
werden die Daten immer mit ausgegeben inkl. Attribute referenzierter MetaModel

``parseAttribute($attributeName, $outputFormat = 'text', $settings = null)``  |br|
rendert ein einzelnes Attribut des Item im vorgegebenen Format; als Rohdaten [raw]
werden die Daten immer mit ausgegeben inkl. Attribute referenzierter MetaModel

``copy()``  |br|
erstellt ein neues Item als Kopie eines vorhandenen Items

``varCopy()``  |br|
erstellt ein neues Item als Kopie eines vorhandenen Items als Variante

``save()``  |br|
speichert den aktuellen Wert bzw. Werte für das Item


Beispiel:
.........

Das folgende Beispiel soll einen kleinen Einstieg in die Arbeit mit den
Interfaces demonstrieren. Das Beispiel kann z.B. in eine Template-Datei
eingefügt und per Inserttag ``{{file::mm_interfaces.html5}}`` in einem 
Artikel-Inhaltselement ausgegeben werden. 

Das Beispiel bezieht sich auf den Ausbau von ":ref:`mm_first_index`".

.. code-block:: php
   :linenos:
   
   <?php
   /* Parameter (Beispiel) */
   
   // Name der MetaModel Tabelle (siehe "Das erstes Metamodel")
   $modelName = 'mm_mitarbeiterliste';
   // ID der Render-Einstellungen "FE-Liste"
   $renderId = 2;
   // ID des Filters
   $filterId = 1;
   
   /* Interface */

   // Den 'service container' kann man erhalten, wenn man ihn aus dem globalen Scope holt,
   // oder aber indem man auf das Event \MetaModelsEvents::SUBSYSTEM_BOOT (oder eines der
   // konkretisierten Events für Backend/Frontend) lauscht.
   // (Container nur notwendig, wenn außerhalb des MM-Zugriffs)

   /* --- MM 2.0 --- */
   /** @var \MetaModels\IMetaModelsServiceContainer $container */ 
   //$container = $GLOBALS['container']['metamodels-service-container']; 
   // MM Factory
   //$factory = $container->getFactory();
   
   /* --- MM 2.1 --- */
   /** @var $container */
   $factory = $this->getContainer()->get('metamodels.factory');
   // alternativ
   //$factory = \Contao\System::getContainer()->get('metamodels.factory');

   /* --- MM 2.x --- */
   // MetaModel erzeugen, wenn Tabellen/MetaModel-Name bekannt.
   $model = $factory->getMetaModel($modelName);
   // MetaModel erzeugen, wenn nur id bekannt ($metaModelId == tl_metamodel.id des MetaModel).
   //$model = $factory->getMetaModel($factory->translateIdToMetaModelName($metaModelId));
   // leerer Filter
   $filter = $model->getEmptyFilter();
   // vordefinierter Filter über die Filter-Id
   //$filter = $model->prepareFilter($filterId, []);
   // alle Items
   $items = $model->findByFilter($filter);
   // alle Items geparst zu Array mit HTML5 Knoten
   $arrItems = $items->parseAll('html5', $model->getView($renderId));
   // alternativ nur Knoten raw und text
   //$arrItems = $items->parseAll('text');
   //dump($arrItems);
   
   /* Ausgabe */
   
   // Anzahl der Items
   echo 'Anzahl: '.$items->getCount()."<br>\n";
   
   // Variante 1 - Items-Objekt
   /*
   foreach ($items as $item)
   {
       echo $item->get('name')."<br>\n";
   }
   */
   
   // Variante 2 - Items-Array
   foreach ($arrItems as $arrItem)
   {
       echo $arrItem['html5']['name']."<br>\n";
   }


.. |br| raw:: html

   <br />
