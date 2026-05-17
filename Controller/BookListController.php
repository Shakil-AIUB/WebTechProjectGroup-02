<?php
<<<<<<< HEAD
include_once __DIR__ . "/../Config/Auth.php";
include_once __DIR__ . "/../Model/db.php";

auth_check("member");

$obj = new db();
$conn = $obj->connection();
$books = $obj->GetBooks($conn);

?>
=======

session_start();

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

$db = new db();

$conn = $db->connection();

$books = $db->GetBooks($conn);

?>
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
