<?php

namespace Fh\HttpClient;

/**
 * An abstract implementation of HttpResponseInterface
 * Based on Payment/HttpClient (http://github.com/payment/httpclient) by Dominik Zogg 
 * 
 * @author Dan Martin <dmartin@fh.org>
 *
 */
abstract class AbstractResponse implements HttpResponseInterface
{
    /**
     * @var integer
     */
    protected $statusCode;

    /**
     * @var string
     */
    protected $contentType;

    /**
     * @var string
     */
    protected $content;

    /**
     * @var array
     */
    protected $headers;

    /**
     * Constructor
     * @param int $statusCode
     * @param string $contentType
     * @param string $content
     * @param array $headers
     */
    public function __construct($statusCode, $contentType, $content, array $headers)
    {
        $this->statusCode = $statusCode;
        $this->contentType = $contentType;
        $this->content = $content;
        $this->headers = $headers;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param $name
     * @return mixed
     */
    abstract public function getHeader($name);
}
