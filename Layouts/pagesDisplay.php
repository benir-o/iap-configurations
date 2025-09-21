<?php
require "Pages.php";
require "layouts.php";
$bookLayout = new Layouts();
global $conf;
$bookLayout->header($conf);
$page = new Pages();
$page->bookViewing();
