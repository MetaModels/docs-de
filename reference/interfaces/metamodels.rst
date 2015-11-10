.. _ref_api_interf_mm:

MetaModels Interfaces
=====================

.. warning:: Noch im Aufbau!

Die MetaModels Interfaces bilden die Basis der Interfaces und
ermöglichen den Zugriff auf ein MetaModel bis hin zum einzelnen
Item.

Viele Arbeiten bei dem Einsatz bzw. Verwendung der Interfaces konzentrienen
sich auf die Abfrage vorhandenener Daten eines MetaModel. Hier folgt der
Aufbau analog dem Aufbau einer Abfrage oder Auflistung über das Contentelement
bzw. Frontend-Modul mit

* Verbindung zu MetaModels; z.B. um außerhalb eines MetaModel-Templates eine Verbindung
  herzustellen - siehe :ref:`ref_api_interf_mm_metamodelsservicecontainer`
* Verbindung zum MetaModel - siehe :ref:`ref_api_interf_mm_factory`
* Abfrage eines MetaModels unter Berücksichtigung von Filterregeln 
  - siehe :ref:`ref_api_interf_mm_metamodel`
* Zugriff auf alle Items; ggf. Parsing der Items mit Angabe des Ausgabeformats
  (Text, HTML5) und der Renderingeinstellung) - siehe :ref:`ref_api_inteface_items`
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

``$container = $GLOBALS['container']['metamodels-service-container'];``

Anschließend kann mit einem Interface daruaf zugegriffen werden - z.B.:

``$factory = $container->getFactory();``

Mit dem Zugriff über $GLOBALS kann in eigenen Templates und Programmierungen
leicht auf den Service-Container zugegriffen werden. Andere Möglichkeiten
wären über Events wie z.B. "\MetaModelsEvents::SUBSYSTEM_BOOT".

Aktuelle Informationen unter: `IMetaModelsServiceContainer <https://github.com/MetaModels/core/blob/master/src/MetaModels/IMetaModelsServiceContainer.php>`_

**Interfaces:**

``getFactory()`` |br|
gibt den Zugriff auf MetaModels zurück

``getAttributeFactory()`` |br|
gibt den Zugriff auf die Attribute zurück

``getFilterFactory()`` |br|
gibt den Zugriff auf die Filter zurück

``getRenderSettingFactory()`` |br|
gibt den Zugriff auf die Renderingeinstellungen zurück

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
.....................................

Mit dem ServiceContainerAware Interface kann man Zugriff auf den 
Service-Container erhalten oder einen neuen Service-Container
zuweisen.

Aktuelle Informationen unter: `IServiceContainerAware <https://github.com/MetaModels/core/blob/master/src/MetaModels/IServiceContainerAware.php>`_

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

Aktuelle Informationen unter: `IFactory <https://github.com/MetaModels/core/blob/master/src/MetaModels/IFactory.php>`_

**Interfaces:**

``getMetaModel($strMetaModelName);`` |br|
erstellt eine MetaModel-Instanz mit dem übergebenen Namen

``translateIdToMetaModelName($intMetaModelId);`` |br|
gibt den Namen zu einer MetaModel-ID zurück
  
``collectNames();`` |br|
gibt alle MetaModel-Namen als Array zurück

``getServiceContainer();`` |br|
gibt den Service-Container zurück

``byTableName($strTableName);`` |br|   
erstellt eine MetaModel-Instanz aus Tabellenname  |br|
**Deprecated**: bitte Methode ``getMetaModel($strMetaModelName);`` verwenden

``byId($intMetaModelId);`` |br|
erstellt eine MetaModel-Instanz aus Tabellen-ID  |br|
**Deprecated**: bitte Methode ``getMetaModel($strMetaModelName);`` mit 
``translateIdToMetaModelName($intMetaModelId);`` verwenden

``getAllTables();`` |br|
gibt alle MetaModel-Tabellennamen als Array zurück  |br|
**Deprecated**: bitte Methode ``collectNames();`` verwenden
 


.. _ref_api_interf_mm_metamodel:

MetaModel Interface:
....................

Mit dem MetaModel-Interface können Eigenschaften einer MetaModel-Instanz abgefragt bzw.
beeinfusst werden.

Zunächst muss eine MetaModels-Instanz über den Namen eines MetaModel erzeugt werden
siehe :ref:`ref_api_interf_mm_factory`)

``$objMetaModel = \MetaModels\IFactory::getMetaModel($strMetaModelName);``

bzw. inklusive des Service-Containers:

.. code-block:: php
	 :linenos:
   
   <?php
	 /** @var \MetaModels\IMetaModelsServiceContainer $container */
	 $container = $GLOBALS['container']['metamodels-service-container'];
	 
	 $factory = $container->getFactory();
	 $strMetaModelName = $factory->translateIdToMetaModelName($intMetaModelId);
	 $objMetaModel = $factory->getMetaModel($strMetaModelName);


