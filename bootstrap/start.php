<?php

Dotenv::load(__DIR__, '../.env');

use Domains\Mailer\Email;

$domains = new Domains\Check;
$forRenewals = $domains->getRenewalDates();

$email = new Email;
$email->sendMessage($forRenewals);
