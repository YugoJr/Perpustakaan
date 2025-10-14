<?php
require_once "Config/Database.php";

class Book {
    private $conn;
    public function __construct() {
        $db = new Database();
        $this->conn = $db->connect();
    }

    public function all() {
        $stmt = $this->conn->query("SELECT * FROM books ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($id) {
        $stmt = $this->conn->prepare("SELECT * FROM books WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $author, $year) {
        $stmt = $this->conn->prepare("INSERT INTO books (title, author, year) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $author, $year]);
    }

    public function update($id, $title, $author, $year) {
        $stmt = $this->conn->prepare("UPDATE books SET title=?, author=?, year=? WHERE id=?");
        return $stmt->execute([$title, $author, $year, $id]);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM books WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>
