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
                <form action="/api/save/account" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <?= csrf_field(); ?>
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="<?= $data_user['nama'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $data_user['email'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="form-group">
                            <label for="telp">Telpon</label>
                            <input type="text" class="form-control" id="telp" name="telp"
                                value="<?= $data_user['telp'] ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="form-group mt-2 mb-2">
                            <img id="foto-gambar" src="/<?= $data_user['foto'] ?>" alt="image"
                                class="img-fluid avatar-md rounded-circle">
                        </div>
                        <div class="form-group">
                            <label for="divisi">Divisi</label>
                            <select class="form-select" id="divisi" name="divisi" required>
                                <!-- ambil data divisi -->
                                <option value="">Pilih Divisi...</option>
                                <?php foreach ($data_divisi as $d) : ?>
                                <option value="<?= $d['nama_divisi'] ?>"><?= $d['nama_divisi'] ?></option>
                                <?php endforeach; ?>

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <select id="level" class="form-select" name="level" required>
                                <!-- ambil data divisi -->
                                <option value="">Pilih Level...</option>
                                <option value="Pegawai">Pegawai</option>
                                <option value="Admin">Admin</option>

                            </select>
                        </div>
                        <input type="hidden" id="id_user" name="id_user" value="<?= $data_user['id_user'] ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <input type="submit" id="save" class="btn btn-primary" value="Save Changes">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#divisi').val('<?= $data_user['divisi'] ?>');
        $('#level').val('<?= $data_user['level'] ?>');
    })
    </script>
</div>
<?= $this->endSection() ?>