<?php
include_once '../../config/database.php';

$db = new Database();
$conn = $db->connection();
$id = $_POST['borrow_id'];
$sql = "UPDATE borrow_records SET status='Active' WHERE borrow_id='$id'";


$conn->query($sql);

echo json_encode(["status"=>"success"]);
?>