Anschließend kann eine Eigenschaft abgefragt oder gesetzt werden - z.B. die Abfrage
aller vorhandenen Attribute:

``$arrAttributes = $objMetaModel->getAttributes();``

Aktuelle Informationen unter: `IMetaModel <https://github.com/MetaModels/core/blob/master/src/MetaModels/IMetaModel.php>`_

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

``addAttribute(IAttribute $objAttribute)``  |br|
fügt ein Attribut in die interne Liste der Attribute ein

``hasAttribute($strAttributeName)``  |br|
prüft, ob ein Attribut mit dem gegebenen Namen in der internen Liste der
Attribute vorhanden ist

``getAttributes()``  |br|
gibt ein Array mit allen Attributen des instanzierten MetaModel zurück

``getInVariantAttributes()``  |br|
gibt ein Array mit den Attributen des instanzierten MetaModel zurück
welche nicht als Varianten definiert sind

``getAttribute($strAttributeName)``  |br|
gibt die Instanz des Attributes mit dem gegebenen Attributnamen zurück

``getAttributeById($intId)``  |br|
gibt die Instanz des Attributes mit der gegebenen Attribut-ID zurück

``findById($intId, $arrAttrOnly = array())``  |br|
gibt das Item mit der gegebenen ID zurück; optional kann ein Array mit 
Attributnamen angegben werden, deren Werte zurück zu gegeben werden sollen

``getEmptyFilter()``  |br|
erzeugt einen "leeres" Filterobjekt ohne Filterregeln

``prepareFilter($intFilterSettings, $arrFilterUrl)``  |br|
erzeugt ein Filterobjekt aus einer gegebenen Filter-ID und einem optionalen
Array mit Filterparametern z.B. für die Übernahme von GET-Werten aus einer
URL

``findByFilter(
$objFilter,
$strSortBy = '',
$intOffset = 0,
$intLimit = 0,
$strSortOrder = 'ASC',
$arrAttrOnly = array()
)``  |br|
gibt die Items zurück, welche mit einem gegbenen Filter in dem instanzierten
MetaModel ermittelt werden - neben den Parametern der Sortierung, Offset, Limit
und Sortierrichtung, kann ein Array mit Attributnamen angegben werden, deren
Werte zurück zu gegeben werden sollen

``getIdsFromFilter(
$objFilter, 
$strSortBy = '',
$intOffset = 0,
$intLimit = 0,
$strSortOrder = 'ASC'
)``  |br|
gibt die IDs der Items zurück, welche mit einem gegbenen Filter in dem instanzierten
MetaModel ermittelt werden - die Parametern der Sortierung, Offset, Limit
und Sortierrichtung können angegeben werden

``getCount($objFilter)``  |br|
gibt die Anzahl der Items zurück, die nach einem gegebenen Filter ermittelt werden

``findVariantBase($objFilter)``  |br|
gibt alle Items einer Varianten-Basis zürück, die nach einem gegebenen Filter ermittelt werden

``findVariants($arrIds, $objFilter)``  |br|
gibt alle Varianten-Items eines Arrays mit IDs und einem gegebenen Filter zurück

``findVariantsWithBase($arrIds, $objFilter)``  |br|
gibt alle Varianten-Items eines Arrays mit IDs und einem gegebenen Filter zurück;
die Abfrage unterscheidet nicht zwischen Items einer Varianten-Basis und -Items

``getAttributeOptions($strAttribute, $objFilter = null)``  |br|
gibt alle Optionen eines gegebenen Attributs zurück; Optional kann
ein Filter angegeben werden

``saveItem($objItem)``  |br|
speichert ein gegebenes Item

``delete($objItem)``  |br|
speichert ein gegebenes Item

``getView($intViewId = 0)``  |br|
gibt die Instanz der Renderingeinstellungen des instanzierten MetaModel zurück


.. _ref_api_inteface_items:

Items Interface:
................

Mit dem Items-Interface können Eigenschaften der Items abgefragt werden.

Zunächst muss eine MetaModels-Instanz über die ID oder dem Namen eines MetaModel
erzeugt und anschließend z.B. über einen Filter eine Liste von Items ermittelt werden.

``$objItems = $objMetaModel->findByFilter($objFilter);``

Anschließend kann eine Eigenschaft abgefragt werden - z.B. die Abfrage
zur Anzahl aller vorhandenen Items:

``$intAmountItems = $objItems->getCount();``

Aktuelle Informationen unter: `IItems <https://github.com/MetaModels/core/blob/master/src/MetaModels/IItems.php>`_

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

``parseValue($strOutputFormat = 'text', $objSettings = null)``  |br|
parst das aktuelle Item und gibt das Ergebnis als Array der Attribute zurück;
für die Ausgaben in XHTML/HTML5 müssen die Renderingeinstellungen als
$objSettings übergeben werden z.B. $objMetaModel->getView(3)

