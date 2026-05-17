<?php

include_once '../../Controller/BorrowController.php';

header("Content-Type: application/json");

$id = $_POST['borrow_id'];

$controller = new BorrowController();

$controller->approve($id);

echo json_encode([

    "status" => "success"

]);

?>