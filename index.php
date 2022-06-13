<?php 
    require 'classes/Database.php';

    require 'classes/Article.php';

    require 'includes/auth.php';

    session_start();

   $db = new Database();
   $conn = $db->getConn();
   $articles = Article::getAll($conn);
    
?>
<?php require 'includes/header.php'; ?>


<?php if (isLoggedIn()): ?>
    <p>You are logged in. <a href="logout.php">Logout</a></p>
    <p><a href="new-article.php">Add New Article</a></p>
    <?php else: ?>
        <p>You are not logged in. <a href="login.php">Login</a></p>
        <?php endif; ?>
        

 <!-- ADD A CHECK BEFORE THE LOOP TO CHECK FOR EMPTY ENTRIES -->
<?php if (empty($articles)): ?>
    <p>No articles found.</p>
        <?php else: ?>
    <ul>
        <?php foreach($articles as $article): ?>
            <li>
                <article>
                    <h2><a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a></h2>
                    <p><?= htmlspecialchars($article['content']); ?></p>
                </article>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>
   