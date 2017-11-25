<?php

namespace Core\Response;

use Core\Exception\NotSupportedException;

class BaseResponse
{
    /**
     * Full list of all http status codes which can be used
     *
     * @var array
     */
    protected static $statusMessages = [
        200 => 'OK',
        404 => 'Not Found',
    ];

    /**
     * @var int
     */
    protected $code = 200;

    /**
     * @var array
     */
    protected $headers = [];

    /**
     * @var string
     */
    protected $body;

    /**
     * @param int $code
     * @return $this
     * @throws NotSupportedException
     */
    public function setCode($code)
    {
        if (!isset(static::$statusMessages[$code])) {
            throw new NotSupportedException('Unknown HTTP status code '.$code);
        }

        $this->code = $code;

        return $this;
    }

    /**
     * @param string $header
     * @param string $value
     * @return $this
     */
    public function addHeader($header, $value)
    {
        $this->headers[$header] = $value;

        return $this;
    }

    /**
     * @param string $body
     * @return $this
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;

    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $contentType
     * @param string $charset
     * @return $this
     */
    public function setContentType($contentType = 'text/html', $charset = 'utf-8')
    {
        $this->addHeader('Content-type', $contentType.'; charset='.$charset);

        return $this;
    }
}
