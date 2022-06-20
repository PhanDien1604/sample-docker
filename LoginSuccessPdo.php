<?php
session_start();

if(isset($_GET['logout'])) {
    unset($_SESSION['user']);
    header("location:LoginPdo.php");
}
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="./vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

        <title>RegisterPdo</title>
    </head>
<body>
    <div class="m-5">
        <h3 class="text-success">Đăng nhập thành công</h3>
        <p><?php echo $_SESSION['user']->name ?></p>
        <p><?php echo $_SESSION['user']->phone ?></p>
        <p><?php echo $_SESSION['user']->email ?></p>
        <p><?php echo $_SESSION['user']->address ?></p>
        <form action="" method="get">
            <button class="btn btn-secondary" name="logout">Logout</button>
        </form>
    </div>
</body>
</html>