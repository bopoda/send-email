<?php

namespace Core\Response;

/**
 * Class to return http response
 */
class HttpResponse extends BaseResponse
{
    /**
     * @param string|null $body
     * @param string $contentType
     */
    public function __construct($body = null, $contentType = 'text/html')
    {
        $this->setBody($body);
        $this->setContentType($contentType, 'utf-8');
    }

    public function send()
    {
        header(
            'HTTP/1.0 '.$this->code.' '.self::$statusMessages[$this->code],
            true,
            $this->code
        );

        foreach ($this->headers as $name => $value) {
            header($name.': '.$value, true);
        }

        echo $this->body;
    }
}

