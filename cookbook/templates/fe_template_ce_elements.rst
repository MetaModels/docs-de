.. _rst_cookbook_templates_fe_template_ce_elements:

FE-Templates über Content-Elemente erstellen
============================================

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
