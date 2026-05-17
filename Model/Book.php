<?php

include '../config/database.php';

function getBooks() {

    $db = new Database();

    $conn = $db->connection();

    $sql = "

    SELECT 

        books.*,

        (
            books.book_total_copies -

            COUNT(
                CASE
                WHEN borrow_records.status = 'Active'
                THEN 1
                END
            )

        ) AS available_copies

    FROM books

    LEFT JOIN borrow_records
    ON books.book_id = borrow_records.book_id

    GROUP BY books.book_id

    ";

    $result = $conn->query($sql);

    $books = [];

    if($result->num_rows > 0){

        while($row = $result->fetch_assoc()){

            $books[] = $row;

        }

    }

    return $books;
}

function getSingleBook($book_id){
    $db = new Database();

    $conn = $db->connection();

    $sql = "

    SELECT 
        books.*,

        (
            books.book_total_copies -

            COUNT(
                CASE
                WHEN borrow_records.status = 'Active'
                THEN 1
                END
            )

        ) AS available_copies

    FROM books

    LEFT JOIN borrow_records
    ON books.book_id = borrow_records.book_id

    WHERE books.book_id = '$book_id'

    GROUP BY books.book_id

    ";

    $result = $conn->query($sql);

    return $result->fetch_assoc();
}

?>