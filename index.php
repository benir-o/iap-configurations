<?php

require_once "classAutoLoad.php";
$layout->header($conf);
print $hello->today();
$form->login();

$layout->footer($conf);
