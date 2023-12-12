<?php
function url_dasar()
{
	$url_dasar = "http://".$_SERVER['SERVER_NAME'];
	return $url_dasar;
}

function ambil_gambar($id_tulisan)
{
	global $koneksi;
	$sql1 = "SELECT * FROM halaman WHERE id = '$id_tulisan'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$text = $r1['isi'];

	preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $text, $img);
	$gambar = $img[1];
	$gambar = str_replace("../gambar/", url_dasar()."/gambar/", $gambar);
	return $gambar;
}

function ambil_kutipan($id_tulisan){
	global $koneksi;
	$sql1 = "SELECT * FROM halaman WHERE id = '$id_tulisan'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$text = $r1['kutipan'];
	return $text;
}

function ambil_judul($id_tulisan){
	global $koneksi;
	$sql1 = "SELECT * FROM halaman WHERE id = '$id_tulisan'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$text = $r1['judul'];
	return $text;
}

function ambil_isi($id_tulisan){
	global $koneksi;
	$sql1 = "SELECT * FROM halaman WHERE id = '$id_tulisan'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$text = strip_tags($r1['isi']);
	return $text;
}

function buat_link_halaman($id)
{
	global $koneksi;
	$sql = "SELECT * FROM halaman WHERE id = '$id'";
	$q = mysqli_query($koneksi, $sql);
	$r1 = mysqli_fetch_array($q);
	$judul = bersihkan_judul($r1['judul']);
	return url_dasar()."/halaman.php/$id/$judul";
}

function bersihkan_judul($judul){
	$judul_baru = strtolower($judul);
	$judul_baru = preg_replace("/[^a-zA-Z0-9\s-]/", "", $judul_baru);
	$judul_baru = str_replace(" ", "-", $judul_baru);
	return $judul_baru;
}

function dapatkan_id(){
	$id ="";
	if (isset($_SERVER['PATH_INFO'])){
		$id = dirname($_SERVER['PATH_INFO']);
		$id = preg_replace("/[^0-9]/", "", $id);
	}
	return $id;
}

function set_isi($isi){
	$isi = str_replace("../gambar/", url_dasar()."/gambar/", $isi);
	return $isi;
}

function max_kata($isi, $max){
	$array_kata = explode(" ", $isi);
	$array_kata = array_slice($array_kata, 0, $max);
	$isi = implode(" ", $array_kata);
	return $isi;
}

function tutors_foto($id){
	global $koneksi;
	$sql1 = "SELECT * FROM tutors WHERE id = '$id'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$foto = $r1['foto'];

	if($foto){
		return $foto;
	}else{
		return "tutors_default.png";
	}
}

function buat_link_tutors($id)
{
	global $koneksi;
	$sql = "SELECT * FROM tutors WHERE id = '$id'";
	$q = mysqli_query($koneksi, $sql);
	$r1 = mysqli_fetch_array($q);
	$nama = bersihkan_judul($r1['nama']);
	return url_dasar()."/tutors.php/$id/$nama";
}

function partners_foto($id){
	global $koneksi;
	$sql1 = "SELECT * FROM partners WHERE id = '$id'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$foto = $r1['foto'];

	if($foto){
		return $foto;
	}else{
		return "partners_default.png";
	}
}

function buat_link_partners($id)
{
	global $koneksi;
	$sql = "SELECT * FROM partners WHERE id = '$id'";
	$q = mysqli_query($koneksi, $sql);
	$r1 = mysqli_fetch_array($q);
	$nama = bersihkan_judul($r1['nama']);
	return url_dasar()."/partners.php/$id/$nama";
}

function ambil_isi_info ($id, $kolom)
{
	global $koneksi;
	$sql1 = "SELECT $kolom FROM info WHERE id = '$id'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	return $r1["$kolom"];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function kirim_email($email_penerima, $nama_penerima, $judul_email, $isi_email){
//Load Composer's autoloader
	$email_pengirim = "dummyacclogin@gmail.com";
	$nama_pengirim = "noreply";

	require getcwd().'/vendor/autoload.php';
	var_dump(getcwd());

//Create an instance; passing `true` enables exceptions
	$mail = new PHPMailer(true);

	try {
		//Server settings
		$mail->SMTPDebug = 0;                      //Enable verbose debug output
		$mail->isSMTP();                                            //Send using SMTP
		$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
		$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
		$mail->Username   = $email_pengirim;                     //SMTP username
		$mail->Password   = 'bqrd tmkr bgwc irmv';                               //SMTP password
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
		$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

		//Recipients
		$mail->setFrom($email_pengirim, $nama_pengirim);
		$mail->addAddress($email_penerima, $nama_penerima);     //Add a recipient

		//Content
		$mail->isHTML(true);                                  //Set email format to HTML
		$mail->Subject = $judul_email;
		$mail->Body    = $isi_email;

		$mail->send();
		return 'Sukses';
	} catch (Exception $e) {
		echo "Gagal: {$mail->ErrorInfo}";
	}
}