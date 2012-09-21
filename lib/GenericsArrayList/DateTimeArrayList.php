<?php

namespace GenericsArrayList;

use GenericsArrayList\AbstractGenericsArraylList;

class DateTimeArrayList extends AbstractGenericsArrayList
{
    protected function getTarget() { return '\DateTime'; }
}
