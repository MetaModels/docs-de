Dummy filter
============


.. php:class:: Example\MetaModels\Filter\DummyFilter

  Datetime class

  .. php:method:: getMatchingIds()

      Fetch the ids for all matches for this filter rule.

      If no entries have been found, the result is an empty array.
      If no filtering was applied and therefore all ids shall be reported as valid, the return value of NULL is
      allowed.

      :returns: int[]|null.
