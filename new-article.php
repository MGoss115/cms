<!-- TO CHECK THE TYPE OF REQUEST YOU CAN USE $_SERVER["REQUEST_METHOD"] -->

<?php 

require 'classes/Database.php';

require 'classes/Article.php';

require 'includes/url.php';

require 'classes/Auth.php';

    session_start();

    if ( ! Auth::isLoggedIn()) {

        die("unauthorized");

    }

    $article = new Article();

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $db = new Database();
        $conn = $db->getConn();
        
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->published_at = $_POST['published_at'];

        if ($article->create($conn)) {
            redirect("/cms/article.php?id={$article->id}");
        }
    }
?>

<?php require 'includes/header.php'; ?>

<h1>New Article</h1>

<a href="index.php">Home</a>

<?php require 'includes/article-form.php'; ?>

<?php require 'includes/footer.php'; ?>
