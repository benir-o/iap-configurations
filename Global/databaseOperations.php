<?php

//require_once '../classAutoLoad.php'; // Include the autoloader

class databaseOperations
{

    public function databaseinsertion()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            global $conf, $ObjSendMail, $mailCnt, $conn; // Access global configuration and mail object

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
                echo "Registration successful, check your email to verify";
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
    // Add this method to your databaseconnection class
    public function displayUsers()
    {
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
                echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
                echo "<thead>";
                echo "<tr><th>Username</th><th>Email</th></tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['username'] ?? '') . "</td>";
                    echo "<td>" . htmlspecialchars($row['email'] ?? '') . "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<script>alert('Invalid username or Password')</script>";
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
