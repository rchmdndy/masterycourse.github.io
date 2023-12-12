<?php include ("inc_header.php"); ?>

<?php
$err = "";
$sukses = "";

if (!isset($_GET['email']) or !isset($_GET['kode'])) {
	$err = "Link tidak valid";
} else {
	$email = $_GET['email'];
	$kode = $_GET['kode'];

	$sql = "SELECT * FROM members WHERE email = '$email'";
	$q = mysqli_query($koneksi, $sql);
	$r = mysqli_fetch_array($q);
	$nama_lengkap = $r['nama_lengkap'];

	if ($r['status'] == $kode){
		$sql2 = "UPDATE members SET status = '1' WHERE email = '$email'";
		mysqli_query($koneksi, $sql2);
		$sukses = "Verifikasi berhasil, silahkan <a href='login.php'>login</a>";
	}else{
		$err = "Verifikasi gagal, silahkan coba lagi";
	}
}
?>
<h3>Halaman Verifikasi</h3>
<?php if ($err) {echo "<div class='error'>$err</div>";} ?>
<?php if ($sukses) {echo "<div class='sukses'>$sukses</div>";} ?>
<?php include("inc_footer.php")?>
