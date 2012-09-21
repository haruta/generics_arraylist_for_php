<?php
namespace Test\GenericsArrayList;

use GenericsArrayList\ResourceArrayList;

class ResourceArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet()
    {
        $res1 = opendir(__DIR__);
        $res2 = opendir(__DIR__. '/..');
        $res3 = fopen(__FILE__, 'r');

        $obj = new ResourceArrayList();
        $obj->offsetSet(null, $res1);
        $obj[] = $res2;
        $obj->offsetSet(2, $res3);

        $this->assertEquals($res1, $obj->offsetGet(0));
        $this->assertEquals($res2, $obj->offsetGet(1));
        $this->assertEquals($res3, $obj->offsetGet(2));

        closedir($res1);
        closedir($res2);
        fclose($res3);
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Int()
    {
        $obj = new ResourceArrayList();
        $obj->offsetSet(null, 1);
    }
}
