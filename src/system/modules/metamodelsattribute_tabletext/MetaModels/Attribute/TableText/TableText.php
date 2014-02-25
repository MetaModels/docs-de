<?php

/**
 * The MetaModels extension allows the creation of multiple collections of custom items,
 * each with its own unique set of selectable attributes, with attribute extendability.
 * The Front-End modules allow you to build powerful listing and filtering of the
 * data in each collection.
 *
 * PHP version 5
 * @package     MetaModels
 * @subpackage  AttributeTableText
 * @author      David Maack <david.maack@arcor.de>
 * @copyright   The MetaModels team.
 * @license     LGPL.
 * @filesource
 */

namespace MetaModels\Attribute\TableText;

use MetaModels\Attribute\BaseComplex;

/**
 * This is the MetaModelAttribute class for handling table text fields.
 *
 * @package	   MetaModels
 * @subpackage AttributeTableText
 * @author     David Maack <david.maack@arcor.de>
 */
class TableText extends BaseComplex
{
	/**
	 * {@inheritdoc}
	 */
	public function searchFor($strPattern)
	{
		// Base implementation, do a simple search on given column.
		$strQuery = 'SELECT DISTINCT item_id
			FROM ' . $this->getValueTable() . '
			WHERE value LIKE ? AND att_id = ?';

		$objValue = Database::getInstance()
			->prepare($strQuery)
			->executeUncached(
				str_replace(array('*', '?'), array('%', '_'), $strPattern),
				$this->get('id')
			);

		return $objValue->fetchEach('item_id');
	}

