<?php
class DataProviderDependencyTest extends PHPUnit\Framework\TestCase
{
    public function testReference()
    {
        $this->markTestSkipped('This migrateSpec should be skipped.');
        $this->assertTrue(true);
    }

    /**
     * @see https://github.com/sebastianbergmann/phpunit/issues/1896
     * @depends testReference
     * @dataProvider provider
     */
    public function testDependency($param)
    {
    }

    public function provider()
    {
        $this->markTestSkipped('Any migrateSpec with this data provider should be skipped.');
        return [];
    }
}
