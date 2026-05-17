<?php

include_once '../Controller/BookController.php';

$controller = new BookController();

$books = $controller->allBooks();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
</head>
<body>

<h1>Library Books</h1>

<table border="1" cellpadding="10">

<tr>

    <th>Title</th>
    <th>Author</th>
    <th>Available</th>
    <th>Action</th>

</tr>

<?php foreach($books as $book){ ?>

<tr>

    <td>
        <?= $book['book_title']; ?>
    </td>

    <td>
        <?= $book['book_author']; ?>
    </td>

    <td>
        <?= $book['available_copies']; ?>
    </td>

    <td>

        <button
        class="borrow-btn"
        data-id="<?= $book['book_id']; ?>"
        >
            Borrow
        </button>

        <a href="book_details.php?id=<?= $book['book_id']; ?>">
            Details
        </a>

    </td>

</tr>

<?php } ?>

</table>

<script>

document.querySelectorAll(".borrow-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        let formData = new FormData();

        formData.append("book_id", id);

        fetch("../api/borrow/request.php", {

            method: "POST",

            body: formData

        })

        .then(res => res.json())

        .then(data => {

            alert(data.message);

            location.reload();

        });

    });

});

</script>

</body>
</html>