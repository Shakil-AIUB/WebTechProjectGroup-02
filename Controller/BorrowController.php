<?php

<<<<<<< HEAD
include_once '../Model/db.php';

class BorrowController {

    public function requestBook($member_id, $book_id){

        return requestBorrow(
            $member_id,
            $book_id
        );
    }

    public function approve($id){

        return approveBorrow($id);
    }

    public function reject($id){

        return rejectBorrow($id);
    }

    public function returnBook($id){

        return returnBorrow($id);
    }

    public function pendingRequests(){

        return pendingRequests();
    }

    public function searchLoans($keyword){

        return searchLoans($keyword);
    }
}

=======
include '../Model/db.php';

class BorrowController
{
    private $db;
    private $conn;

    public function __construct()
    {
        $this->db = new db();
        $this->conn = $this->db->connection();
    }

    public function showBooks()
    {
        return $this->db->GetBooks($this->conn);
    }

    public function pendingRequests()
    {
        return $this->db->getPendingRequests($this->conn);
    }

    public function searchLoans($keyword)
    {
        return $this->db->searchActiveLoans(
            $this->conn,
            $keyword
        );
    }

    public function singleBook($book_id)
    {
        return $this->db->GetSingleBook(
            $this->conn,
            $book_id
        );
    }
}

$controller = new BorrowController();

$books = $controller->showBooks();

$requests = $controller->pendingRequests();

>>>>>>> a0a6185 (fix some merged part)
?>