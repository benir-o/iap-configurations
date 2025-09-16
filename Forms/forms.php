<?php
class forms
{
    public function signup()
    {
?>

        <form method="post" action="/iap-configurations/Global/validateForm.php">
            <div class="form-custom">
                <div class="container-sm mb3-custom">
                    <div class="mb-3">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="John Smith" aria-label="Username" aria-describedby="basic-addon1">
                        <!--<input type="text" id="username" placeholder="John Smith" name="username">-->
                    </div>
                    <div class="mb-3">
                        <label for="email">Email: </label>
                        <input type="text" id="email" name="email" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                        <!--<input type="email" id="email" required name="email">-->
                    </div>
                    <div class="mb-3">
                        <label for="password">Password: </label>
                        <input type="text" id="password" name="password" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                    <div class="mb-3">
                        <?php $this->submit_button("Sign Up", "signup"); ?> <a href="signin.php">Already have an account? Log in</a>
                    </div>
                    <div class="mb-3">
                        <form method="get" action="/iap-configurations/Global/validateForm.php">
                            <button type="submit" class="btn btn-primary">Get Users</button>
                        </form>

                    </div>
                </div>
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

            </div>

            <!--<input type="password" id="password" name="password">-->
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
        <form method="post" action="">
            <label for="username">Username: </label>
            <input type="text" id="username">
            <br>
            <label for="password">Password:</label>
            <input type="password" required>
            <br>
            <input type="submit" value="log in"><a href="./">Don't have an account? Sign up</a>
        </form>
<?php
    }
}
