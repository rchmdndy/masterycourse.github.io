<?php include ("inc_header.php")?>
<?php
$judul      = "";
$kutipan    = "";
$isi        = "";
$error      = "";
$suskes     = "";

$id = $_GET['id'] ?? "";

if($id != ""){
    $sql1 = "SELECT * FROM halaman WHERE id = '$id'";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $judul      = $r1['judul'];
    $kutipan    = $r1['kutipan'];
    $isi        = $r1['isi'];

    if ($isi == ""){
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
	$judul = $_POST['judul'];
	$kutipan = $_POST['kutipan'];
	$isi = $_POST['isi'];

	if (empty($judul) or empty($isi)) {
		$error = "Judul tidak boleh kosong";
	}
    if (empty($error)){
        if ($id != ""){
            $sql1 = "UPDATE halaman SET judul = '$judul', kutipan = '$kutipan', isi = '$isi' WHERE id = '$id'";
        }else{
            $sql1 = "INSERT INTO halaman (judul, kutipan, isi, tgl_isi) VALUES ('$judul', '$kutipan', '$isi', NOW())";
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
<h1>Halaman Admin Input Data</h1>
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
<form action="" method="post">
    <div class="mb-3 row">
        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="judul" value="<?php echo $judul;?>" name="judul">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="kutipan" class="col-sm-2 col-form-label">Kutipan</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kutipan" value="<?php echo $kutipan;?>" name="kutipan">
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
