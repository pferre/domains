<?php


namespace Domains\Mailer;

use Swift_Mailer;

/**
 * Class Email
 * @package Domains\Mailers
 */
class Email {

    public function send($domains)
    {
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername(getenv('EMAIL_USERNAME'))
            ->setPassword(getenv('EMAIL_PASSWORD'))
            ;

        $mailer = Swift_Mailer::newInstance($transport);

        $message = \Swift_Message::newInstance('The following domains will expire soon')
            ->setFrom(['pierre@craftwb.co.uk' => 'Domain Checker at ChezFerre'])
            ->setTo(['pierre@pierreferre.com' => 'Pierre Ferré'])
            ->setBody($domains)
            ;

        try {
            $mailer->send($message);
        } catch(\Swift_SwiftException $e) {
            return $e->getMessage();
        }
    }
} 
