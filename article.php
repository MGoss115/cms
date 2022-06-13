<?php 
    require 'classes/Database.php';
    require 'includes/article.php';

    $db = new Database();
    $conn = $db->getConn();
    
    // VALIDATE ID HAS BEEN SET/DECLARED AND IS NOT NULL
    if (isset($_GET['id'])){
        $article = getArticle($conn, $_GET['id']);
    }else{
        $article = null;
    }
?>
<?php require 'includes/header.php'; ?>
        <!-- ADD A CHECK BEFORE THE LOOP TO CHECK FOR EMPTY ENTRIES -->
<?php if ($article) : ?>
    <article>
        <h2><?= htmlspecialchars($article['title']); ?></h2>
        <p><?= htmlspecialchars($article['content']); ?></p>
    </article>

    <a href="edit-article.php?id=<?= $article['id']; ?>">Edit</a>
    <a href="delete-article.php?id=<?= $article['id']; ?>">Delete</a>

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>
<a href="index.php">Home</a>
<?php require 'includes/footer.php'; ?>

