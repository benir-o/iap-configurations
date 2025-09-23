<?php
class Books
{
    var $bookName; //String
    var $bookAuthor; //String
    var $bookImage;
    public static $bookCollection = [];
    function __construct($bookName, $bookAuthor, $bookImage)
    {
        $this->bookName = $bookName;
        $this->bookAuthor = $bookAuthor;
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
print_r(Books::getBookCollection()[0]);
