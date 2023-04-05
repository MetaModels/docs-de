.. _rst_cookbook_templates_fe_template_schema_org:

Strukturierte Daten im FE-Template ausgeben
===========================================

Die MM-Daten können für eine leichtere Analyse zu ihrem Inhalt z. B. für Suchmaschinen mit s.g. "strukturierte Daten"
im Quelltext ergänzt werden. Einer der bekanntesten Kataloge für solche Auszeichnungen ist unter
`Schema.org <https://schema.org/`_ zu finden.

Die Schemata können in den Kodierungen ``RDFa``, ``Microdata`` and ``JSON-LD`` erstellt und in die Seite eingebaut
werden. Bis Contao 4.9 war die Kodierung die Contao verwendet hat ``Microdata`` - seit Contao 4.12 wird ``JSON-LD``
eingesetzt.

Für den Einbau der Auszeichnung erstellt man ein eigenes Template aus ``metamodels_prerendered.html5`` und passt dieses
so an, wie die folgenden Beispiele einer Stellenausschreibung zeigen - siehe `JobPosting <https://schema.org/JobPosting>`_.

Zum Testen der Auszeichnung kann z. B. mit folgenden Tools geprüft werden:

* `Rich-Suchergebnisse <https://search.google.com/test/rich-results>`_
* `Schema-Validierung <https://validator.schema.org/>`_

Auszeichnung mit ``Microdata``
------------------------------

.. code-block:: php
   :linenos:

   <?php if (count($this->data)): ?>
       <div class="layout_full">
           <?php foreach ($this->data as $arrKey => $arrItem): ?>
                <?php $this->block('item'); ?>
               <div class="item <?= $arrItem['class'] ?>" itemscope itemtype="https://schema.org/JobPosting">
                   <h2 itemprop="title"><?= $arrItem['text']['title'] ?></h2>
                   <div>
                       <p><strong>Location:</strong> <span itemprop="jobLocation" itemscope
                                                           itemtype="https://schema.org/Place">
                               <span itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                               <span itemprop="addressLocality"><?= $arrItem['text']['city'] ?></span>
                                   <span itemprop="addressRegion"><?= $arrItem['text']['region'] ?></span>
                               </span>
                           </span>
                       </p>
                   </div>
                   ...
               </div>
           <?php endforeach; ?>
       </div>
   <?php else : ?>
       <?php $this->block('noItem'); ?>
       <p class="info"><?= $this->noItemsMsg ?></p>
       <?php $this->endblock(); ?>
   <?php endif; ?>


Auszeichnung mit ``JSON-LD``
----------------------------

.. note:: Die Unterstützung steht erst ab Contao 4.13 mit MM 2.3 zur Verfügung.

.. code-block:: php
   :linenos:

   <?php

   use Contao\CoreBundle\Routing\ResponseContext\JsonLd\JsonLdManager;
   use Contao\System;
   use Spatie\SchemaOrg\JobPosting;
   use Spatie\SchemaOrg\Organization;
   use Spatie\SchemaOrg\Place;
   use Spatie\SchemaOrg\PostalAddress;
   use Spatie\SchemaOrg\PropertyValue;

   $jsonLdGraph     = null;
   $responseContext = System::getContainer()->get('contao.routing.response_context_accessor')->getResponseContext();
   if ($responseContext && $responseContext->has(JsonLdManager::class))
   {
       /** @var JsonLdManager $jsonLdManager */
       $jsonLdManager = $responseContext->get(JsonLdManager::class);
       $jsonLdGraph   = $jsonLdManager->getGraphForSchema(JsonLdManager::SCHEMA_ORG);
   }
   ?>
   <?php if (count($this->data)): ?>
       <div class="layout_full">
           <?php foreach ($this->data as $arrItem): ?>
               <?php
               // Build Schema.org data.
               $schemaData = (new JobPosting())
                   ->identifier((new PropertyValue())->propertyID('jobId')->value($arrItem['raw']['id']))
                   ->hiringOrganization((new Organization())->name($arrItem['text']['corporation_name']))
                   ->title($arrItem['text']['name'])
                   ->datePosted(date('Y-m-d', $arrItem['raw']['created_date']))
                   ->jobLocation((new Place())->address((new PostalAddress())->addressCountry($arrItem['text']['country'])))
                   ->description($arrItem['text']['description']);
               ?>
                <?php $this->block('item'); ?>
               <div class="item <?= $arrItem['class'] ?>">
                   <h2 itemprop="title"><?= $arrItem['text']['title'] ?></h2>
                   <div>
                       <p><strong>Location:</strong><?= $arrItem['text']['city'] ?> <?= $arrItem['text']['region'] ?>
                       </p>
                   </div>
                   ...
                   <div class="actions">
                       <?php if (null !== ($href = $arrItem['actions']['jumpTo']['href'] ?? null)) {
                           $schemaData->url($href);
                       } ?>
                       <?php foreach ($arrItem['actions'] as $action): ?>
                           <?php $this->insert('mm_actionbutton', ['action' => $action]); ?>
                       <?php endforeach; ?>
                   </div>
               </div>
               <?php /* Add Schema.org data. */ $jsonLdGraph?->add($schemaData, 'job-' . $arrItem['raw']['id']); ?>
           <?php endforeach; ?>
       </div>
   <?php else : ?>
       <?php $this->block('noItem'); ?>
       <p class="info"><?= $this->noItemsMsg ?></p>
       <?php $this->endblock(); ?>
   <?php endif; ?>

Der Einbau über ``JSON-LD`` ist zwar mit einigen Programmierzeilen verbunden, aber dafür ist die Auszeichnung aus dem
HTML-Quelltext für die Browseranzeige herausgelöst. Damit können vorhandene Templates leichter angepasst oder mit
weiteren Auszeichnungen ergänzt werden.

Wenn mehrere Datensätze an den Graphen eingefügt werden - z. B. bei einer MM-Listenausgabe - ist die Übergabe einer
eindeutigen Kennung notwendig ``$jsonLdGraph?->add($schemaData, <Unique-ID>)``.
