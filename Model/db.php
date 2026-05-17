<?php

$conn = new mysqli(
    "localhost",
    "root",
    "",
    "library"
);

if($conn->connect_error){
    die("Database Connection Failed");
}







function getBooks(){

    global $conn;

    $sql = "

    SELECT

        books.*,

        (

            books.book_total_copies -

            COUNT(
                CASE
                WHEN borrow_records.status='Active'
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

    $data = [];

    while($row = $result->fetch_assoc()){

        $data[] = $row;

    }

    return $data;
}







function getSingleBook($id){

    global $conn;

    $sql = "

    SELECT

        books.*,

        (

            books.book_total_copies -

            COUNT(
                CASE
                WHEN borrow_records.status='Active'
                THEN 1
                END
            )

        ) AS available_copies

    FROM books

    LEFT JOIN borrow_records
    ON books.book_id = borrow_records.book_id

    WHERE books.book_id='$id'

    GROUP BY books.book_id

    ";

    $result = $conn->query($sql);

    return $result->fetch_assoc();
}







function requestBorrow($member_id, $book_id){

    global $conn;

    $sql = "

    INSERT INTO borrow_records

    (
        member_id,
        book_id,
        status,
        borrow_date,
        due_date
    )

    VALUES

    (
        '$member_id',
        '$book_id',
        'Pending',
        CURDATE(),
        DATE_ADD(CURDATE(), INTERVAL 14 DAY)
    )

    ";

    return $conn->query($sql);
}







function approveBorrow($id){

    global $conn;

    $sql = "

    UPDATE borrow_records

    SET status='Active'

    WHERE borrow_id='$id'

    ";

    return $conn->query($sql);
}







function rejectBorrow($id){

    global $conn;

    $sql = "

    DELETE FROM borrow_records

    WHERE borrow_id='$id'

    ";

    return $conn->query($sql);
}







function returnBorrow($id){

    global $conn;

    $sql = "

    UPDATE borrow_records

    SET

        status='Returned',
        return_date=NOW()

    WHERE borrow_id='$id'

    ";

    return $conn->query($sql);
}







function pendingRequests(){

    global $conn;

    $sql = "

    SELECT

        borrow_records.borrow_id,
        members.member_name,
        books.book_title,
        borrow_records.borrow_date,
        borrow_records.status

    FROM borrow_records

    JOIN members
    ON members.member_id = borrow_records.member_id

    JOIN books
    ON books.book_id = borrow_records.book_id

    WHERE borrow_records.status='Pending'

    ";

    $result = $conn->query($sql);

    $data = [];

    while($row = $result->fetch_assoc()){

        $data[] = $row;

    }

    return $data;
}







function searchLoans($keyword){

    global $conn;

    $sql = "

    SELECT

        borrow_records.borrow_id,
        members.member_name,
        books.book_title,
        borrow_records.borrow_date

    FROM borrow_records

    JOIN members
    ON members.member_id = borrow_records.member_id

    JOIN books
    ON books.book_id = borrow_records.book_id

    WHERE borrow_records.status='Active'

    AND
    (

        members.member_name LIKE '%$keyword%'

        OR

        books.book_title LIKE '%$keyword%'

    )

    ";

    $result = $conn->query($sql);

    $data = [];

    while($row = $result->fetch_assoc()){

        $data[] = $row;

    }

    return $data;
}

?>