<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit Post</title>
</head>

<body>
    <div class="container-fluid">
        <?php
        include_once("../classes/Database.php");
        include_once("../classes/Post.php");
        $post = new Post();
        $errors = [];
        $row = null;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $result = $post->update($_POST['id'], $_POST['title'], $_POST['content'], $_POST['author']);
            if ($result === true) {
                header("Location: list_posts.php");
                exit;
            } else {
                $errors = $result;
                $row = $post->edit($_POST['id']);
            }
        } else {
            $row = $post->edit($_GET['id'] ?? null);
        }
        ?>

        <?php if ($row) { ?>
            <h2>Edit Post</h2>

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
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" rows="5" required><?php echo htmlspecialchars($row['content']); ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" required>
                </div>
                <button type="submit" class="btn btn-outline-success">Update</button>
                <a href="list_posts.php" class="btn btn-outline-secondary">Cancel</a>
            </form>
        <?php } else { ?>
            <p>No post found. Please try again.</p>
        <?php } ?>
    </div>


</body>

</html>