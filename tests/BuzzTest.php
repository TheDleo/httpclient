<?php

namespace Fh\Http\Test;

use Fh\Http\BuzzClient;
use Fh\Http\BuzzResponse;
use Fh\Http\HttpException;
use \Mockery as m;
use Buzz\Browser;
use Buzz\Client\Curl;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    private $client;
    private $factory;
    private $browser;

    protected function setUp()
    {
        $this->client = $this->getMock('Buzz\Client\ClientInterface');
        $this->factory = $this->getMock('Buzz\Message\Factory\FactoryInterface');
    
        $this->browser = new Browser($this->client, $this->factory);
    }

    public function testBuzzClientGetHeaderContentType()
    {
        $client = new BuzzClient();
        $response = $client->get('http://www.google.com/');

        $this->assertEquals($response->getContentType(), $response->getHeader('Content-Type'));
    }

    /**
     * @expectedException Fh\Http\HttpException
     */
    public function testRequestThrowsHttpException()
    {
        $client = new BuzzClient();
        $response = $client->get('thisisnotaurl/');
    }

    public function testBuzzClientWithMockBrowser()
    {
        $client = new BuzzClient();
        $client->setBrowser($this->browser);

        $this->assertEquals($this->browser, $client->getBrowser());
    }

    public function testSetResponseInConstructor()
    {
        $response = m::mock('Fh\Http\ResponseInterface');
        $response->shouldReceive('getContent')->andReturn('foo');
        $response->shouldReceive('setResponse')->andReturn($response);
        
        $client = new BuzzClient($response);
        
        $result = $client->get('http://www.google.com/');
        
        $this->assertEquals($response->getContent(),$result->getContent());
    }

    /**
     * @dataProvider provideMethods
     */
    public function testBuzzClientBasicMethods($method, $content)
    {
        
        $buzzRequest = $this->getMock('Buzz\Message\RequestInterface');
        $message = $this->getMock('Buzz\Message\Response');
        
        $this->client->expects($this->once())
            ->method('send')
            ->with($buzzRequest, $message)
            ->will($this->returnValue($this->client));

        $this->factory->expects($this->once())
            ->method('createRequest')
            ->with(strtoupper($method))
            ->will($this->returnValue($buzzRequest));

        $this->factory->expects($this->once())
            ->method('createResponse')
            ->will($this->returnValue($message));
        
        $browser = new Browser($this->client, $this->factory);

        $headers = array('X-Blah: duh');
        
        $response = m::mock('Fh\Http\ResponseInterface');
        $response->shouldReceive('getContent')->andReturn($content);
        $response->shouldReceive('setResponse')->andReturn($response);
        
        $client = new BuzzClient($response);
        $client->setBrowser($this->browser);

        $result = $client->$method('http://www.example.com/', $content, $headers);
        
        $this->assertEquals($content, $result->getContent());

    }

    public function provideMethods()
    {
        return array(
            array('get',    ''),
            array('head',   ''),
            array('post',   'content'),
            array('put',    'content'),
            array('delete', 'content'),
            array('patch',  'content')
        );
    }
    
    public function testResponseObjectMethods()
    {
        $response = new BuzzResponse();
        $headers = array('X-Blah: duh');
        $response->setResponse('200', 'text/html', 'content', $headers);
        
        $this->assertEquals('duh', $response->getHeader('X-Blah'));
        $this->assertEquals($headers, $response->getHeaders());
        $this->assertEquals('200', $response->getStatusCode());
        $this->assertEquals('content',$response->getContent());
        $this->assertEquals('text/html',$response->getContentType());
    }
    
    public function testSetBuzzResponseObject()
    {
        $response = new BuzzResponse();
        $client = new BuzzClient();
        
        $client = $client->setResponseObj($response);
        
        $this->assertSame($response, $client->getResponseObj());
        $this->assertEquals($response, $client->getResponseObj());
        
    }
}
