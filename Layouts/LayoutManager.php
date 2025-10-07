<?php
require "booksDisplay.php";
class LayoutManager
{

    private $action;
    private $page;
    private $myBook;
    function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : 'home';
        $this->myBook = new booksDisplay();
    }


    public function header($conf)
    {
?>
        <!DOCTYPE html>
        <html lang="en" data-bs-theme="auto">

        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="description" content="">
            <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
            <meta name="generator" content="Astro v5.13.2">
            <title><?php echo $conf['site_name']; ?></title>
            <link href="<?php echo $conf['site_url']; ?>/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        </head>

        <body>
            <main>
                <div class="container py-4">
                <?php
            }
            public function nav($conf)
            {



                ?>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="./"><?php echo $conf['site_name']; ?></a> <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                            <div class="collapse navbar-collapse" id="navbarsExample05">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="index.php" id="home-nav-link">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="?action=signin" id="signin-link">Sign in</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="?action=signup" id="signup-link">Sign up</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link " href="?action=browseBooks" id="browsebooks"><?php print "Browse books" ?></a>
                                    </li>
                                </ul>
                                <form role="search"> <input class="form-control" type="search" placeholder="Search" aria-label="Search"> </form>
                            </div>
                        </div>
                    </nav>
                <?php
            }
            public function banner($conf)
            {
                ?>
                    <div class="p-1 mb-4 bg-body-tertiary rounded-3">
                        <div class="container-fluid py-1">
                            <h1 class="display-5 fw-bold">Welcome to <?php echo $conf['site_name']; ?></h1>
                            <p class="col-md-8 fs-4">We're fostering a unique reading culture, bringing together everyone's spark.</p>
                            <button class="btn btn-primary btn-lg" type="button">Join now</button>
                        </div>
                    </div>
                <?php
            }
            public function content()
            {
                ?>
                    <div class="row align-items-md-stretch">
                        <div class="col-md-6">
                            <div class="h-100 p-5 text-bg-dark rounded-3">

                                <?php

                                $signForm = new forms();
                                switch ($this->action) {
                                    case "signin":
                                        $signForm->login();
                                        break;
                                    case "signup":
                                        $signForm->signup();
                                        break;
                                    default:
                                        $signForm->login();
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                                <h2>About Us</h2>
                                <p>
                                    Welcome to The Good Bookstore Kenya, your premier destination for literary discovery and endless reading adventures.
                                    Our carefully curated collection spans over 50,000 titles across every genre imaginable, from heart-pounding thrillers and enchanting fantasy novels to thought-provoking biographies and practical self-help guides.
                                    Whether you're searching for the latest bestsellers, timeless classics, or hidden literary gems waiting to be discovered, BookHaven offers an unparalleled selection at competitive prices.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
            }
            public function homePageContent()
            {
                $this->myBook->bookPageNavSection();
                ?>
                    <section class="bg-primary text-white py-5" id="home">
                        <?php
                        $this->myBook->homeSection();
                        ?>
                    </section>
                    <section class="py-5" id="books">
                        <?php
                        $this->myBook->sortBooksSection();
                        $this->myBook->displayBooks() ?>
                    </section>
                    <section class="py-5 bg-dark text-white">
                        <?php
                        $this->myBook->subscribeSection();
                        ?>
                    </section>


                <?
            }

            public function footer($conf)
            {

                ?>
                    <footer class="pt-3 mt-4 text-body-secondary border-top">
                        <p>Copyright &copy; <?php
                                            echo date("Y"); ?> <?php print "The Good BookStore"; ?> - All Rights Reserved</p>
                    </footer>
                </div>
            </main>
            <script src="/js/script.js"></script>
            <script src="<?php echo $conf['site_url']; ?>/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        </body>

        </html>
<?php
            }
        }
