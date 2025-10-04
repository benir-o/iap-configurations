<?php

use function PHPUnit\Framework\fileExists;

spl_autoload_register('myLoad');
$PathDirectories = ["Forms", "Global", "Layouts"];
function myLoad($class_name)
{
    global $PathDirectories;
    foreach ($PathDirectories as $singledirectory) {
        $path_name = $singledirectory . "/";
        $file_extension = ".php";
        $full_path = $path_name . $class_name . $file_extension;
        if (!fileExists($full_path)) {
            echo "File Not Found. ";
        }
        include_once $full_path;
    }
}
