<!-- TO CHECK THE TYPE OF REQUEST YOU CAN USE $_SERVER["REQUEST_METHOD"] -->

<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        require 'includes/database.php';

        $sql = "INSERT INTO article (title, content, published_at)
                VALUES('" . $_POST['title'] . "','"
                          . $_POST['content'] . "','"
                          . $_POST['published_at'] . "')";

        // EXECUTE SQL QUERY
        $results = mysqli_query($conn, $sql);

        if($results === false){
            echo mysqli_error($conn);
        }else{
            $id = mysqli_insert_id($conn);
            echo "Inserted record with ID: $id";    
        }
    }
?>

<?php require 'includes/header.php'; ?>
<h1>New Article</h1>
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
