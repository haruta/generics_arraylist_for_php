<?php
namespace Test\GenericsArrayList;

require_once __DIR__. '/../../lib/GenericsArrayList/AbstractGenericsArrayList.php';

class AbstractGenericsArrayListTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        spl_autoload_register(function($class) {
            include_once __DIR__. '/../../lib/'. str_replace('\\', '/',$class). '.php';
        });
    }

    public function test_offsetSet_namespace()
    {
        $obj = new DateTimeArrayListForTest();
        $obj[] = new \DateTime();

        $obj = new NamespacedDateTimeArrayListForTest();
        $obj[] = new DateTime();
    }

    public function test_offsetSet_interface()
    {
        $obj = new CountableImplArrayListForTest();
        $obj[] = new CountableImpl1ForTest();
        $obj[] = new CountableImpl2ForTest();
        
        $this->assertEquals(1, $obj->offsetGet(0)->count());
        $this->assertEquals(2, $obj->offsetGet(1)->count());
    }
}

class DateTimeArrayListForTest
    extends \GenericsArrayList\AbstractGenericsArrayList
{
    protected function getTarget() { return 'datetime'; }
}

class NamespacedDateTimeArrayListForTest
    extends \GenericsArrayList\AbstractGenericsArrayList
{
    protected function getTarget() { return 'Test\GenericsArrayList\DateTime'; }
}

class CountableImplArrayListForTest
    extends \GenericsArrayList\AbstractGenericsArrayList
{
    protected function getTarget() { return 'Countable'; }
}

class DateTime
{
}

class CountableImpl1ForTest implements \Countable
{
    public function count() { return 1; }
}

class CountableImpl2ForTest implements \Countable
{
    public function count() { return 2; }
}
