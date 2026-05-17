<?php

include_once '../Controller/BorrowController.php';

$controller = new BorrowController();

$requests = $controller->pendingRequests();

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pending Requests</title>

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

        .status{

            display: inline-block;

            padding: 8px 14px;

            border-radius: 20px;

            font-size: 13px;

            font-weight: bold;
        }

        .pending{

            background: #fef3c7;

            color: #92400e;
        }

        .active{

            background: #dcfce7;

            color: #166534;
        }

        .btn-group{

            display: flex;

            gap: 10px;

            flex-wrap: wrap;
        }

        button{

            border: none;

            padding: 10px 16px;

            border-radius: 8px;

            cursor: pointer;

            font-weight: bold;

            transition: 0.3s;
        }

        .approve-btn{

            background: linear-gradient(to right, #22c55e, #16a34a);

            color: white;
        }

        .approve-btn:hover{

            transform: scale(1.05);
        }

        .reject-btn{

            background: linear-gradient(to right, #ef4444, #dc2626);

            color: white;
        }

        .reject-btn:hover{

            transform: scale(1.05);
        }

        .empty{

            text-align: center;

            padding: 30px;

            color: #64748b;

            font-size: 18px;

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

            Pending Borrow Requests

        </h1>

        <p>

            Approve or reject book borrow requests

        </p>

    </div>

    <div class="card">

        <table>

            <tr>

                <th>Member</th>

                <th>Book</th>

                <th>Status</th>

                <th>Action</th>

            </tr>

            <?php if(count($requests) > 0){ ?>

                <?php foreach($requests as $r){ ?>

                <tr id="row-<?= $r['borrow_id']; ?>">

                    <td>

                        <?= $r['member_name']; ?>

                    </td>

                    <td>

                        <?= $r['book_title']; ?>

                    </td>

                    <td>

                        <span
                        class="status pending"
                        id="status-<?= $r['borrow_id']; ?>"
                        >

                            <?= $r['status']; ?>

                        </span>

                    </td>

                    <td>

                        <div class="btn-group">

                            <button
                            class="approve-btn"
                            data-id="<?= $r['borrow_id']; ?>"
                            >

                                Approve

                            </button>

                            <button
                            class="reject-btn"
                            data-id="<?= $r['borrow_id']; ?>"
                            >

                                Reject

                            </button>

                        </div>

                    </td>

                </tr>

                <?php } ?>

            <?php } else { ?>

                <tr>

                    <td colspan="4" class="empty">

                        No Pending Requests

                    </td>

                </tr>

            <?php } ?>

        </table>

    </div>

</div>

<script>

document.querySelectorAll(".approve-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/approve.php", {

            method: "POST",

            body: new URLSearchParams({

                borrow_id: id

            })

        })

        .then(res => res.json())

        .then(data => {

            if(data.status === "success"){

                let status = document.getElementById("status-" + id);

                status.innerText = "Active";

                status.classList.remove("pending");

                status.classList.add("active");

            }

        });

    });

});

document.querySelectorAll(".reject-btn").forEach(btn => {

    btn.addEventListener("click", function(){

        let id = this.dataset.id;

        fetch("../api/borrow/reject.php", {

            method: "POST",

            body: new URLSearchParams({

                borrow_id: id

            })

        })

        .then(res => res.json())

        .then(data => {

            if(data.status === "success"){

                document.getElementById("row-" + id).remove();

            }

        });

    });

});

</script>

</body>
</html>