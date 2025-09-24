<?php

class databaseOperations
{


    public function databaseinsertion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            global $conf, $ObjSendMail, $mailCnt, $conn, $layout; // Access global configuration and mail object

            $username = $_POST['username'];
            $email = $_POST['email'];
            $user_password = $_POST['password'];
            $GLOBALS['user_data'] = array(
                'name' => $username,
                'email' => $email,
                'password' => $user_password,
            );
            //Insert the user into the database
            $stmt = $conn->prepare("INSERT INTO users (username,email,user_password) VALUES (?,?,?)");
            //Bind 4 strings: Name, Email, Password, Token
            $stmt->bind_param("sss", $username, $email, $user_password);

            //We would like to send a verification email
            if ($stmt->execute()) {
                $ObjSendMail->send_Mail($conf, $mailCnt);
                $layout->header($conf);
                $layout->homePageContent($GLOBALS['user_data']['name']);
                echo "Registration successful, check your email to verify";
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
}
