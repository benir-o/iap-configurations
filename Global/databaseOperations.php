<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: /iap-configurations/index.php");
    exit;
}
require_once __DIR__ . '/../Forms/forms.php';
require_once __DIR__ . '/../conf.php';
require_once __DIR__ . '/../Layouts/LayoutManager.php';
require_once __DIR__ . '/../Global/sendMail.php';

session_start();
class databaseOperations
{

    public LayoutManager $layout1;
    public sendMail $mailObject;
    public forms $FormObject;

    function __construct()
    {
        $this->layout1 = new LayoutManager();
        $this->mailObject = new sendMail();
        $this->FormObject = new forms();
    }
    public function databaseinsertion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            global $conf, $mailCnt, $conn; // Access global configuration and mail object

            $_SESSION['username'] = $_POST['username'];
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['password'] = $_POST['password'];
            $verification_code = rand(10000, 990000);
            $GLOBALS['user_data'] = array(
                'name' => $_SESSION['username'],
                'email' => $_SESSION['email'],
                'password' => $_SESSION['password'],
                'verification_code' => $verification_code
            );
            // Check if user already exists (by email or username)
            $checkStmt = $conn->prepare("SELECT id FROM bookstore_users WHERE username=? OR email=?");
            $checkStmt->bind_param("ss", $_SESSION['username'], $_SESSION['email']);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows > 0) {
                // User already exists
                header("Location: /iap-configurations/index.php?error=user_exists");
                exit;
                // Takes the user back to the signup page if similar credentials appear in the database
                return;
            }
            //Insert the user into the database
            $stmt = $conn->prepare("INSERT INTO bookstore_users (username,email,user_password, verification_code) VALUES (?,?,?,?)");
            //Bind 4 strings: Name, Email, Password, Token
            $stmt->bind_param("ssss", $_SESSION['username'], $_SESSION['email'], $_SESSION['password'], $verification_code);

            //We would like to send a verification email
            if ($stmt->execute()) {
                $_SESSION['send_email_to_signup'] = true;
                $this->mailObject->send_Mail($conf, $mailCnt);
                $this->layout1->header($conf);
                $this->FormObject->verification_form();
            } else {
                echo "Error: " . $stmt->error;
            }
            session_destroy();
        }
    }
    // Add this method to your databaseconnection class
    public function displayUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $conn, $conf;
            $_SESSION['email1'] = $_POST['email1'];
            $_SESSION['password1'] = $_POST['password'];
            $GLOBALS['user_data_retrieval'] = array(
                'name' => $_SESSION['username1'],
                'password' => $_SESSION['password1']
            );

            try {
                $stmt = $conn->prepare("SELECT email FROM bookstore_users WHERE email=? AND user_password=?");
                $stmt->bind_param('ss', $_SESSION['email1'], $_SESSION['password1']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    $this->layout1->header($conf);
                    $this->layout1->homePageContent();
                } else {
                    echo "<script>alert('Invalid username or Password');window.location.href = '/iap-configurations/index.php'</script>";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
            header("Location: /iap-configurations/Global/admin.html");
            exit;
        }
    }
    public function authenticateUser()
    {
        global $layout, $conf;
        if (isset($_GET['error']) && $_GET['error'] === 'invalid_code') {
            echo "<script>alert('Invalid verification code. Please try again.')</script>";
            $layout->header($conf);
            $reauthenticate = new forms();
            $reauthenticate->verification_form();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $conf, $conn, $layout;
            $authentication_code = $_POST['code'];
            $authstmt = $conn->prepare("SELECT verification_code FROM bookstore_users WHERE verification_code=?");
            $authstmt->bind_param("s", $authentication_code);
            $authstmt->execute();
            $authresult = $authstmt->get_result();
            if ($authresult && $authresult->num_rows > 0) {
                $this->layout1->header($conf);
                $this->layout1->homePageContent();
            } else {
                //We redirect the user back to the verification page
                header("Location: /iap-configurations/index.php");
                exit;
                //echo "Error: " . $authstmt->error;
            }
        }
    }
    public function passwordReset()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $conn, $conf, $mailCnt;
            $_SESSION['initialemail'] = $_POST['initialemail'];
            $_SESSION['newpassword'] = $_POST['newpassword'];
            $verification_code = rand(10000, 990000);
            $GLOBALS['resetFunction'] = array(
                'verification_code' => $verification_code,
                'initialemail' => $_SESSION['initialemail']
            );
            $pass_stmt = $conn->prepare("SELECT email FROM bookstore_users WHERE email=?");
            $pass_stmt->bind_param("s", $_SESSION['initialemail']);
            $pass_stmt->execute();
            $executionresult = $pass_stmt->get_result();
            if ($executionresult->num_rows > 0) {
                $this->mailObject->send_Mail($conf, $mailCnt);
                $setverification = $conn->prepare("UPDATE bookstore_users set verification_code=? WHERE email=?");
                $setverification->bind_param("ss", $verification_code, $_SESSION['initialemail']);
                $setverification->execute();
                $setNewPassword = $conn->prepare("UPDATE bookstore_users set user_password=?  WHERE email=?");
                $setNewPassword->bind_param("ss", $_SESSION['newpassword'], $_SESSION['initialemail']);
                $setNewPassword->execute();
                $this->layout1->header($conf);
                $this->FormObject->verification_form();
                // echo "<script>window.location.href='/iap-configurations/index.php';</script>";
            } else {
                echo "<script>alert('Bad Credentials');
                window.location.href = '/iap-configurations/index.php';</script>";
            }
        }
    }
    public function adminAddbookToDatabase()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $conn;
            $_SESSION['book_name'] = $_POST['book_name'];
            $_SESSION['author'] = $_POST['author'];
            $_SESSION['book_price'] = $_POST['book_price'];
            $addStmt = $conn->prepare("INSERT INTO book (book_name,author) VALUES (?,?)");
            $addStmt->bind_param("ss", $_SESSION['book_name'], $_SESSION['author']);
            $addStmt->execute();
            if (!$addStmt->execute()) {
                die("Execute failed: " . $addStmt->error);
            }
        }
    }
}
$dbaseObject1 = new databaseOperations();
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'signup') {
        $dbaseObject1->databaseinsertion();
    } elseif ($_POST['action'] === 'login') {
        $dbaseObject1->displayUsers();
    } elseif ($_POST['action'] === 'passwordReset') {
        $dbaseObject1->passwordReset();
    } elseif ($_POST['action'] === 'addBook') {
        $dbaseObject1->adminAddbookToDatabase();
    }
}
