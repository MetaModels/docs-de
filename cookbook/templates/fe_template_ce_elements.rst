.. _rst_cookbook_templates_fe_template_ce_elements:

FE-Templates über Content-Elemente erstellen
============================================

CE YouTube
----------

Bei komplexeren Ausgaben wie z. B. bei dem CE YouTube gibt es neben der YT-ID noch verschiedene weitere
Parameter, die eingestellt bzw. ausgegeben werden können. Man kann über das MM-Template diese CEs einbinden
und für die Ausgabe verwenden. Die Einbindung der CEs kann sowohl im Template der Rendersettings
(``metamodels_prerendered.html5``) als auch in den Templates der Attribute (``mm_attr_*.html5``) erfolgen

Folgend soll das Vorgehen anhand des CE Youtube verdeutlicht werden. Man legt ein Attribut Text an, in dem
die YT-ID gespeichert wird. Zudem erstellt man sich ein neue Template ``mm_attr_text_video_yt.html5``, welches
bei den Attributseinstellungen in den Rendersettings ausgewählt wird.

In dem Template folgenden Code eingeben:

.. code-block:: php
   :linenos:

   <?php
   $contentData['type']           = 'youtube';
   $contentData['youtube']        = $this->raw . '?rel=0';
   $contentData['youtubeOptions'] = serialize(['youtube_nocookie']);
   $contentData['playerSize']     = serialize(['560', '315']);
   $contentData['playerAspect']   = '16:9';

   $model = new ContentModel();
   $model->setRow($contentData);

   $content = new ContentYouTube($model);

   echo $content->generate();


Damit ist das Grundgerüst schon fertig gestellt und kann nach Bedarf weiter ausgebaut werden. Die möglichen
Parameter kann man aus den Element-Klassen von Contao ermitteln -
z. B. `ContentYouTube <https://github.com/contao/contao/blob/6cfb659affeb526539d776b430bcafa4b0324849/core-bundle/src/Resources/contao/elements/ContentYouTube.php>`_.

Die Parameter können wie in dem Beispiel fest eingetragen werden - möglich wäre aber auch, Werte aus weiteren Attributen
einzubinden über ``$this->row['yt_aspect']`` im Attribut-Template oder ``$arrItem['text']['yt_aspect']`` im Template der
Rendersettings.

Bei den Rendersettings wäre auch eine Eingabe über die Parameter des CE/FE-Modul möglich -
siehe :ref:`rst_cookbook_templates_fe_list_parameters`.

Für eine kompakte Darstellung und Eingabe in der Eingabemaske, könnte man sich auch mit dem MCW-Attribut eine
einzeilige "Multi-Eingabe" erstellen - siehe :ref:`rst_extended_attribute_mcw`.


FE-Modul RockSolid Slider
-------------------------

Möchte man vorgefertigte Slider wie beim `RockSolid Slider <https://rocksolidthemes.com/de/contao/plugins/responsive-slider>`_
als Inhalt in MM ausgeben, gibt es wie immer verschiedene Wege - folgend einer als Anregung:

Zunächst wird ein Slider z. B. als Bilderslider über den entsprechenden Navigationspunkt im BE angelegt und die
gewünschten Bilder ausgewählt. Zur Vereinfachung der Konfigurationseinstellungen legt man weiterhin ein FE-Modul
vom Typ "RockSolid Slider" an und nimmt dort die gewünschten Einstellungen zu Größe, Animation, Navigation usw. vor
- die ID des FE-Moduls z. B. ``55`` wird dann im Template noch benötigt.

In MM legt man ein Attribut vom Typ Einzelauswahl [Select] mit den folgenden Einstellungen an:

* Quelltabelle: tl_rocksolid_slider
* ID-Spalte: id
* Werte-Spalte: name
* Alias-Spalte: id
* Auswahl-Sortierung: name

Damit kann später ein Slider in der Eingabemaske ausgewählt werden in der natürlich das Attribut eingebunden wird.

Zudem wird ein eigenes Template z. B. ``mm_attr_select_rst_slider.html5`` mit folgendem Inhalt angelegt:

.. code-block:: php
   :linenos:

   <?php
   $moduleData['type']                      = 'rocksolid_slider';
   $moduleData['rsts_id']                   = $this->raw['id'];
   $moduleData['rsts_import_settings']      = 1;
   $moduleData['rsts_import_settings_from'] = 55;

   $model = new ModuleModel();
   $model->setRow($moduleData);

   $module = new MadeYourDay\RockSolidSlider\Module\Slider($model);

   echo $module->generate();

Der Typ muss unbedingt angegeben werden, damit die passenden CSS-Klassen für den Slider in den Quelltext kommen; die
``55`` ist die Modul-ID der Einstellungen.

In den Rendersettings für die Ausgabe wird das Attribut ebenfalls eingebunden und bei den Attributseinstellungen das
Template ``mm_attr_select_rst_slider`` ausgewählt.
