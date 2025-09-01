<?php
class forms
{
    public function signup()
    {
?>

        <form method="post" action="">
            <label for="username">Username: </label>
            <input type="text" id="username" placeholder="John Smith">
            <br>
            <label for="email">Email: </label>
            <input type="email" id="email" required>
            <br>
            <label for="password">Password: </label>
            <input type="password" id="password">
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
