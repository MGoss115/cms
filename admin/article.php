<?php

require '../includes/init.php';

Auth::requireLogin();

$conn = require '../includes/db.php';

if (isset($_GET['id'])) {
    $article = Article::getWithCategories($conn, $_GET['id']);
} else {
    $article = null;
}

?>
<?php require '../includes/header.php'; ?>

<?php if ($article) : ?>

    <article>
        <h2><?= htmlspecialchars($article[0]['title']); ?></h2>
          <?php if ($article[0]['published_at']) : ?>
                        <time><?= $article[0]['published_at'] ?></time>
                    <?php else: ?>
                        Unpublished
                    <?php endif; ?>
        <!-- checks to see if we have any categories to display & if we do the below code loops through the array and prints them out -->
        <?php if ($article[0]['category_name']) : ?>
            <p>Categories:
                <!-- loops through and prints out the categories -->
                <?php foreach ($article as $a) : ?>
                    <?= htmlspecialchars($a['category_name']); ?>
                <?php endforeach; ?>
            </p>
        <?php endif; ?>

        <?php if ($article[0]['image_file']) : ?>
            <img src="/cms/uploads/<?= $article[0]['image_file']; ?>">
        <?php endif; ?>

        <p><?= htmlspecialchars($article[0]['content']); ?></p>
    </article>

    <a href="edit-article.php?id=<?= $article[0]['id']; ?>">Edit</a>
    <a class="delete" href="delete-article.php?id=<?= $article[0]['id']; ?>">Delete</a>
    <a href="edit-article-image.php?id=<?= $article[0]['id']; ?>">Edit Image</a>

<?php else : ?>
    <p>Article not found.</p>
<?php endif; ?>

<?php require '../includes/footer.php'; ?>

