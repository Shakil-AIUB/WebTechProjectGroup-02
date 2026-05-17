<?php

session_start();

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

if(isset($_GET['id']))
{
    $id = $_GET['id'];

    $db = new db();

    $conn = $db->connection();

    $result = $db->deleteGenre($conn, $id);

    if($result)
    {
        $_SESSION['success'] = "Genre Deleted Successfully";
    }
    else
    {
        $_SESSION['error'] = "Cannot Delete Genre Because Books Exist";
    }

    header("Location: ../View/LibrarianDashboard.php");
}

?>