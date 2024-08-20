<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>My Blog</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <h1 style="margin: 0 auto; text-align: center; width: 100%;">Welcome to Tuka's Blog</h1>
        </div>
    </nav>

    <div class="container-fluid">

        <h2>All Posts</h2>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Author</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("../classes/Database.php");
                include_once("../classes/Post.php");

                $post = new Post();
                $rows = $post->listAll();
                $i = 1;
                if (!empty($rows)) {
                    foreach ($rows as $row) {
                ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['content']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                            <td><?php echo $row['updated_at']; ?></td>
                            <td>
                                <a class="btn btn-outline-dark" href="view_post.php?id=<?php echo $row['id']; ?>">View</a>
                                <a class="btn btn-outline-warning" href="edit_post.php?id=<?php echo $row['id']; ?>">Edit</a>
                                <a class="btn btn-outline-danger" href="delete_post.php?id=<?php echo $row['id']; ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='7'>No data found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="create_post.php" class="btn btn-outline-primary">Add New Post</a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>