<?php
include "../Config/Auth.php";
auth_check("admin");
include "../Model/db.php";
$database = new db();
$connection = $database->connection();
$database->generate_fines($connection);
$books = $database->topBorrowedBooks($connection);
$members = $database->topMembers($connection);
$monthly = $database->monthlyBorrowReport($connection);
$chartLabels = [];
$chartData = [];
while($row = $monthly->fetch_assoc()){ $chartLabels[] = $row["month_label"]; $chartData[] = (int)$row["total"]; }
?>
