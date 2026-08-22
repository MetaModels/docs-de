.. _component_index:

Komponenten eines MetaModel
===========================

In den folgenden Kapiteln soll der Aufbau von MetaModels aufgezeigt werden, um die "Logik"
des Aufbaus der Erweiterung zu verstehen.

Zunächst eine Einordnung von zwei Begriffen: mit **MetaModel** (Singular) soll im
Folgenden eine Datentabelle mit ihren Attributen, Ein-/Ausgabe-Möglichkeiten,
Filtern usw. bezeichnet werden. Ein MetaModel wird in den folgenden Texten 
ohne "s" geschrieben, auch wenn dies z.B. durch den Genitiv erforderlich wäre.

Der Begriff **MetaModels** (Plural) steht allein als Bezeichnung für das
Erweiterungspaket für Contao.

Für Neu- oder Wiedereinsteiger in MetaModels ist es möglicher Weise etwas schwierig, einen passenden Arbeitsablauf für
die Erstellung zu finden. Für diese Zielgruppe gibt es einen :ref:`einfachen Arbeitsablauf für den Umgang mit MetaModels
<component_workflow>`. Dort sind auch einige :ref:`Tipps für den Start <component_workflow_tips>` sowie eine
:ref:`Übersicht, mit welchen Attributen man was speichern kann <component_data-in-attributes>`.

Bevor man sich an die Erstellung komplexerer Datenstrukturen in MetaModels macht, sollte man sich unbedingt
Gedanken über einen "eleganten" Aufbau - insbesondere der Relationen der Models untereinander - machen. Dazu gibt es
eine Übersichtsseite ":ref:`component_relations`".

Nach dem Erstellen eines MetaModel stehen die folgenden Hauptkomponenten zur Bearbeitung zur Verfügung:

 |svg_fields_22| |img_fields|  :ref:`component_attribute` |br|
 |svg_rendersettings_22| |img_rendersettings|  :ref:`component_rendersettings` |br|
 |svg_dca_22| |img_dca|  :ref:`component_dca` |br|
 |svg_searchable_pages_22| |img_searchable_pages|  :ref:`component_searchable-pages` |br|
 |svg_filter_22| |img_filter|  :ref:`component_filter` |br|
 |svg_dca_combine_22| |img_dca_combine|  :ref:`component_dca-combine`

Bei der Erstellung eines (einfachen) MetaModel können die Komponenten in der aufgeführten 
Reihenfolge abgearbeitet werden. Mit zunehmender Komplexität des MetaModels - also im
Zusammenspiel mehrerer MetaModel miteinander - kommt man nicht umhin, einzelne Eingaben
in einem vorhandenen MetaModel weiter zu ergänzen oder abzuändern.

Neben den Hauptkomponenten gibt es weitere Einstellungsmöglichkeiten wie das Anlegen von Gruppierung/Sortierung der Items
in einer BE-Liste oder :ref:`Anzeigebedingungen der Eingabewidgets einer Eingabemaske <component_dca_visibility-conditions>`.

.. _rst_component_index_mm_lageplan:
Für eine leichtere Übersicht wo was zu finden ist, gibt es den
:download:`"MM-Lageplan" </_download/MM_Lageplan_e-spin-Berlin.pdf>` zum Download.

Mit der Erweiterung MetaModels erhält Contao jeweils zwei neue Inhaltselemente und Module
für die Frontendausgabe. Mit dem Inhaltselement/Modul "MetaModel-Liste" können
Datensätze einzeln oder als Liste auf der Webseite ausgegeben werden und mit dem
Inhaltselement/Modul "MetaModel-Frontendfilter" steht ein Filter für das Frontend
zur Verfügung - mehr dazu unter :ref:`component_contentelements`.

Wie die einzelnen Templates zusammenwirken, ist auf der Seite zu den :ref:`component_templates` aufgeführt.

MetaModels ist sehr gut auf die Arbeit mit mehrsprachigen Inhalten ausgerichtet -
:ref:`mehr zur Mehrsprachigkeit in MM. <component_multi-language>`

Um einzelne Werte eines Datensatzes (Item) oder die Anzahl aller Datensätze im Contao-Kontext
auszugeben, stehen verschiedene :ref:`Insert-Tags <component_inserttags>` zur Verfügung.


.. toctree::
    :hidden:
    :maxdepth: 1

    workflow
    new-mm
    attribute
    rendersettings
    dca
    dca-visibility-conditions
    searchable-pages
    filter
    dca-combine
    contentelements
    relations
    schema-manager
    translations
    templates
    data-in-attributes
    multi-language
    inserttags

.. |br| raw:: html

   <br />
   
.. |nbsp| unicode:: 0xA0 
   :trim:

.. |img_fields| image:: /_img/icons/fields.png
.. |svg_fields_22| image:: /_img/icons_svg/fields.svg
   :width: 22px
.. |img_rendersettings| image:: /_img/icons/rendersettings.png
.. |svg_rendersettings_22| image:: /_img/icons_svg/rendersettings.svg
   :width: 22px
.. |img_dca| image:: /_img/icons/dca.png
.. |svg_dca_22| image:: /_img/icons_svg/dca.svg
   :width: 22px
.. |img_searchable_pages| image:: /_img/icons/searchable_pages.png
.. |svg_searchable_pages_22| image:: /_img/icons_svg/searchable_pages.svg
   :width: 22px
.. |img_filter| image:: /_img/icons/filter.png
.. |svg_filter_22| image:: /_img/icons_svg/filter.svg
   :width: 22px
.. |img_dca_combine| image:: /_img/icons/dca_combine.png
.. |svg_dca_combine_22| image:: /_img/icons_svg/dca_combine.svg
   :width: 22px
