<?php
require "../Global/bookAuthors.php";
require "../classAutoLoad.php";
require "../conf.php";
class Pages
{
    public $authorSet = [];

    public function __construct($authors = [])
    {
        $this->authorSet = $authors;
    }
    public function bookViewing()
    {
?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4" href="#">
                    <i class="bi bi-book-fill me-2"></i><?php echo "Hello there" ?>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link active" href="/iap-configurations/index.php">Home</a>
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
                            <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
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
                            <img src="https://images.unsplash.com/photo-1613520761471-8d5f28e343c0?w=300&h=400&fit=crop" class="card-img-top book-cover rounded-3" alt="Book Cover">
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

    <?php
    }

    public function makebook($bookAuthor)
    {
    ?>
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
<?php
    }
}
$pages = new Pages([$author1, $author2, $author3, $author4]);
$layout->header($conf);
$pages->bookViewing();
