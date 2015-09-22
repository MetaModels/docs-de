.. _reference_api:

MetaModels API
==============

Die MetaModels API bildet die Schnittstelle zur eigenen Programmierung und
Erweiterung.

.. _reference_api_intercaces:

Core Interfaces
---------------

Die API von MetaModels hält Schnittstellen zum Ansprechen verschiedener Klassen 
als "`Interfaces <http://php.net/manual/de/language.oop5.interfaces.php>`_" bereit.

Die Interfaces können zum Beispiel in eigenen Programmierungen bzw. Funktionen in
Events/Hooks oder in Templates eingesetzt werden.

Beispiele dazu werden im "Cookbook" folgen.

Factory Interface:
..................

Mit dem Factory Interface können Instanzen eines MetaModel erstellt und bestimmte
Eigenschafen abgefragt werden.

Aktuelle Informationen unter: `IFactory <https://github.com/MetaModels/core/blob/master/src/MetaModels/IFactory.php>`_

``\MetaModels\IFactory::getMetaModel($metaModelName);`` |br|
erstellt eine MetaModel-Instanz mit dem übergebenen Namen
     
``\MetaModels\IFactory::byId($strTableName);`` |br|
erstellt eine MetaModel-Instanz aus Tabellen-ID

``\MetaModels\IFactory::byTableName($strTableName);`` |br|   
erstellt eine MetaModel-Instanz aus Tabellenname
   
``\MetaModels\IFactory::getAllTables();`` |br|
gibt alle MetaModel-Tabellennamen als Array zurück
   
``\MetaModels\IFactory::collectNames();`` |br|
gibt alle MetaModel-Namen als Array zurück
   
``\MetaModels\IFactory::translateIdToMetaModelName($metaModelId);`` |br|
gibt den übersetzen Namen zu einer MetaModel-Id zurück
   
``\MetaModels\IFactory::getServiceContainer();`` |br|
ermittelt den Event-Dispatcher   

MetaModel Interface:
....................

Mit dem MetaModel-Interface können Eigenschaften einer MetaModel-Instanz abgefragt bzw.
beeinfusst werden.

Zunächst muss eine MetaModels-Instanz über die ID oder dem Namen eines MetaModel
erzeugt werden:

``$objMetaModel = \MetaModels\IFactory::byId($metaModelId);`` 
``$objMetaModel = \MetaModels\IFactory::byTableName($metaModelName);``

Anschließend kann eine Eigenschaft abgefragt oder gesetzt werden - z.B. die Abfrage
aller vorhandenen Attribute:

``$arrAttributes = $objMetaModel->getAttributes();``

Aktuelle Informationen unter: `IMetaModel <https://github.com/MetaModels/core/blob/master/src/MetaModels/IMetaModel.php>`_


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
gibt die Instnz des Attributes mit dem gegebenen Attributnamen zurück

``getAttributeById($intId)``  |br|
gibt die Instnz des Attributes mit der gegebenen Attribut-ID zurück

``findById($intId, $arrAttrOnly = array())``  |br|
gibt das Item mit der gegebenen ID zurück; optional kann ein Array mit 
Attributnamen angegben werden, deren Werte zurück zu gegeben werden sollen

``getEmptyFilter()``  |br|
erzeugt einen "leeres" Filterobjekt ohne Filterregeln

``prepareFilter($intFilterSettings, $arrFilterUrl)``  |br|
erzeugt ein Filterobjekt aus einer gegebenen Filter-ID und einem Array
mit URL-Parameter z.B. für die Aufnahme von GET-Werten

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
MetaModel ermittelt werden - neben den Parametern der Sortierung, Offset, Limit
und Sortierrichtung, kann ein Array mit Attributnamen angegben werden, deren
Werte zurück zu gegeben werden sollen

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

``delete(IItem $objItem)``  |br|
speichert ein gegebenes Item

``getView($intViewId = 0)``  |br|
gibt die Instanz der Renderingeinstellungen des instanzierten MetaModel zurück




.. |br| raw:: html

   <br />
