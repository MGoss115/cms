<?php 
    require 'includes/database.php';
    require 'includes/article.php';

    $conn = getDB();
    // VALIDATE ID HAS BEEN SET/DECLARED AND IS NOT NULL
    if (isset($_GET['id'])){
        $article = getArticle($conn, $_GET['id']);
        if($article){

            $title = $article['title'];
            $content = $article['content'];
            $published_at = $article['published_at'];
        } else {
            die("article not found");
        }

    }else{
        die('id not supplied, article not found');
    }
?>
<?php require 'includes/header.php'; ?>

<h1>Edit Article</h1>

<a href="index.php">Home</a>

<?php require 'includes/article-form.php'; ?>

<?php require 'includes/footer.php'; ?>