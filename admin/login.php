<?php

session_start();
if (isset($_SESSION['admin_username']) != "") {
    header("location:index.php");
    exit();
}
include("config.php");
include("inc_fungsi.php");

$username = "";
$password = "";
$err = "";

if (isset($_POST['login'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) or empty($password)){
        $err = "Username dan password tidak boleh kosong";
    }else{
        $sql1 = "SELECT * FROM admin WHERE username = '$username' AND password = md5('$password')";
        $q1 = mysqli_query($koneksi, $sql1);
        $n1 = mysqli_num_rows($q1);
        $r1 = mysqli_fetch_array($q1);

        if($n1 < 1){
            $err = "Username salah";
        }elseif($r1['password'] != md5($password)) {
	        $err = "Password salah";
        }else {
	        $_SESSION['admin_username'] = $username;
            header("Location: index.php");
            exit();
        }
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo url_dasar();?>/css/bootstrap.min.css" crossorigin="anonymous">
    <title>Login Admin</title>
</head>
<body style="width: 100%;max-width: 330px;margin:auto;padding:15px">
<h1>Login Admin</h1>
<form action="" method="POST">
    <?php
    if ($err){
        echo "<div class=\"alert alert-danger\" role=\"alert\">$err</div>";
    }
    ?>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" class="form-control" id="username" value="<?php echo $username;?>"/>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" class="form-control" id="password"/>
    </div>
    <div class="form-group">
        <input type="submit" name="login" value="Login" class="btn btn-primary"/>
    </div>
</form>
</body>
</html>