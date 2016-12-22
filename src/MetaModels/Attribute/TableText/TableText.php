<?php

/**
 * This file is part of MetaModels/attribute_translatedurl.
 *
 * (c) 2012-2016 The MetaModels team.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * This project is provided in good faith and hope to be usable by anyone.
 *
 * @package    MetaModels
 * @subpackage AttributeTableText
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Andreas Isaak <info@andreas-isaak.de>
 * @author     David Maack <david.maack@arcor.de>
 * @author     David Greminger <david.greminger@1up.io>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Ingolf Steinhardt <info@e-spin.de>
 * @copyright  2012-2016 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_translatedurl/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Attribute\TableText;

use MetaModels\Attribute\BaseComplex;

/**
 * This is the MetaModelAttribute class for handling table text fields.
 */
class TableText extends BaseComplex
{
    /**
     * {@inheritdoc}
     */
    public function searchFor($strPattern)
    {
        $objValue = $this
            ->getMetaModel()
            ->getServiceContainer()
            ->getDatabase()
            ->prepare(
                sprintf(
                    'SELECT DISTINCT item_id FROM %1$s WHERE value LIKE ? AND att_id = ?',
                    $this->getValueTable()
                )
            )
            ->execute(
                str_replace(array('*', '?'), array('%', '_'), $strPattern),
                $this->get('id')
            );

        return $objValue->fetchEach('item_id');
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributeSettingNames()
    {
        return array_merge(parent::getAttributeSettingNames(), array(
            'tabletext_cols',
        ));
    }

    /**
     * Return the table we are operating on.
     *
     * @return string
     */
    protected function getValueTable()
    {
        return 'tl_metamodel_tabletext';
    }

    /**
     * {@inheritdoc}
     */
    public function getFieldDefinition($arrOverrides = array())
    {
        $arrColLabels                        = deserialize($this->get('tabletext_cols'), true);
        $arrFieldDef                         = parent::getFieldDefinition($arrOverrides);
        $arrFieldDef['inputType']            = 'multiColumnWizard';
        $arrFieldDef['eval']['columnFields'] = array();

        $countCol = count($arrColLabels);
        for ($i = 0; $i < $countCol; $i++) {
            $arrFieldDef['eval']['columnFields']['col_' . $i] = array(
                'label'     => $arrColLabels[$i]['rowLabel'],
                'inputType' => 'text',
                'eval'      => array(),
            );
            if ($arrColLabels[$i]['rowStyle']) {
                $arrFieldDef['eval']['columnFields']['col_' . $i]['eval']['style'] =
                    'width:' . $arrColLabels[$i]['rowStyle'];
            }
        }

        return $arrFieldDef;
    }

    /**
     * {@inheritdoc}
     */
    public function setDataFor($arrValues)
    {
        // Check if we have an array.
        if (empty($arrValues)) {
            return;
        }

        // Get the ids.
        $arrIds = array_keys($arrValues);
        $objDB  = $this->getMetaModel()->getServiceContainer()->getDatabase();

        // Reset all data for the ids.
        $this->unsetDataFor($arrIds);

        // Insert or update the cells.
        $strQueryUpdate = 'UPDATE %s';
        $strQueryInsert = 'INSERT INTO ' . $this->getValueTable() . ' %s';

        foreach ($arrIds as $intId) {
            // Walk every row.
            foreach ($arrValues[$intId] as $row) {
                // Walk every column and update / insert the value.
                foreach ($row as $col) {
                    if (empty($this->getSetValues($col, $intId)['value'])) {
                        continue;
                    }
                    $objDB
                        ->prepare(
                            $strQueryInsert .
                            ' ON DUPLICATE KEY ' .
                            str_replace(
                                'SET ',
                                '',
                                $objDB
                                    ->prepare($strQueryUpdate)
                                    ->set($this->getSetValues($col, $intId))
                                    ->query
                            )
                        )
                        ->set($this->getSetValues($col, $intId))
                        ->execute();
                }
            }
        }
    }

    /**
     * {@inheritdoc}
     *
     * Fetch filter options from foreign table.
     */
    public function getFilterOptions($idList, $usedOnly, &$arrCount = null)
    {
        if ($idList) {
            $objRow = $this
                ->getMetaModel()
                ->getServiceContainer()
                ->getDatabase()
                ->prepare(
                    sprintf(
                        'SELECT value, COUNT(value) as mm_count
                        FROM %1$s
                        WHERE item_id IN (%2$s) AND att_id = ?
                        GROUP BY value
                        ORDER BY FIELD(id,%2$s)',
                        $this->getValueTable(),
                        $this->parameterMask($idList)
                    )
                )
                ->execute(array_merge($idList, array($this->get('id')), $idList));
        } else {
            $objRow = $this
                ->getMetaModel()
                ->getServiceContainer()
                ->getDatabase()
                ->prepare(
                    sprintf(
                        'SELECT value, COUNT(value) as mm_count
                        FROM %s
                        WHERE att_id = ?
                        GROUP BY value',
                        $this->getValueTable()
                    )
                )
                ->execute($this->get('id'));
        }

        $arrResult = array();
        while ($objRow->next()) {
            $strValue = $objRow->value;

            if (is_array($arrCount)) {
                $arrCount[$strValue] = $objRow->mm_count;
            }

            $arrResult[$strValue] = $strValue;
        }

        return $arrResult;
    }

    /**
     * {@inheritdoc}
     */
    public function getDataFor($arrIds)
    {
        $arrWhere = $this->getWhere($arrIds);
        $objValue = $this
            ->getMetaModel()
            ->getServiceContainer()
            ->getDatabase()
            ->prepare(
                sprintf(
                    'SELECT * FROM %1$s%2$s ORDER BY row ASC, col ASC',
                    $this->getValueTable(),
                    ($arrWhere ? ' WHERE ' . $arrWhere['procedure'] : '')
                )
            )
            ->execute(($arrWhere ? $arrWhere['params'] : null));

        $arrReturn = array();
        while ($objValue->next()) {
            $arrReturn[$objValue->item_id][$objValue->row][] = $objValue->row();
        }

        return $arrReturn;
    }

    /**
     * {@inheritdoc}
     */
    public function unsetDataFor($arrIds)
    {
        $arrWhere = $this->getWhere($arrIds);

        $this
            ->getMetaModel()
            ->getServiceContainer()
            ->getDatabase()
            ->prepare(
                sprintf(
                    'DELETE FROM %1$s%2$s',
                    $this->getValueTable(),
                    ($arrWhere ? ' WHERE ' . $arrWhere['procedure'] : '')
                )
            )
            ->execute(($arrWhere ? $arrWhere['params'] : null));
    }

    /**
     * Build a where clause for the given id(s) and rows/cols.
     *
     * @param mixed    $mixIds One, none or many ids to use.
     *
     * @param int|null $intRow The row number, optional.
     *
     * @param int|null $intCol The col number, optional.
     *
     * @return array<string,string|array>
     */
    protected function getWhere($mixIds, $intRow = null, $intCol = null)
    {
        $strWhereIds = '';
        $strRowCol   = '';
        if ($mixIds) {
            if (is_array($mixIds)) {
                $strWhereIds = ' AND item_id IN (' . implode(',', $mixIds) . ')';
            } else {
                $strWhereIds = ' AND item_id=' . $mixIds;
            }
        }

        if (is_int($intRow) && is_int($intCol)) {
            $strRowCol = ' AND row = ? AND col = ?';
        }

        $arrReturn = array(
            'procedure' => 'att_id=?' . $strWhereIds . $strRowCol,
            'params' => ($strRowCol)
                ? array($this->get('id'), $intRow, $intCol)
                : array($this->get('id')),
        );

        return $arrReturn;
    }

    /**
     * {@inheritdoc}
     */
    public function valueToWidget($varValue)
    {
        if (!is_array($varValue)) {
            return array();
        }

        $arrColLabels = deserialize($this->get('tabletext_cols'), true);
        $countCol     = count($arrColLabels);
        $widgetValue  = array();

        foreach ($varValue as $k => $row) {
            for ($kk = 0; $kk < $countCol; $kk++) {
                $i = array_search($kk, array_column($row, 'col'));

                $widgetValue[$k]['col_' . $kk] = ($i !== false) ? $row[$i]['value'] : '';
            }
        }

        return $widgetValue;
    }

    /**
     * {@inheritdoc}
     */
    public function widgetToValue($varValue, $itemId)
    {
        if (!is_array($varValue)) {
            return array();
        }

        $newValue = array();
        // Start row numerator at 0.
        $intRow = 0;
        foreach ($varValue as $k => $row) {
            foreach ($row as $kk => $col) {
                $kk = str_replace('col_', '', $kk);

                $newValue[$k][$kk]['value'] = $col;
                $newValue[$k][$kk]['col']   = $kk;
                $newValue[$k][$kk]['row']   = $intRow;
            }
            $intRow++;
        }

        return $newValue;
    }

    /**
     * Calculate the array of query parameters for the given cell.
     *
     * @param array $arrCell The cell to calculate.
     *
     * @param int   $intId   The data set id.
     *
     * @return array
     */
    protected function getSetValues($arrCell, $intId)
    {
        return array(
            'tstamp'  => time(),
            'value'   => (string) $arrCell['value'],
            'att_id'  => $this->get('id'),
            'row'     => (int) $arrCell['row'],
            'col'     => (int) $arrCell['col'],
            'item_id' => $intId,
        );
    }
}
