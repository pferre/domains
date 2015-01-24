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
        $transport = $this->setTransport();

        $mailer = Swift_Mailer::newInstance($transport);

        $message = $this->setMessage($domains);

        try {
            $mailer->send($message);
        } catch(\Swift_SwiftException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return \Swift_SmtpTransport
     */
    private function setTransport()
    {
        $transport = \Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
            ->setUsername(getenv('EMAIL_USERNAME'))
            ->setPassword(getenv('EMAIL_PASSWORD'));
        return $transport;
    }

    /**
     * @param $domains
     * @return \Swift_Mime_MimePart
     */
    private function setMessage($domains)
    {
        $message = \Swift_Message::newInstance('The following domains will expire soon')
            ->setFrom([ getenv('EMAIL_FROM') => 'Domain Checker at ChezFerre'] )
            ->setTo([ getenv('EMAIL_TO') => 'Pierre Ferré'] )
            ->setBody($domains, 'text/html');
        return $message;
    }
} 
