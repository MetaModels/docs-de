<?php

namespace Example\MetaModels\Filter;

use MetaModels\Filter\IFilterRule;

/**
 * This example filter never returns anything.
 *
 * @package Example\MetaModels\Filter
 */
class DummyFilter implements IFilterRule
{
    /**
     * Fetch the ids for all matches for this filter rule.
     *
     * If no entries have been found, the result is an empty array.
     * If no filtering was applied and therefore all ids shall be reported as valid, the return value of NULL is
     * allowed.
     *
     * @return int[]|null
     */
    public function getMatchingIds()
    {
        return array();
    }
}
