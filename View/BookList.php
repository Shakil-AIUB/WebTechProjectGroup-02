<?php

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("admin");

$obj = new db();
$conn = $obj->connection();

$books = $obj->GetBooks($conn);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Books</title>

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

        .red{
            color: red;
            font-weight: bold;
        }

    </style>
</head>

<body>

<h2>Book List</h2>

<table>

<tr>
    <th>Title</th>
    <th>Author</th>
    <th>Genre</th>
    <th>Available</th>
</tr>

<?php
while($row = $books->fetch_assoc())
{
?>

<tr>

    <td><?php echo $row["title"]; ?></td>

    <td><?php echo $row["author"]; ?></td>

    <td><?php echo $row["genre_name"]; ?></td>

    <td>

        <?php

        if($row["available_copies"] > 0)
        {
            echo $row["available_copies"];
        }
        else
        {
            echo "<span class='red'>Unavailable</span>";
        }

        ?>

    </td>

</tr>

<?php
}
?>

</table>

<br>

<a href="admin_dashboard.php">Back</a>

</body>
</html>