	public function getAttributeSettingNames()
	{
		return array_merge(parent::getAttributeSettingNames(), array(
			'tabletext_cols'
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
		$arrColLabels = deserialize($this->get('tabletext_cols'), true);
		$arrFieldDef=parent::getFieldDefinition($arrOverrides);
		$arrFieldDef['inputType'] = 'multiColumnWizard';
		$arrFieldDef['eval']['columnFields'] = array();

		for ($i = 0; $i < count($arrColLabels); $i++)
		{
			$arrFieldDef['eval']['columnFields']['col_'.$i] = array
			(
				'label'			=> $arrColLabels[$i]['rowLabel'],
				'inputType'		=> 'text',
				'eval'			=> array(),
			);
			if ($arrColLabels[$i]['rowStyle']) {
				$arrFieldDef['eval']['columnFields']['col_'.$i]['eval']['style'] = 'width:'.$arrColLabels[$i]['rowStyle'];
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
		if(empty($arrValues))
		{
			return;
		}

		$objDB = \Database::getInstance();
		// get the ids
		$arrIds = array_keys($arrValues);
		$strQueryUpdate = 'UPDATE %s';

		// insert or Update the cells
		$strQuery = 'INSERT INTO ' . $this->getValueTable() . ' %s';
		foreach ($arrIds as $intId)
		{
			//delete missing rows
			if (empty($arrValues[$intId]))
			{
				// No values give, delete all values.
				$strDelQuery = 'DELETE FROM ' . $this->getValueTable() . ' WHERE att_id=? AND item_id=?';

				$objDB
					->prepare($strDelQuery)
					->execute(intval($this->get('id')), $intId);
				continue;
			}

			// We have some values, delete the missing ones.
			$rowIds		 = array_keys($arrValues[$intId]);
			$strDelQuery = 'DELETE FROM ' . $this->getValueTable() . ' WHERE att_id=? AND item_id=? AND row NOT IN (' . implode(',', $rowIds) . ')';

			$objDB
				->prepare($strDelQuery)
				->execute(intval($this->get('id')), $intId);

			//walk every row
			foreach ($arrValues[$intId] as $k => $row)
			{
				//walk every column and update / insert the value
				foreach ($row as $kk => $col)
				{
					$objDB->prepare($strQuery . ' ON DUPLICATE KEY ' . str_replace('SET ', '', $objDB->prepare($strQueryUpdate)->set($this->getSetValues($col, $intId))->query))
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
	public function getFilterOptions($arrIds, $usedOnly, &$arrCount = null)
	{
		if ($arrIds)
		{
			// Ensure proper integer ids for SQL injection safety reasons.
			$strIdList = implode(',', array_map('intval', $arrIds));

			$strSql = 'SELECT value, COUNT(value) as mm_count
				FROM ' . $this->getValueTable() . '
				WHERE item_id IN (' . $strIdList . ') AND att_id = ?
				GROUP BY value
				ORDER BY FIELD(id,' . $strIdList . ')';

			$objRow = Database::getInstance()
				->prepare($strSql)
				->executeUncached($this->get('id'));
		}
		else
		{
			$strSql = 'SELECT value, COUNT(value) as mm_count
				FROM ' . $this->getValueTable() . '
				WHERE att_id = ?
				GROUP BY value';

			$objRow = Database::getInstance()
				->prepare($strSql)
				->executeUncached($this->get('id'));
		}

		$arrResult = array();
		while ($objRow->next())
		{
			$strValue = $objRow->value;

			if (is_array($arrCount))
			{
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
		$objDB = \Database::getInstance();

		$arrWhere = $this->getWhere($arrIds);
		$strQuery = 'SELECT * FROM ' . $this->getValueTable() . ($arrWhere ? ' WHERE ' . $arrWhere['procedure'] : ''). ' ORDER BY row ASC, col ASC';
		$objValue = $objDB->prepare($strQuery)
			->executeUncached(($arrWhere ? $arrWhere['params'] : null));

		$arrReturn = array();
		while ($objValue->next())
		{
			$arrReturn[$objValue->item_id][$objValue->row][] = $objValue->row();
		}

		return $arrReturn;
	}

	/**
	 * {@inheritdoc}
	 */
	public function unsetDataFor($arrIds)
	{
		$objDB = \Database::getInstance();

		$arrWhere = $this->getWhere($arrIds);
		$strQuery = 'DELETE FROM ' . $this->getValueTable() . ($arrWhere ? ' WHERE ' . $arrWhere['procedure'] : '');

		$objDB->prepare($strQuery)
			->execute(($arrWhere ? $arrWhere['params'] : null));
	}



	/**
	 * Build a where clause for the given id(s) and rows/cols.
	 *
	 * @param mixed  $mixIds        one, none or many ids to use.
	 * @param int    $intRow        the row number, optional
	 * @param int    $intCol        the col number, optional
	 * @return string
	 */
	protected function getWhere($mixIds, $intRow = null, $intCol = null)
	{
		$strWhereIds = '';
		$strRowCol = '';
		if ($mixIds)
		{
			if (is_array($mixIds))
			{
				$strWhereIds = ' AND item_id IN (' . implode(',', $mixIds) . ')';
			} else {
				$strWhereIds = ' AND item_id='. $mixIds;
			}
		}

		if (is_int($intRow) && is_int($intCol))
		{
			$strRowCol = ' AND row = ? AND col = ?';
		}

		$arrReturn = array(
			'procedure' => 'att_id=?' . $strWhereIds.$strRowCol,
			'params' => ($strRowCol)? array(intval($this->get('id')), $intRow, $intCol) : array(intval($this->get('id')))
		);

		return $arrReturn;
	}


	/**
	 * {@inheritdoc}
	 */
	public function valueToWidget($varValue)
	{
		if (!is_array($varValue)) return array();
		$widgetValue = array();
		foreach ($varValue as $row)
		{
			foreach ($row as $key => $col)
			{
				$widgetValue[$col['row']]['col_'.$key] = $col['value'];
			}
		}
		return $widgetValue;
	}

	/**
	 * {@inheritdoc}
	 */
	public function widgetToValue($varValue, $intId)
	{
		if (!is_array($varValue)) return null;
		$newValue = array();
		foreach ($varValue as $k => $row)
		{
			foreach ($row as $kk => $col)
			{
				$kk = str_replace('col_', '', $kk);
				$newValue[$k][$kk]['value'] = $col;
				$newValue[$k][$kk]['col'] = $kk;
				$newValue[$k][$kk]['row'] = $k;
			}
		}
		return $newValue;
	}

	protected function getSetValues($arrCell, $intId)
	{
		return array
		(
			'tstamp' => time(),
			'value' => (string)$arrCell['value'],
			'att_id' => $this->get('id'),
			'row' => (int)$arrCell['row'],
			'col' => (int)$arrCell['col'],
			'item_id' => $intId,
		);
	}
}
