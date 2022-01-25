<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Cuti Yang Disetujui</h4>
            </div>
            <!-- create card -->
            <div class="container">
                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                    role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success - </strong>
                    <?php echo session()->getFlashdata('success'); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Failed - </strong>
                    <?php echo session()->getFlashdata('error'); ?>
                </div>
                <?php endif; ?>
                <!-- create table -->
                <div class="card">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="scroll-horizontal-datatable" class="table table-hover mb-0 w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">NIK/NIP</th>
                                        <th class="text-center">NAMA</th>
                                        <th class="text-center">WILAYAH</th>
                                        <th class="text-center">TANGGAL</th>
                                        <th class="text-center">SAMPAI TANGGAL</th>
                                        <th class="text-center">TIPE CUTI</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">SURAT CUTI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_cuti as $d) : ?>
                                    <tr>
                                        <td class="align-middle text-center"><?= $d['nip'] ?></td>
                                        <td class="align-middle text-center"><?= strtoupper($d['nama']) ?></td>
                                        <td class="align-middle text-center"><?= strtoupper($d['lokasi_kerja']) ?></td>
                                        <td class="align-middle text-center"><?= $d['tanggal_awal'] ?></td>
                                        <td class="align-middle text-center"><?= $d['tanggal_akhir'] ?></td>
                                        <td class="align-middle text-center"><?= strtoupper($d['tipe_cuti']) ?></td>
                                        <td class="align-middle text-center"><span class="text-success">DISETUJUI</span>
                                        </td>
                                        <td class="align middle text-center">
                                            <a style="cursor:pointer" onclick="lihat('<?= $d['surat_cuti'] ?>')">
                                                <i class="mdi mdi-file-pdf-outline mdi-36px text-danger"></i>
                                            </a>

                                        </td>
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
            function lihat(id) {
                location.href = id;
            }




            $(document).ready(function() {
                $('#scroll-horizontal-datatable').DataTable();

            });
            </script>


        </div>
    </div>
</div>
<?= $this->endSection() ?>