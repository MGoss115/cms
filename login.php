<?php

    require 'includes/url.php';

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST['username'] == 'kay' && $_POST['password'] == 'kay'){
            session_regenerate_id(true);
            $_SESSION['is_logged_in'] = true;
            redirect('/cms');
        } else {
            $error = "username/password incorrect!";
        }
    }
?>

<?php require 'includes/header.php'; ?>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post">
    <div>
        <label for="username">Username</label>
        <input type="text" name="username" id="username">
    </div>
     <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <button>Login</button>
</form>

<?php require 'includes/footer.php'; ?>