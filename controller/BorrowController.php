<?php
include_once '../model/Book.php';  

class BorrowController
{
    public function showBooks(){
        $books = getBooks();
        
        return $books;  
    }
}

$controller = new BorrowController();   

$books = $controller->showBooks();

include_once '../view/member_books.php';    
?>