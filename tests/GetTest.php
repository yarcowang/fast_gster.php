<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use \Yarco\FastGster\{Base, Get};

class Example02
{
    use Base;

    #[Get]
    private string $noName;

    #[Get]
    private ?string $nullName = null;

    #[Get]
    private string $name;

    public function __construct($_name)
    {
        $this->name = $_name;
    }
}

final class GetTest extends TestCase
{
    protected Example02 $foo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->foo = new Example02('hello');
    }

    public function testOnNoName()
    {
        $this->expectException(Error::class);
        $this->foo->getNoName();
    }

    public function testOnNullName()
    {
        $this->assertNull($this->foo->getNullName());
    }

    public function testOnName()
    {
        $this->assertEquals('hello', $this->foo->getName());
    }

}