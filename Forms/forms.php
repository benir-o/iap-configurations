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
                    <input type="text" id="username" name="username" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="password">Password:</label>
                    <input type="password" name="password" required class="form-control">
                </div>
                <!--<div class="mb-3">
                    <input type="submit" value="log in"><a href="#signUp">Don't have an account? Sign up</a>
                </div>-->
                <div class="mb-3">
                    <?php $this->submit_button("Sign In", "signin"); ?> <a href="#">Don't have an account, Sign up</a>
                </div>


        </form>

        </div>

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
}
