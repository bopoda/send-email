<?php

namespace Controller;

use Core\Response\HttpResponse;
use Core\View;
use Model\EmailModel;
use Service\EmailFormHandler;

class EmailController
{
    const PER_PAGE = 10;

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

    public function listAction()
    {
        $emailModel = new EmailModel();
        $emails = $emailModel->fetch(self::PER_PAGE);

        return new HttpResponse(View::create('list.html.php', [
            'emails' => $emails,
        ])->render());
    }
}