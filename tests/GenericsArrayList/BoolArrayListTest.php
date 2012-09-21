<?php
namespace Test\GenericsArrayList;

use GenericsArrayList\BoolArrayList;

class BoolArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet()
    {
        $obj = new BoolArrayList();
        $obj->offsetSet(null, true);
        $obj[] = false;
        $obj->offsetSet(2, true);

        $this->assertTrue($obj->offsetGet(0));
        $this->assertFalse($obj->offsetGet(1));
        $this->assertTrue($obj->offsetGet(2));
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Int()
    {
        $obj = new BoolArrayList();
        $obj->offsetSet(null, 1);
    }
}
