<?php

use function PHPUnit\Framework\fileExists;

spl_autoload_register('myLoad');

function myLoad($class_name)
{
    $path_name = "Global/";
    $file_extension = ".php";
    $full_path = $path_name . $class_name . $file_extension;
    if (!fileExists($full_path)) {
        echo "File Not Found. ";
    }
    include_once $full_path;
}
