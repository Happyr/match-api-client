<?php

declare(strict_types=1);

namespace HappyrMatch\ApiClient\Model;

class AbstractCollection implements \ArrayAccess, \Countable, \Iterator
{
    private $items;
    private $key;
    private $count;

    protected function setItems(array $items)
    {
        if (null !== $this->items) {
            throw new \LogicException('AbstractCollection::setItems can only be called once.');
        }

        $this->items = array_values($items);
        $this->count = count($items);
        $this->key = 0;
    }

    public function current()
    {
        return $this->items[$this->key];
    }

    public function next()
    {
        ++$this->key;
    }

    public function key()
    {
        if ($this->key >= $this->count) {
            return null;
        }

        return $this->key;
    }

    public function valid()
    {
        return $this->key < $this->count;
    }

    public function rewind()
    {
        $this->key = 0;
    }

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->items[$offset])) {
            throw new \RuntimeException(sprintf('Key "%s" does not exist in collection', $offset));
        }

        return $this->items[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw new \RuntimeException('Cannot set value on READ ONLY collection');
    }

    public function offsetUnset($offset)
    {
        throw new \RuntimeException('Cannot unset value on READ ONLY collection');
    }

    public function count()
    {
        return $this->count;
    }
}
