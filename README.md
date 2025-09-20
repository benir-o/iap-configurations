# Configuration File Handling Within the Project

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

# Server Configuration Guide

[![PHP](https://img.shields.io/badge/PHP-8.2.29-777BB4?style=flat-square&logo=php&logoColor=white)](https://php.net)
[![Apache](https://img.shields.io/badge/Apache-2.4-D22128?style=flat-square&logo=apache&logoColor=white)](https://apache.org)
[![MariaDB](https://img.shields.io/badge/MariaDB-12.0-003545?style=flat-square&logo=mariadb&logoColor=white)](https://mariadb.org)
[![Windows](https://img.shields.io/badge/Windows-11-0078D6?style=flat-square&logo=windows&logoColor=white)](https://microsoft.com)

A comprehensive guide for setting up a complete web development environment on Windows 11 with Apache, PHP, MariaDB, and Composer.

## 🎯 Objective

Set up a local development server environment capable of running internet applications with:

- Apache web server for HTTP request handling
- PHP for server-side scripting
- MariaDB for database management
- Composer for PHP dependency management

## 🛠️ Prerequisites

- Windows 11 operating system
- Administrator privileges
- Internet connection for downloads

## 📦 Installation Components

| Component | Version                       | Purpose                    |
| --------- | ----------------------------- | -------------------------- |
| Apache    | 2.4                           | Web server software        |
| PHP       | 8.2.29 (VS16 x64 Thread Safe) | Server-side scripting      |
| MariaDB   | 12.0                          | Database management system |
| Composer  | Latest                        | PHP dependency manager     |

## 🚀 Installation Guide

### 1. Apache Web Server

#### Download and Install

1. Visit [Apache Lounge](https://www.apachelounge.com/download/)
2. Download the **win64 version**
3. Download **vc_redist_x64** (Visual C++ Redistributable)
4. Extract the httpd file
5. Move the `Apache24` folder to `C:\` (root directory)

#### Service Installation

```cmd
# Open Command Prompt as Administrator
cd C:\Apache24\bin
httpd.exe -k install -n "Apache24"
```

#### Verification

```cmd
# Start Apache service
cd C:\Apache24\bin
httpd.exe -k start

# Check version
httpd -v
```

Open your browser and navigate to `http://localhost/` - you should see "**It works!**"

### 2. PHP Installation

#### Download and Setup

1. Visit [PHP for Windows](https://windows.php.net/download/)
2. Download **PHP 8.2.29 - VS16 x64 Thread Safe**
3. Extract to `C:\php`

#### Environment Variables

1. Search for "**Edit the system environment variables**" in Windows Start
2. Under **System Variables**, select **Path**
3. Click **Edit** → **New**
4. Add `C:\php` and move it to the top of the list

#### Configure Apache for PHP

Edit `C:\Apache24\conf\httpd.conf` and add the following lines at the bottom:

```apache
# PHP configuration
LoadModule php_module "C:/php/php8apache2_4.dll"
AddHandler application/x-httpd-php .php
PHPIniDir "C:/php"
```

#### Restart Apache

```cmd
cd C:\Apache24\bin
httpd.exe -k restart
```

#### Test PHP Installation

1. Create `C:\Apache24\htdocs\info.php`:

```php
<?php
phpinfo();
?>
```

2. Visit `http://localhost/info.php` - you should see a purple PHP info page

### 3. MariaDB Database

#### Installation

1. Visit [MariaDB Downloads](https://mariadb.org/download/)
2. Select **Windows** → Download **MSI installer**
3. Run installer with default settings
4. Set a **root password** and port (default: 3306)

#### Environment Variables

1. Open "**Edit the system environment variables**"
2. Select **Path** under System Variables
3. Add `C:\Program Files\MariaDB 12.0\bin`

#### Verification

```cmd
mysql -u root -p
# Enter your root password
# Type 'exit' to leave the MariaDB shell
```

#### Configure PHP MySQLi Extension

1. Navigate to `C:\php`
2. Open `php.ini` file
3. Find `;extension=mysqli` and uncomment it to `extension=mysqli`
4. Save and restart Apache:

```cmd
cd C:\Apache24\bin
httpd.exe -k restart
```

### 4. Composer Installation

#### Setup

1. Visit [Composer Downloads](https://getcomposer.org/download)
2. Click **Composer-Setup.exe** under Windows Installer
3. Select PHP executable: `C:\php\php.exe`
4. Follow installation prompts

#### Verification

```cmd
composer -v
```

## 📁 Configuration Files

### httpd.conf

Location: `C:\Apache24\conf\httpd.conf`

Added configuration:

```apache
# PHP configuration
LoadModule php_module "C:/php/php8apache2_4.dll"
AddHandler application/x-httpd-php .php
PHPIniDir "C:/php"
```

### php.ini

Location: `C:\php\php.ini`

Modified configuration:

```ini
extension=mysqli
```

## 🔧 Troubleshooting

### Database Connection Issues

- **Problem**: MySQLi connection failures
- **Solution**:
  - Verify root password matches your MySQLi connection code
  - Ensure `extension=mysqli` is uncommented in `php.ini`
  - Restart Apache after changes

### PHP Not Working

- **Problem**: PHP files not executing (showing source code)
- **Solution**:
  - Verify PHP module is loaded in `httpd.conf`
  - Check if `C:\php` is in system PATH environment variable
  - Test with `php -v` command

### Apache Service Issues

- **Problem**: Apache won't start
- **Solution**:
  - Check Windows Services for conflicting Apache installations (e.g., XAMPP)
  - Disable conflicting services or uninstall previous Apache installations
  - Run `httpd.exe -k start` as Administrator

## 🧪 Testing Your Setup

Create a test file `C:\Apache24\htdocs\test.php`:

```php
<?php
echo "<h1>Server Configuration Test</h1>";

// Test PHP
echo "<h2>PHP Version: " . phpversion() . "</h2>";

// Test Database Connection
$host = 'localhost';
$username = 'root';
$password = 'your_password_here';

try {
    $mysqli = new mysqli($host, $username, $password);
    echo "<h2>✅ Database Connection: SUCCESS</h2>";
    $mysqli->close();
} catch (Exception $e) {
    echo "<h2>❌ Database Connection: FAILED</h2>";
    echo "<p>Error: " . $e->getMessage() . "</p>";
}
?>
```

Visit `http://localhost/test.php` to verify everything is working correctly.

## 📚 Next Steps

With your server environment configured, you can now:

- Develop PHP web applications
- Use Composer to manage PHP packages
- Create and manage databases with MariaDB
- Host your applications locally for development

## 🤝 Contributing

Feel free to submit issues and enhancement requests!

## 📄 License

This configuration guide is provided as-is for educational purposes.

---

**Note**: This configuration is specific to Windows 11. For Linux or macOS, different steps and paths will be required.
