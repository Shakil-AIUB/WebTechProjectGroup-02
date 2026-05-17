<?php

session_start();

include_once '../../Controller/BorrowController.php';

header("Content-Type: application/json");

if(!isset($_SESSION['member_id'])){

    echo json_encode([

        "status" => "error",
        "message" => "Please Login"

    ]);

    exit();
}

$member_id = $_SESSION['member_id'];

$book_id = $_POST['book_id'];

$controller = new BorrowController();

$controller->requestBook(
    $member_id,
    $book_id
);

echo json_encode([

    "status" => "success",
    "message" => "Borrow Request Sent"

]);

?>