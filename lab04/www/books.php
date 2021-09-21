<?php
require "../bootstrap.php";

use CT275\Lab4\Book;

$books = Book::all();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>

	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<h2>Add new book</h2>
	<form action="add-book.php" method="POST">
		<label>Title:</label> <input type="text" name="title" /> <br><br>
		<label>Num of Pages:</label> <input type="number" name="pages_count" /> <br><br>
		<label>Price:</label> <input type="number" name="price" /> <br><br>
		<label>Description:</label> <input type="text" name="description" /> <br><br>
		<label>Author's First Name:</label> <input type="text" name="first_name" /> <br><br>
		<label>Author's Last Name:</label> <input type="text" name="last_name" /> <br><br>
		<label>Author Email:</label> <input type="text" name="email" /> <br><br>
		<input type="submit" name="submit" value="Save" />
	</form>
	<hr>

	<form action="search-books.php" method="get">
		Search: <input type="text" name="search">
		<button type="submit">Search</button>
	</form>
	<hr>

	<h2>List of books: </h2>
	<table style="width:100%">
		<tr>
			<th>Title</th>
			<th>Num of Pages</th>
			<th>Price</th>
			<th>Description</th>
			<th>Author</th>
			<th>Delete</th>
			<th>Edit</th>
		</tr>
		<?php foreach ($books as $book) : ?>
			<tr>
				<td><?= $book->title ?></td>
				<td><?= $book->pages_count ?></td>
				<td><?= $book->price ?></td>
				<td><?= $book->description ?></td>
				<td><?= $book->author->first_name . " " . $book->author->last_name
						. " (" . $book->author->email . ")" ?></td>
				<td>
					<form action="del-book.php" method="get">
						<input type="hidden" name="id" value="<?= $book->id ?>">
						<button type="submit">Delete</button>
					</form>
				</td>
				<td>
					<form action="edit-book.php" method="get">
						<input type="hidden" name="id" value="<?= $book->id ?>">
						<input type="hidden" name="author_id" value="<?= $book->author->id ?>">
						<button type="submit">Edit</button>
					</form>
				</td>
			</tr>
		<?php endforeach ?>
	</table>
</body>

</html>