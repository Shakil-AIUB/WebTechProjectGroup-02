<?php

class db
{
    function connection()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "webtech";

        $connection = new mysqli($db_host, $db_user, $db_password, $db_name);

        if($connection->connect_error)
        {
            die("Could not Connect Database " . $connection->connect_error);
        }

        return $connection;
    }

    function signin($connection, $tablename, $email)
    {
        $stmt = $connection->prepare("SELECT * FROM $tablename WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    function getUserById($connection, $id)
    {
        $stmt = $connection->prepare("SELECT * FROM members WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result();
    }

    function updateProfile($connection, $id, $name, $email, $phone)
    {
        $stmt = $connection->prepare("UPDATE members SET name=?, email=?, phone=? WHERE id=?");
        $stmt->bind_param("sssi", $name, $email, $phone, $id);
        return $stmt->execute();
    }

    function CheckUser($connection, $tablename, $email)
    {
        $stmt = $connection->prepare("SELECT * FROM $tablename WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result();
    }

    function updatePassword($connection, $id, $newPassword)
    {
        $stmt = $connection->prepare("UPDATE members SET password_hash=? WHERE id=?");
        $stmt->bind_param("si", $newPassword, $id);
        return $stmt->execute();
    }

    function WithSQLInjection($connection, $tablename, $name, $email, $phone, $password, $role, $date)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $connection->prepare("INSERT INTO members 
        (name, email, phone, password_hash, role, created_at) 
        VALUES (?,?,?,?,?,?)");

        $stmt->bind_param("ssssss", $name, $email, $phone, $hash, $role, $date);
        return $stmt->execute();
    }

    function getDashboardCounts($connection, $member_id)
    {
        $counts = [
            "active_loans" => 0,
            "upcoming_dues" => 0,
            "outstanding_fines" => 0
        ];

        $stmt = $connection->prepare("SELECT COUNT(*) AS cnt FROM borrow_records 
        WHERE member_id=? AND status='Active'");
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        $r = $stmt->get_result();
        if($r)
        {
            $counts["active_loans"] = (int)$r->fetch_assoc()["cnt"];
        }

        $stmt = $connection->prepare("SELECT COUNT(*) AS cnt FROM borrow_records 
        WHERE member_id=? 
        AND status='Active' 
        AND due_date BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 7 DAY)");
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        $r = $stmt->get_result();
        if($r)
        {
            $counts["upcoming_dues"] = (int)$r->fetch_assoc()["cnt"];
        }

        $stmt = $connection->prepare("SELECT COALESCE(SUM(amount),0) AS total FROM fines 
        WHERE member_id=? AND is_paid=0");
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        $r = $stmt->get_result();
        if($r)
        {
            $counts["outstanding_fines"] = (float)$r->fetch_assoc()["total"];
        }

        return $counts;
    }

    // TASK 4: Auto fine generation
    function generate_fines($connection)
    {
        $sql = "SELECT id, member_id, due_date,
                DATEDIFF(CURDATE(), due_date) AS overdue_days
                FROM borrow_records
                WHERE status='Active'
                AND due_date < CURDATE()";

        $result = $connection->query($sql);

        if(!$result)
        {
            return false;
        }

        while($row = $result->fetch_assoc())
        {
            $borrow_id = (int)$row["id"];
            $member_id = (int)$row["member_id"];
            $days = (int)$row["overdue_days"];

            if($days < 0)
            {
                $days = 0;
            }

            $amount = $days * 5;

            $stmt = $connection->prepare("SELECT id FROM fines WHERE borrow_record_id=?");
            $stmt->bind_param("i", $borrow_id);
            $stmt->execute();
            $check = $stmt->get_result();

            if($check->num_rows > 0)
            {
                $fine = $check->fetch_assoc();
                $fine_id = (int)$fine["id"];

                $stmt = $connection->prepare("UPDATE fines 
                SET amount=?, member_id=? 
                WHERE id=? AND is_paid=0");

                $stmt->bind_param("dii", $amount, $member_id, $fine_id);
                $stmt->execute();
            }
            else
            {
                $is_paid = 0;

                $stmt = $connection->prepare("INSERT INTO fines 
                (borrow_record_id, member_id, amount, is_paid, created_at) 
                VALUES (?,?,?,?,NOW())");

                $stmt->bind_param("iidi", $borrow_id, $member_id, $amount, $is_paid);
                $stmt->execute();
            }
        }

        return true;
    }

    // Browse books
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

        GROUP BY 
            books.id,
            books.title,
            books.author,
            books.isbn,
            books.total_copies,
            genres.genre_name
        ";
        return $connection->query($sql);
    }

    function getMemberFines($connection, $member_id)
    {
$sql = "SELECT 
    fines.id,
    fines.amount,
    books.title,
    borrow_records.due_date,
    GREATEST(DATEDIFF(CURDATE(), borrow_records.due_date), 0) AS overdue_days

                FROM fines

                JOIN borrow_records
                ON fines.borrow_record_id = borrow_records.id

                JOIN books
                ON borrow_records.book_id = books.id

                WHERE fines.member_id=?
                AND fines.is_paid=0";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("i", $member_id);
        $stmt->execute();
        return $stmt->get_result();
    }

    function getAllUnpaidFines($connection, $search="")
    {
        $like = "%" . $search . "%";

        $sql = "SELECT 
                    fines.id,
                    fines.amount,
                    members.name,
                    books.title,
                    borrow_records.due_date,
                    GREATEST(DATEDIFF(CURDATE(), borrow_records.due_date), 0) AS overdue_days

                FROM fines

                JOIN members
                ON fines.member_id = members.id

                JOIN borrow_records
                ON fines.borrow_record_id = borrow_records.id

                JOIN books
                ON borrow_records.book_id = books.id

                WHERE fines.is_paid=0
                AND members.name LIKE ?";

        $stmt = $connection->prepare($sql);
        $stmt->bind_param("s", $like);
        $stmt->execute();
        return $stmt->get_result();
    }

    function payFine($connection, $fine_id)
    {
        $stmt = $connection->prepare("UPDATE fines SET is_paid=1 WHERE id=?");
        $stmt->bind_param("i", $fine_id);
        return $stmt->execute();
    }

    function topBorrowedBooks($connection)
    {
        $sql = "SELECT books.title, COUNT(*) AS total
                FROM borrow_records
                JOIN books
                ON borrow_records.book_id = books.id
                GROUP BY borrow_records.book_id, books.title
                ORDER BY total DESC
                LIMIT 10";

        return $connection->query($sql);
    }

    function topMembers($connection)
    {
        $sql = "SELECT members.name, COUNT(*) AS total
                FROM borrow_records
                JOIN members
                ON borrow_records.member_id = members.id
                GROUP BY borrow_records.member_id, members.name
                ORDER BY total DESC
                LIMIT 10";

        return $connection->query($sql);
    }


    function getAllUsers($connection)
    {
    $sql = "SELECT * FROM members ORDER BY id DESC";

    return $connection->query($sql);
    }


    function getBorrowHistory($connection, $member_id)
{
    $sql = "SELECT 
                books.title,
                borrow_records.borrow_date,
                borrow_records.due_date,
                borrow_records.status
            FROM borrow_records
            JOIN books
            ON borrow_records.book_id = books.id
            WHERE borrow_records.member_id=?
            ORDER BY borrow_records.borrow_date DESC";

    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $member_id);
    $stmt->execute();

    return $stmt->get_result();
}

    
    function monthlyBorrowReport($connection)
    {
        $sql = "SELECT 
                    DATE_FORMAT(borrow_date, '%Y-%m') AS month_label,
                    COUNT(*) AS total
                FROM borrow_records
                WHERE borrow_date >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 5 MONTH), '%Y-%m-01')
                GROUP BY DATE_FORMAT(borrow_date, '%Y-%m')
                ORDER BY month_label ASC";

        return $connection->query($sql);
    }
}

?>