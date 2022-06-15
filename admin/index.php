<?php 
    require '../includes/init.php';

    Auth::requireLogin();

    $conn = require '../includes/db.php';

    $articles = Article::getAll($conn);
    
?>
<?php require '../includes/header.php'; ?>

<h2>Adminstrator</h2>

<p><a href="new-article.php">Add New Article</a></p>

 <!-- ADD A CHECK BEFORE THE LOOP TO CHECK FOR EMPTY ENTRIES -->
<?php if (empty($articles)): ?>
    <p>No articles found.</p>
        <?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($articles as $article): ?>
            <tr>
                <td>
                    <a href="article.php?id=<?= $article['id']; ?>"><?= htmlspecialchars($article['title']); ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
<?php require '../includes/footer.php'; ?>
