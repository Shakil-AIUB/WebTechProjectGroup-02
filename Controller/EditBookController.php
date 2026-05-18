<?php

include "../Config/Auth.php";
include "../Model/db.php";

auth_check("librarian");

$db = new db();

$conn = $db->connection();

$id = $_GET['id'];

$bookResult = $db->GetSingleBook(
    $conn,
    $id
);

$book = mysqli_fetch_assoc($bookResult);

$genres = $db->GetGenres($conn);

$error = "";
$success = "";

if(isset($_POST['updateBook']))
{
    $title = trim($_POST['title']);

    $author = trim($_POST['author']);

    $isbn = trim($_POST['isbn']);

    $genre = trim($_POST['genre']);

    $copies = trim($_POST['copies']);

    $shelf = trim($_POST['shelf']);

    $year = trim($_POST['year']);

    if(empty($title))
    {
        $error = "Title Required";
    }

    else if(empty($author))
    {
        $error = "Author Required";
    }

    else if(
        !preg_match(
            '/^(\\d{10}|\\d{13})$/',
            $isbn
        )
    )
    {
        $error = "ISBN Invalid";
    }

    else if($copies <= 0)
    {
        $error = "Copies Must Be Greater Than 0";
    }

    else
    {
        $result = $db->UpdateBook(
            $conn,
            $id,
            $title,
            $author,
            $isbn,
            $genre,
            $copies,
            $shelf,
            $year
        );

        if($result)
        {
            header(
                "Location: BookList.php"
            );
        }
        else
        {
            $error = "Update Failed";
        }
    }
}

?>