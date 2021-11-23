<?php declare(strict_types=1);



use PHPUnit\Framework\TestCase;
use controller\Layout as layout;


final class layoutTest extends TestCase
{
    public function testCanBeCreatedFromValidEmailAddress(): void
    {
        $this->assertInstanceOf(
            layout::class,
            layout::fromString('user@example.com')
        );
    }

    public function testCannotBeCreatedFromInvalidEmailAddress(): void
    {
        $this->expectException(InvalidArgumentException::class);

        layout::fromString('invalid');
    }

    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            layout::fromString('user@example.com')
        );
    }
}