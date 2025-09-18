<?php

require_once "classAutoLoad.php";
$layout->header($conf);
$layout->nav($conf);
$layout->banner($conf);
$layout->content();
$layout->formContent();
//$form->signup();
$layout->footer($conf);
