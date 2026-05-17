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

    $check = $db->CheckBorrowedBook(
        $conn,
        $id
    );

    if(mysqli_num_rows($check) > 0)
    {
        echo "Cannot Delete. Book Is Borrowed.";
    }
    else
    {
        $db->DeleteBook(
            $conn,
            $id
        );

        header(
            "Location: ../View/BookList.php"
        );
    }
}

?>