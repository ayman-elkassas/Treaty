<?php
use PHPUnit\Framework\TestCase;

class DataProviderFilterTest extends TestCase
{
    /**
     * @dataProvider truthProvider
     */
    public function testTrue($truth)
    {
        $this->assertTrue($truth);
    }

    public static function truthProvider()
    {
        return [
           [true],
           [true],
           [true],
           [true]
        ];
    }

    /**
     * @dataProvider falseProvider
     */
    public function testFalse($false)
    {
        $this->assertFalse($false);
    }

    public static function falseProvider()
    {
        return [
          'false migrateSpec'       => [false],
          'false migrateSpec 2'     => [false],
          'other false migrateSpec' => [false],
          'other false test2'=> [false]
        ];
    }
}
