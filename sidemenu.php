<?php if($level=='1'): ?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-database nav-icon"></i>
                <p>Referensi
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=refpddk" class="nav-link">
                        <i class="fas fa-award nav-icon"></i>
                        <p>Referensi Pendidikan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=refkerja" class="nav-link">
                        <i class="fas fa-address-card nav-icon"></i>
                        <p>Referensi Pekerjaan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=refgaji" class="nav-link">
                        <i class="fas fa-chart-bar nav-icon"></i>
                        <p>Referensi Penghasilan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=refskul" class="nav-link">
                        <i class="fas fa-university nav-icon"></i>
                        <p>Referensi Sekolah Mitra</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-cogs nav-icon"></i>
                <p>Pengaturan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=datasekolah" class="nav-link">
                        <i class="fas fa-school nav-icon"></i>
                        <p>Identitas Sekolah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=datauser" class="nav-link">
                        <i class="fas fa-user nav-icon"></i>
                        <p>Pengguna</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-user-graduate nav-icon"></i>
                <p>Data GTK
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=datagtk" class="nav-link">
                        <i class="fas fa-search nav-icon"></i>
                        <p>Lihat Data</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=addgtk&m=1" class="nav-link">
                        <i class="fas fa-user-edit nav-icon"></i>
                        <p>Tambah Data</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=tgsguru" class="nav-link">
                        <i class="fas fa-users-cog nav-icon"></i>
                        <p>Penugasan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-users nav-icon"></i>
                <p>Peserta Didik
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=datasiswa" class="nav-link">
                        <i class="fas fa-search nav-icon"></i>
                        <p>Lihat Data</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=addsiswa&m=1" class="nav-link">
                        <i class="fas fa-user-plus nav-icon"></i>
                        <p>Tambah Data</p>
                    </a>
                </li>
                <!-- <li class="nav-item">
						<a href="index.php?p=riwayatsiswa" class="nav-link">
							<i class="fas fa-user-check nav-icon"></i>
							<p>Riwayat Pendidikan</p>
						</a>
					</li> -->
                <li class="nav-item">
                    <a href="index.php?p=mutasisiswa" class="nav-link">
                        <i class="fas fa-user-minus nav-icon"></i>
                        <p>Mutasi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=eksporsiswa" class="nav-link">
                        <i class="fas fa-sync-alt nav-icon"></i>
                        <p>Impor Data</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-book-reader nav-icon"></i>
                <p>Pembelajaran
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=datakur" class="nav-link">
                        <i class="fas fa-graduation-cap nav-icon"></i>
                        <p>Kurikulum</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=datamapel" class="nav-link">
                        <i class="far fa-check-circle nav-icon"></i>
                        <p>Mata Pelajaran</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=kompetensi" class="nav-link">
                        <i class="fas fa-globe nav-icon"></i>
                        <p>Ekstrakurikuler</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=kompetensi" class="nav-link">
                        <i class="fas fa-check-double nav-icon"></i>
                        <p>Kompetensi Dasar</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-list nav-icon"></i>
                        <p>Rombongan Belajar
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?p=datakelas" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Data Rombel</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=isikelas" class="nav-link">
                                <i class="fas fa-list nav-icon"></i>
                                <p>Anggota Rombel</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=dataampu" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Pengampu</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=datakkm" class="nav-link">
                        <i class="fas fa-chart-line nav-icon"></i>
                        <p>Data KKM</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="fas fa-book nav-icon"></i>
                <p>Penilaian
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item has-treeview"">
						<a href=" #" class="nav-link">
                    <i class="far fa-check-circle nav-icon"></i>
                    <p>Input Nilai Rapor</p>
                    <i class="fas fa-angle-left right"></i>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php?p=datarapor&d=1" class="nav-link">
                                <i class="fas fa-check-square nav-icon"></i>
                                <p>Nilai Sikap Spiritual</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=datarapor&d=2" class="nav-link">
                                <i class="fas fa-check-square  nav-icon"></i>
                                <p>Nilai Sikap Sosial</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=datarapor&d=3" class="nav-link">
                                <i class="fas fa-check-square nav-icon"></i>
                                <p>Nilai Pengetahuan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=datarapor&d=4" class="nav-link">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>Nilai Keterampilan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=rptekskul" class="nav-link">
                                <i class="far fa-check-square nav-icon"></i>
                                <p>Nilai Ekstrakurikuler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="index.php?p=rptabsen" class="nav-link">
                                <i class="fas fa-check nav-icon"></i>
                                <p>Ketidakhadiran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=nilaius" class="nav-link">
                        <i class="fas fa-user-graduate nav-icon"></i>
                        <p>Input Nilai US</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=nilaiijz" class="nav-link">
                        <i class="fas fa-chalkboard-teacher nav-icon"></i>
                        <p>Lihat Nilai Ijazah</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=nilaieksim" class="nav-link">
                        <i class="fas fa-sync-alt nav-icon"></i>
                        <p>Import Nilai</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>Cetak
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=cetakrapor" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Laporan Hasil Belajar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cetakledger" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Rekap Hasil Belajar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cetakmutasi" class="nav-link">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>Mutasi Peserta Didik</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cetakbinduk" class="nav-link">
                        <i class="far fa-list-alt nav-icon"></i>
                        <p>Buku Induk</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="index.php?p=help" class="nav-link">
                <i class="far fa-question-circle nav-icon"></i>
                <p>Bantuan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?p=about" class="nav-link">
                <i class="fas fa-info-circle nav-icon"></i>
                <p>Tentang</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</nav>
