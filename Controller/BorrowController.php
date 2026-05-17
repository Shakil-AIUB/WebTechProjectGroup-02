<?php

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

?>