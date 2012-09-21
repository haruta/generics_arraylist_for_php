<?php

namespace GenericsArrayList;

use GenericsArrayList\AbstractGenericsArraylList;

class ResourceArrayList extends AbstractGenericsArrayList
{
    protected function getTarget() { return 'resource'; }
}
