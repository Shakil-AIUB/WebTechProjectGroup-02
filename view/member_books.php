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
            background: linear-gradient(to right, #eef2f3, #dfe9f3);
            min-height: 100vh;
            padding: 50px;
        }

        .container{
            width: 90%;
            max-width: 1100px;
            margin: auto;
        }

        .title{
            text-align: center;
            margin-bottom: 35px;
        }

        .title h1{
            color: #222;
            font-size: 40px;
            margin-bottom: 10px;
        }

        .title p{
            color: #666;
            font-size: 16px;
        }

        .card{
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: #4f46e5;
            color: white;
            padding: 18px;
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
            padding: 18px;
            border-bottom: 1px solid #eee;
            color: #444;
            font-size: 15px;
        }

        tr:hover{
            background-color: #f8f9ff;
            transition: 0.3s;
        }

        .borrow-btn{
            background: linear-gradient(to right, #22c55e, #16a34a);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .borrow-btn:hover{
            transform: scale(1.05);
            opacity: 0.9;
        }

        .copies{
            font-weight: bold;
            color: #2563eb;
        }

        @media(max-width:768px){

            body{
                padding: 20px;
            }

            .title h1{
                font-size: 28px;
            }

            table{
                font-size: 14px;
            }

            th, td{
                padding: 12px;
            }

        }

    </style>

</head>

<body>

<?php
include '../controller/BorrowController.php';
?>

<div class="container">

    <div class="title">
        <h1>Library Book List</h1>
        <p>Browse available books and borrow your favorite one</p>
    </div>

    <div class="card">

        <table>

            <tr>
                <th>Book Title</th>
                <th>Author</th>
                <th>Total Copies</th>
                <th>Action</th>
            </tr>

            <?php foreach($books as $book) { ?>

            <tr>

                <td>
                    <?= $book['book_title']; ?>
                </td>

                <td>
                    <?= $book['book_author']; ?>
                </td>

                <td class="copies">
                    <?= $book['book_total_copies']; ?>
                </td>

                <td>
                    <button class="borrow-btn">
                        Borrow
                    </button>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>