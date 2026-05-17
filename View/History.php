<?php

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("member");

$obj = new db();
$conn = $obj->connection();

$member_id = $_SESSION["member_id"];

$history = $obj->getBorrowHistory($conn, $member_id);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Borrow History</title>

    <style>
        body{
            font-family: Arial;
            background: #f4f6f9;
            padding: 40px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th{
            background: #1a3a5c;
            color: white;
            padding: 12px;
        }

        td{
            padding: 12px;
            border-bottom: 1px solid #eee;
        }
    </style>
</head>

<body>

<h2>Borrow History</h2>

<table>
    <tr>
        <th>Book</th>
        <th>Borrow Date</th>
        <th>Due Date</th>
        <th>Status</th>
    </tr>

    <?php
    if($history && $history->num_rows > 0)
    {
        while($row = $history->fetch_assoc())
        {
    ?>

    <tr>
        <td><?php echo htmlspecialchars($row["title"]); ?></td>
        <td><?php echo htmlspecialchars($row["borrow_date"]); ?></td>
        <td><?php echo htmlspecialchars($row["due_date"]); ?></td>
        <td><?php echo htmlspecialchars($row["status"]); ?></td>
    </tr>

    <?php
        }
    }
    else
    {
    ?>

    <tr>
        <td colspan="4">No borrow history found.</td>
    </tr>

    <?php
    }
    ?>
</table>

<br>

<a href="member_dashboard.php">Back</a>

</body>
</html>