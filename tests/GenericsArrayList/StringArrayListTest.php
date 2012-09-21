<?php
namespace Test\GenericsArrayList;

use GenericsArrayList\StringArrayList;

class StringArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet()
    {
        $obj = new StringArrayList();
        $obj->offsetSet(null, "0.0");
        $obj[] = "0.1";
        $obj->offsetSet(2, '0.2');

        $this->assertEquals('0.0', $obj->offsetGet(0));
        $this->assertEquals('0.1', $obj->offsetGet(1));
        $this->assertEquals('0.2', $obj->offsetGet(2));
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Int()
    {
        $obj = new StringArrayList();
        $obj->offsetSet(null, 1);
    }
}
