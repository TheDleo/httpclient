<?php

namespace Fh\HttpClient;

/**
 * Abstract implementation of HttpClientInterface
 * Based on Payment/HttpClient (http://github.com/payment/httpclient) by Dominik Zogg 
 * 
 * @author Dan Martin <dmartin@fh.org>
 *
 */
abstract class AbstractClient implements HttpClientInterface
{
    /**
     * The Response object.
     * @param Fh\HttpcClient\HttpResponseInterface $response
     */
    protected $response;
    
    /**
     * Constructor
     * @param Fh\HttpcClient\HttpResponseInterface $response
     */
    public function __construct(Fh\HttpcClient\HttpResponseInterface $response)
    {
        $this->response = $response;
    }
    
    /**
     * Send a http-request and return a http-response.
     *
     * @param string $method HTTP method, uppercase
     * @param string $url Url to send HTTP request to
     * @param string $content Content of the request, can be empty.
     * @param array $headers Array of Headers, header Name is the key.
     * @param array $options Vendor specific options to activate specific features.
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return HttpResponseInterface
     */
    abstract public function request(
        $method,
        $url,
        $content = null,
        array $headers = array(),
        array $options = array()
    );
    
    public function get($url, $content = null, array $headers = array(), array $options = array())
    {
        return $this->request(self::METHOD_GET, $url, $content, $headers, $options);
    }

    public function post($url, $content = null, array $headers = array(), array $options = array())
    {
        return $this->request(self::METHOD_POST, $url, $content, $headers, $options);
    }

    public function put($url, $content = null, array $headers = array(), array $options = array())
    {
        return $this->request(self::METHOD_PUT, $url, $content, $headers, $options);
    }

    public function delete($url, $content = null, array $headers = array(), array $options = array())
    {
        return $this->request(self::METHOD_DELETE, $url, $content, $headers, $options);
    }

    public function head($url, $content = null, array $headers = array(), array $options = array())
    {
        return $this->request(self::METHOD_HEAD, $url, $content, $headers, $options);
    }

    public function patch($url, $content = null, array $headers = array(), array $options = array())
    {
        return $this->request(self::METHOD_PATCH, $url, $content, $headers, $options);
    }
}
