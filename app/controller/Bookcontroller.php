<?php
require_once "app/model/Book.php";

class BookController {
    private $bookModel;
    public function __construct() {
        $this->bookModel = new Book();
    }

    public function index() {
        $books = $this->bookModel->all();
        include "app/view/book/index.php";
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->bookModel->create($_POST['title'], $_POST['author'], $_POST['year']);
            header("Location: index.php");
        }
        include "app/view/book/create.php";
    }

    public function edit() {
        $id = $_GET['id'];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->bookModel->update($id, $_POST['title'], $_POST['author'], $_POST['year']);
            header("Location: index.php");
        }
        $book = $this->bookModel->find($id);
        include "app/view/book/edit.php";
    }

    public function delete() {
        $this->bookModel->delete($_GET['id']);
        header("Location: index.php");
    }
}
?>