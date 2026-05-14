<?php

include_once '../model/Book.php';  
include_once '../model/BorrowModel.php';

if (!class_exists('BorrowController')) {

    class BorrowController
    {
        public function showBooks(){
            return getBooks();
        }

        public function pendingRequests(){
            return getPendingRequests();
        }
    }
}



$controller = new BorrowController();

$books = $controller->showBooks();

$requests = $controller->pendingRequests();







?>