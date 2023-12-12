<?php include ("inc_header.php")?>
<?php
$nama      	= "";
$foto 		= "";
$foto_name 	= "";
$isi        = "";
$error      = "";
$suskes     = "";

$id = $_GET['id'] ?? "";

if($id != ""){
	$sql1 = "SELECT * FROM partners WHERE id = '$id'";
	$q1 = mysqli_query($koneksi, $sql1);
	$r1 = mysqli_fetch_array($q1);
	$nama      = $r1['nama'];
	$isi        = $r1['isi'];
	$foto       = $r1['foto'];

	if ($isi == ""){
		$error = "Data tidak ditemukan";
	}
}

if (isset($_POST['simpan'])) {
	$nama = $_POST['nama'];
	$isi = $_POST['isi'];

	if (empty($nama) or empty($isi)) {
		$error = "nama tidak boleh kosong";
	}

	if($_FILES['foto']['name']){
		$foto_name = $_FILES['foto']['name'];
		$foto_file = $_FILES['foto']['tmp_name'];
		$detail_file = pathinfo($foto_name);

		$foto_ekstensi = $detail_file['extension'];
		$ektensi_yang_diperbolehkan = array('png','jpg', "jpeg");
		if(!in_array($foto_ekstensi, $ektensi_yang_diperbolehkan)){
			$error = "Ekstensi file tidak diperbolehkan";
		}
	}
	if (empty($error)){
		if($foto_name){
			$direktori = "../gambar";

			@unlink($direktori."/".$foto);

			$foto_name = "partners_".time()."_".$foto_name;
			move_uploaded_file($foto_file, $direktori."/".$foto_name);
			$foto = $foto_name;
		}else{
			$foto_name = $foto;
		}

		if ($id != ""){
			$sql1 = "UPDATE partners SET nama = '$nama', isi = '$isi', foto='$foto_name' WHERE id = '$id'";
		}else{
			$sql1 = "INSERT INTO partners (nama, foto, isi, tgl_isi) VALUES ('$nama', '$foto_name', '$isi', NOW())";
		}
		$q1 = mysqli_query($koneksi, $sql1);
		if ($q1) {
			$suskes = "Data berhasil ditambahkan";
		} else {
			$error = "Data gagal ditambahkan";
		}
	}
}

?>
<h1>Halaman Admin Input Data Partners</h1>
<div class="mb-3 row">
	<a href="halaman.php"><< Kembali ke halaman admin</a>
</div>
<?php
if($error) {
	echo "<div class=\"alert alert-danger\" role=\"alert\">$error</div>";
}
?>
<?php
if ($suskes) {
	echo "<div class=\"alert alert-success\" role=\"alert\">$suskes</div>";
}
?>
<form action="" method="post" enctype="multipart/form-data">
	<div class="mb-3 row">
		<label for="nama" class="col-sm-2 col-form-label">Nama</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="nama" value="<?php echo $nama;?>" name="nama">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="foto" class="col-sm-2 col-form-label">Foto</label>
		<div class="col-sm-10">
			<?php
			if($foto){
				echo "<img src='../gambar/$foto' style='max-height: 100px;max-width: 100px'/>";

			}
			?>
			<input type="file" class="form-control" id="foto" name="foto">
		</div>
	</div>
	<div class="mb-3 row">
		<label for="isi" class="col-sm-2 col-form-label">Isi</label>
		<div class="col-sm-10">
			<textarea class="form-control" name="isi" id="summernote"><?php echo $isi;?></textarea>
		</div>
	</div>
	<div class="mb-3 row">
		<div class="col-sm-2"></div>
		<div class="col-sm-10">
			<input type="submit" name="simpan" value="Simpan" class="btn btn-primary"/>
		</div>
	</div>

</form>
<?php include ("inc_footer.php")?>
