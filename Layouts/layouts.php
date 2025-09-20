<?php

class Layouts
{
    function __construct() {}
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
                                    <li class="nav-item"> <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') echo 'active'; ?>" aria-current="page" href="/iap-configurations/index.php" id="home-nav-link">Home</a> </li>
                                    <li class="nav-item"> <a class="nav-link <?php if (basename($_SERVER['PHP_SELF']) == 'signin.php') echo 'active'; ?>" href="/iap-configurations/Forms/signin.php" id="signin-link">Sign In</a> </li>
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
                            <p class="col-md-8 fs-4">Check out the examples below for how you can remix and restyle it to your liking.</p>
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
                                $signForm->signup();
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                                <h2>About Us</h2>
                                <p>
                                    Welcome to BookHaven, your premier destination for literary discovery and endless reading adventures.
                                    Our carefully curated collection spans over 50,000 titles across every genre imaginable, from heart-pounding thrillers and enchanting fantasy novels to thought-provoking biographies and practical self-help guides.
                                    Whether you're searching for the latest bestsellers, timeless classics, or hidden literary gems waiting to be discovered, BookHaven offers an unparalleled selection at competitive prices.
                                </p>
                            </div>
                        </div>
                    </div>
                <?php
            }
            public function homePageContent($username)
            {
                ?>
                    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
                        <div class="container">
                            <a class="navbar-brand fw-bold fs-4" href="#">
                                <i class="bi bi-book-fill me-2"></i><?php echo "Hello there, " . $username ?>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="navbarNav">
                                <ul class="navbar-nav me-auto">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#books">Books</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#categories">Categories</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#about">About</a>
                                    </li>
                                </ul>
                                <div class="d-flex">
                                    <input class="form-control me-2" type="search" placeholder="Search books..." style="min-width: 250px;">
                                    <button class="btn btn-outline-light me-2" type="submit">
                                        <i class="bi bi-search"></i>
                                    </button>
                                    <button class="btn btn-light me-2">
                                        <i class="bi bi-cart3"></i>
                                        <span class="badge bg-danger">3</span>
                                    </button>
                                    <button class="btn btn-outline-light">
                                        <i class="bi bi-person-circle"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </nav>
                    <section class="bg-primary text-white py-5" id="home">
                        <div class="container py-4">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h1 class="display-4 fw-bold mb-4">Discover Your Next Great Read</h1>
                                    <p class="lead mb-4">Explore thousands of books across all genres. From bestsellers to hidden gems, find your perfect book today.</p>
                                    <button class="btn btn-light btn-lg me-3">
                                        <i class="bi bi-book me-2"></i>Browse Books
                                    </button>
                                    <button class="btn btn-outline-light btn-lg">
                                        <i class="bi bi-star me-2"></i>Best Sellers
                                    </button>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <div class="row">
                                        <div class="col-4 mb-3">
                                            <div class="card bg-info text-white border-0 rounded-4">
                                                <div class="card-body text-center p-4">
                                                    <h3 class="card-title">50K+</h3>
                                                    <p class="card-text mb-0">Books Available</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <div class="card bg-success text-white border-0 rounded-4">
                                                <div class="card-body text-center p-4">
                                                    <h3 class="card-title">25K+</h3>
                                                    <p class="card-text mb-0">Happy Readers</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <div class="card bg-warning text-white border-0 rounded-4">
                                                <div class="card-body text-center p-4">
                                                    <h3 class="card-title">500+</h3>
                                                    <p class="card-text mb-0">Authors</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="py-5" id="books">
                        <div class="container">
                            <div class="row align-items-center mb-5">
                                <div class="col">
                                    <h2 class="mb-0">Featured Books</h2>
                                </div>
                                <div class="col-auto">
                                    <select class="form-select">
                                        <option>Sort by Popularity</option>
                                        <option>Sort by Price: Low to High</option>
                                        <option>Sort by Price: High to Low</option>
                                        <option>Sort by Rating</option>
                                        <option>Sort by Newest</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" id="bookGrid">
                                <!-- Book 1 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1544947950-fa07a98d237f?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">The Silent Patient</h6>
                                            <p class="text-muted small mb-2">Alex Michaelides</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star"></i>
                                                <span class="ms-1 text-muted">4.2</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$14.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Book 2 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">Atomic Habits</h6>
                                            <p class="text-muted small mb-2">James Clear</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <span class="ms-1 text-muted">4.8</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$18.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Book 3 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">The Seven Husbands</h6>
                                            <p class="text-muted small mb-2">Taylor Jenkins Reid</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                                <span class="ms-1 text-muted">4.5</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$16.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--Book 4 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1589998059171-988d887df646?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">Dune</h6>
                                            <p class="text-muted small mb-2">Frank Herbert</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star"></i>
                                                <span class="ms-1 text-muted">4.3</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$19.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book 5 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1592496431122-2349e0fbc666?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">The Psychology of Money</h6>
                                            <p class="text-muted small mb-2">Morgan Housel</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <span class="ms-1 text-muted">4.7</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$15.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book 6 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1512820790803-83ca734da794?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">The Midnight Library</h6>
                                            <p class="text-muted small mb-2">Matt Haig</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-half"></i>
                                                <span class="ms-1 text-muted">4.4</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$17.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book 7 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1543002588-bfa74002ed7e?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">Project Hail Mary</h6>
                                            <p class="text-muted small mb-2">Andy Weir</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <span class="ms-1 text-muted">4.9</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$21.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Book 8 -->
                                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <img src="https://images.unsplash.com/photo-1554415707-6e8cfc93fe23?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
                                        <div class="card-body d-flex flex-column">
                                            <h6 class="card-title fw-bold">The Thursday Murder Club</h6>
                                            <p class="text-muted small mb-2">Richard Osman</p>
                                            <div class="text-warning mb-2">
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star-fill"></i>
                                                <i class="bi bi-star"></i>
                                                <span class="ms-1 text-muted">4.1</span>
                                            </div>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="badge bg-danger rounded-pill px-3 py-2 fs-6">$13.99</span>
                                                <button class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-cart-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </section>
                    <section class="py-5 bg-dark text-white">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-6">
                                    <h3>Stay Updated with New Releases</h3>
                                    <p class="mb-0">Get notified about the latest books and exclusive offers.</p>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Enter your email">
                                        <button class="btn btn-primary" type="button">
                                            <i class="bi bi-envelope-fill me-2"></i>Subscribe
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
