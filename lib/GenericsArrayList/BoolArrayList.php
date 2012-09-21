<?php

namespace GenericsArrayList;

use GenericsArrayList\AbstractGenericsArraylList;

class BoolArrayList extends AbstractGenericsArrayList
{
    protected function getTarget() { return 'bool'; }
}
