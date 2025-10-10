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
            global $conf, $ObjSendMail, $mailCnt, $conn, $layout; // Access global configuration and mail object

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
            $checkStmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
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
            $stmt = $conn->prepare("INSERT INTO users (username,email,user_password, verification_code) VALUES (?,?,?,?)");
            //Bind 4 strings: Name, Email, Password, Token
            $stmt->bind_param("ssss", $_SESSION['username'], $_SESSION['email'], $_SESSION['password'], $verification_code);

            //We would like to send a verification email
            if ($stmt->execute()) {
                // $ObjSendMail->send_Mail($conf, $mailCnt);
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
            global $conn;
            $_SESSION['username1'] = $_POST['username'];
            $_SESSION['password1'] = $_POST['password'];
            $GLOBALS['user_data_retrieval'] = array(
                'name' => $_SESSION['username1'],
                'password' => $_SESSION['password1']
            );

            try {
                $stmt = $conn->prepare("SELECT username, email FROM users WHERE username=? AND user_password=?");
                $stmt->bind_param('ss', $_SESSION['username1'], $_SESSION['password1']);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {

                    $this->showHomepage();
                } else {
                    echo "<script>alert('Invalid username or Password')</script>";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
    private function showHomePage()
    {
        global $conf, $layout;
        $this->layout1->header($conf);
        $this->layout1->homePageContent();
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
            $authstmt = $conn->prepare("SELECT verification_code FROM users WHERE verification_code=?");
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
}
$dbaseObject1 = new databaseOperations();
if (isset($_POST['action'])) {
    if ($_POST['action'] === 'signup') {
        $dbaseObject1->databaseinsertion();
    } elseif ($_POST['action'] === 'login') {
        $dbaseObject1->displayUsers();
    }
}
