<?php

header("Content-Type: application/json");

include "../Model/db.php";

$db = new db();

$conn = $db->connection();

$search = "";

if(isset($_GET['q']))
{
    $search = $_GET['q'];
}

$result = $db->searchBooks($conn, $search);

$data = [];

while($row = $result->fetch_assoc())
{
    $data[] = $row;
}

echo json_encode($data);

?>