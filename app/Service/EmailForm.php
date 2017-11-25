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
        'subject',
        'email',
        'name',
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

        return !$errors;
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

    //TODO:
    public function hasAttachments()
    {
        return false;
//        return (bool) $this->filesData;
    }

    //TODO:
    public function getAttachments()
    {
        return [];
    }
}