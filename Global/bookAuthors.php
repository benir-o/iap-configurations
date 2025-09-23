<?php
class Authors
{
    public String $author_name;
    public String $books = [];

    function __construct($author_name, $author_books)
    {
        $this->author_name = $author_name;
        $this->books = $author_books;
    }
}
$author1 = new Authors("James Clear", ['Atomic Habits', 'Made it Last Year']);
