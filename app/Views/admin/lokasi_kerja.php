<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Lokasi Kerja</h4>
            </div>

            <!-- create card -->
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
                        <!-- add new button -->
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="text-right">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#standard-add-modal">
                                        <i class="mdi mdi-plus-circle-outline"></i>
                                        Add New
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="scroll-horizontal-datatable" class="table table-hover mb-0 w-100 nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">Lokasi Kerja</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($lokasi_kerja as $d) : ?>
                                    <tr>
                                        <td class="text-center"><?= ucwords($d['lokasi']) ?></td>
                                        <td class="text-center">
                                            <!-- open edit modal -->
                                            <button onclick="edit('<?= $d['id_lokasi'] ?>','<?= $d['lokasi'] ?>')"
                                                type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">Edit</button>

                                            <button onclick="del('<?= $d['id_lokasi'] ?>')"
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
            <!-- modal for add -->
            <div id="standard-add-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Add lokasi kerja</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?= csrf_field(); ?>
                                <label for="nama">Nama lokasi</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <input type="button" id="save" class="btn btn-primary" value="Save Changes">
                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal for add -->
            <!-- modal for edit -->
            <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog"
                aria-labelledby="standard-modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="standard-modalLabel">Edit lokasi kerja</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?= csrf_field(); ?>
                                <label for="nama">lokasi</label>
                                <input type="text" class="form-control" id="lokasi_edit" name="lokasu" required>
                            </div>
                            <input type="hidden" id="id_lokasi_edit" name="id_lokasi">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <input type="button" id="save_edit" class="btn btn-primary" value="Save Changes">
                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal for edit -->

            <!-- load datatable -->
            <script>
            function del(id) {
                // confirm 
                var conf = confirm("Are you sure you want to delete ?");
                if (conf) {
                    // ajax delete data to database
                    $.ajax({
                        url: "/api/delete/lokasi-kerja",
                        type: "POST",
                        data: {
                            id_lokasi: id,
                        },
                        success: function(data) {
                            // parse json data
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Lokasi Berhasil Dihapus");
                                location.reload();

                            } else {
                                alert("Lokasi Gagal Dihapus");
                            }
                        },
                    });
                }


            }

            function edit(id, nama) {
                $('#lokasi_edit').val(nama);
                $('#id_lokasi_edit').val(id);
            }
            $(document).ready(function() {
                $('#scroll-horizontal-datatable').DataTable({
                    "order": [
                        [1, "asc"]
                    ]
                });
                $('#save').click(function() {
                    $.ajax({
                        url: "/api/save/lokasi-kerja",
                        type: "POST",
                        data: {
                            lokasi: $('#nama').val(),
                        },
                        success: function(data) {
                            // parse json data
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Lokasi Berhasil Ditambahkan");
                                location.reload();

                            } else {
                                alert("Lokasi Gagal Ditambahkan");
                            }
                        },
                    });
                });
                $('#save_edit').click(function() {
                    $.ajax({
                        url: "/api/edit/lokasi-kerja",
                        type: "POST",
                        data: {
                            id_lokasi: $('#id_lokasi_edit').val(),
                            lokasi: $('#lokasi_edit').val(),
                        },
                        success: function(data) {
                            // parse json data
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Lokasi Berhasil Diedit");
                                location.reload();

                            } else {
                                alert("Lokasi Gagal Diedit");
                            }
                        },
                    });
                });
            })
            </script>


        </div>
    </div>
    <!-- end page title -->

</div>
<?= $this->endSection() ?>