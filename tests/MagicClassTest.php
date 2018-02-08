<?php

/*
 +-----------------------------------------------------------------------------+
 | PHPPackage - Magic Class - Test
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

use PHPUnit\Framework\TestCase;

class MagicClassTest extends TestCase
{
    const TEST_CLASS = 'PHPPackage\MagicClass';

    /**
     *
     */
    public function testObjectInstanceOf()
    {
        $magicClass = new MagicClass();

        $this->assertInstanceOf(self::TEST_CLASS, $magicClass);
    }

    /**
     *
     */
    public function testConstruct()
    {
        $magicClass = new MagicClass('testing', 'construct');

        // test storage property
        $this->assertClassHasAttribute('storage', self::TEST_CLASS);

        // test ArrayAccess
        $this->assertInternalType('string', $magicClass[0]);
        $this->assertInternalType('string', $magicClass[1]);
        //
        $this->assertEquals('testing', $magicClass[0]);
        $this->assertEquals('construct', $magicClass[1]);

        // test ArrayObject
        $this->assertInternalType('string', $magicClass->{0});
        $this->assertInternalType('string', $magicClass->{1});
        //
        $this->assertEquals('testing', $magicClass->{0});
        $this->assertEquals('construct', $magicClass->{1});
    }

    /**
     *
     */
    public function testArrayAccessGetterSetter()
    {
        $magicClass = new MagicClass();

        // set something keyed
        $magicClass['foo'] = 'BarBaz';
        $this->assertInternalType('string', $magicClass['foo']);
        $this->assertEquals('BarBaz', $magicClass['foo']);

        // set something indexed
        $magicClass[] = 'BarBaz';
        $this->assertInternalType('string', $magicClass[0]);
        $this->assertEquals('BarBaz', $magicClass[0]);
    }

    /**
     *
     */
    public function testArrayAccessIsset()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass['foo'] = 'BarBaz';

        // test
        $this->assertTrue(isset($magicClass['foo']));
    }

    /**
     *
     */
    public function testArrayAccessUnset()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass['foo'] = 'BarBaz';

        // check isset
        $this->assertTrue(isset($magicClass['foo']));

        // unset and check
        unset($magicClass['foo']);
        $this->assertFalse(isset($magicClass['foo']));
    }

    /**
     *
     */
    public function testMagicGetterSetter()
    {
        $magicClass = new MagicClass();

        // set something keyed
        $magicClass->foo = 'BarBaz';
        $this->assertInternalType('string', $magicClass->foo);
        $this->assertEquals('BarBaz', $magicClass->foo);

        // set something indexed
        $magicClass[] = 'BarBaz';
        $this->assertInternalType('string', $magicClass->{0});
        $this->assertEquals('BarBaz', $magicClass->{0});
    }

    /**
     *
     */
    public function testMagicIsset()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass->foo = 'BarBaz';

        // test
        $this->assertTrue(isset($magicClass->foo));
    }

    /**
     *
     */
    public function testMagicUnset()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass->foo = 'BarBaz';

        // check isset
        $this->assertTrue(isset($magicClass->foo));

        // unset and check
        unset($magicClass->foo);
        $this->assertFalse(isset($magicClass->foo));
    }

    /**
     *
     */
    public function testMagicInvoke()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass->string = 'BarBaz';

        //
        if (phpversion() >= 7) {
            $magicClass->object = new class {
                private $foo = 'BarBaz';
    
                public function getFoo()
                {
                    return $this->foo;
                }
            };
            $this->assertEquals('BarBaz', $magicClass('object')->getFoo());
        }

        // test
        $this->assertEquals('BarBaz', $magicClass('string'));
        $this->assertEquals(null, $magicClass('non_existent'));
    }

    /**
     *
     */
    public function testMagicToString()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass->string = 'BarBaz';
        
        $expected = json_encode(['string' => 'BarBaz'], JSON_PRETTY_PRINT);

        // test
        $this->assertEquals($expected, strval($magicClass));
    }

    /**
     *
     */
    public function testMagicDebugInfo()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass->string = 'BarBaz';

        // test
        $this->assertEquals(
            "PHPPackage\MagicClass Object\n(\n    [string] => BarBaz\n)\n",
            print_r($magicClass, true)
        );
    }
    
    /**
     *
     */
    public function testCount()
    {
        $magicClass = new MagicClass();

        // set something
        $magicClass->string = 'BarBaz';

        // test
        $this->assertEquals(1, $magicClass->count());
        $this->assertEquals(1, count($magicClass));
    }
}
