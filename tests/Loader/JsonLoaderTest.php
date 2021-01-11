<?php

namespace DarthSoup\Tests\TranslationExtended\Loader;

use DarthSoup\TranslationExtended\Loader\JsonLoader;
use Illuminate\Filesystem\Filesystem;
use Mockery as m;
use PHPUnit\Framework\TestCase;

class JsonLoaderTest extends TestCase
{
    protected function tearDown(): void
    {
        m::close();
    }

    public function testLoadMethodWithoutNamespacesProperlyCallsLoader()
    {
        $loader = new JsonLoader($files = m::mock(Filesystem::class), __DIR__);
        $files->shouldReceive('exists')->once()->with(__DIR__ . '/en/foo.json')->andReturn(true);
        $files->shouldReceive('get')->once()->with(__DIR__ . '/en/foo.json')->andReturn('{ "foo": "bar" }');

        $this->assertEquals(['foo' => 'bar'], $loader->load('en', 'foo', null));
    }

    public function testEmptyArraysReturnedWhenFilesDontExist()
    {
        $loader = new JsonLoader($files = m::mock(Filesystem::class), __DIR__);
        $files->shouldReceive('exists')->once()->with(__DIR__ . '/en/foo.json')->andReturn(false);
        $files->shouldReceive('get')->never();

        $this->assertEquals([], $loader->load('en', 'foo', null));
    }

    public function testEmptyArraysReturnedWhenFilesDontExistForNamespacedItems()
    {
        $loader = new JsonLoader($files = m::mock(Filesystem::class), __DIR__);
        $files->shouldReceive('get')->never();

        $this->assertEquals([], $loader->load('en', 'foo', 'bar'));
    }
}
