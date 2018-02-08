<?php
/*
 +-----------------------------------------------------------------------------+
 | PHPPackage - Magic Class
 +-----------------------------------------------------------------------------+
 | Copyright (c)2018 (http://github.com/phppackage/magicclass)
 +-----------------------------------------------------------------------------+
 | This source file is subject to MIT License
 | that is bundled with this package in the file LICENSE.
 |
 | If you did not receive a copy of the license and are unable to
 | obtain it through the world-wide-web, please send an email
 | to lawrence@cherone.co.uk so we can send you a copy immediately.
 +-----------------------------------------------------------------------------+
 | Authors:
 |   Lawrence Cherone <lawrence@cherone.co.uk>
 +-----------------------------------------------------------------------------+
 */

namespace PHPPackage;

use ArrayAccess;
use ArrayObject;
use Countable;

class MagicClass implements ArrayAccess, Countable
{
    /**
     * @var ArrayObject
     */
    private $storage;

    /**
     * @param array $arguments
     */
    public function __construct(...$arguments)
    {
        $this->storage = new ArrayObject($arguments);
        $this->storage->setFlags(
            ArrayObject::STD_PROP_LIST | ArrayObject::ARRAY_AS_PROPS
        );
    }

    /**
     * ArrayAccess offsetGet (getter).
     *
     * @param string $index
     */
    public function offsetGet($index)
    {
        return isset($this->storage->{$index}) ? $this->storage->{$index} : null;
    }

    /**
     * ArrayAccess offsetSet (setter).
     *
     * @param string $index
     * @param mixed  $value
     */
    public function offsetSet($index, $value)
    {
        if (is_null($index)) {
            $this->storage[] = $value;
        } else {
            $this->storage->{$index} = $value;
        }
    }

    /**
     * ArrayAccess offsetExists (isset).
     *
     * @param string $index
     */
    public function offsetExists($index)
    {
        return isset($this->storage->{$index});
    }

    /**
     * ArrayAccess offsetUnset (unset).
     *
     * @param string $index
     */
    public function offsetUnset($index)
    {
        unset($this->storage->{$index});
    }

    /**
     * Magic method (getter).
     *
     * @param string $index
     */
    public function __get($index)
    {
        return $this->storage->{$index};
    }

    /**
     * Magic method (setter).
     *
     * @param string $index
     * @param mixed  $value
     */
    public function __set($index, $value)
    {
        $this->storage->{$index} = $value;
    }

    /**
     * Magic method (isset).
     *
     * @param string $index
     */
    public function __isset($index)
    {
        return isset($this->storage->{$index});
    }

    /**
     * Magic method (unset).
     *
     * @param string $index
     */
    public function __unset($index)
    {
        unset($this->storage->{$index});
    }

    /**
     * Magic method (as function invoker).
     *
     * @param mixed  $arguments
     */
    public function __invoke(...$arguments)
    {
        if (isset($this->storage->{$arguments[0]})) {
            return $this->storage->{$arguments[0]};
        }
    }

    /**
     * Magic method (toString well json).
     */
    public function __toString()
    {
        $return = [];
        foreach ($this->storage as $key => $value) {
            $return[$key] = $value;
        }
        return json_encode($return, JSON_PRETTY_PRINT);
    }

    /**
     * Magic method (overide print_r/var_dump).
     */
    public function __debugInfo()
    {
        $return = [];
        foreach ($this->storage as $key => $value) {
            $return[$key] = $value;
        }
        return $return;
    }

    /**
     * Implements Countable
     */
    public function count()
    {
        return $this->storage->count();
    }

}
