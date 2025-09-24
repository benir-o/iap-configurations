<?php

require_once "classAutoLoad.php";
$layout->header($conf);
$layout->nav($conf);
$layout->banner($conf);
$layout->content();
$page->makebook($author1->author_name, $author1->books);
//$page->makebook();
//$form->signup();
//$layout->footer($conf);
