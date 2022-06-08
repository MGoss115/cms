<!-- TO CHECK THE TYPE OF REQUEST YOU CAN USE $_SERVER["REQUEST_METHOD"] -->

<?php 
    require 'includes/database.php';
    
    $errors = [];

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        // CHECK TO SEE IF REQUIRED FIELDS ARE EMPTY
        
        if($_POST['title'] == ''){
            $errors[] = 'Title is required';
        }
        if($_POST['content'] == ''){
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
            mysqli_stmt_bind_param($stmt, "sss", $_POST['title'], $_POST['content'], $_POST['published_at']);
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
        <input type="text" name="title" id="title" placeholder="Article Title">
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Article Content"></textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="datetime-local" name="published_at" id="published_at">
    </div>
    <button type="submit">Add</button>
</form>
<?php require 'includes/footer.php'; ?>
