<?php

namespace Fh\Http;

class BuzzResponse extends AbstractResponse implements ResponseInterface
{
    public function getHeader($name)
    {
        $data = array_values($this->getHeaders());
        $return = null;

        foreach ($data as $value) {
            if (strpos($value, ':')) {
                list($headerName, $headerValue) = explode(': ', $value);
                if ($headerName === $name) {
                    $return = $headerValue;
                }
            }
        }

        return $return;
    }
}
