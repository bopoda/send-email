<?php

namespace Controller;

use Core\Response\HttpResponse;
use Core\View;

class EmailController
{
    public function emailFormAction()
    {
        return new HttpResponse(View::create('emailForm.html.php', [

        ])->render());
    }
}