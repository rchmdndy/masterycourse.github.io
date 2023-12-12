<?php include("inc_header.php")?>
        <?php

            $sukses = "";
            $katakunci = ($_GET['katakunci'] ?? "");
            if (isset($_GET['op'])) {
                $op = $_GET['op'];
            }else{
                $op = "";
            }
            if ($op == 'delete'){
                $id = $_GET['id'];
                $sql1 = "DELETE FROM halaman WHERE id='$id'";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1){
                    $sukses = "Data berhasil dihapus";
                }
            }
        ?>
        <h1>Halaman Admin</h1>
        <p>
            <a href="halaman_input.php">
                <input type="button" class="btn btn-primary" value="Buat Halaman">
            </a>
        </p>
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
                <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary">
            </div>
        </form>
        <table class="table table-striped">
            <thead>
            <tr>
                <th class="col-1">#</th>
                <th>Judul</th>
                <th>Kutipan</th>
                <th class="col-2">Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $sqltambahan = "";
                if ($katakunci != '') {
                    $array_katakunci = array_slice(explode(" ", $katakunci), 0, 100);
                    for ($i = 0; $i < count($array_katakunci); $i++) {
                        $array_katakunci[$i] = "judul LIKE '" . $array_katakunci[$i] . "%'";
                    }
                    $sqltambahan = "WHERE " . implode(" OR ", $array_katakunci);
                }
                $sql1 = "SELECT * FROM halaman $sqltambahan";
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
                        <td><?php echo $r1['judul']?></td>
                        <td><?php echo $r1['kutipan']?></td>
                        <td>
                            <a href="halaman_input.php?id=<?php echo $r1['id'];?>">
                            <span class="badge bg-danger">Edit</span>
                            </a>

                            <a href="halaman.php?op=delete&id=<?php echo $r1['id']?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                            <span class="badge bg-warning">Delete</span>
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
                    <a class="page-link" href="halaman.php?katakunci=<?php echo $katakunci?>&cari=<?php echo $cari?>&page=<?php echo $i ?>"><?php echo $i ?></a>
                </li>
                <?php
            }
        ?>
    </ul>
</nav>
<?php include("inc_footer.php")?>
