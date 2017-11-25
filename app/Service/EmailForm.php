<?php

namespace Service;

/**
 * Class designed to validate email html form
 */
class EmailForm
{
    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var array
     */
    private $postData;

    /**
     * @var array
     */
    private $filesData;

    /**
     * @var array
     */
    private $filesNames = [];

    /**
     * @var array
     */
    private $expectedFields = [
        'message',
        'subject',
        'email',
        'name',
    ];

    /**
     * @var array
     */
    private $nonEmptyFields = [
        'message',
        'email',
    ];

    public function __construct(array $postData, array $filesData)
    {
        $this->postData = array_map('trim', $postData);
        $this->filesData = $filesData;
    }

    /**
     * Is email form valid
     *
     * @return bool
     */
    public function isValid()
    {
        $errors = [];

        foreach ($this->expectedFields as $field) {
            if (!isset($this->postData[$field])) {
                $errors[] = $field . ' should be presented in form';
            } elseif (!is_string($this->postData[$field])) {
                $errors[] = $field . ' should be a string';
            }
        }

        if (!$errors) {
            foreach ($this->nonEmptyFields as $field) {
                if (!$this->postData[$field]) {
                    $errors[] = $field . ' required to be not empty';
                }
            }
        }

        $this->errors = $errors;

        if (!$this->errors) {
            $this->errors = $this->moveFilesFromTmpDir();
        }

        return !$this->errors;
    }

    /**
     * @return string
     */
    public function getSubject()
    {
        return $this->postData['subject'];
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->postData['email'];
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->postData['name'];
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->postData['message'];
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasAttachments()
    {
        return (bool) $this->filesNames;
    }

    /**
     * @return array
     */
    public function getAttachments()
    {
        $attachments = [];

        foreach ($this->filesNames as $name) {
            $attachments[] = $this->getDestinationByName($name);
        }

        return $attachments;
    }

    /**
     * Should be validation of files
     *
     * @return array  Array of errors
     */
    private function moveFilesFromTmpDir()
    {
        if (empty($this->filesData['image']['tmp_name'])) {
            return [];
        }

        $errors = [];
        foreach ($this->filesData['image']['tmp_name'] as $tmpFile) {
            if (!$tmpFile) {
                continue;
            }

            $name = basename($tmpFile);
            $destination = $this->getDestinationByName($name);
            $result = move_uploaded_file(
                $tmpFile,
                $destination
            );

            if ($result) {
                $this->filesNames[] = $name;
            } else {
                $errors[] = 'Can not move file to ' . $destination;
            }
        }

        return $errors;
    }

    /**
     * Get full path to file on server
     *
     * @param string $name
     * @return string
     */
    private function getDestinationByName($name)
    {
        return ROOT_DIR . '/assets/uploads/' . $name;
    }
}