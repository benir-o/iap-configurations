<?php
class Authors
{
    public $author_name;
    public $books = [];
    public static $authorCollection = [];

    function __construct($author_name, $books = [])
    {
        $this->author_name = $author_name;
        $this->books = $books;
        self::$authorCollection[$author_name] = $this->books;
    }
    public static function displayAllAuthorsandBooks()
    {
        foreach (self::$authorCollection as $bookAuthor => $bookList) {
            echo "Author: " . $bookAuthor . "\nBooks: ";
            foreach ($bookList as $bookName) {
                echo " " . $bookName;
            }
            echo "\n";
        }
    }
    public static function getAuthorBooks($author_name)
    {
        //A ternary operation that checks if the author is within the dataset
        return isset(self::$authorCollection[$author_name]) ? self::$authorCollection[$author_name] : null;
    }
}
$author1 = new Authors("James Clear", ['Atomic Habits', 'Made it Last Year']);
$author2 = new Authors("Morgan Housel", ["The Undoing Project", "The Psychology of Money"]);

Authors::displayAllAuthorsandBooks();
