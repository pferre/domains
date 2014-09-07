<?php


namespace Domains\Mailer;

use Swift_Mailer;

/**
 * Class Email
 * @package Domains\Mailers
 */
class Email {

    public function sendMessage($values)
    {
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername(getenv('EMAIL_USERNAME'))
            ->setPassword(getenv('EMAIL_PASSWORD'))
            ;

        $mailer = Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance('Domains you registered')
            ->setFrom(['fredo.f@gmail.com' => 'Fred Ferré'])
            ->setTo(['pierre@pierreferre.com' => 'Pierre Ferré'])
            ->setBody($values)
            ;
        $mailer->send($message);
        echo 'Sending email ....'."\n";
    }
} 
