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
        if($published_at != ''){
            $date_time = date_create_from_format('Y-m-d H:i:s', $published_at);

            if($date_time === false){
                $errors[] = 'Invalid date and time';
            }else{
                $date_errors = date_get_last_errors();
                
                if($date_errors['warning_count'] > 0){
                    $errors[] = 'Invalid date and time';
                }
            }
        }
        if (empty($errors)) {

            $conn = getDB();

            $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";

            $stmt = mysqli_prepare($conn, $sql);

            if ($stmt === false) {

                echo mysqli_error($conn);

            } else {

                if ($published_at == '') {
                    $published_at = null;
                }

                mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

                if (mysqli_stmt_execute($stmt)) {

                    $id = mysqli_insert_id($conn);

                    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
                        $protocol = 'https';
                    } else {
                        $protocol = 'http';
                    }

                    header("Location: $protocol://" . $_SERVER['HTTP_HOST'] . "/cms/article.php?id=$id");
                    exit;

                } else {

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
        <input type="text" name="title" id="title" placeholder="Article Title" value="<?= htmlspecialchars($title); ?>">>
    </div>
    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10" placeholder="Article Content"><?= htmlspecialchars($content); ?></textarea>
    </div>
    <div>
        <label for="published_at">Publication date and time</label>
        <input type="text" name="published_at" id="published_at" value="<?= htmlspecialchars($published_at); ?>">
    </div>
    <button type="submit">Add</button>
</form>
<a href="index.php">Home</a>
<?php require 'includes/footer.php'; ?>
