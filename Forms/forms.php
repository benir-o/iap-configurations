<?php
class forms
{
    public function signup()
    {
?>

        <form method="post" action="">
            <label for="username">Username: </label>
            <input type="text" id="username" placeholder="John Smith">
            <label for="email">Email: </label>
            <input type="email" id="email" required>
            <label for="password">Password: </label>
            <input type="password" id="password">
        </form>

    <?Php
    }
    public function login()
    {
    ?>
        <form method="post" action="">
            <label for="username">Username: </label>
            <input type="text" id="username">
            <label for="password">Password:</label>
            <input type="password" required>
            <input type="submit" value="log in"><a href="./">Don't have an account? Sign up</a>

        </form>
<?php
    }
}
