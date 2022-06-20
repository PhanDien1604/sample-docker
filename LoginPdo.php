<?php
$cookie_name = 'user';
 
$cookie_time = (3600 * 24 * 30);

session_start();
// print_r($_POST);
$error=[];
if(isset($_POST['submit'])==true){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $remember_me=$_POST['remember_me'];

    if(empty($remember_me)) {
        setcookie ('remember_email', '', time() - $cookie_time);
        setcookie ('remember_password', '', time() - $cookie_time);
        setcookie ('remember_login', '', time() + $cookie_time);
    }

    if(empty($email)||strlen($email)>255){
        $error['email'] = 'Email không hợp lệ';
    }elseif(empty($password)|| strlen($password) < 6 || strlen($password) > 100){
        $error['password']= 'Mật khẩu không hợp lệ';
    }
    else{
        try {
            $conn = new PDO('mysql:host=db;port=3306;dbname=dienpq', 'root', 'root');
            $sql="SELECT * FROM users WHERE mail = ? AND password = ?";
            $st= $conn->prepare($sql);
            $st->setFetchMode(PDO::FETCH_OBJ);
            $st->execute([$email, $password]);
            $data = $st->fetch();
            if($data) {
                $_SESSION['user'] = $data;
                // echo 'Đăng nhập thành công';
                if(!empty($remember_me)) {  
                    setcookie ('remember_email', $email, time() + $cookie_time);
                    setcookie ('remember_password', $password, time() + $cookie_time);
                    setcookie ('remember_login', $remember_me, time() + $cookie_time);
                }
                header("location:LoginSuccessPdo.php");
            } else {
                echo 'Đăng nhập thất bại';
            }
        } catch (PDOException $e) {
            echo 'Error!:';
            echo '</br>';
            echo $e;
            die();
        }   
    }
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
    <form method="POST" style="width:500px" class= "m-auto";>
        <h1 class= "m-auto p2">Login</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="<?php echo(isset($_COOKIE['remember_email']) ? $_COOKIE['remember_email'] : "") ?>" placeholder="Nhập email của bạn">
            <span style="color: red;"><?php echo(isset($error['email']))?$error['email']:'' ?></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" value="<?php echo(isset($_COOKIE['remember_password']) ? $_COOKIE['remember_password'] : "") ?>" placeholder="Nhập mật khẩu(ít nhất 6 ký tự)">
            <span style="color: red;"><?php echo(isset($error['password']))?$error['password']:'' ?></span>
        </div>
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" name="remember_me" <?php echo(isset($_COOKIE['remember_login']) ? "checked" : "") ?>>Remember me
            </label>
        </div>
        <button class="btn btn-primary mt-4" name="submit">Login</button>
    </form>
    </body>
</html>