<?php if (session()->role == "user") : ?>
<?= $this->extend('template/pegawai_template') ?>
<?php else : ?>
<?= $this->extend('template/admin_template') ?>
<?php endif; ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dokumentasi</h4>
            </div>
            <!-- create card -->
            <div class="container">
                <!-- create table -->

                <?php if (session()->role == "user") : ?>
                <div class="card">
                    <div class="card-body">
                        <div class="accordion custom-accordion" id="custom-accordion-one">
                            <div class="card mb-0">
                                <div class="card-header" id="headingFour">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            I. Bagaimana cara mengajukan cuti ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Buka menu "Ajukan Cuti"
                                            </li>
                                            <li>
                                                Isi semua form dengan benar lalu klik tombol "Kirim Permintaan Cuti"
                                            </li>
                                            <li>
                                                Pengajuan cuti anda akan terlihat pada halaman "Data Cuti"
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingEight">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseEight" aria-expanded="false"
                                            aria-controls="collapseEight">
                                            II. Bagaimana cara melihat data cuti yang telah diajukan ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Anda dapat mengakses halaman "Data Cuti"
                                            </li>
                                            <li>
                                                Pada halaman tersebut, anda dapat melihat daftar pengajuan cuti anda,
                                                dan memonitor status approval cuti anda
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingFive">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                            III. Apa maksud halaman "Cuti Disetujui" ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Halaman ini berisi data pengajuan cuti anda yang telah disetujui
                                            </li>
                                            <li>
                                                Anda dapat mendownload surat cuti anda pada halaman ini
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingSix">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseSix" aria-expanded="false"
                                            aria-controls="collapseSix">
                                            IV. Apa maksud halaman "Cuti Ditolak" ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Halaman ini berisi data pengajuan cuti anda yang telah ditolak
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php else : ?>
                <div class="card">
                    <div class="card-body">
                        <div class="accordion custom-accordion" id="custom-accordion-one">
                            <div class="card mb-0">
                                <div class="card-header" id="headingFour">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseFour" aria-expanded="false"
                                            aria-controls="collapseFour">
                                            I. Halaman "Home" <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Jika anda sebagai master admin atau jabatan anda sebagai KA
                                                PUSYANKESWANNAK anda dapat melihat dan meng-export laporan pegawai
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingFive">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseFive" aria-expanded="false"
                                            aria-controls="collapseFive">
                                            II. Bagaimana cara melihat pengajuan cuti pegawai ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Akses halaman "Data Cuti Pegawai" untuk melihat siapa saja yang
                                                mengajukan cuti sesuai dengan wilayah kerja anda
                                            </li>
                                            <li>
                                                Klik tombol "Lihat" untuk mengetahui secara detail , siapa yang
                                                mengajukan cuti
                                            </li>
                                            <li>
                                                Jika anda sebagai approval, maka pada saat anda meng-klik tombol "Lihat"
                                                anda dapat memberikan pernyataan "Dilihat,Approve,Reject" sesuai dengan
                                                jabatan anda
                                            </li>
                                            <li>
                                                Jika anda sebagai approval akhir, setelah anda memilih aksi "Approve"
                                                maka surat cuti akan otomatis dibuat
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingSix">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseSix" aria-expanded="false"
                                            aria-controls="collapseSix">
                                            III. Bagaimana cara melihat cuti yang disetujui ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseSix" class="collapse" aria-labelledby="headingSix"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Anda dapat mengakses halaman "Cuti Disetujui"
                                            </li>
                                            <li>
                                                Jika anda sebagai admin namun jabatan anda bukan pengawas, maka halaman
                                                tersebut akan menampilkan seluruh data cuti pegawai yang disetujui
                                            </li>
                                            <li>
                                                Jika anda seorang pengawas maka halaman tersebut hanya berisikan data
                                                cuti anda yang telah disetujui
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingSeven">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseSeven" aria-expanded="false"
                                            aria-controls="collapseSeven">
                                            IV. Bagaimana cara melihat cuti yang ditolak ? <i
                                                class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Anda dapat mengakses halaman "Cuti Ditolak"
                                            </li>
                                            <li>
                                                Jika anda sebagai admin namun jabatan anda bukan pengawas, maka halaman
                                                tersebut akan menampilkan seluruh data cuti pegawai yang ditolak
                                            </li>
                                            <li>
                                                Jika anda seorang pengawas maka halaman tersebut hanya berisikan data
                                                cuti anda yang telah ditolak
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-0">
                                <div class="card-header" id="headingEight">
                                    <h5 class="m-0">
                                        <a class="custom-accordion-title collapsed d-block py-1"
                                            data-bs-toggle="collapse" href="#collapseEight" aria-expanded="false"
                                            aria-controls="collapseEight">
                                            V. Anda sebagai pengawas ? Bagaimana cara melihat data cuti yang telah
                                            diajukan ? <i class="mdi mdi-chevron-down accordion-arrow"></i>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                                    data-bs-parent="#custom-accordion-one">
                                    <div class="card-body">
                                        <ul>
                                            <li>
                                                Anda dapat mengakses halaman "Data Cuti Anda"
                                            </li>
                                            <li>
                                                Pada halaman tersebut, anda dapat melihat daftar pengajuan cuti anda,
                                                dan memonitor status approval cuti anda
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>