<?php

namespace GenericsArrayList;

use GenericsArrayList\AbstractGenericsArrayList;

class StringArrayList extends AbstractGenericsArrayList
{
    protected function getTarget() { return 'string'; }
}
