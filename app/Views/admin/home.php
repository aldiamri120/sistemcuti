<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <!-- create card -->
            <?php if (session()->get('role') == 'master admin') : ?>
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-account-heart widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Jumlah Pegawai</h5>
                                <h3 class="mt-3 mb-3"><?= $total_pegawai ?></h3>
                            </div> <!-- end card-body-->
                        </div>
                    </div>
                    <div class="col">

                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="float-end">
                                    <i class="mdi mdi-archive widget-icon"></i>
                                </div>
                                <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Jabatan</h5>
                                <h3 class="mt-3 mb-3"><?= $total_jabatan ?></h3>
                            </div> <!-- end card-body-->
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <div class="container">
                <div class="row">
                    <div class="col">

                        <div class="card widget-flat">
                            <div class="card-body">
                                <div class="table-responsive ">
                                    <h3>Report Data Cuti</h3>
                                    <table id="scroll-horizontal-datatable"
                                        class="table table-striped table-hover mb-0 w-100 nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-center">NAMA</th>
                                                <th class="text-center">NIK</th>
                                                <th class="text-center">JABATAN</th>
                                                <th class="text-center">LOKASI KERJA</th>
                                                <th class="text-center">TANGGAL CUTI</th>
                                                <th class="text-center">SISA CUTI</th>
                                                <th class="text-center">STATUS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($data_cuti as $d) : ?>
                                            <tr>
                                                <td class="text-center"><?= strtoupper($d['nama']) ?></td>
                                                <td class="text-center"><?= strtoupper($d['nip'])  ?></td>
                                                <td class="text-center"><?= strtoupper($d['nama_jabatan'])  ?></td>
                                                <td class="text-center"><?= strtoupper($d['lokasi_kerja'])  ?></td>
                                                <td class="text-center">
                                                    <?= date("d/m/Y", strtotime($d['tanggal_awal'])) . " - " . date("d/m/Y", strtotime($d['tanggal_akhir']))  ?>
                                                </td>
                                                <td class="text-center"><?= $d['tahun'] ?> :
                                                    <?= $d['jatah_cuti_tahunan'] ?> Hari</td>
                                                <?php if (str_contains($d['approval_2'], "Disetujui")) : ?>
                                                <td class="text-center text-success">Disetujui</td>
                                                <?php else : ?>
                                                <td class="text-center text-danger">Ditolak</td>
                                                <?php endif; ?>
                                            </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <!-- end page title -->
        <script>
        $(document).ready(function() {
            $('#scroll-horizontal-datatable').DataTable({

                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf', 'print'
                ]
            });
        });
        </script>
    </div>
    <?= $this->endSection() ?>