<?php
class db{
function connection()
{
$db_host = "localhost";
$db_user= "root";
$db_password="";
$db_name="webtech";

$connection=  new mysqli($db_host, $db_user,$db_password,$db_name);
if($connection->connect_error)
    {
        die ("Could not Connect Database".$connection->connect_error);
    }
return $connection;
}

function signin($connection, $tablename, $email)
{
    $sql = "SELECT * FROM ".$tablename." WHERE email='".$email."'";
    $result = $connection->query($sql);
    return $result;
}

function getUserById($connection, $id)
{
    $sql = "SELECT * FROM members WHERE id = '".$id."'";
    $result = $connection->query($sql);
    return $result;
}

function updateProfile($connection, $id, $name, $email, $phone)
{
    $sql = "UPDATE members SET name='".$name."', email='".$email."', phone='".$phone."' WHERE id='".$id."'";
    $result = $connection->query($sql);
    return $result;
}

function CheckUser($connection, $tablename, $email)
{
    $sql = "SELECT * FROM ".$tablename." WHERE email='".$email."'";
    $result = $connection->query($sql);
    return $result;
}

function updatePassword($connection, $id, $newPassword)
{
    $sql = "UPDATE members SET password_hash='".$newPassword."' WHERE id='".$id."'";
    $result = $connection->query($sql);
    return $result;
}

function WithSQLInjection($connection, $tablename, $name,$email,$phone, $password, $role, $date)
{
    $sql= "INSERT INTO " .$tablename. "(name,email,phone, password_hash, role, created_at) VALUES (?,?,?,?,?,?)";
    $statement=$connection->prepare($sql);
    $statement->bind_param("ssssss",$name,$email,$phone, $password, $role, $date);
    $result = $statement->execute();
    return $result;
}

function getDashboardCounts($connection, $member_id)
{
    $counts = [
        "active_loans"      => 0,
        "upcoming_dues"     => 0,
        "outstanding_fines" => 0,
    ];

    $r = $connection->query("SELECT COUNT(*) AS cnt FROM loans WHERE member_id='$member_id' AND status='active'");
    if($r) $counts["active_loans"] = (int)$r->fetch_assoc()["cnt"];

    $r = $connection->query("SELECT COUNT(*) AS cnt FROM loans WHERE member_id='$member_id' AND status='active' AND due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
    if($r) $counts["upcoming_dues"] = (int)$r->fetch_assoc()["cnt"];

    $r = $connection->query("SELECT COALESCE(SUM(amount),0) AS total FROM fines WHERE member_id='$member_id' AND paid=0");
    if($r) $counts["outstanding_fines"] = (float)$r->fetch_assoc()["total"];

    return $counts;
}

/* =========================
   Dashboard Summary
========================= */

function totalBooks($connection)
{
    $sql = "SELECT COUNT(*) AS total FROM books";
    $result = $connection->query($sql);
    return $result->fetch_assoc()['total'];
}

function issuedToday($connection)
{
    $sql = "
    SELECT COUNT(*) AS total
    FROM borrow_records
    WHERE status='Active'
    AND DATE(borrow_date)=CURDATE()
    ";
    $result = $connection->query($sql);
    return $result->fetch_assoc()['total'];
}

function returnedToday($connection)
{
    $sql = "
    SELECT COUNT(*) AS total
    FROM borrow_records
    WHERE status='Returned'
    AND DATE(due_date)=CURDATE()
    ";
    $result = $connection->query($sql);
    return $result->fetch_assoc()['total'];
}

function pendingReturns($connection)
{
    $sql = "
    SELECT COUNT(*) AS total
    FROM borrow_records
    WHERE status='Active'
    ";
    $result = $connection->query($sql);
    return $result->fetch_assoc()['total'];
}

/* =========================
   Recent Activities
========================= */

function recentActivities($connection)
{
    $sql = "
    SELECT
        members.name AS member_name,
        books.title AS book_title,
        borrow_records.status,
        borrow_records.borrow_date

    FROM borrow_records

    INNER JOIN members
    ON borrow_records.member_id = members.id

    INNER JOIN books
    ON borrow_records.book_id = books.id

    ORDER BY borrow_records.id DESC
    LIMIT 5
    ";

    return $connection->query($sql);
}

/* =========================
   GENRE CRUD
========================= */

function AddGenre($connection, $genre)
{
    $sql = "INSERT INTO genres(genre_name) VALUES('$genre')";
    return $connection->query($sql);
}

function GetGenres($connection)
{
    $sql = "SELECT * FROM genres";
    return $connection->query($sql);
}

function CheckGenreBooks($connection, $id)
{
    $sql = "SELECT * FROM books WHERE genre_id='$id'";
    return $connection->query($sql);
}

function DeleteGenre($connection, $id)
{
    $check = "SELECT * FROM books WHERE genre_id='$id'";
    $result = $connection->query($check);

    if(mysqli_num_rows($result) > 0)
    {
        return false;
    }

    $sql = "DELETE FROM genres WHERE id='$id'";
    return $connection->query($sql);
}

/* =========================
   BOOK CRUD
========================= */

function AddBook(
    $connection,
    $title,
    $author,
    $isbn,
    $genre_id,
    $total_copies,
    $shelf_location,
    $published_year
)
{
    $sql = "
    INSERT INTO books
    (title, author, isbn, genre_id, total_copies, shelf_location, publication_year)
    VALUES
    ('$title', '$author', '$isbn', '$genre_id', '$total_copies', '$shelf_location', '$published_year')
    ";
    return $connection->query($sql);
}

function GetBooks($connection)
{
    $sql = "
    SELECT
    books.id,
    books.title,
    books.author,
    books.isbn,
    books.total_copies,

    genres.genre_name,

    (
        books.total_copies -
        COUNT(
            CASE
            WHEN borrow_records.status='Active'
            THEN 1
            END
        )
    ) AS available_copies

    FROM books

    LEFT JOIN genres
    ON books.genre_id = genres.id

    LEFT JOIN borrow_records
    ON books.id = borrow_records.book_id

    GROUP BY books.id
    ";
    return $connection->query($sql);
}

function GetSingleBook($connection, $id)
{
    $sql = "SELECT * FROM books WHERE id='$id'";
    return $connection->query($sql);
}

function UpdateBook(
    $connection,
    $id,
    $title,
    $author,
    $isbn,
    $genre_id,
    $total_copies,
    $shelf_location,
    $published_year
)
{
    $sql = "
    UPDATE books
    SET
    title='$title',
    author='$author',
    isbn='$isbn',
    genre_id='$genre_id',
    total_copies='$total_copies',
    shelf_location='$shelf_location',
    publication_year='$published_year'
    WHERE id='$id'
    ";
    return $connection->query($sql);
}

function DeleteBook($connection, $id)
{
    $check = "
    SELECT * FROM borrow_records
    WHERE book_id='$id'
    AND status='Active'
    ";
    $result = $connection->query($check);

    if(mysqli_num_rows($result) > 0)
    {
        return false;
    }

    $sql = "DELETE FROM books WHERE id='$id'";
    return $connection->query($sql);
}

function CheckBorrowedBook($connection, $id)
{
    $sql = "
    SELECT * FROM borrow_records
    WHERE book_id='$id'
    AND status='Active'
    ";
    return $connection->query($sql);
}

/* =========================
   AJAX SEARCH
========================= */

function searchBooks($connection, $search)
{
    $sql = "SELECT books.id,
    books.title,
    books.author,
    books.isbn,
    books.total_copies,

    genres.genre_name,(
        books.total_copies -
        COUNT(
            CASE
            WHEN borrow_records.status='Active'
            THEN 1
            END
        )
    ) AS available_copies

    FROM books

    LEFT JOIN genres
    ON books.genre_id = genres.id

    LEFT JOIN borrow_records
    ON books.id = borrow_records.book_id

    WHERE
    books.title LIKE '%$search%'
    OR books.author LIKE '%$search%'
    OR books.isbn LIKE '%$search%'

    GROUP BY books.id
    ";
    return $connection->query($sql);
}

}
?>