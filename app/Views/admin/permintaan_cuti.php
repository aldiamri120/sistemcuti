<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Permintaan Cuti Pegawai</h4>
            </div>
            <!-- create card -->
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
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
                                        <th>DETAIL</th>
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
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-success btn-sm"
                                                        onclick="lihat(<?= $d['id_cuti'] ?>)">LIHAT</button>
                                                </div>
                                            </div>
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
                location.href = "/home/lihat-cuti/" + id;
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