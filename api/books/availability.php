<?php
include_once '../../model/Book.php'

header('Content-Type: application/json');

$book_id = $_GET['id'];

$book = getSingleBook($book_id);

echo json_encode([
    
    "available" => $book['available_copies']

]);
?>