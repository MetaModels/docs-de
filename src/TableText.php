<?php

/**
 * This file is part of MetaModels/attribute_translatedurl.
 *
 * (c) 2012-2017 The MetaModels team.
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
 * @author     David Molineus <david.molineus@netzmacht.de>
 * @copyright  2012-2017 The MetaModels team.
 * @license    https://github.com/MetaModels/attribute_translatedurl/blob/master/LICENSE LGPL-3.0
 * @filesource
 */

namespace MetaModels\Attribute\TableText;

use Contao\System;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DBALException;
use MetaModels\Attribute\BaseComplex;
use MetaModels\IMetaModel;

/**
 * This is the MetaModelAttribute class for handling table text fields.
 */
class TableText extends BaseComplex
{
    /**
     * Database connection.
     *
     * @var Connection
     */
    private $connection;

    /**
     * Instantiate an MetaModel attribute.
     *
     * Note that you should not use this directly but use the factory classes to instantiate attributes.
     *
     * @param IMetaModel      $objMetaModel The MetaModel instance this attribute belongs to.
     *
     * @param array           $arrData      The information array, for attribute information, refer to documentation of
     *                                      table tl_metamodel_attribute and documentation of the certain attribute
     *                                      classes for information what values are understood.
     *
     * @param Connection|null $connection   The database connection.
     */
    public function __construct(IMetaModel $objMetaModel, array $arrData = [], Connection $connection = null)
    {
        parent::__construct($objMetaModel, $arrData);

        if (null === $connection) {
            // @codingStandardsIgnoreStart
            @trigger_error(
                'Connection is missing. It has to be passed in the constructor. Fallback will be dropped.',
                E_USER_DEPRECATED
            );
            // @codingStandardsIgnoreEnd
            $connection = System::getContainer()->get('database_connection');
        }

        $this->connection = $connection;
    }

    /**
     * {@inheritdoc}
     */
    public function searchFor($strPattern)
    {
        $query     = 'SELECT DISTINCT item_id FROM %1$s WHERE value LIKE :value AND att_id = :id';
        $statement = $this->connection->prepare($query);
        $statement->bindValue('value', str_replace(array('*', '?'), array('%', '_'), $strPattern));
        $statement->bindValue('id', $this->get('id'));
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_COLUMN, 'item_id');
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

        // Reset all data for the ids.
        $this->unsetDataFor($arrIds);

        foreach ($arrIds as $intId) {
            // Walk every row.
            foreach ($arrValues[$intId] as $row) {
                // Walk every column and update / insert the value.
                foreach ($row as $col) {
                    if (empty($this->getSetValues($col, $intId)['value'])) {
                        continue;
                    }

                    try {
                        $this->connection->insert($this->getValueTable(), $this->getSetValues($col, $intId));
                    } catch (DBALException $e) {
                        $this->connection->update(
                            $this->getValueTable(),
                            $this->getSetValues($col, $intId),
                            [
                                'att_id'  => $this->get('id'),
                                'item_id' => $intId
                            ]
                        );
                    }
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
        $builder = $this->connection->createQueryBuilder()
            ->select('value, COUNT(value) as mm_count')
            ->from($this->getValueTable())
            ->andWhere('att_id = :att_id')
            ->setParameter('att_id', $this->get('id'))
            ->groupBy('value');


        if ($idList) {
            $builder
                ->andWhere('item_id IN (:id_list)')

                ->orderBy('FIELD(id,:id_list)')
                ->setParameter('id_list', $idList, Connection::PARAM_INT_ARRAY);
        }

        $statement = $builder->execute();

        $arrResult = array();
        while ($objRow = $statement->fetch(\PDO::FETCH_OBJ)) {
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
        $builder  = $this->connection->createQueryBuilder()
            ->select('*')
            ->from($this->getValueTable())
            ->orderBy('row', 'ASC')
            ->addOrderBy('col', 'ASC');

        if ($arrWhere) {
            $builder->andWhere($arrWhere['procedure']);

            foreach ($arrWhere['params'] as $name => $value) {
                $builder->setParameter($name, $value);
            }
        }

        $statement = $builder->execute();
        $arrReturn = [];

        while ($row = $statement->fetch(\PDO::FETCH_ASSOC)) {
            $arrReturn[$row['item_id']][$row['row']][] = $row;
        }

        return $arrReturn;
    }

    /**
     * {@inheritdoc}
     */
    public function unsetDataFor($arrIds)
    {
        $arrWhere = $this->getWhere($arrIds);

        $builder = $this->connection->createQueryBuilder()
            ->delete($this->getValueTable());

        if ($arrWhere) {
            $builder->andWhere($arrWhere['procedure']);

            foreach ($arrWhere['params'] as $name => $value) {
                $builder->setParameter($name, $value);
            }
        }

        $builder->execute();
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
            $strRowCol = ' AND row = :row AND col = :col';
        }

        $arrReturn = array(
            'procedure' => 'att_id=:att_id' . $strWhereIds . $strRowCol,
            'params' => ($strRowCol)
                ? array('att_id' => $this->get('id'), 'row' => $intRow, 'col' => $intCol)
                : array('att_id' => $this->get('id')),
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
