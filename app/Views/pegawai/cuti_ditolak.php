<?= $this->extend('template/pegawai_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Cuti Yang Ditolak</h4>
            </div>
            <!-- create card -->
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
                        <?php if (!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                            role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Success - </strong>
                            <?php echo session()->getFlashdata('success'); ?>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty(session()->getFlashdata('error'))) : ?>
                        <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                            role="alert">
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            <strong>Failed - </strong>
                            <?php echo session()->getFlashdata('error'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table id="scroll-horizontal-datatable" class="table table-hover mb-0 w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>NIK/NIP</th>
                                        <th>NAMA</th>
                                        <th>WILAYAH</th>
                                        <th>TANGGAL</th>
                                        <th>SAMPAI TANGGAL</th>
                                        <th>TIPE CUTI</th>
                                        <th>STATUS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_cuti as $d) : ?>
                                    <tr>
                                        <td><?= $d['nip'] ?></td>
                                        <td><?= strtoupper($d['nama']) ?></td>
                                        <td><?= strtoupper($d['lokasi_kerja']) ?></td>
                                        <td><?= $d['tanggal_awal'] ?></td>
                                        <td><?= $d['tanggal_akhir'] ?></td>
                                        <td><?= strtoupper($d['tipe_cuti']) ?></td>
                                        <td><span class="text-danger">DITOLAK</span></td>
                                    </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <!-- load datatable -->
            <script>
            $(document).ready(function() {
                $('#scroll-horizontal-datatable').DataTable();

            });
            </script>


        </div>
    </div>
</div>
<?= $this->endSection() ?>