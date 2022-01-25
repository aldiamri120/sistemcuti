<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Data Admin</h4>
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
                                        <th>NAMA</th>
                                        <th>ID PJLP</th>
                                        <th>NIK</th>
                                        <th>JABATAN</th>
                                        <th>LOKASI KERJA</th>
                                        <th>LEVEL</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data_pegawai as $d) : ?>
                                    <tr>

                                        <td><?= strtoupper($d['nama']) ?></td>
                                        <td><?= strtoupper($d['id_pjlp']) ?></td>
                                        <td><?= $d['nip'] ?></td>
                                        <td><?= strtoupper($d['nama_jabatan']) ?></td>
                                        <td><?= strtoupper($d['lokasi_kerja']) ?></td>
                                        <td><?= strtoupper($d['role']) ?></td>
                                        <td>
                                            <!-- open edit modal -->
                                            <button
                                                onclick="edit('<?= $d['id_user'] ?>','<?= $d['id_pjlp'] ?>','<?= $d['nama'] ?>','<?= $d['nip'] ?>','<?= $d['id_jabatan'] ?>','<?= $d['lokasi_kerja'] ?>','<?= $d['role'] ?>')"
                                                type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#standard-modal">Edit</button>
                                            <button onclick="del('<?= $d['id_user'] ?>')"
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
                            <h4 class="modal-title" id="standard-modalLabel">Admin</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?= csrf_field(); ?>
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">ID PJLP</label>
                                <input type="text" class="form-control" id="id_pjlp" name="id_pjlp" required>
                            </div>
                            <div class="form-group">
                                <label for="email">NIK</label>
                                <input type="email" class="form-control" id="nip" name="nip" required>
                            </div>
                            <div class="form-group">
                                <label for="telp">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="divisi">Jabatan</label>
                                <select class="form-select" id="jabatan" name="jabatan" required>
                                    <!-- ambil data divisi -->
                                    <option value="">Pilih Jabatan...</option>
                                    <?php foreach ($data_jabatan as $d) : ?>
                                    <option value="<?= $d['id_jabatan'] ?>"><?= strtoupper($d['nama_jabatan']) ?>
                                    </option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select id="level" class="form-select" name="level" required>
                                    <option value="admin">Admin</option>
                                    <option value="master admin">Master Admin</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Lokasi Kerja</label>
                                <select id="lokasi_kerja" class="form-select" name="lokasi_kerja" required>
                                    <!-- ambil data divisi -->
                                    <option value="">Pilih Lokasi...</option>
                                    <option value="semua lokasi">Semua Lokasi</option>
                                    <?php foreach ($data_lokasi as $d) : ?>
                                    <option value="<?= $d['lokasi'] ?>"><?= $d['lokasi'] ?></option>
                                    <?php endforeach; ?>

                                </select>
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
                            <h4 class="modal-title" id="standard-modalLabel">Admin</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <?= csrf_field(); ?>
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama_edit" name="nama">
                            </div>
                            <div class="form-group">
                                <label for="nama">ID PJLP</label>
                                <input type="text" class="form-control" id="id_pjlp_edit" name="id_pjlp">
                            </div>
                            <div class="form-group">
                                <label for="email">NIK</label>
                                <input type="email" class="form-control" id="nip_edit" name="nip">
                            </div>
                            <div class="form-group">
                                <label for="telp">Password</label>
                                <input type="password" class="form-control" id="password_edit" name="password">
                            </div>
                            <div class="form-group">
                                <label for="divisi">Jabatan</label>
                                <select class="form-select" id="jabatan_edit" name="jabatan">
                                    <!-- ambil data divisi -->
                                    <option value="">Pilih Jabatan...</option>
                                    <?php foreach ($data_jabatan as $d) : ?>
                                    <option value="<?= $d['id_jabatan'] ?>"><?= strtoupper($d['nama_jabatan']) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="level">Level</label>
                                <select id="role_edit" class="form-select" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="master admin">Master Admin</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Lokasi Kerja</label>
                                <select id="lokasi_kerja_edit" class="form-select" name="lokasi_kerja" required>
                                    <!-- ambil data divisi -->
                                    <option value="">Pilih Lokasi...</option>
                                    <option value="semua lokasi">Semua Lokasi</option>
                                    <?php foreach ($data_lokasi as $d) : ?>
                                    <option value="<?= $d['lokasi'] ?>"><?= $d['lokasi'] ?></option>
                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <input type="hidden" id="id_user_edit" name="id_user">
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
            function edit(id_user, id_pjlp, nama, nip, id_jabatan, lokasi_kerja, role) {
                $('#standard-modal').modal('show');
                $('#nama_edit').val(nama);
                $('#id_pjlp_edit').val(id_pjlp);
                $('#nip_edit').val(nip);
                $('#jabatan_edit').val(id_jabatan);
                $('#lokasi_kerja_edit').val(lokasi_kerja);
                $('#role_edit').val(role);
                $('#id_user_edit').val(id_user);
                $('#password_edit').val();


            }


            function del(id) {
                // confirm 
                var conf = confirm("Are you sure you want to delete ?");
                if (conf) {
                    // ajax delete data to database
                    $.ajax({
                        url: "/api/delete/pegawai",
                        type: "POST",
                        data: {
                            id_user: id,
                        },
                        success: function(data) {
                            // parse json
                            var resp = $.parseJSON(data);
                            if (resp.status == "1") {
                                alert("Data Berhasil Dihapus")
                                location.reload();
                            } else {
                                alert("Data Gagal Dihapus")
                            }
                        },
                    });
                }


            }

            $(document).ready(function() {
                $('#scroll-horizontal-datatable').DataTable();
                $('#save').click(function() {
                    // ajax
                    $.ajax({
                        url: "/api/save/pegawai",
                        type: "POST",
                        data: {
                            nama: $('#nama').val(),
                            nip: $('#nip').val(),
                            id_pjlp: $('#id_pjlp').val(),
                            password: $('#password').val(),
                            jabatan: $('#jabatan').val(),
                            lokasi_kerja: $('#lokasi_kerja').val(),
                            level: $('#level').val(),
                        },
                        success: function(data) {
                            // parse json
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Data Berhasil Ditambahkan");
                                location.reload();

                            } else {
                                alert("Data Gagal Ditambahkan");
                            }
                        },
                    });
                })
                $('#save_edit').click(function() {
                    var nama_m = $('#nama_edit').val();
                    var nip_m = $('#nip_edit').val();
                    var id_pjlp_m = $('#id_pjlp_edit').val();
                    var lokasi_kerja_m = $('#lokasi_kerja_edit').val();
                    var id_jabatan_m = $('#jabatan_edit').val();
                    var role_m = $('#role_edit').val();
                    var id_user_m = $('#id_user_edit').val();
                    var password_m = $('#password_edit').val();
                    // ajax
                    $.ajax({
                        url: "/api/edit/pegawai",
                        type: "POST",
                        data: {
                            id_user: id_user_m,
                            id_pjlp: id_pjlp_m,
                            lokasi_kerja: lokasi_kerja_m,
                            nama: nama_m,
                            nip: nip_m,
                            password: password_m,
                            role: role_m,
                            id_jabatan: id_jabatan_m,

                        },
                        success: function(data) {
                            // parse json
                            var resp = JSON.parse(data);
                            if (resp.status == "1") {
                                alert("Data Berhasil Diedit");
                                location.reload();

                            } else {
                                alert("Data Gagal Diedit");
                            }
                        }
                    });
                })

            });
            </script>


        </div>
    </div>
    <!-- end page title -->

</div>
<?= $this->endSection() ?>