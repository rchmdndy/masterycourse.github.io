<?php include("inc_header.php")?>
<?php
if (isset($_SESSION['members_email']) != ""){
    header("Location: index.php");
    exit();
}
?>

<h3>Pendaftaran</h3>
<?php
$email = "";
$nama_lengkap = "";
$err = "";
$sukses = "";

if(isset($_POST['simpan'])){
	$email = $_POST['email'];
	$nama_lengkap = $_POST['nama_lengkap'];
	$password = $_POST['password'];
	$konfirmasi_password = $_POST['konfirmasi_password'];

	if ($email == "" || $nama_lengkap == "" || $password == "" || $konfirmasi_password == ""){
		$err = "<li>Mohon lengkapi semua field</li>";
	}

	if($email != ""){
		$sql1 = "SELECT email FROM members WHERE email = '$email'";
		$q1 = mysqli_query($koneksi, $sql1);
		$n1 = mysqli_fetch_array($q1);
		if ($n1 > 0){
			$err .= "<li>Email sudah terdaftar</li>";
		}

		if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$err .= "<li>Email tidak valid</li>";
		}
	}
	if ($password != $konfirmasi_password){
		$err .= "<li>Konfirmasi password tidak sesuai</li>";
	}
	if (strlen($password) <= 6){
		$err .= "<li>Panjang password minimal 6 karakter</li>";
	}
	if (empty($err)){
        $status = md5(rand(0, 1000));
        $judul_email = "Pendaftaran Member";
		$isi_email = 'Akun yang kamu mliki dengan email <b>'.$email.'</b> telah siap digunakan<br/>';
		$isi_email .= 'Sebelumnya silahkan aktifasi email di link dibawah ini : <br/>';
		$isi_email .= url_dasar().'/verifikasi.php?email='.$email.'&kode='.$status;

        kirim_email($email, $nama_lengkap, $judul_email, $isi_email);

        $sql1 = "INSERT INTO members (email, nama_lengkap, password, status) VALUES ('$email', '$nama_lengkap', md5('$password'), '$status')";
        $q1 = mysqli_query($koneksi, $sql1);

        if ($q1){
            $sukses = "Pendaftaran berhasil, silahkan cek email kamu untuk aktifasi akun";
        }

		$sukses = "Proses berhasil";
	}
}
?>
<?php if ($err) {echo "<div class='error'><ul>$err</ul></div>";}?>
<?php if ($sukses) {echo "<div class='sukses'><ul>$sukses</ul></div>";}?>

<form action="" method="POST">
	<table>
		<tr>
			<td class="label">Email</td>
			<td>
				<input type="text" class="input" name="email" value="<?php echo $email; ?>" />
			</td>
		</tr>
		<tr>
			<td class="label">Nama Lengkap</td>
			<td>
				<input type="text" class="input" name="nama_lengkap" value="<?php echo $nama_lengkap; ?>" />
			</td>
		</tr>
		<tr>
			<td class="label">Password</td>
			<td>
				<input type="password" name="password" class="input"/>
			</td>
		</tr>
		<tr>
			<td class="label">Konfirmasi Password</td>
			<td>
				<input type="password" name="konfirmasi_password" class="input"/>
                <br/>


            </td>
		</tr>
        <tr>
                <div class="pendaftaran">
                    <p>
                        Sudah punya akun? Silahkan <a href='<?php echo url_dasar()?>/login.php'>login</a>
                    </p>
                </div>
        </tr>
		<tr>
			<td></td>
			<td>
				<input type="submit" name="simpan" class="input tbl-biru"/>
			</td>
		</tr>

	</table>
</form>

<?php include("inc_footer.php")?>
