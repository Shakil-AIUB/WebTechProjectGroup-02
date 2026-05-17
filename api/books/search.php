<?php
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
