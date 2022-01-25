<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Jabatan</h4>
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
                                        <th>Id</th>
                                        <th>Jabatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_jabatan as $d) : ?>
                                    <tr>
                                        <td><?= $d['id_jabatan'] ?></td>
                                        <td><?= ucwords($d['nama_jabatan']) ?></td>
                                        <td>
                                            <!-- open edit modal -->
                                            <button
                                                onclick="edit('<?= $d['id_jabatan'] ?>','<?= $d['nama_jabatan'] ?>')"
                                                type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">Edit</button>

                                            <button onclick="del('<?= $d['id_jabatan'] ?>')"
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
                            <h4 class="modal-title" id="standard-modalLabel">Add Jabatan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?= csrf_field(); ?>
                                <label for="nama">Nama Jabatan</label>
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
                            <h4 class="modal-title" id="standard-modalLabel">Edit Jabatan</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?= csrf_field(); ?>
                                <label for="nama">jabatan</label>
                                <input type="text" class="form-control" id="nama_edit" name="nama" required>
                            </div>
                            <input type="hidden" id="id_jabatan_edit" name="id_jabatan">
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
                        url: "/api/delete/jabatan",
                        type: "POST",
                        data: {
                            id_jabatan: id,
                        },
                        success: function(data) {
                            // parse json data
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Jabatan Berhasil Dihapus");
                                location.reload();

                            } else {
                                alert("Jabatan Gagal Dihapus");
                            }
                        },
                    });
                }


            }

            function edit(id, nama) {
                $('#nama_edit').val(nama);
                $('#id_jabatan_edit').val(id);
            }
            $(document).ready(function() {
                $('#scroll-horizontal-datatable').DataTable();
                $('#save').click(function() {
                    if ($.trim($('#nama').val()) == '') {
                        alert('Nama Jabatan Harus Diisi');
                    } else {
                        $.ajax({
                            url: "/api/save/jabatan",
                            type: "POST",
                            data: {
                                nama_jabatan: $('#nama').val(),
                            },
                            success: function(data) {
                                // parse json data
                                var resp = JSON.parse(data);
                                if (resp.status == "1") {
                                    alert("Jabatan Berhasil Ditambahkan");
                                    location.reload();

                                } else {
                                    alert("Jabatan Gagal Ditambahkan");
                                }
                            },
                        });
                    }
                });
                $('#save_edit').click(function() {
                    $.ajax({
                        url: "/api/edit/jabatan",
                        type: "POST",
                        data: {
                            id_jabatan: $('#id_jabatan_edit').val(),
                            nama_jabatan: $('#nama_edit').val(),
                        },
                        success: function(data) {
                            // parse json data
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Jabatan Berhasil Diedit");
                                location.reload();

                            } else {
                                alert("Jabatan Gagal Diedit");
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