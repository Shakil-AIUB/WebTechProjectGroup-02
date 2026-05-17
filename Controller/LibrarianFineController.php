<?php
include "../Config/Auth.php";
auth_check("librarian");
include "../Model/db.php";
$database = new db();
$connection = $database->connection();
$database->generate_fines($connection);
$search = isset($_GET["search"]) ? trim($_GET["search"]) : "";
$fines = $database->getAllUnpaidFines($connection, $search);
?>
