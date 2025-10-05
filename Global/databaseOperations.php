<?php
require_once __DIR__ . '/../Forms/forms.php';
class databaseOperations
{


    public function databaseinsertion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            global $conf, $ObjSendMail, $mailCnt, $conn, $layout; // Access global configuration and mail object

            $username = $_POST['username'];
            $email = $_POST['email'];
            $user_password = $_POST['password'];
            $verification_code = rand(10000, 990000);
            $GLOBALS['user_data'] = array(
                'name' => $username,
                'email' => $email,
                'password' => $user_password,
                'verification_code' => $verification_code
            );
            // Check if user already exists (by email or username)
            $checkStmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
            $checkStmt->bind_param("ss", $username, $email);
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
            $stmt->bind_param("ssss", $username, $email, $user_password, $verification_code);

            //We would like to send a verification email
            if ($stmt->execute()) {
                $ObjSendMail->send_Mail($conf, $mailCnt);
                $layout->header($conf);
                $myForm = new forms();
                $myForm->verification_form();
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
    // Add this method to your databaseconnection class
    public function displayUsers()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            global $conn;
            $username = $_GET['username'];
            $user_password = $_GET['password'];
            $GLOBALS['user_data_retrieval'] = array(
                'name' => $username,
                'password' => $user_password
            );

            try {
                $stmt = $conn->prepare("SELECT username, email FROM users WHERE username=? AND user_password=?");
                $stmt->bind_param('ss', $username, $user_password);
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
        $layout->header($conf);
        $layout->homePageContent($GLOBALS['user_data_retrieval']['name']);
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
                $layout->header($conf);
                $layout->homePageContent();
            } else {
                //We redirect the user back to the verification page
                header("Location: /iap-configurations/Global/verificationForm.php?error=invalid_code");
                exit;
                //echo "Error: " . $authstmt->error;
            }
        }
    }
}
