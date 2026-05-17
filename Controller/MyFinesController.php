<?php
include "../Config/Auth.php";
auth_check("member");
include "../Model/db.php";
$database = new db();
$connection = $database->connection();
$database->generate_fines($connection);
$member_id = $_SESSION["member_id"];
$fines = $database->getMemberFines($connection, $member_id);
$total = 0;
?>
