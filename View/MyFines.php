<?php

include "../Controller/MyFinesController.php";

?>

<!DOCTYPE html>
<html>
<head>
    <title>My Fines</title>

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
            padding: 10px;
        }

        td{
            padding: 10px;
            border-bottom: 1px solid #eee;
        }

        .total{
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }

    </style>
</head>

<body>

<h2>My Fines</h2>

<table>

<tr>
    <th>Book</th>
    <th>Due Date</th>
    <th>Days</th>
    <th>Amount</th>
</tr>

<?php

$total = 0;

if($fines && $fines->num_rows > 0)
{
    while($row = $fines->fetch_assoc())
    {
        $total += $row["amount"];

?>

<tr>

    <td><?php echo $row["title"]; ?></td>

    <td><?php echo $row["due_date"]; ?></td>

    <td><?php echo $row["overdue_days"]; ?></td>

    <td><?php echo $row["amount"]; ?> TK</td>

</tr>

<?php

    }
}
else
{
?>

<tr>
    <td colspan="4">
        No unpaid fines found.
    </td>
</tr>

<?php
}
?>

</table>

<p class="total">
    Total Fine:
    <?php echo $total; ?> TK
</p>

<br>

<a href="member_dashboard.php">
    Back
</a>

</body>
</html>