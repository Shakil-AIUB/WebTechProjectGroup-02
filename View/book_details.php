<?php

include_once '../Controller/BookController.php';

$controller = new BookController();

$id = $_GET['id'];

$book = $controller->singleBook($id);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Book Details</title>
</head>
<body>

<h1>
    <?= $book['book_title']; ?>
</h1>

<h3>
    <?= $book['book_author']; ?>
</h3>

<div id="availability">

<?php if($book['available_copies'] > 0){ ?>

    <span>Available</span>

<?php } else { ?>

    <span>Unavailable</span>

<?php } ?>

</div>

<script>

const BOOK_ID = <?= $id ?>;

function updateAvailability(){

    fetch(
        "../api/books/availability.php?id=" + BOOK_ID
    )

    .then(res => res.json())

    .then(data => {

        let div =
        document.getElementById("availability");

        if(data.available > 0){

            div.innerHTML =
            "<span>Available</span>";

        }

        else{

            div.innerHTML =
            "<span>Unavailable</span>";

        }

    });

}

updateAvailability();

</script>

</body>
</html>