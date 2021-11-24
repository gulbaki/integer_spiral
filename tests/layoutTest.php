<?php declare(strict_types=1);



use PHPUnit\Framework\TestCase;
use controller\Layout as layout;


final class layoutTest extends TestCase
{
    public function createFieldCheck(): void
    {
         $layout = new layout();

          $this->assertEmpty($layout->createLayout());
    }


}