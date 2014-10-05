<?php

use Domains\Mailer\Email;
use Domains\DomainsChecker;

$domains = new DomainsChecker();
$domainsForRenewals = $domains->getRenewalDates();

if ( !empty($domainsForRenewals ) ) {
    $email = new Email();
    $email->send($domainsForRenewals);
    exit;
}

echo "No domains set to expire in the next 90 days";


