<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Yarco\FastGster\{Base, Get, Set};

class Example03
{
    use Base;

    #[Get, Set]
    private string $name;

    #[Get, Set('age > 0 and age < 120')]
    private int $age;
}

class SetTest extends TestCase
{
    protected Example03 $foo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->foo = new Example03();
    }

    public function testSimpleSet()
    {
        $this->foo->setName('Yarco Wang');
        $this->assertEquals('Yarco Wang', $this->foo->getName());
    }

    public function testAgeGuard()
    {
        $this->foo->setAge(18);
        $this->assertEquals(18, $this->foo->getAge());

        $this->expectException(\Yarco\FastGster\ValidationFailedException::class);
        // let's say, China has 5000 years old age.
        $this->foo->setAge(5000);
    }



}
