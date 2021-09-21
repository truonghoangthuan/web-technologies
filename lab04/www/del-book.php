<?php
require "../bootstrap.php";
require "helper.php";

use CT275\Lab4\Book;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['id'])) {
    $book = Book::where('id', $_GET['id']);
    if ($book != null) {
        $book->delete();
        redirect("books.php");
    } else {
        redirect("books.php");
    }
}
