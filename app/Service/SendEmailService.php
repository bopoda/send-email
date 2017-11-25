<?php

namespace Service;

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendEmailService
{
    public function __construct(EmailForm $emailForm)
    {
        $this->setSubject($emailForm->getSubject())
            ->setEmail($emailForm->getEmail())
            ->setName($emailForm->getName())
            ->setMessage($emailForm->getMessage());

        if ($emailForm->hasAttachments()) {
            $this->setAttachments($emailForm->getAttachments());
        }
    }

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $email;

    /**
     * Array of absolute pathes to attachments on server
     *
     * @var array
     */
    private $attachments = [];

    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setAttachments(array $attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function getAttachments()
    {
        return $this->attachments;
    }

    public function send()
    {
        $phpMailer = new PHPMailer(true);
        try {
            //Server settings
            $phpMailer->SMTPDebug = 2;                                 // Enable verbose debug output
            $phpMailer->isMail();                                      // Set mailer to use SMTP
            $phpMailer->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
            $phpMailer->SMTPAuth = true;                               // Enable SMTP authentication
            $phpMailer->Username = 'user@example.com';                 // SMTP username
            $phpMailer->Password = 'secret';                           // SMTP password
            $phpMailer->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
            $phpMailer->Port = 587;                                    // TCP port to connect to

            $phpMailer->setFrom(
                $this->getEmail(),
                $this->getName()
            );

//            $phpMailer->addAddress('joe@example.net', 'Joe User');     // Add a recipient
//            $phpMailer->addAddress('ellen@example.com');               // Name is optional
//            $phpMailer->addReplyTo('info@example.com', 'Information');
//            $phpMailer->addCC('cc@example.com');
//            $phpMailer->addBCC('bcc@example.com');

            //Attachments
//            $phpMailer->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//            $phpMailer->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            //Content
            $phpMailer->isHTML(true);                                  // Set email format to HTML
            $phpMailer->Subject = $this->getSubject();
            $phpMailer->Body    = $this->getMessage();

            $phpMailer->send();
        } catch (Exception $e) {
            throw new \Exception('Mailer Error: ' . $phpMailer->ErrorInfo, 0, $e);
        }
    }
}