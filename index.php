<?php

require_once 'bootstrap/start.php';

use Domains\Mailer\Email;
use Domains\DomainsChecker;

$domains = new DomainsChecker();
$domainsForRenewals = $domains->getRenewalDates();

if ( !empty($domainsForRenewals ) ) {

    $email = new Email();
    $email->send($domainsForRenewals);
    exit;

}