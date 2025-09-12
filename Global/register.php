<?php

require_once '../classAutoLoad.php'; // Include the autoloader


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
