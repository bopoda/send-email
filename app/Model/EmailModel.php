<?php

namespace Model;

use Core\Database\AbstractModel;
use Service\EmailForm;

class EmailModel extends AbstractModel
{
    /**
     * @inheritdoc
     */
    public function getDatabaseName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function getTableName()
    {
        return 'email';
    }

    /**
     * Save new email row
     *
     * @param EmailForm $emailForm
     * @return string  Id of new row
     */
    public function saveNewEmail(EmailForm $emailForm)
    {
        $sql = "INSERT INTO {$this->getTableName()} (name, email, subject, message, attachments, added_at)
			VALUES (:name, :email, :subject, :message, :attachments, :added_at)";
        $preparedResult = $this->getPdo()->prepare($sql);
        $preparedResult->execute([
            ':name' => $emailForm->getName(),
            ':email' => $emailForm->getEmail(),
            ':subject' => $emailForm->getSubject(),
            ':message' => $emailForm->getMessage(),
            ':attachments' => $emailForm->hasAttachments() ? json_encode($emailForm->getAttachments()) : '',
            ':added_at' => date('Y-m-d H:i:s'),
        ]);

        return $this->getPdo()->lastInsertId();
    }

    /**
     * Update email status
     *
     * @param int $emailId
     * @param int $success
     */
    public function updateSuccess($emailId, $success)
    {
        $sql = "UPDATE {$this->getTableName()} 
          SET success=:success
          WHERE id=:id";
        $preparedResult = $this->getPdo()->prepare($sql);
        $preparedResult->execute([
            ':id' => $emailId,
            ':success' => $success,
        ]);
    }

}