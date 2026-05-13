<?php
session_start();    

include '../../config/database.php';

header('Content-Type: application/json');   

if(!isset($_SESSION['user_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Unauthorized'
    ]);
    exit;
}

$db = new Database(); 

$conn = $db->connection();

$member_id = $_SESSION['member_id'];

$book_id = $_POST['book_id'];

$sql = "

SELECT 
    books.total_copies -

    COUNT(
        CASE
        WHEN borrow_records.status = 'Active'
        THEN 1
        END
    ) AS available

FROM books

LEFT JOIN borrow_records
ON books.id = borrow_records.book_id

WHERE books.id = '$book_id'

GROUP BY books.id

";


$result = $conn->query($sql);

$row = $result->fetch_assoc();
?>
