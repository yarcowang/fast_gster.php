<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class Example01
{
    use \Yarco\FastGster\Base;
}

final class BaseTest extends TestCase
{
    protected Example01 $foo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->foo = new Example01();
    }

    public function testWhenCallingNotGetSet()
    {
        $this->expectException(\Yarco\FastGster\UndefinedMethodException::class);
        $this->foo->helloWorld();
    }

    public function testWhenCallingNoGetSet()
    {
        $this->expectException(\Yarco\FastGster\UndefinedMethodException::class);
        $this->foo->getName();
    }
}
