<?php

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("admin");

$obj = new db();
$conn = $obj->connection();
$result = $obj->GetAllUsers($conn);


?>

<!DOCTYPE html>
<html>
<head>
    <title>Users</title>

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

<h2>All Users</h2>

<table>

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Role</th>
</tr>

<?php
while($row = $result->fetch_assoc())
{
?>

<tr>

    <td><?php echo $row["id"]; ?></td>

    <td><?php echo $row["name"]; ?></td>

    <td><?php echo $row["email"]; ?></td>

    <td><?php echo $row["phone"]; ?></td>

    <td><?php echo $row["role"]; ?></td>

</tr>

<?php
}
?>

</table>

<br>

<a href="admin_dashboard.php">Back</a>

</body>
</html>