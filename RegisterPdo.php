<?php

session_start();
// print_r($_POST);    
$error=[];
if(isset($_POST['submit'])==true){
    $email=$_POST['email'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $password_confirm=$_POST['password_confirm'];
    $address=$_POST['address'];
    $phone=$_POST['phone'];

    if(empty($email)||strlen($email)>255){
        $error['email'] = 'Email không hợp lệ';
    }elseif(empty($password)|| strlen($password) < 6 || strlen($password) > 100){
        $error['password']= 'Mật khẩu không hợp lệ';
    }elseif(empty($password) || $password != $password_confirm){
        $error['password_confirm'] = 'Mật khẩu nhập lại không trùng khớp';
    }elseif(empty($phone)|| strlen($phone) < 9 || strlen($phone) > 10){
        $error['password']= 'Số điện thoại không hợp lệ';
    }elseif(empty($address)){
        $error['address']= 'Vui lòng nhập địa chỉ';
    }
    else{
        try {
            $conn = new PDO('mysql:host=db;port=3306;dbname=dienpq', 'root', 'root');
            $sql="INSERT INTO users(mail, name, password, phone, address) VALUES (?, ?, ?, ?, ?)";
            $st= $conn->prepare($sql);
            $st->execute([$email, $name, $password, $phone, $address]);
            header("location:LoginPdo.php");
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
        <h1 class= "m-auto p2">Register</h1>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Nhập email của bạn">
            <span style="color: red;"><?php echo(isset($error['mail_address']))?$error['mail_address']:'' ?></span>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên của bạn(ít nhất 6 ký tự)">
            <span style="color: red;"><?php echo(isset($error['name']))?$error['name']:'' ?></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Nhập mật khẩu(ít nhất 6 ký tự)">
            <span style="color: red;"><?php echo(isset($error['password']))?$error['password']:'' ?></span>
        </div>
        <div class="mb-3">
            <label for="password_confirm" class="form-label">Password confirm</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" placeholder="Xác nhận mật khẩu">
            <span style="color: red;"><?php echo(isset($error['password_confirm']))?$error['password_confirm']:'' ?></span>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" class="form-control" id="address" placeholder="Nhập địa chỉ">
            <span style="color: red;"><?php echo(isset($error['address']))?$error['address']:'' ?></span>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="number" name="phone"  class="form-control" id="phone" placeholder="Nhập số điện thoại">
            <span style="color: red;"><?php echo(isset($error['phone']))?$error['phone']:'' ?></span>
        </div>	
        <button class="btn btn-primary" name="submit">Register</button>
    </form>
    </body>
</html>