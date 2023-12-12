<?php include "inc_header.php"?>
	<!-- untuk home -->
	<section id="home">
		<img src="<?php echo ambil_gambar(15)?>"/>
		<div class="kolom">
			<p class="deskripsi"><?php echo ambil_kutipan(15)?></p>
			<h2><?php echo ambil_judul(15)?></h2>
            <div class="details">
			    <?php echo max_kata(ambil_isi(15), 16)?>
            </div>
			<p><a href="<?php echo buat_link_halaman(15)?>" class="tbl-pink">Pelajari Lebih Lanjut</a></p>
		</div>
	</section>

	<!-- untuk courses -->
	<section id="courses">
		<div class="kolom">
			<p class="deskripsi"><?php echo ambil_kutipan(16)?></p>
			<h2><?php echo ambil_judul(16)?></h2>
            <div class="details">
			<?php echo max_kata(ambil_isi(16), 44)?>
            </div>
			<p><a href="<?php echo buat_link_halaman(16)?>" class="tbl-biru">Pelajari Lebih Lanjut</a></p>
		</div>
		<img src="<?php echo ambil_gambar(16)?>"/>
	</section>

	<!-- untuk tutors -->
	<section id="tutors">
		<div class="tengah">
			<div class="kolom">
				<p class="deskripsi">Our Top Tutors</p>
				<h2>Tutors</h2>
				<p>Dibimbing oleh para Senior yang telah berpengalaman dalam dunia coding dan teaching</p>
			</div>

			<div class="tutor-list">
                <?php
                $sql1 = "SELECT * FROM tutors ORDER BY id DESC";
                $q1 = mysqli_query($koneksi, $sql1);
                while($r1 = mysqli_fetch_array($q1)){
                    ?>
                    <div class="kartu-tutor">
                        <a href="<?php echo buat_link_tutors($r1['id'])?>">
                        <img src="<?php echo url_dasar()."/gambar/".tutors_foto($r1['id'])?>"/>
                        <p><?php echo $r1['nama']?></p>
                        </a>
                    </div>
                    <?php
                }
                ?>
			</div>
		</div>
	</section>

	<!-- untuk partners -->
	<section id="partners">
		<div class="tengah">
			<div class="kolom">
				<p class="deskripsi">Our Top Partners</p>
				<h2>Partners</h2>
				<p>Course ini telah direkomendasikan dan telah bekerja sama untuk melatih employee partner-partner kita.</p>
			</div>

			<div class="partner-list">
                <?php
                $sql1 = "SELECT * FROM partners ORDER BY id DESC";
                $q1 = mysqli_query($koneksi, $sql1);
                while ($r1 = mysqli_fetch_array($q1)){
                   ?>
                    <div class="kartu-partner">
                        <a href="<?php echo buat_link_partners($r1['id'])?>">
                        <img src="<?php echo url_dasar()."/gambar/".partners_foto($r1['id'])?>"/>
                        </a>
                    </div>
                <?php
                }
                ?>
			</div>
		</div>
	</section>

<?php include "inc_footer.php"?>