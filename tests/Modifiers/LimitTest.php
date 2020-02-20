<?php

namespace Tests\Modifiers;

use Illuminate\Support\Collection;
use Statamic\Modifiers\Modify;
use Tests\TestCase;

class LimitTest extends TestCase
{
    /** @test */
    function it_limits_arrays()
    {
        $arr = ['one', 'two', 'three', 'four', 'five'];

        $this->assertEquals(['one', 'two'], $this->modify($arr, 2));
        $this->assertEquals(['one', 'two', 'three'], $this->modify($arr, 3));
    }

    /** @test */
    function it_limits_collections()
    {
        $collection = collect(['one', 'two', 'three', 'four', 'five']);

        $limited = $this->modify($collection, 2);
        $this->assertInstanceOf(Collection::class, $limited);
        $this->assertEquals(['one', 'two'], $limited->all());

        $limited = $this->modify($collection, 3);
        $this->assertInstanceOf(Collection::class, $limited);
        $this->assertEquals(['one', 'two', 'three'], $limited->all());
    }

    function modify($arr, $limit)
    {
        return Modify::value($arr)->limit($limit)->fetch();
    }
}