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
    /**
     *
     */
    protected $browser;
    
    /**
     * Set the Buzz Browser
     * @param $browser
     * @return \Fh\Http\BuzzClient
     */
    public function setBrowser(Browser $browser)
    {
        $this->browser = $browser;
        return $this;
    }
    
    /**
     * Get the http client
     * @return \Buzz\Browser
     */
    public function getBrowser()
    {
        if (is_null($this->browser)) {
            $this->browser = new Browser(new Curl());
        }
        
        return $this->browser;
    }

    /**
     * Set the response object
     * @param ResponseInterface $response
     * @return \Fh\Http\BuzzClient
     */
    public function setResponseObj(ResponseInterface $response)
    {
        $this->responseObj = $response;
        return $this;
    }

    public function getResponseObj()
    {
        if (is_null($this->responseObj)) {
            $this->responseObj = new BuzzResponse();
        }

        return $this->responseObj;
    }

    /**
     * Make an http request
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
        try {
            $originalResponse = $this->getBrowser()->call($url, $method, $headers, $content);

            return $this->getResponseObj()->setResponse(
                $originalResponse->getStatusCode(),
                $originalResponse->getHeader('Content-Type'),
                $originalResponse->getContent(),
                $originalResponse->getHeaders()
            );
        } catch (\Exception $e) {
            throw new HttpException($e);
        }
    }
}
