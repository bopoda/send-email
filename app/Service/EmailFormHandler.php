<?php

namespace Service;

use Model\EmailModel;

/**
 * Class designed to handle post action to save email to database and send
 */
class EmailFormHandler
{
    /**
     * @param array $postData
     * @param array $filesData
     * @return array
     */
    public function handlePostAction(array $postData, array $filesData)
    {
        $errors = [];

        $emailForm = new EmailForm($postData, $filesData);

        if (!$emailForm->isValid()) {
            $errors = array_merge($errors, $emailForm->getErrors());
        }

        if (!$errors) {
            $emailModel = new EmailModel();
            $emailId = $emailModel->saveNewEmail($emailForm);

            $sendEmailService = new SendEmailService($emailForm);
            try {
                $sendEmailService->send();
                $emailModel->updateSuccess($emailId, 1);
            } catch (\Exception $e) {
                $errors[] = $e->getMessage();
            }
        }

        return $errors;
    }
}