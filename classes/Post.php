<?php

include_once 'Database.php';
include_once("../Traits/Validator.php");

class Post
{
    use Validator;
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // ======> List all posts method <====== //
    // 1- selecting the records and order them by created_at in descending order
    // 2- Execute the query and return the result as an associative array
    // 3- Check if the query was successful
    public function listAll()
    {
        $query = "SELECT * FROM posts ORDER BY created_at DESC";

        $result = $this->conn->query($query);

        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }

    // ======> Read post method <====== //
    // 1- Select a post by its id
    // 2- Execute the prepared SQL statement
    // 3- Get the result of and fetch in array
    public function read($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // ======> Create post method <====== //
    // 1- Sanitize and validate inputs
    // 2- Check if all validation rules have passed 
    // 3- Execute the SQL statement and return the result
    public function create($title, $content, $author)
    {
        $title = $this->test_input($title);
        $content = $this->test_input($content);
        $author = $this->test_input($author);

        $this->isText($title, 'title')->inputLength($title, 'title', 5, 50);
        $this->isText($content, 'content')->inputLength($content, 'content', 20, 500);
        $this->isText($author, 'author')->inputLength($author, 'author', 3, 50);

        if ($this->passes()) {
            $stmt = $this->conn->prepare("INSERT INTO posts (title, content, author) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $content, $author);
            return $stmt->execute();
        } else {
            return $this->getErrors();
        }
    }

    // ======> Edit post method <====== //
    public function edit($id)
    {
        return $this->read($id);
    }

    // ======> Update post method <====== //
    public function update($id, $title, $content, $author)
    {
        $title = $this->test_input($title);
        $content = $this->test_input($content);
        $author = $this->test_input($author);

        $this->isText($title, 'title')->inputLength($title, 'title', 5, 100);
        $this->isText($content, 'content')->inputLength($content, 'content', 20);
        $this->isText($author, 'author')->inputLength($author, 'author', 3, 50);

        if ($this->passes()) {
            $stmt = $this->conn->prepare("UPDATE posts SET title = ?, content = ?, author = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
            $stmt->bind_param("sssi", $title, $content, $author, $id);
            return $stmt->execute();
        } else {
            return $this->getErrors();
        }
    }

    // ======> Delete post method <====== //
    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
