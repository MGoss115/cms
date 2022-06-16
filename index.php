<?php 
    require 'includes/init.php';

    $conn = require 'includes/db.php';

    //coalescing operator 
    $paginator = new Paginator($_GET['page'] ?? 1, 3, Article::getTotal($conn));

    $articles = Article::getPage($conn, $paginator->limit, $paginator->offset);
    
?>
<?php require 'includes/header.php'; ?>


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
<?php require 'includes/pagination.php'; ?>
<?php endif; ?>
<?php require 'includes/footer.php'; ?>
   