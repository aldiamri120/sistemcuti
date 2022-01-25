<?= $this->extend('template/admin_template') ?>
<?= $this->section('content') ?>
<div class="content">
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Detail Approval Cuti</h4>
            </div>


            <!-- create card -->
            <div class="container">
                <!-- create table -->
                <div class="card">
                    <div class="card-body">
                        <div class="container text-center">
                            <img src="<?= $data['foto'] ?>" alt="image" class="img-fluid avatar-xl rounded-circle">
                        </div>
                        <label for="" class="form-label">NIK</label>
                        <input type="text" class="form-control" id="nip" value="<?= $data['nip'] ?>" disabled>
                        <label for="" class="form-label">ID PJLP</label>
                        <input type="text" class="form-control" id="id_pjlp" value="<?= $data['id_pjlp'] ?>" disabled>
                        <label for="" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" value="<?= strtoupper($data['nama']) ?>"
                            disabled>
                        <label for="" class="form-label">Jabatan</label>
                        <input type="text" class="form-control" id="jabatan"
                            value="<?= strtoupper($data['nama_jabatan']) ?>" disabled>
                        <label for="" class="form-label">Lokasi Kerja</label>
                        <input type="text" class="form-control" id="lokasi_kerja"
                            value="<?= strtoupper($data['lokasi_kerja']) ?>" disabled>
                        <label for="" class="form-label">Tanggal Cuti</label>
                        <input type="date" class="form-control" id="tanggal_awal" value="<?= $data['tanggal_awal'] ?>"
                            disabled>
                        <label for="" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_akhir" value="<?= $data['tanggal_akhir'] ?>"
                            disabled>
                        <label for="" class="form-label">Tipe Cuti</label>
                        <input type="text" class="form-control" id="tipe_cuti"
                            value="<?= strtoupper($data['tipe_cuti']) ?>" disabled>
                        <label for="" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan"
                            disabled><?= strtoupper($data['alasan_cuti']) ?></textarea>
                        <label for="" class="form-label">Dokumen</label>
                        <div class="form-group">
                            <?php if ($data['dokumen'] != "") : ?>
                            <a href="<?= $data['dokumen'] ?>" target="_blank">
                                <button class="btn btn-primary">Lihat Dokumen</button></a>
                            <?php else : ?>
                            <button class="btn btn-primary" disabled>Dokumen Tidak Ada</button>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Status Approval</label>
                            <div id="jstree-2">
                                <ul>
                                    <?php if ($data['nama_jabatan'] != "pengawas") : ?>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        PENGAWAS
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['verifikator_1'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php endif; ?>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        KASATLAK
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['verifikator_2'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        PPTK PJLP
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['verifikator_3'] ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        KASUBBAG TU
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['approval_1'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li data-jstree='{"icon" : "dripicons-user text-primary " , "opened" : true }'>
                                        KA PUSYANKESWANNAK
                                        <ul>
                                            <li>
                                                <a href="javascript:;">
                                                    <?= $data['approval_2'] ?> </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php if (session()->role != "master admin") : ?>
                        <div class="form-group">
                            <label for="" class="form-label">Aksi</label>
                            <!-- select2 -->

                            <?php if (session()->nama_jabatan == "ka pusyankeswannak") : ?>
                            <select class="form-select select2" id="aksi">
                                <option value="2">Approve</option>
                                <option value="0">Reject</option>
                            </select>
                            <label for="" class="form-label">Tanda Tangan</label>
                            <div>
                                <input type="file" class="form-control" id="ttd">
                            </div>
                            <?php else : ?>
                            <select class="form-select select2" id="aksi">
                                <option value="1">Dilihat</option>
                            </select>
                            <label for="" class="form-label">Tanda Tangan</label>
                            <div>
                                <input type="file" class="form-control" id="ttd">
                            </div>

                            <?php endif; ?>


                        </div>
                        <div class="form-group mt-2">
                            <!-- button submit -->
                            <button class="btn btn-primary" id="app-submit">Submit</button>
                            <!-- button back -->
                            <a href="<?= base_url('/home/permintaan-cuti') ?>" class="btn btn-danger">Kembali</a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#app-submit').click(function(evt) {
            evt.preventDefault();
            if ($('#ttd')[0].files[0] == undefined) {
                alert('Tanda Tangan Tidak Boleh Kosong');
                return false;
            }
            // aksi
            var aksi = $('#aksi').val();
            if (aksi != "") {
                var formData = new FormData();
                formData.append('ttd', $('#ttd')[0].files[0]);
                formData.append('id_cuti', "<?= $data['id_cuti'] ?>");
                formData.append('status', aksi);
                $.ajax({
                    url: "/api/edit/approval-cuti",
                    type: "POST",
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    enctype: 'multipart/form-data',
                    processData: false,
                    success: function(datas) {
                        // parse json
                        console.log(datas);
                        var resp = JSON.parse(datas);
                        if (resp.status == "1") {
                            alert("Data berhasil disimpan");
                            if (resp.redir != 0) {
                                if (resp.redir == 90) {
                                    window.location.replace("/home/cuti-ditolak");
                                } else {
                                    window.location.replace("/home/pembuatan-surat-cuti/" +
                                        resp
                                        .redir);
                                }

                            } else {
                                location.reload();
                            }

                        } else if (resp.status == "3") {
                            alert("Data sudah pernah diupdate");
                        } else if (resp.status == "4") {
                            alert("Role sebelumnya belum memberikan keputusan");
                        } else if (resp.status == "99") {
                            alert(
                                "Jabatan anda tidak terdaftar sebagai approval/verifikator"
                            );
                        } else if (resp.status == "999") {
                            alert(
                                "File TTD harus berupa gambar [jpg,png]");
                        } else {
                            alert("Gagal simpan data");
                        }

                    }
                });
            }
        })
    });
    </script>
</div>
<?= $this->endSection() ?>