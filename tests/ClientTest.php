<?php

namespace Fh\Http\Test;

use Fh\Http\BuzzClient;

use Fh\Http;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function testThatTestsRun()
    {
        $this->assertTrue(true);
    }
    
    public function testBuzzClientRequest()
    {
        $client = new BuzzClient();
        var_dump($client);
    }
}