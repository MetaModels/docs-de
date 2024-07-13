.. _component_translations:

Symfony-Translation
===================

.. note:: Die Symfony-Translation ist ab MetaModels Version 2.3 implementiert.

Kurzinfo
--------

Die Applikationsausgaben von MetaModels in Contao werden mehrsprachig zur Verfügung gestellt. Damit sind alle
Navigationsausgaben, Bezeichnungen und Beschreibungen der Eingabewidgets, Legenden der Eingabemasken usw. gemeint
aber nicht die eingegeben "Nutzdaten". Ab MetaModels Version 2.3 übernimmt die Bereitstellung die
`Symfony-Translation <https://symfony.com/doc/current/translation.html>`_, welche sich durch verschiedene Vorteile
wie z. B. ein gutes Caching auszeichnet.

Zum Laden von neuen oder geänderten Eingaben muss der Cache Symfony-Translations gelöscht werden (s. u.).

Die Übersetzungen selbst werden über die Webseite von `Transifex <https://app.transifex.com/metamodels/>`_ gemanaged.
An der Übersetzung unserer Basissprache Englisch in andere Sprachen kann sich jeder über Transifex beteiligen.


Hintergründe
-------------

In Contao und auch MetaModels werden immer mehr native Komponenten von Symfony eingesetzt und bestehende
Eigenentwicklungen substituiert. In der MetaModels-Version 2.3 wurde die Übersetzung auf die Symfony-Komponenten
`Translation <https://symfony.com/doc/current/translation.html>`_ umgebaut und die Übersetzungen direkt im Format
XLIFF vorgehalten.

Die Symfony-Translation bietet ein sehr gutes Caching der übersetzten Texte und beschleunigt damit den Aufbau des
Backends. Dieser Cache wird - sofern nicht schon vorhanden - bei Start von Contao einmal erzeugt und steht anschließend
bei allen Aufrufen zur Verfügung.

Bei MetaModels gibt es gegenüber anderen Erweiterungen die Besonderheit, dass in MetaModels auch Eingaben gemacht werden,
welche die Anzeige im Backend betreffen - z. B. die Models in der Hauptnavigation, Name und Beschreibungen aus den
Attributen für die Eingabewidgets usw. Das hat zur Folge, dass bei Neueingaben oder Änderungen der Texte der
Translation-Cache neu aufgebaut werden muss. Die Neuerstellung erzwingt man durch das Löschen des Caches - das kann
über den Contao-Manager erfolgen oder über die Konsole.

Der Cache liegt üblicher Weise in den Ordnern

- var/cache/dev/translations
- var/cache/prod/translations

Die XLIFF-Dateien liegen nun bei den MM-Repos im Ordner ``Resources/translations/`` - einige wenige Übersetzungen,
die direkt nach Contao gereicht werden, mussten wir in ``Resources/contao/languages`` belassen.


Eigene Anpassung von Übersetzungen
----------------------------------

Bestehende eigene Übersetzungstexte, die als PHP-Array angelegt wurden, werden weiterhin geladen.

Neue Überschreibungen sollten als XLIFF-Datei angelegt werden. Den Aufbau kann man sich bei der Datei ansehen, dessen
Wert man abändern möchte. Dabei ist zu beachten, dass die XLIFF-Dateien beim DCG in Version 2.0 vorliegen und bei
MetaModels in Version 1.2 - der Aufbau unterscheidet sich etwas.

Beispiel: möchte man für Deutsch den Button "Filtern" in "Suche" umbenennen, muss eine Datei angelegt werden als

- contao/Resources/translations/metamodels_filter.de.xlf oder
- src/Resources/translations/metamodels_filter.de.xlf

mit dem Inhalt

.. code-block:: xliff
   :linenos:

   <?xml version="1.0" ?><xliff xmlns="urn:oasis:names:tc:xliff:document:1.2" version="1.2">
     <file source-language="en" datatype="plaintext" original="src/CoreBundle/Resources/translations/metamodels_filter.en.xlf" target-language="de">
       <body>
         <trans-unit id="submit" resname="submit">
           <source>Filter</source>
           <target>Suche</target>
         </trans-unit>
       </body>
     </file>
   </xliff>

Für die Übernahme nicht vergessen, den Translation-Cache zu löschen!
