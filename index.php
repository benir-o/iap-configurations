<?php
require_once "classAutoLoad.php";
$layout->header($conf);
print $hello->today();
$form->signup();
$layout->footer($conf);
