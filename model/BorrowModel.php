<?php
include_once '../config/database.php';

function getPendingRequests()
{
    $db = new Database();
    $conn = $db->connection();

    $sql = "

    SELECT 
        borrow_records.borrow_id,
        members.member_name,
        books.book_title,
        borrow_records.borrow_date,
        borrow_records.status

    FROM borrow_records

    JOIN members 
    ON members.member_id = borrow_records.member_id

    JOIN books 
    ON books.book_id = borrow_records.book_id

    WHERE borrow_records.status = 'Pending'

    ";

    $result = $conn->query($sql);

    $data = [];

    while($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    return $data;
}
?>