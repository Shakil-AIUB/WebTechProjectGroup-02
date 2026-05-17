<?php

session_start();

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

$db = new db();

$conn = $db->connection();

$error = "";
$success = "";

if(isset($_POST['addGenre']))
{
    $genre = trim($_POST['genre']);

    if(empty($genre))
    {
        $error = "Genre Required";
    }
    else
    {
        $result = $db->AddGenre(
            $conn,
            $genre
        );

        if($result)
        {
            $success = "Genre Added";
        }
        else
        {
            $error = "Failed To Add Genre";
        }
    }
}

if(isset($_GET['delete']))
{
    $id = $_GET['delete'];

    $check = $db->CheckGenreBooks(
        $conn,
        $id
    );

    if(mysqli_num_rows($check) > 0)
    {
        $error = "Cannot delete genre. Books exist.";
    }
    else
    {
        $db->DeleteGenre($conn,$id);
        $success = "Genre Deleted";
    }
}

$genres = $db->GetGenres($conn);

?>