<?php
require "../bootstrap.php";
require "helper.php";

use CT275\Lab4\Book;
use CT275\Lab4\Author;

if (
    $_SERVER['REQUEST_METHOD'] == 'GET' &&
    isset($_GET['id']) &&
    Book::find($_GET['id']) != null
) {
    $book = Book::find($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    Author::find($_POST['author_id'])
        ->update([
            'first_name' => $_POST['first_name'],
            'last_name' => $_POST['last_name'],
            'email' => $_POST['email']
        ]);

    Book::find($_POST['book_id'])
        ->update([
            'title' => $_POST['title'],
            'pages_count' => $_POST['pages_count'],
            'price' => $_POST['price'],
            'description' => $_POST['description']
        ]);

    redirect("books.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>Edit book</h2>
    <form action="edit-book.php" method="POST">
        <input type="hidden" name="book_id" value="<?= $book->id ?>">

        <label>Title:</label>
        <input type="text" name="title" value="<?= $book->title ?>">
        <br>

        <label>Num of Pages:</label>
        <input type="number" name="pages_count" value="<?= $book->pages_count ?>">
        <br>

        <label>Price:</label>
        <input type="number" name="price" value="<?= $book->price ?>">
        <br>

        <label>Description:</label>
        <input type="text" name="description" value="<?= $book->description ?>">
        <br>

        <input type="hidden" name="author_id" value="<?= $book->author->id ?>">

        <label>Author's First Name:</label>
        <input type="text" name="first_name" value="<?= $book->author->first_name ?>">
        <br>

        <label>Author's Last Name:</label>
        <input type="text" name="last_name" value="<?= $book->author->last_name ?>">
        <br>

        <label>Author Email:</label>
        <input type="text" name="email" value="<?= $book->author->email ?>">
        <br>

        <input type="submit" name="submit" value="Save" />
    </form>
</body>

</html>