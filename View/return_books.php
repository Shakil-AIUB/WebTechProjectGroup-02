<?php

include_once '../Controller/BorrowController.php';

$controller = new BorrowController();

$keyword = $_GET['search'] ?? '';

$loans = $controller->searchLoans($keyword);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Return Books</title>

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

            margin-bottom: 30px;
        }

        .header h1{

            font-size: 40px;

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

        .search-box{

            display: flex;

            gap: 10px;

            margin-bottom: 20px;
        }

        .search-box input{

            flex: 1;

            padding: 12px;

            border: 1px solid #cbd5e1;

            border-radius: 8px;

            outline: none;

        }

        .search-box input:focus{

            border-color: #2563eb;
        }

        .search-box button{

            padding: 12px 18px;

            border: none;

            background: #2563eb;

            color: white;

            font-weight: bold;

            border-radius: 8px;

            cursor: pointer;

            transition: 0.3s;
        }

        .search-box button:hover{

            background: #1d4ed8;
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

        button.return-btn{

            background: linear-gradient(to right, #ef4444, #dc2626);

            color: white;

            border: none;

            padding: 10px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: bold;

            transition: 0.3s;
        }

        button.return-btn:hover{

            transform: scale(1.05);
        }

        .empty{

            text-align: center;

            padding: 25px;

            color: #64748b;

            font-weight: bold;
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

            Return Processing

        </h1>

        <p>

            Search active loans and process returns

        </p>

    </div>

    <div class="card">

        <form class="search-box">

            <input
                type="text"
                name="search"
                value="<?= $keyword; ?>"
                placeholder="Search member or book..."
            >

            <button>

                Search

            </button>

        </form>

        <table>

            <tr>

                <th>Member</th>

                <th>Book</th>

                <th>Date</th>

                <th>Action</th>

            </tr>

            <?php if(count($loans) > 0){ ?>

                <?php foreach($loans as $l){ ?>

                <tr id="row-<?= $l['borrow_id']; ?>">

                    <td>

                        <?= $l['member_name']; ?>

                    </td>

                    <td>

                        <?= $l['book_title']; ?>

                    </td>

                    <td>

                        <?= $l['borrow_date']; ?>

                    </td>

                    <td>

                        <button
                        class="return-btn"
                        data-id="<?= $l['borrow_id']; ?>"
                        >

                            Return

                        </button>

                    </td>

                </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td colspan="4" class="empty">

                        No Active Loans Found

                    </td>

                </tr>

            <?php } ?>

        </table>

    </div>

</div>

<script>

document.querySelectorAll(".return-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/return.php", {

            method: "POST",

            body: new URLSearchParams({

                borrow_id: id

            })

        })

        .then(res => res.json())

        .then(data => {

            alert(data.message);

            document.getElementById("row-" + id).remove();

        });

    });

});

</script>

</body>
</html>