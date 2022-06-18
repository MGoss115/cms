<!-- TO CHECK THE TYPE OF REQUEST YOU CAN USE $_SERVER["REQUEST_METHOD"] -->

<?php 

require '../includes/init.php';

    Auth::requireLogin();

    $article = new Article();

    $category_ids = [];
    $conn = require '../includes/db.php';
    $categories = Category::getAll($conn);

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        
        $article->title = $_POST['title'];
        $article->content = $_POST['content'];
        $article->published_at = $_POST['published_at'];

        $category_ids = $_POST['category'] ?? [];

        if ($article->create($conn)) {
            
            $article->setCategories($conn, $category_ids);

            Url::redirect("/cms/admin/article.php?id={$article->id}");
        }
    }
?>

<?php require '../includes/header.php'; ?>

<h1>New Article</h1>

<?php require 'includes/article-form.php'; ?>

<?php require '../includes/footer.php'; ?>
