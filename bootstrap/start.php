<?php

use Domains\Mailer\Email;

$domains = new Domains\Check;
$forRenewals = $domains->getRenewalDates();

if (empty($forRenewals)) {
	$email = new Email;
	$email->sendMessage($forRenewals);
}

echo "Nothing to send...";


