<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">My Account</h4>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- alert -->
                <?php if (!empty(session()->getFlashdata('error'))) : ?>
                <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Failed - </strong> <?php echo session()->getFlashdata('error'); ?>
                </div>
                <?php endif; ?>
                <?php if (!empty(session()->getFlashdata('success'))) : ?>
                <div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show"
                    role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    <strong>Success - </strong> <?php echo session()->getFlashdata('success'); ?>
                </div>
                <?php endif; ?>
                <!-- end alert -->
                <div class="container text-center">
                    <img src="<?= $data_user['foto'] ?>" alt="image" class="img-fluid avatar-xl rounded-circle">
                </div>
                <form action="/api/edit/akun" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?= csrf_field(); ?>
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama_edit" name="nama"
                                value="<?= ucwords($data_user['nama']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="nama">ID PJLP</label>
                            <input type="text" class="form-control" id="id_pjlp_edit" name="id_pjlp"
                                value="<?= $data_user['id_pjlp'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="email">NIK</label>
                            <input type="text" class="form-control" id="nip_edit" name="nip"
                                value="<?= $data_user['nip'] ?>">
                        </div>
                        <div class="form-group">
                            <label for="telp">Password</label>
                            <input type="password" class="form-control" id="password_edit" name="password">
                        </div>
                        <div class="form-group">
                            <label for="jabatan">Jabatan</label>
                            <select class="form-select" id="jabatan_edit" name="jabatan">
                                <!-- ambil data divisi -->
                                <option value="">Pilih Jabatan...</option>
                                <?php foreach ($data_jabatan as $d) : ?>
                                <option value="<?= $d['id_jabatan'] ?>"><?= ucwords($d['nama_jabatan']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <?php if (session()->role != "master admin") : ?>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select id="role_edit" class="form-select" name="role">
                                <!-- ambil data divisi -->
                                <option value="<?= $role ?>"><?= ucwords($role) ?></option>

                            </select>
                        </div>
                        <?php else : ?>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select id="role_edit" class="form-select" name="role">
                                <!-- ambil data divisi -->
                                <option value="">Pilih Level...</option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="master admin">Master Admin</option>

                            </select>
                        </div>
                        <?php endif; ?>

                        <div class="form-group">
                            <label for="nama">Lokasi Kerja</label>
                            <select id="lokasi_kerja_edit" class="form-select" name="lokasi_kerja">
                                <!-- ambil data divisi -->
                                <option value="">Pilih Lokasi...</option>
                                <option value="semua lokasi">Semua Lokasi</option>
                                <?php foreach ($data_lokasi as $d) : ?>
                                <option value="<?= $d['lokasi'] ?>"><?= $d['lokasi'] ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama">Foto</label>
                            <input type="file" class="form-control" id="foto_edit" name="foto">
                        </div>
                        <input type="hidden" id="id_user_edit" name="id_user" value="<?= $data_user['id_user'] ?>">
                    </div>
                    <div class="modal-footer">
                        <input type="submit" id="save" class="btn btn-primary" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#role_edit').val('<?= $data_user['role'] ?>');
        $('#jabatan_edit').val('<?= $data_user['id_jabatan'] ?>');
        $('#lokasi_kerja_edit').val('<?= $data_user['lokasi_kerja'] ?>');
    });
    </script>

</div>
<?= $this->endSection() ?>