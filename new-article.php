<!-- TO CHECK THE TYPE OF REQUEST YOU CAN USE $_SERVER["REQUEST_METHOD"] -->

<?php 

require 'includes/init.php';

    if ( ! Auth::isLoggedIn()) {

        die("unauthorized");

    }

    $article = new Article();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $conn = require 'includes/db.php';
        
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->published_at = $_POST['published_at'];

        if ($article->create($conn)) {
            Url::redirect("/cms/article.php?id={$article->id}");
        }
    }
?>

<?php require 'includes/header.php'; ?>

<h1>New Article</h1>

<a href="index.php">Home</a>

<?php require 'includes/article-form.php'; ?>

<?php require 'includes/footer.php'; ?>
