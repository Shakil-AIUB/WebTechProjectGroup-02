<?php

session_start();

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

$db = new db();

$conn = $db->connection();

$totalBooks = $db->totalBooks($conn);

$issuedToday = $db->issuedToday($conn);

$returnedToday = $db->returnedToday($conn);

$pendingReturns = $db->pendingReturns($conn);

$activities = $db->recentActivities($conn);

?>