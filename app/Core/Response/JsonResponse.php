<?php

namespace Core\Response;

/**
 * Class to return JSON response
 */
class JsonResponse extends HttpResponse
{
    public function __construct(array $data)
    {
        $json = json_encode($data);

        parent::__construct($json, 'application/json');
    }
}