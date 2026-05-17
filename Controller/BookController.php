<?php

include_once '../Model/db.php';

class BookController {

    public function allBooks(){

        return getBooks();
    }

    public function singleBook($id){

        return getSingleBook($id);
    }
}

?>