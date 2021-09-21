<?php require "../bootstrap.php"; ?>
<?php

use CT275\Lab4\Book;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $books = Book::where('title', '=', $_GET['search'])->get();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>

    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h2>List of books: </h2>
    <table style="width:100%">
        <tr>
            <th>Title</th>
            <th>Num of Pages</th>
            <th>Price</th>
            <th>Description</th>
            <th>Author</th>
        </tr>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= $book->title ?></td>
                <td><?= $book->pages_count ?></td>
                <td><?= $book->price ?></td>
                <td><?= $book->description ?></td>
                <td><?= $book->author->first_name . " " . $book->author->last_name
                        . " (" . $book->author->email . ")" ?></td>
            </tr>
        <?php endforeach ?>
    </table>
</body>

</html>