<?php

include_once '../controller/BorrowController.php';

$controller = new BorrowController();

$book_id = $_GET['id'] ?? 0;

$book = $controller->singleBook($book_id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Details</title>
</head>
<body>
    <div class="card">
        <h1>
            <?php echo $book['book_title']?>

        </h1>
        <h3>
             <?php echo $book['book_author']; ?>
        </h3>

        <div id="availability-badge">

        <?php
         if($book['available_copies'] > 0){
            echo '<span class="badge available">
                Available
            </span>';
         }
         else{
            echo '<span class="badge available">
                Unavailable
            </span>';
         }

        ?>

        </div>

    </div>

    <script>
        const BOOK_ID = <?php echo $book_id; ?>;
    </script>

    <script src=""></script>
</body>
</html>