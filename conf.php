<?php
// Site Information
$conf['site_name'] = 'Internet Application Programming';
$conf['site_url'] = 'http://localhost';
$conf['admin_email'] = 'benir.omenda@strathmore.edu';

// Database Configuration
$conf['db_type'] = 'pdo';
$conf['db_host'] = 'localhost';
$conf['db_user'] = 'root';
$conf['db_pass'] = 'ManCity@254';
$conf['db_name'] = 'basedata5';

// Site Language
$conf['site_lang'] = 'en';

//Email Configuration
$conf['mail_type'] = 'smtp'; //Option smtp or mail
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'benir.omenda@strathmore.edu';
$conf['smtp_pass'] = 'jvvw ivdm buye uauw';
$conf['smtp_port'] = 465;
$conf['smtp_secure'] = 'ssl';

$mailCnt = [
    'name_from' => 'Benir Omenda',
    'email_from' => 'benir.omenda@strathmore.edu',
    'name_to' => 'Nir Odeny',
    'email_to' => 'beniromenda@gmail.com',
    'subject' => 'IAP Week 2 email',
    'body' => 'This is a new semester'
];

$conn = new mysqli($conf['db_host'], $conf['db_user'], $conf['db_pass'], $conf['db_name']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
