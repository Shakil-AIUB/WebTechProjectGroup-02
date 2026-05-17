<?php
include "../../Model/db.php";

$db = new db();
$conn = $db->connection();

$search = $_GET['q'] ?? '';

$result = $db->searchBooks($conn, $search);

$data = [];
while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

header("Content-Type: application/json");
echo json_encode($data);
?>