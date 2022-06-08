<!-- TO CHECK THE TYPE OF REQUEST YOU CAN USE $_SERVER["REQUEST_METHOD"] -->

<?php 
    require 'includes/database.php';
    
    $errors = [];
    $title = '';
    $content = '';
    $published_at = '';

    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $title = $_POST['title'];
        $content = $_POST['content'];
        $published_at = $_POST['published_at'];

        // CHECK TO SEE IF REQUIRED FIELDS ARE EMPTY
        
        if($title == ''){
            $errors[] = 'Title is required';
        }
        if($content == ''){
            $errors[] = 'Content is required';
        }
        
        if(empty($errors)){

        $conn = getDB();

        $sql = "INSERT INTO article (title, content, published_at)
                VALUES(?, ?, ?)";

        // RETURNS SQL STATEMENT AND IF THERE IS AN ERROR IN THE SQL QUERY THEN IT WILL BE RETURN WITH THE IF STATEMENT
        $stmt = mysqli_prepare($conn, $sql);

        if($stmt === false){    //HERE IS THE CEHCK 
            echo mysqli_error($conn);
        }else{
            mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);
            if(mysqli_stmt_execute($stmt)){
                $id = mysqli_insert_id($conn);
                echo "Inserted record with ID: $id";    
            }else{
                echo mysqli_stmt_error($stmt);
            }
        }
    }
}
?>

<?php require 'includes/header.php'; ?>
<h1>New Article</h1>

<?php if(!empty($errors)): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
 
<form method="post">
    <div>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Article Title" value="<?= $title; ?>">>
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Article Content"><?= $content; ?></textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at" value="<?= $published_at; ?>">
    </div>
    <button type="submit">Add</button>
</form>
<?php require 'includes/footer.php'; ?>
