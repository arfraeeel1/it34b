<?php
require_once('config/config.php');
require_once('config/functions.php');

if (isset($_SESSION['user_id'])){
    header('Location: ' . BASE_URL . '/' . $_SESSION['user_role'] . '/index.php');
    exit;
}

$error='';

if($_SERVER['REQUEST_METHOD']==='POST'){
    $login = trim($_POST['login'] ?? '');
    $password = $_POST['password'] ?? '';

    if(loginUser($pdo, $login, $password)){
        logActivity($pdo, $_SESSION['user_id'], $_SESSION['user_email'], 'login', 'success');
        header('Location: ' . BASE_URL . '/' . $_SESSION['user_role'] . '/index.php');
        exit;
    }

    $error = 'Invalid login credentials';

    if ($login === '' || $password === '') {
        logActivity($pdo, null, $login, 'login', 'failed');
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if($error): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="POST" action="">
        <label for="login">Email or Username:</label>
        <input type="text" name="login" id="login" required><br><br>

        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <button type="submit">Login</button>
    </form>

</body>
</html>