``parseAll($strOutputFormat = 'text', $objSettings = null)``  |br|
parst alle Items und gibt das Ergebnis als Array der Items mit dessen Attributen zurück;
für die Ausgaben in XHTML/HTML5 müssen die Renderingeinstellungen als
$objSettings übergeben werden z.B. $objMetaModel->getView(3)


.. _ref_api_interf_mm_item:

Item Interface:
...............

Mit dem Item-Interface können Eigenschaften eines Item abgefragt werden.

Zunächst muss eine MetaModels-Instanz über die ID oder dem Namen eines MetaModel
erzeugt und anschließend z.B. über einen Filter (ggf. auch leerer Filter)eine
Liste von Items ermittelt werden.

``$objItem = $objMetaModel->findByFilter($objFilter);``  |br|

Anschließend kann eine Eigenschaft abgefragt werden - z.B. die Abfrage
des Wertes eines Attributs:

``$valAttribute = $objItems->get($strAttributeName);``  |br|

Ein neues Item wird wie folgt erzeugt:

``$objItem = new \MetaModels\Item($objMetaModel, array());``

In dem übergebenen Array können "Key-Value-Paare" übergeben werden - dies
ist aber nur bei einfachen Item-Typen wie Text sinnvoll.

Aktuelle Informationen unter: `IItems <https://github.com/MetaModels/core/blob/master/src/MetaModels/IItem.php>`_

**Interfaces:**

``get($strAttributeName)``  |br|
gibt den Wert eines Attributes bei gegebenen Attributnamen zurück

``set($strAttributeName, $varValue)``  |br|
setzt den Wert eines Attributes

``getMetaModel()``  |br|
gibt die Instanz des Items zurück

``getAttribute($strAttributeName)``  |br|
gibt den Wert eines Attributes bei gegebenen Attributnamen zurück

``isVariant()``  |br|
ermittelt, ob das Item eine Variante eines anderen Items ist

``isVariantBase()``  |br|
ermittelt, ob das Item eine Variantenbasis ist

``getVariants($objFilter)``  |br|
gibt ein Array mit den Varianten des Items zurück

``parseValue($strOutputFormat = 'text', $objSettings = null)``  |br|
rendert das Item im vorgegebenen Format; als Rohdaten [raw]
werden die Daten immer mit ausgegeben inl. Attribute referenzierter MetaModel

``parseAttribute($strAttributeName, $strOutputFormat = 'text', $objSettings = null)``  |br|
rendert ein einzelnes Attribut des Item im vorgegebenen Format; als Rohdaten [raw]
werden die Daten immer mit ausgegeben inl. Attribute referenzierter MetaModel

``copy()``  |br|
erstellt ein neues Item als Kopie eines vorhandenem Items

``varCopy()``  |br|
erstellt ein neues Item als Kopie eines vorhandenem Items als Variante

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
   
   // Name der MetaModel Tabelle (siehe "Das erstes Metamodel(s)")
   $strModelName = 'mm_mitarbeiterliste';
   // ID der Renderingeinstellungen "FE-Liste"
   $intRenderId = 2;
   
   /* Interface */

   // Den 'service container' kann man erhalten, wenn man ihn aus dem globalen Scope holt,
   // oder aber indem man auf das Event \MetaModelsEvents::SUBSYSTEM_BOOT (oder eines der
   // konkretisierten Events für Backend/Frontend) lauscht.
   // (Container nur notwendig, wenn außerhalb des MM-Zugriffs)
   /** @var \MetaModels\IMetaModelsServiceContainer $container */ 
   $container = $GLOBALS['container']['metamodels-service-container']; 
   // MM Factory
   $factory = $container->getFactory();
   // MM aus Tabellen/MM-Name (außerhalb eines MM-Templates)
   $objMetaModel = $factory->byTableName($strModelName);
   // MM aus Tabellen/MM-Name (in einem MM-Template)
   //$objMetaModel = \MetaModels\Factory::byTableName($strModelName);
   // leerer Filter
   $objFilter = $objMetaModel->getEmptyFilter();
   // alle Items
   $objItems = $objMetaModel->findByFilter($objFilter);
   // alle Items geparst zu Array
   $arrItems = $objItems->parseAll($strOutputFormat = 'html5',
                                   $objMetaModel->getView($intRenderId));
   //print_r($arrItems);
   
   /* Ausgabe */
   
   // Anzahl der Items
   echo 'Anzahl: '.$objItems->getCount()."<br>\n";;
   
   // Variante 1 - Items-Objekt
   /*
   foreach ($objItems as $objItem)
   {
   	echo $objItem->get('name')."<br>\n";
   }
   */
   
   // Variante 2 - Items-Array
   foreach ($arrItems as $arrItem)
   {
   	echo $arrItem['html5']['name']."<br>\n";
   }


.. |br| raw:: html

   <br />
