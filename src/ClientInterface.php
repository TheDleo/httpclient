<?php

namespace Fh\Http;

/**
 * An HTTP Client interface
 * Based on Payment/HttpClient (http://github.com/payment/httpclient) by Dominik Zogg 
 * 
 * @author Dan Martin <dmartin@fh.org>
 *
 */
interface ClientInterface
{
    const METHOD_OPTIONS = 'OPTIONS';
    const METHOD_GET     = 'GET';
    const METHOD_HEAD    = 'HEAD';
    const METHOD_POST    = 'POST';
    const METHOD_PUT     = 'PUT';
    const METHOD_DELETE  = 'DELETE';
    const METHOD_PATCH   = 'PATCH';
    
    /**
     * Send an HTTP request and return an HTTP response.
     *
     * @param string $method HTTP method, uppercase
     * @param string $url Url to send HTTP request to
     * @param string $content Content of the request, can be empty.
     * @param array $headers Array of Headers, header Name is the key.
     * @param array $options Vendor specific options to activate specific features.
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function request($method, $url, $content = null, array $headers = array(), array $options = array());
    
    /**
     * Send an HTTP GET request
     * @param string $url
     * @param string $content
     * @param array $headers
     * @param array $options
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function get($url, $content = null, array $headers = array(), array $options = array());

    /**
     * Send an HTTP POST request
     * @param string $url
     * @param string $content
     * @param array $headers
     * @param array $options
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function post($url, $content = null, array $headers = array(), array $options = array());

    /**
     * Send an HTTP PUT request
     * @param string $url
     * @param string $content
     * @param array $headers
     * @param array $options
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function put($url, $content = null, array $headers = array(), array $options = array());

    /**
     * Send an HTTP DELETE request
     * @param string $url
     * @param string $content
     * @param array $headers
     * @param array $options
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function delete($url, $content = null, array $headers = array(), array $options = array());

    /**
     * Send and HTTP HEAD request
     * @param string $url
     * @param string $content
     * @param array $headers
     * @param array $options
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function head($url, $content = null, array $headers = array(), array $options = array());

    /**
     * Send an HTTP PATCH reqeust
     * @param string $url
     * @param string $content
     * @param array $headers
     * @param array $options
     * @throws HttpException If no response can be created an exception should be thrown.
     * @return ResponseInterface
     */
    public function patch($url, $content = null, array $headers = array(), array $options = array());
}
