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
        $sendEmail = false;

        if ($_POST) {
            $emailFormHandler = new EmailFormHandler();
            $errors = $emailFormHandler->handlePostAction($_POST, $_FILES);
            if (!$errors) {
                $sendEmail = true;
            }
        }

        return new HttpResponse(View::create('emailForm.html.php', [
            'errors' => $errors,
            'sendEmail' => $sendEmail,
        ])->render());
    }
}