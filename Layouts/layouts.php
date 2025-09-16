<?php

class Layouts
{
    public function header($conf)
    {
?>

        <!--<div class="container-md bg-success rounded-4 p-4 my-5 shadow">
            <header>
                <h1>Welcome to <?php print $conf['site_name']; ?></h1>
            </header>
        </div>-->

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
    public function body()
    {
    ?>

        <body>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navbar</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="#signup">Sign up</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#signin">Sign in</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" aria-disabled="true">Disabled</a>
                            </li>
                        </ul>
                        <form class="d-flex" role="search">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
            <?php
            $form = new forms();
            $form->signup();
            ?>
            <div class="container-sm mb3-custom">
                <h2>Why Join Us?</h2>
                <p>
                    By signing up, you’ll get access to exclusive features,
                    personalized content, and much more.
                    <strong>Ut Omnes Unum Sint</strong> is a Latin phrase meaning
                    <em>"That all may be one."</em> It emphasizes the importance of
                    unity, cooperation, and harmony among people. Often used as a motto
                    in educational, religious, and community settings, it reminds us that
                    despite our differences, we are called to work together towards a
                    common purpose.
                </p>
            </div>



        </body>
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
