<?php

namespace GenericsArrayList;

use GenericsArrayList\AbstractGenericsArrayList;

class ArrayArrayList extends AbstractGenericsArrayList
{
    protected function getTarget() { return 'array'; }
}
