## Configuration Files
I have excluded two files from being pushed to github due to security.<br>
These files are `conf.php` and `classAutoLoad.php`<br>
However, In this readme, I will display the configuration file and the autoload file, but excluding the passwords and other important details.
### conf.php
```php
<?php
// Site Information

use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Html;

$conf['site_name'] = 'Authentication By Benir';
$conf['site_url'] = 'http://localhost';
$conf['admin_email'] = 'benir.omenda@strathmore.edu';

// Database Configuration
$conf['db_type'] = 'pdo';
$conf['db_host'] = '';
$conf['db_user'] = '';
$conf['db_pass'] = '';
$conf['db_name'] = '';

// Site Language
$conf['site_lang'] = 'en';

//Email Configuration
$conf['mail_type'] = 'smtp'; //Option smtp or mail
$conf['smtp_host'] = 'smtp.gmail.com';
$conf['smtp_user'] = 'benir.omenda@strathmore.edu';
$conf['smtp_pass'] = '';
$conf['smtp_port'] = ;
$conf['smtp_secure'] = 'ssl';

$mailCnt = [
    'name_from' => 'Benir Omenda',
    'email_from' => 'benir.omenda@strathmore.edu',
    // 'name_to' => 'Nir Odeny',
    // 'email_to' => '',: This has been reconfigured.
    'subject' => 'Connection Verified.',
    'body' => 'This is to test for successful database connectivity'
];

$conn = new mysqli($conf['db_host'], $conf['db_user'], $conf['db_pass'], $conf['db_name']);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$get_all_users = "SELECT * FROM users ORDER BY username ASC";
$users_display = $conn->query($get_all_users);

$row;
if ($users_display->num_rows > 0) {
    echo "<ol>";
    while ($row = $users_display->fetch_assoc()) {
        echo "<li>" . htmlspecialchars($row['username']) . "</li>";
    };
    echo "</ol>";
}


```
### classAutoLoad.php

```php
require 'Plugins/PHPMailer/vendor/autoload.php';
require_once "conf.php";

$directories = ["Forms", "Layouts", "Global"];

spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});
//Create an instance of HelloWorld

$ObjSendMail = new sendMail();
$form = new forms();
$layout = new layouts();
```
