<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Cuti</h4>
            </div>

            <!-- modal sukses -->
            <div id="success-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-success">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-checkmark h1"></i>
                                <h4 class="mt-2">Well Done!</h4>
                                <p class="mt-3" id="text_success"></p>
                                <button type="button" class="btn btn-light my-2"
                                    data-bs-dismiss="modal">Continue</button>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- modal gagal -->
            <div id="danger-alert-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content modal-filled bg-danger">
                        <div class="modal-body p-4">
                            <div class="text-center">
                                <i class="dripicons-wrong h1"></i>
                                <h4 class="mt-2">Oh snap!</h4>
                                <p class="mt-3" id="text_failed"></p>
                                <button type="button" class="btn btn-light my-2"
                                    data-bs-dismiss="modal">Continue</button>
                            </div>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
            <!-- create card -->
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
                        <h3>Permintaan Cuti</h3>

                        <!-- add new button -->
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="row mb-2">
                                    <div class="col">
                                        <div class="text-right">
                                            <input class="form-control" id="id" type="hidden" name="id">
                                            <label for="example-date" class="form-label">Start Date</label>
                                            <input class="form-control" id="date_start" type="date" name="date_start">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="text-right">
                                            <label for="example-date" class="form-label">End Date</label>
                                            <input class="form-control" id="date_end" type="date" name="date_start">
                                        </div>
                                    </div>
                                </div>
                                <textarea class="form-control mb-2" id="keterangan" rows="3"
                                    placeholder="Keterangan"></textarea>
                                <button type="button" id="minta_cuti" class="btn btn-primary">Kirim Permintaan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="scroll-horizontal-datatable" class="table table-hover mb-0 w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Sampai Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Status</th>
                                        <th>Setujui ?</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_cuti as $d) : ?>
                                    <tr>
                                        <td><?= $d['nama'] ?></td>
                                        <td><?= $d['start_tanggal_cuti'] ?></td>
                                        <td><?= $d['end_tanggal_cuti'] ?></td>
                                        <td><?= $d['keterangan'] ?></td>
                                        <td>
                                            <?php if ($d['status'] == "Menunggu Persetujuan") : ?>
                                            <div class="text-primary"><?= $d['status'] ?></div>
                                            <?php elseif ($d['status'] == "Ditolak") : ?>
                                            <div class="text-danger"><?= $d['status'] ?></div>
                                            <?php elseif ($d['status'] == "Disetujui") : ?>
                                            <div class="text-success"><?= $d['status'] ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col">
                                                    <button class="btn btn-success btn-sm"
                                                        onclick=" setuju('<?= $d['id_cuti'] ?>')">Setuju</button>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick=" tolak('<?= $d['id_cuti'] ?>')">Tolak</button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- open edit modal -->
                                            <button onclick=" del('<?= $d['id_cuti'] ?>')"
                                                class="btn btn-danger btn-sm">Hapus</button>
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
            function setuju(id) {
                $.ajax({
                    url: "/api/save/update-cuti",
                    type: "POST",
                    data: {
                        id: id,
                        status: 'Disetujui',
                    },
                    success: function(data) {
                        location.reload();
                    },
                });
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

                $('#minta_cuti').click(function() {
                    var id = $('#id').val();
                    var date_start = $('#date_start').val();
                    var date_end = $('#date_end').val();
                    var keterangan = $('#keterangan').val();
                    $.ajax({
                        url: "/api/save/cuti",
                        type: "POST",
                        data: {
                            id: id,
                            date_start: date_start,
                            date_end: date_end,
                            keterangan: keterangan,
                        },
                        success: function(data) {
                            if (data == "1") {
                                $('#text_success').text('Permintaan cuti berhasil dikirim');
                                $('#success-alert-modal').modal('show');
                                // if modal hide then reload the page
                                $('#success-alert-modal').on('hidden.bs.modal', function(
                                    e) {
                                    location.reload();
                                });

                            } else {
                                $('#text_failed').text('Permintaan cuti gagal dikirim');
                                $('#danger-alert-modal').modal('show');
                            }
                        },
                    });
                });

            });
            </script>


        </div>
    </div>
    <!-- end page title -->
    <!-- <script>
    $(document).ready(function() {
        document.onkeydown = function(e) {
            if (event.keyCode == 123) {
                alert('Access Denied');
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
                alert('Access Denied');
                return false;
            }
            if (e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
                alert('Access Denied');
                return false;
            }
            if (e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
                alert('Access Denied');
                return false;
            }
        }
    });
    </script> -->
</div>
<?= $this->endSection() ?>