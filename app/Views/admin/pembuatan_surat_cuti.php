<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Buat Surat Cuti</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="/api/buat-surat-cuti" class="needs-validation" novalidate method="post">
                    <div class="form-group">
                        <label for="" class="form-label">Nama Pegawai</label>
                        <input type="text" class="form-control" name="nama_pegawai"
                            value="<?= strtoupper($data['nama']) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">NIP</label>
                        <input type="text" class="form-control" name="nip" value="<?= strtoupper($data['nip']) ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" name="jabatan"
                            value="<?= strtoupper($data['nama_jabatan']) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Jenis Cuti</label>
                        <input type="text" class="form-control" name="jenis_cuti"
                            value="<?= strtoupper($data['tipe_cuti']) ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Alasan Cuti</label>
                        <textarea class="form-control" name="alasan_cuti" rows="3"
                            readonly><?= $data['alasan_cuti'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Lama Cuti</label>
                        <input type="text" class="form-control" name="lama_cuti"
                            value="<?= "[ Dari " . $data['tanggal_awal'] . " ] [ Sampai " . $data['tanggal_akhir'] . " ]" ?>"
                            readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Sisa Cuti Tahunan</label>
                        <input type="text" class="form-control" name="sisa_cuti"
                            value="<?= $data['jatah_cuti_tahunan'] ?> Hari" readonly>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Status Approval</label>
                        <div>
                            <div id="jstree-2">
                                <ul>
                                    <?php if ($data['nama_jabatan'] != "pengawas") : ?>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        PENGAWAS
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['verifikator_1'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        KASATLAK
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['verifikator_2'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        PPTK PJLP
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['verifikator_3'] ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        KASUBBAG TU
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['approval_1'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        KA PUSYANKESWANNAK
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['approval_2'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Kepala Sub Bagian Tata Usaha</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="nama_tu" placeholder="Nama" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nip_tu" placeholder="Nip" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="" class="form-label">Kepala Pusat Pelayanan</label>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" name="nama_kepala" placeholder="Nama" required>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="nip_kepala" placeholder="Nip" required>
                            </div>
                        </div>

                    </div>
                    <div class="form-group mt-2">
                        <input type="submit" value="Terbitkan Surat Cuti" class="btn btn-primary">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>