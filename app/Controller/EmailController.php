<?php

namespace Controller;

use Core\Response\HttpResponse;
use Core\View;
use Service\EmailFormHandler;

class EmailController
{
    public function emailFormAction()
    {
        $errors = [];

        if ($_POST) {
            $emailFormHandler = new EmailFormHandler();
            $errors = $emailFormHandler->handlePostAction($_POST, $_FILES);
            if (!$errors) {
                //redirect to avoid send form again
            }
        }

        return new HttpResponse(View::create('emailForm.html.php', [
            'errors' => $errors,
        ])->render());
    }
}