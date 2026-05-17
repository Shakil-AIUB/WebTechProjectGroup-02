<?php

include_once '../../Controller/BorrowController.php';

header("Content-Type: application/json");

$id = $_POST['borrow_id'];

$controller = new BorrowController();

$controller->reject($id);

<<<<<<< HEAD
echo json_encode([

    "status" => "success"

]);

=======
echo json_encode(["status" => "success"]);
>>>>>>> 75a8a0a245e5889229a2779f1713530bf8f94ecc
?>