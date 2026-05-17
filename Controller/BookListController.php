<?php

session_start();

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

$db = new db();

$conn = $db->connection();

$books = $db->GetBooks($conn);

?>