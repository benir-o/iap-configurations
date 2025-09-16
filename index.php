<?php

require_once "classAutoLoad.php";
$layout->page_metadata();
?>

<body><?php
        $layout->header($conf);
        $layout->body();
        //$form->signup();
        $layout->footer($conf);
        ?>
</body>
<?php
