<?php
class Layouts
{
    public function header($conf)
    {
?>

        <div class="container-md bg-success rounded-4 p-4 my-5 shadow">
            <header>
                <h1>Welcome to <?php print $conf['site_name']; ?></h1>
            </header>
        </div>

    <?php
    }
    public function page_metadata()
    {
    ?>

        <head>

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="Layouts/custom.css" rel="stylesheet">
        </head>
    <?php
    }

    public function footer($conf)
    {
    ?>
        <div class="container-md bg-light rounded-4 p-4 my-5 shadow themed-container">
            <footer>
                <p>Copyright &copy; <?php echo date("Y"); ?> <?php print $conf['site_name']; ?> - All rights Reserved</p>
            </footer>
        </div>

<?php
    }
}
