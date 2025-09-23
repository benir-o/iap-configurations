<?php
class Books
{
    var $bookTitle; //String
    var $bookImage; //Link in the form of a string
    public static $bookCollection = [];
    function __construct($bookTitle, $bookImage)
    {
        $this->bookTitle = $bookTitle;
        $this->bookImage = $bookImage;
        //Using self method to access the class itself
        self::$bookCollection[] = $this;
    }
    //     public static function getBook($bookName) {
    //     return isset(self::$allBooks[$bookName]) ? self::$allBooks[$bookName] : null;
    // }

    // public static function getAllBooks() {
    //     return self::$allBooks;
    // }

    public static function getBookCollection()
    {
        return self::$bookCollection;
    }
}
$book1 = new Books("1984", "George Orwell", "1984.jpg");
$book2 = new Books("To Kill a Mockingbird", "Harper Lee", "mockingbird.jpg");

// Access all books
//The model Approach: 1 Author can have many books
print_r(Books::getBookCollection()[0]);
