<?php

require_once '../classAutoLoad.php'; // Include the autoloader


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $conf, $ObjSendMail, $mailCnt, $conn; // Access global configuration and mail object

    $name = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verification_token = bin2hex(random_bytes(50));

    //Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO users (name,email,password) VALUES (?,?,?)");
    //Bind 4 strings: Name, Email, Password, Token
    $stmt->bind_param("sss", $name, $email, $password);

    //We would like to send a verification email
    if ($stmt->execute()) {
        $subject = "Verify your email";
        $verification_link = "http://localhost/iap-configurations/Global/register.php?token=$verification_token"; // Assuming a verify.php exists
        $message = "Click this link to verify your account: <a href='$verification_link'>$verification_link</a>";


        $ObjSendMail->send_Mail($conf, $mailCnt);

        echo "Registration successful, check your email to verify";
    } else {
        echo "Error: " . $stmt->error;
    }
}
