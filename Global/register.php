<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verification_token = bin2hex(random_bytes(50));

    //Insert the user into the database
    $stmt = $conn->prepare("INSERT INTO user_authentication_table (email,password,verification_token) VALUES (?,?,?)");
    //Bind 3 strings: Email, Password, Token
    $stmt->bind_param("sss", $email, $password, $verification_token);

    //We would like to send a verification email
    if ($stmt->execute()) {
        $subject = "Verify your email";
        $verification_link = "http://localhost/iap-configurations/Global/register.php?token=$verify_token";
        $message = "click this link to verify your account: $verification_link";

        //Check on this
        mail($email, $subject, $message, "From: no-reply@domain.com");

        echo "Registration successful, check your email to verify";
    }
}
