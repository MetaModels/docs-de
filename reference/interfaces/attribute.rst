.. _ref_api_interf_attribute:

Attribute Interfaces
====================

.. warning:: Noch im Aufbau!

Die Attribute Interfaces ermöglichen den Zugriff auf die
Attribute - sprich die Spalten der MetaModel-Tabelle -
zum setzen, auslesen von Werten oder der Abfrage von
Informationen.


.. _ref_api_interf_attribute_iattributefactory:

IAttributeFactory Interface
...........................

Das IAttributeFactory Interface ist das "Factory Interface" zur Abfrage
eines Attributes.

Aktuelle Informationen unter: `IAttributeFactory <https://github.com/MetaModels/core/blob/master/src/MetaModels/Attribute/IAttributeFactory.php>`_

**Interfaces:**

``createAttribute($arrInformation, $objMetaModel)`` |br|
gibt die Attribut-Instanz für ein gegebenes MetaModel und einem Array an
Attributvorgaben zurück

``addTypeFactory(IAttributeTypeFactory $typeFactory)`` |br|
fügt ein "typ factory" zum gegebenen "factory" hinzu

``getTypeFactory($typeFactory)`` |br|
gibt den "typ factory" zum gegebenen "factory" zurück

``attributeTypeMatchesFlags($factory, $flags)`` |br|
prüft das Attribute nach zu vergleichenden Flags

``getTypeNames($flags = false)`` |br|
gibt die registrierten Typennamen der Factory zurück

``collectAttributeInformation(IMetaModel $objMetaModel)`` |br|
gibt alle Attributinformationen eines MetaModel zurück

``createAttributesForMetaModel($metaModel)`` |br|
gibt alle Attributinstanzen eines MetaModel zurück

``getIconForType($type)`` |br|
gibt das Icon für ein gegebenen Typnamen zurück


.. _ref_api_interf_attribute_iattributefactory:

IAttribute Interface
....................

Das IAttribute Interface ist das grundlegende Interface für Attribute.

Aktuelle Informationen unter: `IAttributeFactory <https://github.com/MetaModels/core/blob/master/src/MetaModels/Attribute/IAttribute.php>`_

**Interfaces:**

``getName()`` |br|
gibt den (lesbaren) Namen oder Titel eines Attributes zurück

``getColName()`` |br|
gibt den Spaltennamen eines Attributes zurück

``getMetaModel()`` |br|
gibt die MetaModel-Instanz eines Attributes zurück

``get($strKey)`` |br|
gibt die Meta-Informationen eines Attributes zum gegebenen Schlüsselwert zurück

``set($strKey, $varValue)`` |br|
setzt die Meta-Informationen eines Attributes zum gegebenen Schlüsselwert

``handleMetaChange($strMetaName, $varNewValue)`` |br|
ersetzt die Meta-Informationen eines Attributes zum gegebenen Schlüsselwert

``initializeAUX()`` |br|
erstellt alle Hilfsdaten eines Attributes in anderen Tabellen 

``destroyAUX()`` |br|
löscht alle Hilfsdaten eines Attributes in anderen Tabellen

``getAttributeSettingNames()`` |br|
gibt alle zulässigen Einstellungsnamen zurück

``getFieldDefinition($arrOverrides = array())`` |br|
gibt ein DCA wie "$GLOBALS['TL_DCA']['tablename']['fields']['attribute-name]"
zurück, mit einem optionalen Array mit zu überschreibenden Parametern

``valueToWidget($varValue)`` |br|
gibt ein Widgetkompatiblen Wert eines nativen Attributwertes zurück

``widgetToValue($varValue, $intItemId)`` |br|
gibt ein Attributkompatiblen Wert eines nativen Widgetwertes zurück

``setDataFor($arrValues)`` |br|
speichert die Werte nach dem Schema "id => value" in der Datenbank

``getDefaultRenderSettings()`` |br|
gibt die Instanz der Standard-Rendereinstellungen des Attributes zurück

``parseValue($arrRowData, $strOutputFormat = 'text', $objSettings = null)`` |br|
gibt die konvertierten Daten bezüglich des gegebenen Ausgabeformates zurück

