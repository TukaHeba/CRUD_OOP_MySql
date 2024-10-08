<?php

include_once 'Database.php';
include_once("../Traits/Validator.php");

class Post
{
    use Validator;
    private $title;
    private $content;
    private $author;
    private $conn;

    // ======> Post class constructor <====== //
    public function __construct($title = null, $content = null, $author = null)
    {
        $database = new Database();
        $this->conn = $database->connect();

        if ($title !== null) {
            $this->title = $this->test_input($title);
        }
        if ($content !== null) {
            $this->content = $this->test_input($content);
        }
        if ($author !== null) {
            $this->author = $this->test_input($author);
        }
    }

    // ======> List all posts method <====== //
    // 1- selecting the records and order them by created_at in descending order
    // 2- Add a condition to the query if a title or author filter is provided
    // 3- Execute the query and return the result as an associative array
    // 4- Check if the query was successful
    public function listAll($title = '', $author = '')
    {
        $title = $this->conn->real_escape_string($title);
        $author = $this->conn->real_escape_string($author);
        
        $query = "SELECT * FROM posts WHERE 1=1";
    
        if ($title) {
            $query .= " AND title LIKE '%$title%'";
        }
    
        if ($author) {
            $query .= " AND author LIKE '%$author%'";
        }
    
        $query .= " ORDER BY created_at DESC";
    
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
