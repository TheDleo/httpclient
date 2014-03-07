<?php

namespace Fh\Http;

use Buzz\Browser;
use Buzz\Client\Curl;
use Buzz\Message\Response;

/**
 * Fh\Http\ClientInterface Implementation of the Buzz http library
 * Based on Payment/HttpClient/BuzzClient (http://github.com/payment/httpclient-buzz) by Dominik Zogg 
 * 
 * @author Dan Martin <dmartin@fh.org>
 *
 */
class BuzzClient extends AbstractClient implements ClientInterface
{
    protected $browser;
    
    public function setClient(Browser $browser)
    {
        $this->browser = $browser;
        return $this;
    }
    
    public function getClient()
    {
        if(is_null($this->browser)) {
            $this->browser = new Browser(new Curl());
        }
        
        return $this->browser;
    }

    /**
     * @param string $method
     * @param string $url
     * @param null $content
     * @param array $headers
     * @param array $options
     * @return ResponseInterface
     * @throws HttpException
     */
    public function request($method, $url, $content = null, array $headers = array(), array $options = array())
    {
        try
        {
            $originalResponse = $this->getClient()->call($url, $method, $headers, $content);

            return new BuzzResponse(
                $originalResponse->getStatusCode(),
                $originalResponse->getHeader('Content-Type'),
                $originalResponse->getContent(),
                $originalResponse->getHeaders()
            );
        }
        catch(\Exception $e)
        {
            throw new HttpException($e);
        }
    }}
