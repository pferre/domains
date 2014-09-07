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

        $message = \Swift_Message::newInstance('The following domains will expire in the next 7 days')
            ->setFrom(['pierre@craftwb.co.uk' => 'Craftwb'])
            ->setTo(['pierre@pierreferre.com' => 'Pierre Ferré'])
            ->setBody($values)
            ;
        $mailer->send($message);
        echo 'Sending email ....'."\n";
    }
} 
