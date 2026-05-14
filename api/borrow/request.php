<?php

session_start();

include_once '../../config/database.php';

header("Content-Type: application/json");

if(!isset($_SESSION['member_id'])){
    echo json_encode([
        "status" => "error",
        "message" => "Please login first"
    ]);
    exit();
}

$db = new Database();
$conn = $db->connection();

$member_id = $_SESSION['member_id'];
$book_id = $_POST['book_id'];

$sql = "
SELECT 
    books.book_total_copies -
    COUNT(
        CASE
        WHEN borrow_records.status = 'Active'
        THEN 1
        END
    ) AS available
FROM books
LEFT JOIN borrow_records
ON books.book_id = borrow_records.book_id
WHERE books.book_id = '$book_id'
GROUP BY books.book_id
";

$result = $conn->query($sql);
$row = $result->fetch_assoc();

if($row['available'] <= 0){
    echo json_encode([
        "status" => "error",
        "message" => "Book unavailable"
    ]);
    exit();
}

$insert = "
INSERT INTO borrow_records
(member_id, book_id, status, borrow_date, due_date, return_date)
VALUES
('$member_id', '$book_id', 'Pending', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 14 DAY), NULL)
";

$conn->query($insert);

echo json_encode([
    "status" => "success",
    "message" => "Borrow Request Sent"
]);

?>