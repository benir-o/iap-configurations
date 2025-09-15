<?php
class forms
{
    public function signup()
    {
?>

        <form method="post" action="/iap-configurations/Global/register.php">
            <div class="container-sm mb3-custom">
                <div class="mb-3">
                    <label for="username">Username:</label>
                    <input type="text" id="username" class="form-control" placeholder="John Smith" aria-label="Username" aria-describedby="basic-addon1">
                    <!--<input type="text" id="username" placeholder="John Smith" name="username">-->
                </div>
                <div class="mb-3">
                    <label for="email">Email: </label>
                    <input type="text" id="email" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                    <!--<input type="email" id="email" required name="email">-->
                </div>
                <div class="mb-3">
                    <label for="password">Password: </label>
                    <input type="text" id="password" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="mb-3">
                    <?php $this->submit_button("Sign Up", "signup"); ?> <a href="signin.php">Already have an account? Log in</a>
                </div>
            </div>
            <!--<input type="password" id="password" name="password">-->
        </form>

    <?php
    }

    private function submit_button($value, $name)
    {
    ?>
        <button type="submit" class="btn btn-primary" name="<?php echo $name; ?>" value="<?php echo $value; ?>"><?php echo $value; ?></button>
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
