<?php include("inc_header.php")?>
<?php

$sukses = "";
$katakunci = ($_GET['katakunci'] ?? "");
$op = $_GET['op'] ?? "";
if ($op == 'delete'){
	$id = $_GET['id'];
	$sql1 = "DELETE FROM members WHERE id='$id'";
	$q1 = mysqli_query($koneksi, $sql1);
	if ($q1){
		$sukses = "Data berhasil dihapus";
	}
}
?>
<h1>Halaman Admin members</h1>

<?php
if ($sukses) {
	echo "<div class=\"alert alert-success\" role=\"alert\">$sukses</div>";
}
?>
<form class="row g-3" method="get">
	<div class="col-auto">
		<input type="text" class="form-control" placeholder="Masukkan kata kunci" name="katakunci" value="<?php echo $katakunci; ?>">
	</div>
	<div class="col-auto">
		<input type="submit" name="cari" value="Cari Member" class="btn btn-secondary">
	</div>
</form>
<table class="table table-striped">
	<thead>
	<tr>
		<th class="col-1">#</th>
		<th class="col-2">Email</th>
		<th>Nama</th>
		<th class="col-2">Status</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$sqltambahan = "";
	if ($katakunci != '') {
		$array_katakunci = array_slice(explode(" ", $katakunci), 0, 100);
		for ($i = 0; $i < count($array_katakunci); $i++) {
			$array_katakunci[$i] = "nama_lengkap LIKE '%" . $array_katakunci[$i] . "%'";
		}
		$sqltambahan = "WHERE " . implode(" OR ", $array_katakunci);
	}
	$sql1 = "SELECT * FROM members $sqltambahan";
	$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
	$per_halaman = 5;
	$mulai = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
	$q1 = mysqli_query($koneksi, $sql1);
	$total = mysqli_num_rows($q1);
	$pages = ceil($total / $per_halaman);
	$sql1 = $sql1 . " ORDER BY id DESC LIMIT $mulai, $per_halaman";
	$q1 = mysqli_query($koneksi, $sql1);
	$nomor = 1;
	while ($r1 = mysqli_fetch_array($q1)) {
		?>
		<tr>

			<td><?php echo $nomor++;?></td>
			<td><?php echo $r1['email']?></td>
			<td><?php echo $r1['nama_lengkap']?></td>
			<td>
				<?php
				if ($r1['status'] == '1'){
					?>
                    <span class="badge bg-success text-white">Aktif</span>
					<?php
				}else{
					?>
                    <span class="badge bg-danger text-white">Tidak Aktif</span>
					<?php
				}
				?>
			</td>
		</tr>
		<?php
	}
	?>

	</tbody>
</table>
<nav aria-label="Page Nav Example">
	<ul class="pagination">
		<?php
		$cari = isset($_GET['cari']) ? $_GET['cari'] : '';
		for ($i = 1; $i <= $pages; $i++) {
			?>
			<li class="page-item">
				<a class="page-link" href="members.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
			</li>
			<?php
		}
		?>
	</ul>
</nav>
<?php include("inc_footer.php")?>