<?php elseif($level=='2'):?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p> Dashboard</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="index.php?p=datakelas" class="nav-link">
                <i class="far fa-check-square nav-icon"></i>
                <p>Kompetensi Dasar</p>
                <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Sikap Spiritual</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Sikap Sosial</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Pengetahuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Keterampilan</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="index.php?p=dataampu" class="nav-link">
                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                <p>Rencana Penilaian</p>
                <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Penilaian Pengetahuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Penilaian Keterampilan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Penilaian Sikap</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Bobot Penilaian</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="index.php?p=dataampu" class="nav-link">
                <i class="fas fa-chalkboard-teacher nav-icon"></i>
                <p>Input Data Penilaian</p>
                <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Penilaian Pengetahuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Penilaian Keterampilan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Penilaian Sikap</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=hasiltes" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Bobot Penilaian</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-print"></i>
                <p>
                    Laporan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=cetakrapor" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Hasil Belajar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cetakledger" class="nav-link">
                        <i class="fas fa-list-alt nav-icon"></i>
                        <p>Rekap Hasil Belajar</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="index.php?p=help" class="nav-link">
                <i class="far fa-question-circle nav-icon"></i>
                <p>
                    Bantuan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="index.php?p=about" class="nav-link">
                <i class="fas fa-info-circle nav-icon"></i>
                <p>Tentang</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</nav>
<?php else:?>
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="index.php?p=cekdata" class="nav-link">
                <i class="far fa-check-square nav-icon"></i>
                <p>Cek dan Lengkapi Data</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-check-circle nav-icon"></i>
                <p>Cek Nilai</p>
                <i class="fas fa-angle-left right"></i>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="index.php?p=cekrapor&d=1" class="nav-link">
                        <i class="fas fa-check-square nav-icon"></i>
                        <p>Nilai Sikap</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cekrapor&d=2" class="nav-link">
                        <i class="fas fa-check-square  nav-icon"></i>
                        <p>Nilai Pengetahuan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cekrapor&d=3" class="nav-link">
                        <i class="fas fa-check-square nav-icon"></i>
                        <p>Nilai Keterampilan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?p=cekus" class="nav-link">
                        <i class="far fa-check-square nav-icon"></i>
                        <p>Nilai Akhir</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="index.php?p=ceklulus" class="nav-link">
                <i class="fas fa-clock nav-icon"></i>
                <p>Cek Kelulusan</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="far fa-question-circle nav-icon"></i>
                <p>
                    Bantuan
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-info-circle nav-icon"></i>
                <p>Tentang</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="logout.php" class="nav-link">
                <i class="fas fa-power-off nav-icon"></i>
                <p>Keluar</p>
            </a>
        </li>
    </ul>
</nav>
<?php endif ?>