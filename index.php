<?php

require_once "classAutoLoad.php";
// if (isset($_GET['error']) && $_GET['error'] === 'user_exists') {
//     echo "<script>alert('A user with this username or email already exists. Please try another.');</script>";
// }
$layout->header($conf);
$layout->nav($conf);
$layout->banner($conf);
$layout->content();
$layout->footer($conf);
//$page->makebook($author1->author_name, $author1->books);
//$page->makebook();
//$form->signup();
