<?php
include '../config/database.php';

function getBooks() {
    $db = new Database();
    $conn = $db->connection();

    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    $books = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $books[] = $row;
        }
    }

    return $books;
}   



?>