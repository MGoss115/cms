<?php 
    require 'includes/database.php';

    $conn = getDB();
    // VALIDATE ID HAS BEEN SET/DECLARED AND IS NOT NULL AND IS NUMERIC PRIOR TO SEARCH
    if (isset($_GET['id']) && is_numeric($_GET['id'])){

        $sql = "SELECT * 
                FROM article 
                WHERE id = " . $_GET['id'];
    
        $results = mysqli_query($conn, $sql);
    
        if ($results === false){
            echo mysqli_error($conn);
        }else{
            $article = mysqli_fetch_assoc($results); 
        }
    }else{
        $article = null;
    }
?>
<?php require 'includes/header.php'; ?>
        <!-- ADD A CHECK BEFORE THE LOOP TO CHECK FOR EMPTY ENTRIES -->
<?php if ($article === null): ?>
    <p>No articles found.</p>
<?php else: ?>
    <article>
        <h2><?= htmlspecialchars($article['title']); ?></h2>
        <p><?= htmlspecialchars($article['content']); ?></p>
    </article> 
<?php endif; ?>
<a href="index.php">Home</a>
<?php require 'includes/footer.php'; ?>

