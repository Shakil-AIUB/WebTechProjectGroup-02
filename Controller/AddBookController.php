<?php
session_start();
include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

$db = new db();
$conn = $db->connection();
$error = "";
$success = "";

if(isset($_POST['addBook'])){
    $title  = trim($_POST['title'] ?? '');
    $author = trim($_POST['author'] ?? '');
    $isbn   = trim($_POST['isbn'] ?? '');
    $genre  = trim($_POST['genre'] ?? '');
    $copies = trim($_POST['copies'] ?? '');
    $shelf  = trim($_POST['shelf'] ?? '');
    $year   = trim($_POST['year'] ?? '');

        if(empty($title)){
            $error = "Title Required";
        } else if(empty($author)){
            $error = "Author Required";
        } else if(!preg_match('/^(\d{10}|\d{13})$/', $isbn)){
            $error = "ISBN Must Be 10 Or 13 Digits";
        } else if(empty($genre)){
            $error = "Please Select A Genre";
        } else if($copies <= 0){
            $error = "Copies Must Be Greater Than 0";
        } else {
            $result = $db->AddBook($conn, $title, $author, $isbn, $genre, $copies, $shelf, $year);
            if($result){
             $success = "Book Added Successfully";
            } else {
        $error = "Failed To Add Book";
    }
}
}

$genres = $db->GetGenres($conn);
?>