<?php
include_once '../controller/BorrowController.php';

$controller = new BorrowController();
$requests = $controller->pendingRequests();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Pending Borrow Requests</title>

<style>

body{
    font-family: Arial, sans-serif;
    background: #f4f6f9;
    padding: 30px;
}


.card{
    max-width: 1100px;
    margin: auto;
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
}

h2{
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}


table{
    width: 100%;
    border-collapse: collapse;
    overflow: hidden;
    border-radius: 10px;
}

th{
    background: #4f46e5;
    color: white;
    padding: 14px;
    text-align: left;
}

td{
    padding: 14px;
    border-bottom: 1px solid #eee;
    color: #444;
}

tr:hover{
    background: #f8f9ff;
    transition: 0.3s;
}

.status{
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
    display: inline-block;
}

.pending{
    background: #fff3cd;
    color: #856404;
}

.active{
    background: #d1fae5;
    color: #065f46;
}


button{
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    margin-right: 5px;
    transition: 0.3s;
}

.approve-btn{
    background: #22c55e;
    color: white;
}

.approve-btn:hover{
    background: #16a34a;
}

.reject-btn{
    background: #ef4444;
    color: white;
}

.reject-btn:hover{
    background: #dc2626;
}


@media(max-width:768px){
    body{
        padding: 15px;
    }

    td, th{
        font-size: 13px;
        padding: 10px;
    }

    button{
        padding: 6px 10px;
        font-size: 12px;
    }
}

</style>

</head>

<body>

<div class="card">

<h2>Pending Borrow Requests</h2>

<table>

<tr>
    <th>Member</th>
    <th>Book</th>
    <th>Date</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php foreach($requests as $r) { ?>

<tr id="row-<?= $r['borrow_id']; ?>">

    <td><?= $r['member_name']; ?></td>
    <td><?= $r['book_title']; ?></td>
    <td><?= $r['borrow_date']; ?></td>

    <td>
        <span class="status pending" id="status-<?= $r['borrow_id']; ?>">
            <?= $r['status']; ?>
        </span>
    </td>

    <td>

        <button class="approve-btn" data-id="<?= $r['borrow_id']; ?>">
            Approve
        </button>

        <button class="reject-btn" data-id="<?= $r['borrow_id']; ?>">
            Reject
        </button>

    </td>

</tr>

<?php } ?>

</table>

</div>
<script src="../assets/js/librarian.js"></script>
</body>
</html>