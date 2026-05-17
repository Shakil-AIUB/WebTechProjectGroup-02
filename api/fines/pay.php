<?php
session_start();
header('Content-Type: application/json');
if(!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] !== true || $_SESSION["role"] !== "librarian"){ echo json_encode(["success"=>false,"message"=>"Unauthorized"]); exit(); }
include "../../Model/db.php";
$fine_id = isset($_POST["fine_id"]) ? (int)$_POST["fine_id"] : 0;
if($fine_id <= 0){ echo json_encode(["success"=>false,"message"=>"Invalid fine id"]); exit(); }
$database = new db();
$connection = $database->connection();
$ok = $database->payFine($connection, $fine_id);
echo json_encode(["success"=>$ok]);
?>
