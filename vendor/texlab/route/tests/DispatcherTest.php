<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Texlab\Route\Dispatcher;

class DispatcherTest extends TestCase
{
    protected $dispatcher;
    protected $dispatcherNoClean;

    protected function setUp(): void
    {
        $this->dispatcher = new Dispatcher([
            '/one/page{page}' => 'TableOne/ShowTable',
            '/one' => 'TableOne/ShowTable',
            '/post{postId}/comment{commentId}' => 'Post/ShowComment',
        ]);

        $this->dispatcherNoClean = new Dispatcher(
            ['/one/page{page}' => 'TableOne/ShowTable'],
            false
        );

    }

    /**
     * @covers Dispatcher::decodeUri
     * @covers Dispatcher::encodeUri
     */
    function testDispatcher()
    {
        $this->assertEquals(
            ['handler' => 'TableOne/ShowTable', 'vars' => []],
            $this->dispatcher->decodeUri('/one')
        );

        $this->assertEquals(
            ['handler' => 'TableOne/ShowTable', 'vars' => ['page' => 2]],
            $this->dispatcher->decodeUri('/one/page2')
        );

        $this->assertEquals(
            '/one/page15',
            $this->dispatcher->encodeUri('TableOne/ShowTable', ['page' => 15])
        );

        $this->assertEquals(
            '/post11/comment3',
            $this->dispatcher->encodeUri('Post/ShowComment', ['postId' => 11, 'commentId' => 3])
        );

        $this->assertEquals(
            [],
            $this->dispatcher->decodeUri('/abracadabra')
        );
    }

    function testEncodeUri()
    {

        $this->assertEquals(
            '?t=TableOne&a=ShowTable&page=15',
            $this->dispatcherNoClean->encodeUri('TableOne/ShowTable', ['page' => 15])
        );
    }


}