<?php

include_once '../Controller/BookController.php';

$controller = new BookController();

$id = $_GET['id'];

$book = $controller->singleBook($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Book Details</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{

            font-family: Arial, Helvetica, sans-serif;

            min-height: 100vh;

            display: flex;

            justify-content: center;

            align-items: center;

            background: linear-gradient(to right, #e0f2fe, #eff6ff);

            padding: 20px;
        }

        .card{

            width: 100%;

            max-width: 520px;

            background: #fff;

            padding: 35px;

            border-radius: 18px;

            box-shadow: 0 10px 30px rgba(0,0,0,0.12);

            transition: 0.3s;
        }

        .card:hover{

            transform: translateY(-5px);
        }

        .title{

            font-size: 34px;

            color: #0f172a;

            margin-bottom: 10px;
        }

        .author{

            font-size: 18px;

            color: #64748b;

            margin-bottom: 25px;
        }

        .box{

            background: #f8fafc;

            padding: 18px;

            border-radius: 12px;

            margin-bottom: 20px;
        }

        .label{

            font-size: 14px;

            color: #475569;

            margin-bottom: 8px;

        }

        .badge{

            display: inline-block;

            padding: 10px 18px;

            border-radius: 30px;

            font-weight: bold;

            font-size: 14px;
        }

        .available{

            background: #dcfce7;

            color: #166534;
        }

        .unavailable{

            background: #fee2e2;

            color: #991b1b;
        }

        .btn{

            display: inline-block;

            margin-top: 10px;

            padding: 12px 18px;

            border-radius: 10px;

            text-decoration: none;

            background: #2563eb;

            color: white;

            font-weight: bold;

            transition: 0.3s;
        }

        .btn:hover{

            background: #1d4ed8;
        }

    </style>

</head>

<body>

<div class="card">

    <h1 class="title">

        <?= $book['book_title']; ?>

    </h1>

    <h3 class="author">

        By <?= $book['book_author']; ?>

    </h3>

    <div class="box">

        <div class="label">

            Availability Status

        </div>

        <div id="availability">

            <?php if($book['available_copies'] > 0){ ?>

                <span class="badge available">

                    Available

                </span>

            <?php } else { ?>

                <span class="badge unavailable">

                    Unavailable

                </span>

            <?php } ?>

        </div>

    </div>

    <a class="btn" href="member_books.php">

        ← Back to Books

    </a>

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
            '<span class="badge available">Available</span>';

        }

        else{

            div.innerHTML =
            '<span class="badge unavailable">Unavailable</span>';

        }

    });

}

updateAvailability();

</script>

</body>
</html>