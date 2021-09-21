<?php
require "../bootstrap.php";

use CT275\Lab4\Book;
use CT275\Lab4\Author;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $author = new Author($_POST);
    $author->save();

    $book = new Book($_POST);
    $author->books()->save($book);
}
redirect("books.php");