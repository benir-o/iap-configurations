<?php
class forms
{
    public function signup()
    {
?>

        <form method="post" action="/iap-configurations/Global/register.php">
            <div class="container-md bg-light rounded-4 p-4 my-5 shadow">
                <label for="username">Username:</label>
                <input type="text" id="username" class="form-control" placeholder="John Smith" aria-label="Username" aria-describedby="basic-addon1">
                <!--<input type="text" id="username" placeholder="John Smith" name="username">-->
                <br>
                <label for="email">Email: </label>
                <input type="text" id="email" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                <!--<input type="email" id="email" required name="email">-->
                <br>
                <label for="password">Password: </label>
                <input type="text" id="password" class="form-control" required aria-label="Username" aria-describedby="basic-addon1">
                <br>
                <!--<input type="password" id="password" name="password">-->

                <button type="button" class="btn btn-primary">Register</button>
            </div>
        </form>
        <br>

    <?Php
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
