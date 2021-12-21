.. _rst_cookbook_tips_delete_child_items:

Automatischen löschen von Datensätzen von Kindtabellen
======================================================

Werden in MetaModels Tabellen als Kindtabellen verknüpft, so werden die (Kind)Datensätze aktuell nicht automatisch
gelöscht, wenn der entsprechende Elterndatensatz gelöscht wird. Der DC_General unterstützt zwar die Funktion "deep
delete", aber diese ist in MM noch nicht per Konfiguration für die eigenen Tabellen aktivierbar.

Diese kann aber mit einer eigenen DCA-Konfiguration je Eltern-Kind-Beziehung erstellt werden. Das bedeutet auch, dass
das Löschen Eltern-Kind-Kind-Beziehungen aktiviert werden kann. Je Stufe ist eine Datei anzulegen die entsprechend
alle Ebenen "nach unten" beinhalten muss.

Das folgende Beispiel ist für die zweistufige Hierarchie der MM-Tabellen `mm_parent` mit `mm_child` sowie
`mm_child_child`. Die DCA-Dateien müssen je nach Contao-Version in die entsprechenden Ordner - bei Contao 4.9 z. B.
in `contao/dca` (siehe `Contao Handbuch <https://docs.contao.org/dev/framework/dca/>`_).

.. code-block:: php
   :linenos:

    <?php
    // contao/dca/mm_parent.php
    $GLOBALS['TL_DCA']['mm_parent'] = [
        'dca_config' => [
            'data_provider'  => [
                'default' => [
                    'source' => 'mm_parent'
                ],
                'mm_child' => [
                    'source' => 'mm_child'
                ],
                'mm_child_child' => [
                    'source' => 'mm_child_child'
                ],
            ],
            'childCondition' => [
                [
                    'from'    => 'mm_parent',
                    'to'      => 'mm_child',
                    'setOn'   => [
                        [
                            'to_field'   => 'pid',
                            'from_field' => 'id',
                        ],
                    ],
                    'filter'  => [
                        [
                            'local'     => 'pid',
                            'remote'    => 'id',
                            'operation' => '=',
                        ],
                    ],
                    'inverse' => [
                        [
                            'local'     => 'pid',
                            'remote'    => 'id',
                            'operation' => '=',
                        ],
                    ]
                ],
                [
                    'from'    => 'mm_child',
                    'to'      => 'mm_child_child',
                    'setOn'   => [
                        [
                            'to_field'   => 'pid',
                            'from_field' => 'id',
                        ],
                    ],
                    'filter'  => [
                        [
                            'local'     => 'pid',
                            'remote'    => 'id',
                            'operation' => '=',
                        ],
                    ],
                    'inverse' => [
                        [
                            'local'     => 'pid',
                            'remote'    => 'id',
                            'operation' => '=',
                        ],
                    ]
                ],
            ],
        ]
    ];

.. code-block:: php
   :linenos:

    <?php
    // contao/dca/mm_child.php
    $GLOBALS['TL_DCA']['mm_child'] = [
        'dca_config' => [
            'data_provider'  => [
                'default' => [
                    'source' => 'mm_child'
                ],
                'mm_child_child' => [
                    'source' => 'mm_child_child'
                ],
            ],
            'childCondition' => [
                [
                    'from'    => 'mm_child',
                    'to'      => 'mm_child_child',
                    'setOn'   => [
                        [
                            'to_field'   => 'pid',
                            'from_field' => 'id',
                        ],
                    ],
                    'filter'  => [
                        [
                            'local'     => 'pid',
                            'remote'    => 'id',
                            'operation' => '=',
                        ],
                    ],
                    'inverse' => [
                        [
                            'local'     => 'pid',
                            'remote'    => 'id',
                            'operation' => '=',
                        ],
                    ]
                ],
            ],
        ]
    ];

.. |br| raw:: html

   <br />
