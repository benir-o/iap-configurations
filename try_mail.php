<?php

require_once 'classAutoLoad.php';
$mailCnt = [
    'name_from' => 'Benir Omenda',
    'email_from' => 'no-reply@icsccommunity.com',
    'name_to' => 'Nir Odeny',
    'email_to' => 'beniromenda@gmail.com',
    'subject' => 'IAP Week 2 email',
    'body' => 'This is a new semester'
];
$ObjSendMail->send_Mail($conf, $mailCnt);
