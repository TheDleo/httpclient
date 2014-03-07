<?php

namespace Fh\Http;

/**
 * An HTTP Response interface
 * Http Response returned from {@see HttpClientInterface::request}.
 * Based on Payment/HttpClient (http://github.com/payment/httpclient) by Dominik Zogg 
 * 
 * @author Dan Martin <dmartin@fh.org>
 */
interface ResponseInterface
{
    /**
     * @return integer
     */
    public function getStatusCode();

    /**
     * @return string
     */
    public function getContentType();

    /**
     * @return string
     */
    public function getContent();

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @param $name
     * @return mixed
     */
    public function getHeader($name);
}
