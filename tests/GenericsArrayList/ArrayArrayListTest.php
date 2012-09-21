<?php
namespace Test\GenericsArrayList;

use GenericsArrayList\ArrayArrayList;

class ArrayArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet()
    {
        $obj = new ArrayArrayList();
        $obj->offsetSet(null, array(1));
        $obj[] = array();
        $obj->offsetSet(2, array(array(1)));

        $this->assertEquals(array(1), $obj->offsetGet(0));
        $this->assertEquals(array(), $obj->offsetGet(1));
        $this->assertEquals(array(array(1)), $obj->offsetGet(2));
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Int()
    {
        $obj = new ArrayArrayList();
        $obj->offsetSet(null, 1);
    }
}
