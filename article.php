<?php 
    $db_host = "localhost";
    $db_name = "cms";
    $db_user = "kaygoss";
    $db_pass = "WFOIhqv.A@hZdc..";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    
    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }
    
    $sql = "SELECT * 
            FROM article 
            WHERE id = " . $_GET['id'];

    $results = mysqli_query($conn, $sql);

    if ($results === false){
        echo mysqli_error($conn);
    }else{
        $article = mysqli_fetch_assoc($results); 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS</title>
</head>
<body>
    <header>
        <h1>My Blog</h1>
    </header>
    <main>
        <!-- ADD A CHECK BEFORE THE LOOP TO CHECK FOR EMPTY ENTRIES -->
        <?php if ($article === null): ?>
            <p>No articles found.</p>
        <?php else: ?>
            <article>
                 <h2><?= $article['title']; ?></h2>
                 <p><?= $article['content']; ?></p>
            </article> 
        <?php endif; ?>
    </main>
</body>
</html>
