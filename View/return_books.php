<?php
include_once '../controller/BorrowController.php';

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
            background: linear-gradient(to right, #eef2f3, #dfe9f3);
            min-height: 100vh;
            padding: 40px;
        }

        .container{
            width: 90%;
            max-width: 1100px;
            margin: auto;
        }

        .card{
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        .title{
            text-align: center;
            margin-bottom: 30px;
        }

        .title h1{
            font-size: 38px;
            color: #222;
            margin-bottom: 10px;
        }

        .title p{
            color: #666;
            font-size: 16px;
        }

       

        .search-box{
            display: flex;
            gap: 10px;
            margin-bottom: 25px;
        }

        .search-box input{
            flex: 1;
            padding: 14px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            outline: none;
        }

        .search-box input:focus{
            border-color: #4f46e5;
        }

        .search-btn{
            background: #4f46e5;
            color: white;
            border: none;
            padding: 14px 22px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .search-btn:hover{
            background: #4338ca;
        }



        table{
            width: 100%;
            border-collapse: collapse;
        }

        th{
            background: #4f46e5;
            color: white;
            padding: 16px;
            text-align: left;
        }

        th:first-child{
            border-top-left-radius: 10px;
        }

        th:last-child{
            border-top-right-radius: 10px;
        }

        td{
            padding: 16px;
            border-bottom: 1px solid #eee;
            color: #444;
        }

        tr:hover{
            background: #f8f9ff;
            transition: 0.3s;
        }

        

        .return-btn{
            background: linear-gradient(to right, #ef4444, #dc2626);
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .return-btn:hover{
            transform: scale(1.05);
            opacity: 0.9;
        }

      

        .no-data{
            text-align: center;
            padding: 20px;
            color: #888;
            font-weight: bold;
        }

     

    </style>

</head>

<body>

<div class="container">

    <div class="card">

        <div class="title">
            <h1>Return Processing</h1>
            <p>Search active loans and process book returns</p>
        </div>

        

        <form method="GET" class="search-box">

            <input 
                type="text" 
                name="search" 
                placeholder="Search member or book..."
                value="<?= $keyword; ?>"
            >

            <button class="search-btn">
                Search
            </button>

        </form>

     

        <table>

            <tr>
                <th>Member</th>
                <th>Book</th>
                <th>Borrow Date</th>
                <th>Action</th>
            </tr>

            <?php if(count($loans) > 0) { ?>

                <?php foreach($loans as $l) { ?>

                <tr id="row-<?= $l['borrow_id']; ?>">

                    <td><?= $l['member_name']; ?></td>

                    <td><?= $l['book_title']; ?></td>

                    <td><?= $l['borrow_date']; ?></td>

                    <td>
                        <button 
                        class="return-btn" 
                        data-id="<?= $l['borrow_id']; ?>"
                        >
                            Process Return
                        </button>
                    </td>

                </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>
                    <td colspan="4" class="no-data">
                        No Active Loans Found
                    </td>
                </tr>

            <?php } ?>

        </table>

    </div>

</div>

<script src="../assets/js/return.js"></script>

</body>
</html>