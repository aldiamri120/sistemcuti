<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Permintaan Cuti Anda</h4>
            </div>
            <?php if (!empty(session()->getFlashdata('success'))) : ?>
            <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
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
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive mt-2">
                            <table id="scroll-horizontal-datatable" class="table table-hover mb-0 w-100 nowrap">
                                <thead>
                                    <tr>


                                        <th colspan="4" class="border text-center">DETAIL</th>
                                        <th colspan="5" class="border text-center">STATUS APPROVAL</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center border">TANGGAL</th>
                                        <th class="text-center border">SAMPAI TANGGAL</th>
                                        <th class="text-center border">TIPE CUTI</th>
                                        <th class="text-center border">KETERANGAN</th>
                                        <?php if (session()->nama_jabatan != "pengawas") : ?>
                                        <th class="text-center border">PENGAWAS</th>
                                        <?php endif; ?>
                                        <th class="text-center border">KASATLAK</th>
                                        <th class="text-center border">PPTK PJLP</th>
                                        <th class="text-center border">KASUBBAG TU</th>
                                        <th class="text-center border">KA PUSYAMKESWANNAK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_cuti as $d) : ?>
                                    <tr>
                                        <td class="text-center border"><?= $d['tanggal_awal'] ?></td>
                                        <td class="text-center border"><?= $d['tanggal_akhir'] ?></td>
                                        <td class="text-center border"><?= strtoupper($d['tipe_cuti']) ?></td>
                                        <td class="text-center border"><?= strtoupper($d['alasan_cuti']) ?></td>
                                        <?php if (session()->nama_jabatan != "pengawas") : ?>
                                        <td class="text-center border"><?= $d['verifikator_1'] ?></td>
                                        <?php endif; ?>
                                        <td class="text-center border"><?= $d['verifikator_2'] ?></td>
                                        <td class="text-center border"><?= $d['verifikator_3'] ?></td>
                                        <td class="text-center border"><?= $d['approval_1'] ?></td>
                                        <td class="text-center border"><?= $d['approval_2'] ?></td>

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
                location.href = "/home/lihat-cuti-anda/" + id;
            }

            function tolak(id) {
                $.ajax({
                    url: "/api/save/update-cuti",
                    type: "POST",
                    data: {
                        id: id,
                        status: 'Ditolak',
                    },
                    success: function(data) {
                        location.reload();
                    },
                });
            }

            function del(id) {
                // confirm
                var conf = confirm("Are you sure you want to delete ?");
                if (conf) {
                    // ajax delete data to database
                    $.ajax({
                        url: "/api/delete/cuti",
                        type: "POST",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data == "1") {

                                $('#text_success').text('Data berhasil dihapus');
                                $('#success-alert-modal').modal('show');
                                // if modal hide then reload the page
                                $('#success-alert-modal').on('hidden.bs.modal', function(e) {
                                    location.reload();
                                });

                            } else {

                                $('#text_success').text('Gagal hapus data');
                                $('#danger-alert-modal').modal('show');
                            }
                        },
                    });
                }


            }


            $(document).ready(function() {
                $('#scroll-horizontal-datatable').DataTable();

            });
            </script>


        </div>
    </div>
</div>
<?= $this->endSection() ?>