<?php
<<<<<<< HEAD
header('Content-Type: application/json');
include_once __DIR__ . "/../../Config/Auth.php";
include_once __DIR__ . "/../../Model/db.php";

auth_check("member");

$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$obj = new db();
$conn = $obj->connection();
$result = $obj->searchBooksWithAvailability($conn, $q);

$books = [];
if($result){
    while($row = $result->fetch_assoc()){
        $books[] = $row;
    }
}
echo json_encode($books);
?>
=======
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
>>>>>>> 4fdd6d3e3b9187c46a1e4f63c90092607aa87cc8
