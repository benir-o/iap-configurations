<?php
class forms
{
    public function signup()
    {
?>

        <form method="post" action="/iap-configurations/Global/databaseOperations.php" id="signUp">
            <input type="hidden" name="action" value="signup">
            <div class="container-fluid">
                <h2>Sign Up</h2>
                <p>Sign Up to make online purchases, view books and make reservations</p>
                <div class="mb-3">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Wesley Ogam" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <label for="email">Email: </label>
                    <input type="text" id="email" name="email" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <label for="password">Password: </label>
                    <input type="text" id="password" name="password" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <?php $this->submit_button("Sign Up", "signup"); ?> <a href="#">Already have an account? Log in</a>
                </div>
            </div>
        </form>


    <?php
    }

    private function submit_button($value, $name)
    {
    ?>
        <button type="submit" class="btn btn-primary" name="<?php echo $name; ?>" value="<?php echo $value; ?>"><?php echo $value ?></button>
    <?php
    }
    public function login()
    {
    ?>
        <form method="post" action="/iap-configurations/Global/dataBaseOperations.php" id="signin">
            <input type="hidden" name="action" value="login">
            <div class="container-fluid">
                <h2>Sign in</h2>
                <p>Glad to see you back.</p>
                <div class="mb-3">
                    <label for="username">Username: </label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required class="form-control">
                </div>
                <!--<div class="mb-3">
                    <input type="submit" value="log in"><a href="#signUp">Don't have an account? Sign up</a>
                </div>-->
                <div class="mb-3">
                    <?php $this->submit_button("Sign In", "signin"); ?><br> <a href="#">Don't have an account, Sign up</a><br>
                    <a href="/iap-configurations/Global/passwordReset.php">Forgot Password?</a>
                </div>
            </div>
        </form>


    <?php
    }

    public function addBookToDataBase()
    {
    ?>
        <form id="addBookForm">
            <input type="hidden" name="action" value="addBook">
            <div class="container-fluid">
                <h2>Add Books</h2>
                <div class="mb-3">
                    <label for="bookName">Book Name:</label>
                    <input type="text" id="bookName" name="book_name" class="form-control" placeholder="Add a Book" aria-label="addabook" aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="author">Author: </label>
                    <input type="text" id="author" name="author" class="form-control" required aria-label="Bookauthor" aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <div class="mb-3">
                    <label for="author">Price: </label>
                    <input type="text" id="price" name="book_price" class="form-control" required aria-label="Bookprice" aria-describedby="basic-addon1" autocomplete="off">
                </div>
                <div class="mb-3">
                    <button class="btn btn-primary" onclick="addBook()">
                        Add
                    </button>
                    <div id="message" class="mt-3 text-center"></div>
                </div>
            </div>

        </form>
    <?php
    }
    public function verification_form()
    {
    ?>
        <form method="post" action="/iap-configurations/Global/verifyNewUser.php" id="verificationCodeForm">
            <div class="container-fluid">
                <h2>Enter Code</h2>
                <p>A code was sent to your email Address. Place the code here: </p>
                <div class="mb-3">
                    <label for="code">Verification Code: </label>
                    <input type="text" id="code" name="code" class="form-control">
                </div>
                <div class="mb-3">
                    <?php $this->submit_button("Verify", "verificationcode"); ?>
                </div>
        </form>
    <?php

    }
    public function password_reset_form()
    {
    ?>
        <form method="post" action="/iap-configurations/Global/databaseOperations.php" id="verificationCodeForm">
            <input type="hidden" name="action" value="passwordReset">
            <div class="container-fluid">
                <h2>Reset Password</h2>
                <div class="mb-3">
                    <label for="initialemail">Email Address: </label>
                    <input type="text" id="initialemail" name="initialemail" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="newpassword">New Password: </label>
                    <input type="password" id="newpassword" name="newpassword" class="form-control">
                </div>
                <div class="mb-3">
                    <?php $this->submit_button("Reset Password", "password Reset"); ?>
                </div>
            </div>

        </form>
<?php

    }
}
