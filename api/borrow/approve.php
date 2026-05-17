<?php

<<<<<<< HEAD
include_once '../../Controller/BorrowController.php';

header("Content-Type: application/json");

$id = $_POST['borrow_id'];

$controller = new BorrowController();

$controller->approve($id);

echo json_encode([

    "status" => "success"

]);

=======
$db = new Database();
$conn = $db->connection();
$id = $_POST['borrow_id'];
$sql = "UPDATE borrow_records SET status='Active' WHERE borrow_id='$id'";


$conn->query($sql);

echo json_encode(["status"=>"success"]);
>>>>>>> 75a8a0a245e5889229a2779f1713530bf8f94ecc
?>