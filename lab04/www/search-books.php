<?php
require "../bootstrap.php";

use Gregwar\Captcha\PhraseBuilder;

use CT275\Lab4\Book;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Checking that the posted phrase match the phrase stored in the session
    if (isset($_GET['phrase']) && PhraseBuilder::comparePhrases($_GET['phrase'], $_GET['phrase'])) {
        $keyword = "%" . $_GET['search'] . "%";
        $books = Book::join('authors', 'authors.id', '=', 'books.author_id')
            ->where('books.title', 'like', $keyword)
            ->orWhere('authors.first_name', 'like', $keyword)
            ->orWhere('authors.last_name', 'like', $keyword)
            ->orWhereRaw("CONCAT(authors.first_name, ' ', authors.last_name) LIKE ?", $keyword)
            ->get();
    } else {
        echo "<h1>Captcha is not valid!</h1>";
    }
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
        <?php foreach ($books as $book) : ?>
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
    <a href="books.php">Back to homepage</a>
</body>

</html>