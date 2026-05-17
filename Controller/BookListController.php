<?php
include_once __DIR__ . "/../Config/Auth.php";
include_once __DIR__ . "/../Model/db.php";

auth_check("member");

$obj = new db();
$conn = $obj->connection();
$books = $obj->GetBooks($conn);

?>