``getFilterUrlValue($varValue)`` |br|
gibt Attributwerte nach der Verwendung einer Filter-URL zurück

``sortIds($strListIds, $strDirection)`` |br|
gibt ein nach der Sortierrichtung ("ASC|DESC") soertieres Array an IDs zurück

``getFilterOptions($idList, $usedOnly, &$arrCount = null)`` |br|
gibt Attribute nach dem Schema "id => value" zurück

``searchFor($strPattern)`` |br|
gibt alle Items zu einem Suchmuster (z.B. Wildcard * oder ? für ein Buchtaben)
zurück

``filterGreaterThan($varValue, $blnInclusive = false)`` |br|
gibt eine Liste mit IDs von Items zurück, die größer als der gegebene Wert ist;
ist die Option "Inclusive" gesetzt, wird das Item bei Gleichheit mit in
die Liste aufgenommen

``filterLessThan($varValue, $blnInclusive = false)`` |br|
gibt eine Liste mit IDs von Items zurück, die kleiner als der gegebene Wert ist;
ist die Option "Inclusive" gesetzt, wird das Item bei Gleichheit mit in
die Liste aufgenommen

``filterNotEqual($varValue)`` |br|
gibt eine Liste mit IDs von Items zurück, die gleich als der gegebene Wert ist

``modelSaved($objItem)`` |br|
wird aufgerufen, wenn ein gegebenes Item gespeichert wird


.. _ref_api_interf_attribute_icomplex:

ISimple Interface
.................

Das ISimple Interface ist für alle "einfachen" Attribute gedacht,
die über die einfache Methode "SELECT colName FROM mm_table"
ermittelt werden können.

Aktuelle Informationen unter: `ISimple <https://github.com/MetaModels/core/blob/master/src/MetaModels/Attribute/ISimple.php>`_

**Interfaces:**

``getSQLDataType`` |br|
gibt die SQL-Typendeklaration wie z.B. "text NULL" zurück

``createColumn()`` |br|
erstellt die grundlegende Datenbankstruktur für ein gegbenenes Attribut

``deleteColumn()`` |br|
löscht die grundlegende Datenbankstruktur für ein gegbenenes Attribut

``renameColumn($strNewColumnName)`` |br|
benennt die grundlegende Datenbankstruktur für ein gegbenenes Attribut um;
Achtung: die vorhandenen Daten in der Datenbank werden dabei gelöscht

``unserializeData($strValue)`` |br|
gibt die Rohdaten der Datenbank unserialisiert zurück

``serializeData($strValue)`` |br|
gibt die Daten serialisiert für die Datenbank zurück


.. _ref_api_interf_attribute_icomplex:

IComplex Interface
..................

Das IComplex Interface ist für alle "komplexen" Attribute gedacht,
die nicht über die einfache Methode "SELECT colName FROM mm_table"
ermittelt werden können.

Aktuelle Informationen unter: `IComplex <https://github.com/MetaModels/core/blob/master/src/MetaModels/Attribute/IComplex.php>`_

**Interfaces:**

``getDataFor($arrIds)`` |br|
gibt für die übergebenen IDs die Werte als "id => 'native data'" zurück,
wobei "native data" sich nach dem jeweiligen Attributtyp richtet

``unsetDataFor($arrIds)`` |br|
löscht die Werte der Attribute nach dem übergebenen Array der IDs


.. _ref_api_interf_attribute_itranslated:

ITranslated Interface
.....................

Das ITranslated Interface ist für alle übersetzten Attribute.

Aktuelle Informationen unter: `ITranslated <https://github.com/MetaModels/core/blob/master/src/MetaModels/Attribute/ITranslated.php>`_

**Interfaces:**

``searchForInLanguages($strPattern, $arrLanguages = array())`` |br|
gibt die IDs der Items zurück, welche mit der Angabe des Suchmusters (inkl. Wildcads)
und dem optionalen Array an Sprachen gefunden wurden

``setTranslatedDataFor($arrValues, $strLangCode)`` |br|
setzt den Wert für ein Item in der entsprechnden Sprache

``unsetValueFor($arrIds, $strLangCode)`` |br|
löscht die Werte für das Array von Item-IDs in der entsprechnden Sprache

.. |br| raw:: html

   <br />
