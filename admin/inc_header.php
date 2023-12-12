<?php
session_start();

if ($_SESSION['admin_username'] == "") {
    header("location:login.php");
}
include_once ("config.php");
include_once ("inc_fungsi.php");
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Admin</title>
<!--    <link href="../css/all.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="<?php echo url_dasar();?>/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="<?php echo url_dasar();?>/css/summernote-image-list.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<!--    <link href="../css/summernote.min.css" rel="stylesheet" crossorigin="anonymous" ">-->

    <style>
        .image-list-content .col-lg-3 {width: 100%;}
        .image-list-content img {float: left; width: 20%;}
        .image-list-content p {float: left; padding-left: 20px}
        .image-list-item {padding: 10px 0px 10px 0px;}
        .pendaftaran p{
            padding-top: 20px;
            margin-top: 10px;
        }
        .pendaftaran a{
            color: #000;
        }
        .pendaftaran a:hover{
            color: deepskyblue;
        }
    </style>
</head>
<body class="container">
<header>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark"">
	<div class="container-fluid">
		<a class="navbar-brand" href="index.php">Admin</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" aria-current="page" href="halaman.php">Halaman</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="tutors.php">Tutors</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="partners.php">Partner</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="info.php">Contact</a>
				</li>
                <li class="nav-item">
					<a class="nav-link" href="members.php">Members</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout.php">Logout</a>
				</li>
			</ul>
		</div>
	</div>
</header>
<main>
