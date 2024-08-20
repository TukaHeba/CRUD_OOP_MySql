<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Post</title>
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
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $post->create($_POST['title'], $_POST['content'], $_POST['author']);

            if ($result === true) {
                header("Location: list_posts.php");
                exit;
            } else {
                $errors = $result;
            }
        }
        ?>

        <h2>Create New Post</h2>

        <!-- Display errors-->
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" rows="5" required><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="author" class="form-label">Author</label>
                <input type="text" class="form-control" name="author" value="<?php echo isset($_POST['author']) ? htmlspecialchars($_POST['author']) : ''; ?>" required>
            </div>
            <button type="submit" class="btn btn-outline-primary">Create</button>
            <a href="list_posts.php" class="btn btn-outline-secondary">Cancel</a>
        </form>
    </div>


</body>

</html>