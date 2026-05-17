<?php

include_once '../Controller/BookController.php';

$controller = new BookController();

$books = $controller->allBooks();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Library Books</title>

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{

            font-family: Arial, Helvetica, sans-serif;

            background: linear-gradient(to right, #eef2ff, #dbeafe);

            min-height: 100vh;

            padding: 40px;
        }

        .container{

            width: 95%;

            max-width: 1200px;

            margin: auto;
        }

        .header{

            text-align: center;

            margin-bottom: 35px;
        }

        .header h1{

            font-size: 42px;

            color: #0f172a;

            margin-bottom: 10px;
        }

        .header p{

            color: #64748b;

            font-size: 16px;
        }

        .card{

            background: white;

            padding: 25px;

            border-radius: 18px;

            box-shadow: 0 10px 25px rgba(0,0,0,0.1);

            overflow-x: auto;
        }

        table{

            width: 100%;

            border-collapse: collapse;
        }

        th{

            background: #2563eb;

            color: white;

            padding: 16px;

            text-align: left;

            font-size: 15px;
        }

        th:first-child{

            border-top-left-radius: 10px;
        }

        th:last-child{

            border-top-right-radius: 10px;
        }

        td{

            padding: 16px;

            border-bottom: 1px solid #e5e7eb;

            color: #334155;

            font-size: 15px;
        }

        tr:hover{

            background: #f8fafc;

            transition: 0.3s;
        }

        .available{

            font-weight: bold;

            color: #16a34a;
        }

        .unavailable{

            font-weight: bold;

            color: #dc2626;
        }

        .btn-group{

            display: flex;

            gap: 10px;

            flex-wrap: wrap;
        }

        .borrow-btn{

            background: linear-gradient(to right, #22c55e, #16a34a);

            color: white;

            border: none;

            padding: 10px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: bold;

            transition: 0.3s;
        }

        .borrow-btn:hover{

            transform: scale(1.05);

            opacity: 0.9;
        }

        .details-btn{

            display: inline-block;

            text-decoration: none;

            background: #2563eb;

            color: white;

            padding: 10px 16px;

            border-radius: 8px;

            font-weight: bold;

            transition: 0.3s;
        }

        .details-btn:hover{

            background: #1d4ed8;
        }

        @media(max-width:768px){

            body{
                padding: 20px;
            }

            .header h1{
                font-size: 30px;
            }

            th, td{
                padding: 12px;
                font-size: 13px;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h1>

            Library Books

        </h1>

        <p>

            Browse, borrow and manage books easily

        </p>

    </div>

    <div class="card">

        <table>

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

                    <?php if($book['available_copies'] > 0){ ?>

                        <span class="available">

                            <?= $book['available_copies']; ?>

                        </span>

                    <?php } else { ?>

                        <span class="unavailable">

                            0

                        </span>

                    <?php } ?>

                </td>

                <td>

                    <div class="btn-group">

                        <button
                        class="borrow-btn"
                        data-id="<?= $book['book_id']; ?>"
                        >

                            Borrow

                        </button>

                        <a
                        class="details-btn"
                        href="book_details.php?id=<?= $book['book_id']; ?>"
                        >

                            Details

                        </a>

                    </div>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

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