# MetaModels

## Install with composer

You’ll need metamodels core and some attributes / filter to get metamodels running. So choose in you composer
```metamodels/core``` an ```metamodels/bundle_all``` to install the core and all bundles and filters. Don’t forget to run the composer install through „Update packages“. 
When installed, run the database update and your MetaModels installation is done.

Hint: If you know that you don’t need all attributes and / or filter you can install every single  package by it’s own.

## Your first MetaModel

### Create MetaModels
To get started with MetaModels we need at least one MetaModel, jai! We will build a small MetaModel, non translated, MetaModel for real estate references.

In our example we need two MetaModels:

- reference (the MetaModel which contain the real estate objects)
- category (the MetaModel to define categories for references)

Create reference and category metamodels.

### Create attributes

An (empty) MetaModel is just a container for your data objects. But before you can store data in your MetaModel, you need to define some types of data which you like to store.

In MetaModels there are several „attributes“ to store different kind of data. Most of the time you need at least a text attribute (e.g. to store a name).

#### mm_reference
Our reference will contain these attributes:

* Name (text)
* Alias (alias)
* Description (longtext)
* Category (multiple select)
* Highlight-Picture (file)
* Picture Gallery (file, multiselect)

**Name**

Attribute Type: text 
Column Name: name
Name: Name
Description: Name of reference

**Alias**

The alias is an (optional) unique Name / identifier for the data record.

Attribute Type: alias 
Column Name: alias
Name: Alias
Unique: Yes
Description: Alias of reference
Alias-Fields: Name [text]

**Description**

Attribute Type: longtext 
Column Name: description
Name: Description
Description: Description of reference

**Category**

Attribute Type: multi select
Column Name: category
Name: Category
Description: Select a category for the reference

Database table: mm_category

Currently, we haven’t added attributes to our mm_category MetaModel. So for the moment leave the other selects blank, we’ll get back later.

**Highlight picture**

Attribute type: file
column name: picture_highlight
Name: Highlight picture

Customize filetree (optional): select a „content“ folder where the reference pictures are stored

**Gallery**

Attribute type: file
column name: picture_gallery
Name: Gallery

Customize filetree (optional): select a „content“ folder where the reference gallery pictures are stored

multiselect: yes

#### mm_category

For our categorie MetaModel we just need three attributes:

* name (text; „name“)
* alias (alias; „alias“)
* description (longtext; „description“)

Create the attributes as learned in the reference MetaModel.

#### Select configuration

Early, we introduced in our „reference“ MetaModel a select attribute but leaved it’s configuration nearly blank.

The real power of MetaModel gets obvious here. With a simple select attribute you can easily connect MetaModels (or any other sql-table) and optional filter the objects. Filter? Later.

Edit the „multi select“ attribute in your „References“. 

Choose: 

table: mm_category
Name: name - text
Alias: alias - alias
Sorting: sorting

## Create Rendersettings

For now, we have two MetaModel with some attributes and a link between booth. But we didn’t want just to store some data, we also like to display them.

A render setting contains some global settings, attributes you like to display and there settings.
s
No matter if you like to display data in the backend or fronted you need at least one render setting. But we recommend to create at least one setting for the backend and one for the frontend.

*Hint: Prefix your render setting name with BE / FE for easy relocating*.

*Info: It’s necessary to define one render setting as default one*

**Basic-settings**

*Template*: MetaModels provides a set of well organized, solid templates. There are templates for each render setting ( e.g. metamodel_prerendered). You can create your own templates the contao why (Backend > Templates > Create > select the template you like to overwrite > Save (maybe with a new / name addition) > Edit > Choose)

metamodel_prerendered - All attributes are rendered with there template and settings (if available)
metamodel_unrendered - All attributes are rendered in „raw“ to the frontend (the settings of the child attributes are ignored)

*Output Format:*
* HTML 5 - 
* XHTML - 
* Text - Just the „content“

**Jump-to-Page**

The jump-to-page comes into the game when we like to display our references as list with a detail link to one item.
So you need to define a jump-to-page where the user gets redirected if he clicks on a „detail“ link of one of our reference objects.

The filter setting define the rules for the target, your detail page. 

*Info: Set filter settings for list views*

(todo: MetaModel Advanced, just one jump-to-page for multiple languages) 

### Create a rendersetting (backend)

Go to the „render settings“ of „reference“.
* Create a render setting called „BE: references“
* Add „all attributes“ 
* After adding, activate „name“ + „category“

*Info: When you (later) add attributes to your MetaModel you need to add them also in your render setting.*

### Create a rendersetting (frontend list)

Go to the „render settings“ of „reference“.
* Create a render setting called „FE: references list“
* Add „all attributes“ 
* After adding, activate „name“, „category“, „picture_highlight“

### Create a rendersetting (frontend detail)

Go to the „render settings“ of „reference“.
* Create a render setting called „FE: reference detail“
* Add „all attributes“ 
* After adding, activate „name“, „description“, „category“, „picture_highlight“, „picture_gallery“

## Input Screens
