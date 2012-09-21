<?php
namespace Test\GenericsArrayList;

use GenericsArrayList\IntArrayList;

class IntArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet()
    {
        $obj = new IntArrayList();
        $this->assertNull($obj->offsetSet(null, 1));
        $this->assertEquals(1, $obj->offsetGet(0));
        $this->assertEquals(1, $obj->count());

        $obj[] = 2;
        $this->assertEquals(2, $obj[1]);
        $this->assertEquals(2, $obj->count());
    }

    public function test_offsetExists()
    {
        $obj = new IntArrayList();
        $obj[] = 100;
        $this->assertTrue($obj->offsetExists(0));
        $this->assertFalse($obj->offsetExists(1));

        $obj[2] = 200;
        $this->assertTrue($obj->offsetExists(2));
        $this->assertFalse($obj->offsetExists(1));

        $obj->offsetSet(2, 300);
        $this->assertTrue($obj->offsetExists(2));
        $this->assertFalse($obj->offsetExists(1));
    }

    public function test_offsetUnset()
    {
        $obj = new IntArrayList();
        $obj[] = 1;
        $this->assertTrue($obj->offsetExists(0));

        $obj->offsetUnset(0);
        $this->assertFalse($obj->offsetExists(0));
        $this->assertEquals(0, $obj->count());

        $obj[2] = 1;
        $this->assertTrue($obj->offsetExists(2));

        $obj->offsetUnset(2);
        $this->assertFalse($obj->offsetExists(2));
        $this->assertEquals(0, $obj->count());
    }

    public function test_offsetGet()
    {
        $obj = new IntArrayList();
        $obj[] = 100;
        $obj[1] = 200;
        $obj->offsetSet(2, 300);

        $this->assertEquals(100, $obj[0]);
        $this->assertEquals(200, $obj->offsetGet(1));
        $this->assertEquals(300, $obj->offsetGet(2));
    }

    public function test_count()
    {
        $obj = new IntArrayList();
        $obj[] = 100;
        $obj[1] = 200;
        $obj->offsetSet(2, 300);

        $this->assertEquals(3, $obj->count());
    }

    public function test_getIterator()
    {
        $obj = new IntArrayList();
        $obj[] = 100;
        $obj[1] = 200;
        $obj->offsetSet(2, 300);

        $it = $obj->getIterator();
        foreach ($it as $k => $v) {
            $this->assertEquals($obj->offsetGet($k), $v);
        }
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Float()
    {
        $obj = new IntArrayList();
        $obj->offsetSet(null, 0.1);
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_String()
    {
        $obj = new IntArrayList();
        $obj->offsetSet(null, 'test');
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_Null()
    {
        $obj = new IntArrayList();
        $obj->offsetSet(null, null);
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_resource()
    {
        $resource = opendir(__DIR__);
        $obj = new IntArrayList();
        $obj->offsetSet(null, $resource);
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_bool()
    {
        $obj = new IntArrayList();
        $obj->offsetSet(null, true);
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_array()
    {
        $obj = new IntArrayList();
        $obj->offsetSet(null, array());
    }

    /**
     * @expectedException GenericsArrayList\InvalidArgumentTypeException
     */
    public function test_offsetSet_object()
    {
        $obj = new IntArrayList();
        $obj->offsetSet(null, new \StdClass());
    }
}
