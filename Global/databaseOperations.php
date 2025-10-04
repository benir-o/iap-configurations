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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            global $conf, $conn, $layout;
            $authentication_code = $_POST['code'];
            $authstmt = $conn->prepare("SELECT verification_code FROM users WHERE verification_code=?");
            $authstmt->bind_param("s", $authentication_code);
            if ($authstmt->execute()) {
                $layout->header($conf);
                $layout->homePageContent();
            } else {
                echo "Error: " . $authstmt->error;
            }
        }
    }
}
