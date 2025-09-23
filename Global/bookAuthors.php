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
        $authorKey = strtolower($author_name);
        $authorKey = preg_replace("/\s+/", "", $authorKey);
        self::$authorCollection[$authorKey] = $this->books;
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
        //Clean the User Input
        $authorInput = strtolower($author_name);
        $authorCleanInput = preg_replace("/\s+/", "", $authorInput);
        //A ternary operation that checks if the author is within the dataset
        $bookFound = isset(self::$authorCollection[$authorCleanInput]) ? self::$authorCollection[$authorCleanInput] : null;
        print_r($bookFound);
    }
}
$author1 = new Authors("James Clear", ['Atomic Habits', 'The clear Habit Journal']);
$author2 = new Authors("Morgan Housel", [
    "The Psychology of Money",
    "Same as Ever: A Guide to What Never Changes",
    "The Art of Spending Money: Simple Choices for a Richer Life"
]);
$author3 = new Authors("Jane Austen", ["Pride and Prejudice", "Sense and sensibility"]);
$author4 = new Authors("Chimamanda Ngozi Adichie", ["Purple Hibiscus", "Half of a Yellow Sun", "Americana", "Dream Count", "Mama's Sleeping Calf", "The Thing Around Your Neck"]);

//Authors::displayAllAuthorsandBooks();
//Authors::getAuthorBooks("Chimamanda Ngozi Adichie");
