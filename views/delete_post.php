<?php
include_once("../classes/Database.php");
include_once("../classes/Post.php");
$post = new Post();

if (isset($_GET['id'])) {
    $deleted = $post->delete($_GET['id']);
    if ($deleted) {
        header("Location: list_posts.php");
    } else {
        echo "Failed to delete the post.";
    }
} else {
    echo "Invalid post ID.";
}
