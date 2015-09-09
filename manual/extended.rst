Erweiterungen
=============

.. _searchable-pages:

Seitensuche (Searchable Pages)
------------------------------

Beschreibung
^^^^^^^^^^^^
Searchable Pages ist eine Erweiterung im MetaModels Core. Diese soll es
ermöglichen die Sitemap und den Suchindex von Contao so zu erweitern,
dass hier alle Detailseiten, die mit einem MetaModels erstellt wurden,
aufgenommen werden.

Benutzung
^^^^^^^^^

Was wird gebraucht:
    1. Ein Rendersetting, indem die URL zu der Detailseite gepflegt ist.
    2. Ein Filter für diese Detailseite.

Wo stelle ich die neue Funktion ein:
    Im Backend unter dem Menüpunkt MetaModels/MetaModels gibt es neben jedem MetaModels eine neues Icon. Das dritte Icon von rechts mit dem Titel „Define search settings“.
    Hier können neue Einträge erstellt werden. Hierfür muss ein Name vergeben werden, ein Rendersetting und ein Filter ausgewählt werden.

Was macht was:
    Das Rendersetting wird benutzt um die Detailseite zu ermitteln. Es werden damit keine Ausgaben gerändert.
    Die Filter werden benutzt um die URL zu erstellen. Also die eigentlichen Parameter.

.. note:: Custom URL’s die nicht von MetaModels stammen, sondern von einem Entwickler selber im Template hinterlegt wurden, werden nicht unterstützt.

.. info:: Für mehr Informationen, gibt es den :ref:`FAQ Bereich. <faq-searchable-pages>`
