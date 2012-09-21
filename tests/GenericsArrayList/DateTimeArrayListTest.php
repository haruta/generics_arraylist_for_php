<?php
namespace Test\GenericsArrayList;

use GenericsArrayList\DateTimeArrayList;

class DateTimeArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet()
    {
        $d1 = new \DateTime();
        $d2 = new \DateTime();
        $d3 = new \DateTime();

        $obj = new DateTimeArrayList();
        $obj->offsetSet(null, $d1);
        $obj[] = $d2;
        $obj->offsetSet(2, $d3);

        $this->assertEquals($d1, $obj->offsetGet(0));
        $this->assertEquals($d2, $obj->offsetGet(1));
        $this->assertEquals($d3, $obj->offsetGet(2));
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Int()
    {
        $obj = new DateTimeArrayList();
        $obj->offsetSet(null, 1);
    }
}
