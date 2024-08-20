<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>View Post</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <h1 style="margin: 0 auto; text-align: center; width: 100%;">Welcome to Tuka's Blog</h1>
        </div>
    </nav>

    <div class="container-fluid">
        <?php
        include_once("../classes/Database.php");
        include_once("../classes/Post.php");
        $post = new Post();
        $row = $post->read($_GET['id']);
        if ($row) {
        ?>
            <h2><?php echo $row['title']; ?></h2>
            <p><?php echo $row['content']; ?></p>
            <p><strong>Author: </strong><?php echo $row['author']; ?></p>
            <p><strong>Created at: </strong><?php echo $row['created_at']; ?></p>
            <p><strong>Updated at: </strong><?php echo $row['updated_at']; ?></p>
            <a href="list_posts.php" class="btn btn-outline-secondary">Back to All Posts</a>
        <?php
        } else {
            echo "<p>No post found.</p>";
        }
        ?>
    </div>
</body>

</html>