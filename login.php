<?php
    /* Your password */
    $password = 'admin';

    /* Redirects here after login */
    $redirect_after_login = 'admin.php';

    /* Will not ask password again for */
    $remember_password = strtotime('+30 days'); // 30 days

    if (isset($_POST['password']) && $_POST['password'] == $password) {
        setcookie("password", $password, $remember_password);
        header('Location: ' . $redirect_after_login);
        exit;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Password Protected</title>
</head>
<body>
    <div style="text-align:center;margin-top:50px;">
        Password Required
        <form method="POST">
            <input type="text" name="password">
        </form>
    </div>
</body>
</html>