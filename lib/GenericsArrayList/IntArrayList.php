<?php

namespace GenericsArrayList;

use GenericsArrayList\AbstractGenericsArrayList;

class IntArrayList extends AbstractGenericsArrayList
{
    protected function getTarget() { return 'int'; }
}
