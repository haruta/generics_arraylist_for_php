<?php

namespace GenericsArrayList;

use GenericsArrayList\InvalidArgumentTypeException;

abstract class AbstractGenericsArrayList
    implements \ArrayAccess, \IteratorAggregate, \Countable
{
    private $target = null;
    protected $data = array();
    protected $assert_function = null;

    public function __construct()
    {
        $this->target = $this->getTarget();
        switch ($this->target) {
            case 'int':
            case 'string':
            case 'float':
            case 'array':
            case 'bool':
            case 'resource':
                $this->assert_function = 'is_'. $this->target;
                break;
            default:
                $target = $this->target;
                $this->assert_function = function($data) use ($target) {
                    return $data instanceof $target;
                };
        }
    }

    protected function assert($data)
    {
        $assert_function = $this->assert_function;
        return $assert_function($data);
    }

    public function offsetSet($offset, $data)
    {
        if ($this->assert($data) == false) throw new InvalidArgumentTypeException('argment type must be '. $this->target);
        if ($offset === null) {
            $this->data[] = $data;
        } else {
            $this->data[$offset] = $data;
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset)) unset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->data[$offset] : null;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function count()
    {
        return count($this->data);
    }

    abstract protected function getTarget();
}
