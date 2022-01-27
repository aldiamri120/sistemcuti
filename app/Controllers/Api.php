<?php

namespace App\Controllers;

// set timezone default
date_default_timezone_set("Asia/Jakarta");

use App\Models\usersModel;
use App\Models\jabatanModel;
use App\Models\cutitahunanModel;
use App\Models\cutiModel;
use App\Models\lokasikerjaModel;
use App\Models\notifModel;
// exception
use Exception;
use CodeIgniter\Exceptions\PageNotFoundException;

class Api extends BaseController
{
    public function __construct()
    {
        $this->notFound = new PageNotFoundException();
        $this->session = \Config\Services::session();
        $this->pegawai = new usersModel();
        $this->cutitahunan = new cutitahunanModel();
        $this->jabatan = new jabatanModel();
        $this->cuti = new cutiModel();
        $this->notif = new notifModel();
        $this->lokasikerja = new lokasikerjaModel();
    }

    public function notif()
    {
        // get data from notif model
        if ($this->session->wilayah == "semua lokasi") {
            $data = $this->notif->join('permintaan_cuti', 'permintaan_cuti.id_cuti = notif.id_cuti')->join('user', 'user.id_user = permintaan_cuti.id_user');
        } else {
            $data = $this->notif->join('permintaan_cuti', 'permintaan_cuti.id_cuti = notif.id_cuti')->join('user', 'user.id_user = permintaan_cuti.id_user')->where('notif.lokasi_kerja', $this->session->wilayah);
        }
        $res = array();
        if ($this->session->role == 'admin' and str_contains($this->session->nama_jabatan, "pengawas")) {

            $data_admin = $data->where('status_1', 0)->find();
            $num = 1;
            foreach ($data_admin as $d) {
                $res[] = array(
                    'link' => $d['link'],
                    'nama' => $d['nama'],
                );
                $num++;
            }
        } else if ($this->session->role == 'admin' and str_contains($this->session->nama_jabatan, "kasatlak")) {
            $data_admin = $data->where('status_1', 1)->where('status_2', 0)->find();
            $num = 1;
            foreach ($data_admin as $d) {
                $res[] = array(
                    'link' => $d['link'],
                    'nama' => $d['nama'],
                );
                $num++;
            }
        } else if ($this->session->role == 'admin' and str_contains($this->session->nama_jabatan, "pptk")) {
            $data_admin = $data->where('status_1', 1)->where('status_2', 1)->where('status_3', 0)->find();
            $num = 1;
            foreach ($data_admin as $d) {
                $res[] = array(
                    'link' => $d['link'],
                    'nama' => $d['nama'],
                );
                $num++;
            }
        } else if ($this->session->role == 'admin' and str_contains($this->session->nama_jabatan, "kasubbag tu")) {
            $data_admin = $data->where('status_1', 1)->where('status_2', 1)->where('status_3', 1)->where('status_4', 0)->find();
            $num = 1;
            foreach ($data_admin as $d) {
                $res[] = array(
                    'link' => $d['link'],
                    'nama' => $d['nama'],
                );
                $num++;
            }
        } else if ($this->session->role == 'admin' and str_contains($this->session->nama_jabatan, "ka pusyankeswannak")) {
            $data_admin = $data->where('status_1', 1)->where('status_2', 1)->where('status_3', 1)->where('status_4', 1)->where('status_5', 0)->find();
            $num = 1;
            foreach ($data_admin as $d) {
                $res[] = array(
                    'link' => $d['link'],
                    'nama' => $d['nama'],
                );
                $num++;
            }
        } else if ($this->session->role == 'master admin' and str_contains($this->session->nama_jabatan, "admin")) {
            $data_admin = $data->where('status_6', 0)->find();
            $num = 1;
            foreach ($data_admin as $d) {
                $res[] = array(
                    'link' => $d['link'],
                    'nama' => $d['nama'],
                );
                $num++;
            }
        }
        return json_encode($res);
    }
    public function save($url)
    {
        if ($url == 'pegawai') {
            if ($this->request->getPost('level') == "admin" || $this->request->getPost('level') == "master admin") {
                $jatah = 12;
                $tahun = date("Y");
            } else {
                $jatah = 0;
                $tahun = "";
            }
            $data = [
                'id_pjlp' => $this->request->getPost('id_pjlp'),
                'nama' => $this->request->getPost('nama'),
                'nip' => $this->request->getPost('nip'),
                'password' => sha1($this->request->getPost('password')),
                'role' => $this->request->getPost('level'),
                'id_jabatan' => $this->request->getPost('jabatan'),
                'lokasi_kerja' => $this->request->getPost('lokasi_kerja'),
                'tahun' => $tahun,
                'jatah_cuti_tahunan' => $jatah
            ];
            if ($this->pegawai->save($data)) {

                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == 'cuti') {
            $data = [
                'id_user' => $this->request->getPost('id_user'),
                'tahun' => date('Y'),
                'jatah_cuti_tahunan' => '12',
            ];
            if ($this->pegawai->save($data)) {

                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == 'jabatan') {
            $data = [
                'nama_jabatan' => strtolower($this->request->getPost('nama_jabatan')),
            ];
            if ($this->jabatan->save($data)) {

                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == "lokasi-kerja") {
            $data = [
                'lokasi' => ucwords($this->request->getPost('lokasi')),
            ];
            if ($this->lokasikerja->save($data)) {

                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        }
    }

    public function cuti()
    {
        $tanggal_pengajuan = date('Y-m-d');
        $tipe_cuti = $this->request->getPost('tipe_cuti');
        $id_user = $this->session->id_user;
        $date_start = $this->request->getPost('date_start');
        $date_end = $this->request->getPost('date_end');
        $keterangan = $this->request->getPost('keterangan');
        $dokumen = $this->request->getFile('dokumen');
        $dok = "";
        $nama_dokumen = "";
        $file_ok = "0";
        if ($tipe_cuti == "tahunan") {
            $dokumen = null;
        } else {
            $dokumen = $dokumen;
        }
        if ($dokumen) {
            if (!$this->validate([
                'dokumen' => [
                    'rules' => 'uploaded[dokumen]|mime_in[dokumen,image/jpg,image/jpeg,image/gif,image/png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]|max_size[dokumen,2048]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'Dokumen harus berupa foto atau file (pdf,doc,docx)',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ])) {
                session()->setFlashdata('error', $this->validator->listErrors());
                return redirect()->to(base_url('/home/permintaan-cuti-anda'));
            } else {
                $file_ok = "1";
                $data_dokumen = $dokumen;
                $nama_dokumen = rand() . "_" . $data_dokumen->getName();
                $dok = "/upload/dokumen/$nama_dokumen";
                if ($file_ok == "1") {
                    $data_dokumen->move('upload/dokumen/', $nama_dokumen);
                }
            }
        } else {
            $dok = "";
        }

        // cek ambil cuti berapa hari
        $start = strtotime($date_start);
        $end = strtotime($date_end);
        $jarak = $end - $start;
        $cuti_b_hari = $jarak / 60 / 60 / 24; // ambil cuti berapa hari ?

        // atasi error end date lebih besar dari start date
        if ($cuti_b_hari < 0) {
            $this->session->setFlashdata('error', 'Maaf, tanggal start date cuti melebihi end date cuti');
            if ($this->session->get('role') == 'admin') {
                return redirect()->to(base_url('/home/permintaan-cuti-pengawas'));
            } else {
                return redirect()->to(base_url('/pegawai/pengajuan-cuti'));
            }
        }
        // permintaan cuti dilakukan h-7
        $pengajuan = strtotime($tanggal_pengajuan);
        $pengambilan_cuti = strtotime($date_start);
        $jarak_pengambilan_cuti = $pengambilan_cuti - $pengajuan;
        $jarak_pengambilan_cuti = $jarak_pengambilan_cuti / 60 / 60 / 24;

        // cek apakah cuti dilakukan h-7 khusus cuti tahunan
        if ($tipe_cuti == 'tahunan') {
            // cek apakah cuti sudah dialokasikan untuk user ini
            $cek = $this->pegawai->where('id_user', $id_user)->where('tahun', date('Y'))->first();

            if (!$cek) {
                $this->session->setFlashdata('error', 'Maaf, cuti tahunan anda belum dialokasikan');
                if ($this->session->get('role') == 'admin') {
                    return redirect()->to(base_url('/home/permintaan-cuti-pengawas'));
                } else {
                    return redirect()->to(base_url('/pegawai/pengajuan-cuti'));
                }
            } else {
                // cek apakah cuti diajukan h-7 atau tidak
                if ($jarak_pengambilan_cuti < 7) {
                    $this->session->setFlashdata('error', 'Maaf, cuti tahunan anda harus dilakukan h-7');
                    if ($this->session->get('role') == 'admin') {
                        return redirect()->to(('/home/permintaan-cuti-pengawas'));
                    } else {
                        return redirect()->to(base_url('/pegawai/pengajuan-cuti'));
                    }
                } else {
                    // cek apakah cuti sudah dialokasikan untuk user ini
                    $cek = $this->pegawai->where('id_user', $id_user)->where('tahun', date('Y'))->first();
                    // cek sisa cuti tahunan 
                    $sisa_cuti = $this->pegawai->where('id_user', $id_user)->where('tahun', date('Y'))->first()['jatah_cuti_tahunan'] - $cuti_b_hari;

                    if ($sisa_cuti < 0 || $sisa_cuti == 0) {
                        $this->session->setFlashdata('error', 'Maaf, sisa cuti tahunan anda tidak mencukupi [ Permintaan cuti : ' . $cuti_b_hari . ' Hari ] [ Sisa cuti anda : ' . $this->pegawai->where('id_user', $id_user)->where('tahun', date('Y'))->first()['jatah_cuti_tahunan'] . ' Hari ]');
                        if ($this->session->get('role') == 'admin') {
                            return redirect()->to(base_url('/home/permintaan-cuti-pengawas'));
                        } else {
                            return redirect()->to(base_url('/pegawai/pengajuan-cuti'));
                        }
                    } else {
                        // simpan semua
                        $my_name = $this->session->get('nama');
                        $my_jabatan = $this->session->get('nama_jabatan');
                        $my_nip = $this->session->get('nip');
                        if ($this->session->nama_jabatan == "pengawas") {
                            $verif = "<span class=\"badge bg-success\">Dilihat oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        } else {
                            $verif = "<span class=\"badge bg-warning\">Menunggu</span>";
                        }
                        $data = [
                            'id_user' => $id_user,
                            'tanggal_awal' => $date_start,
                            'tanggal_akhir' => $date_end,
                            'tipe_cuti' => $tipe_cuti,
                            'alasan_cuti' => $keterangan,
                            'dokumen' => $dok,
                            'verifikator_1' => $verif,
                            'verifikator_2' => "<span class=\"badge bg-warning\">Menunggu</span>",
                            'verifikator_3' => "<span class=\"badge bg-warning\">Menunggu</span>",
                            'approval_1' => "<span class=\"badge bg-warning\">Menunggu</span>",
                            'approval_2' => "<span class=\"badge bg-warning\">Menunggu</span>",
                            'surat_cuti' => ""
                        ];
                        $this->cuti->save($data);
                        // update jatah cuti tahunan
                        // cek apakah cuti sudah dialokasikan untuk user ini
                        $cek = $this->pegawai->where('id_user', $id_user)->where('tahun', date('Y'))->first();
                        // cek sisa cuti tahunan 
                        $sisa_cuti = $this->pegawai->where('id_user', $id_user)->where('tahun', date('Y'))->first()['jatah_cuti_tahunan'] - $cuti_b_hari;

                        $data_jatah_cuti = [
                            'id_user' => $id_user,
                            'jatah_cuti_tahunan' => $sisa_cuti
                        ];
                        $this->pegawai->save($data_jatah_cuti);
                        // update notif
                        if ($this->session->nama_jabatan == 'pengawas') {
                            $status_1 = 1;
                        } else {
                            $status_1 = 0;
                        }
                        $data_notif = [
                            'id_user' => $id_user,
                            'id_cuti' => $this->cuti->orderBy('id_cuti', 'DESC')->limit(1)->first()['id_cuti'],
                            'lokasi_kerja' => $this->cuti->orderBy('id_cuti', 'DESC')->limit(1)->join('user', 'user.id_user = permintaan_cuti.id_user')->first()['lokasi_kerja'],
                            'link' => '/home/lihat-cuti/' . $this->cuti->orderBy('id_cuti', 'DESC')->limit(1)->join('user', 'user.id_user = permintaan_cuti.id_user')->first()['id_cuti'],
                            'status_1' => $status_1,
                            'status_2' => 0,
                            'status_3' => 0,
                            'status_4' => 0,
                            'status_5' => 0,
                            'status_6' => 0,
                        ];
                        $this->notif->save($data_notif);
                        $this->session->setFlashdata('success', 'Permintaan cuti anda berhasil diajukan');
                        if ($this->session->get('role') == 'admin') {
                            return redirect()->to(base_url('/home/permintaan-cuti-anda'));
                        } else {
                            return redirect()->to(base_url('/pegawai'));
                        }
                    }
                }
            }
        } else {

            // simpan semua
            $my_name = $this->session->get('nama');
            $my_jabatan = $this->session->get('nama_jabatan');
            $my_nip = $this->session->get('nip');
            // fix jika pengawas mengajukan cuti maka langsung ke level diatasnya
            if ($this->session->nama_jabatan == "pengawas") {
                $verif = "<span class=\"badge bg-success\">Dilihat oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
            } else {
                $verif = "<span class=\"badge bg-warning\">Menunggu</span>";
            }
            $data = [
                'id_user' => $id_user,
                'tanggal_awal' => $date_start,
                'tanggal_akhir' => $date_end,
                'tipe_cuti' => $tipe_cuti,
                'alasan_cuti' => $keterangan,
                'dokumen' => $dok,
                'verifikator_1' => $verif,
                'verifikator_2' => "<span class=\"badge bg-warning\">Menunggu</span>",
                'verifikator_3' => "<span class=\"badge bg-warning\">Menunggu</span>",
                'approval_1' => "<span class=\"badge bg-warning\">Menunggu</span>",
                'approval_2' => "<span class=\"badge bg-warning\">Menunggu</span>",
                'surat_cuti' => ""
            ];
            $this->cuti->save($data);
            // update notif
            if ($this->session->nama_jabatan == 'pengawas') {
                $status_1 = 1;
            } else {
                $status_1 = 0;
            }
            $data_notif = [
                'id_user' => $id_user,
                'id_cuti' => $this->cuti->orderBy('id_cuti', 'DESC')->limit(1)->first()['id_cuti'],
                'lokasi_kerja' => $this->cuti->orderBy('id_cuti', 'DESC')->limit(1)->join('user', 'user.id_user = permintaan_cuti.id_user')->first()['lokasi_kerja'],
                'link' => '/home/lihat-cuti/' . $this->cuti->orderBy('id_cuti', 'DESC')->limit(1)->join('user', 'user.id_user = permintaan_cuti.id_user')->first()['id_cuti'],
                'status_1' => $status_1,
                'status_2' => 0,
                'status_3' => 0,
                'status_4' => 0,
                'status_5' => 0,
                'status_6' => 0,
            ];
            $this->notif->save($data_notif);
            $this->session->setFlashdata('success', 'Permintaan cuti anda berhasil diajukan');
            if ($this->session->get('role') == 'admin') {
                return redirect()->to(base_url('/home/permintaan-cuti-anda'));
            } else {
                return redirect()->to(base_url('/pegawai'));
            }
        }
    }


    public function edit($url)
    {
        if ($url == "pegawai") {
            $password = $this->request->getPost('password');
            // cek password apakah kosong atau tidak
            if ($password == "") {
                $data = [
                    'id_user' => $this->request->getPost('id_user'),
                    'id_pjlp' => $this->request->getPost('id_pjlp'),
                    'nama' => $this->request->getPost('nama'),
                    'nip' => $this->request->getPost('nip'),
                    'role' => $this->request->getPost('role'),
                    'id_jabatan' => $this->request->getPost('id_jabatan'),
                    'lokasi_kerja' => $this->request->getPost('lokasi_kerja'),
                ];
            } else {
                $data = [
                    'id_user' => $this->request->getPost('id_user'),
                    'id_pjlp' => $this->request->getPost('id_pjlp'),
                    'nama' => $this->request->getPost('nama'),
                    'nip' => $this->request->getPost('nip'),
                    'password' => sha1($password),
                    'role' => $this->request->getPost('role'),
                    'id_jabatan' => $this->request->getPost('id_jabatan'),
                    'lokasi_kerja' => $this->request->getPost('lokasi_kerja'),
                ];
            }
            if ($this->pegawai->save($data)) {
                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == 'jabatan') {
            $data = [
                'id_jabatan' => $this->request->getPost('id_jabatan'),
                'nama_jabatan' => strtolower($this->request->getPost('nama_jabatan')),
            ];
            if ($this->jabatan->save($data)) {

                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == "approval-cuti") {
            $id_cuti = $this->request->getPost('id_cuti');
            $status = $this->request->getPost('status');
            $ttd = $this->request->getFile('ttd');
            $role = $this->session->role;
            $my_name = $this->session->nama;
            $my_jabatan = $this->session->nama_jabatan;
            $my_nip = $this->session->nip;
            if (!$this->validate([
                'ttd' => [
                    'rules' => 'uploaded[ttd]|mime_in[ttd,image/jpg,image/jpeg,image/gif,image/png]|max_size[ttd,2024]',
                    'errors' => [
                        'uploaded' => 'Harus Ada File yang diupload',
                        'mime_in' => 'File harus berupa gambar',
                        'max_size' => 'Ukuran File Maksimal 2 MB'
                    ]
                ]
            ])) {
                $data = [
                    'status' => '999', //error
                    'redir' => 0
                ];
                return json_encode($data);
            } else {
                $file_ok = "1";
                $data_foto = $ttd;
                $nama_foto = rand() . "_" . $data_foto->getName();
                $dok = "/upload/ttd/$nama_foto";

                if ($file_ok == "1") {
                    $data_foto->move('upload/ttd/', $nama_foto);
                }

                // get data cuti
                $data_cuti = $this->cuti->where('id_cuti', $id_cuti)->first();
                if ($role == 'admin' and str_contains($my_jabatan, "pengawas")) {
                    if (!strpos($data_cuti['verifikator_1'], 'Menunggu')) {
                        $data = [
                            'status' => '3',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else {
                        if ($status == "1") {
                            $appr = "<span class=\"badge bg-success\">Dilihat oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        } else {
                            $appr = "<span class=\"badge bg-danger\">Ditolak oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        }
                        // update notif status
                        $get_notif_id = $this->notif->where('id_cuti', $id_cuti)->first();
                        $update_notif = [
                            'id_notif' => $get_notif_id['id_notif'],
                            'status_1' => 1,
                        ];
                        $this->notif->save($update_notif);

                        $data_save = [
                            'id_cuti' => $id_cuti,
                            'verifikator_1' => $appr,
                            'ttd_1' => $dok,
                        ];
                        $this->cuti->save($data_save);
                        $data = [
                            'status' => '1',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    }
                } else if ($role == 'admin' and str_contains($my_jabatan, "kasatlak")) {
                    if (strpos($data_cuti['verifikator_1'], 'Menunggu')) {
                        $data = [
                            'status' => '4',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else if (strpos($data_cuti['verifikator_1'], 'Ditolak')) {
                        $data = [
                            'status' => '5',
                            'redir' => 0

                        ];
                        return json_encode($data);
                    } else if (!strpos($data_cuti['verifikator_2'], 'Menunggu')) {
                        $data = [
                            'status' => '3',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else {
                        if ($status == "1") {
                            $appr = "<span class=\"badge bg-success\">Dilihat oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        } else {
                            $appr = "<span class=\"badge bg-danger\">Ditolak oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        }
                        // update notif status
                        $get_notif_id = $this->notif->where('id_cuti', $id_cuti)->first();
                        $update_notif = [
                            'id_notif' => $get_notif_id['id_notif'],
                            'status_2' => 1,
                        ];
                        $this->notif->save($update_notif);

                        $data_save = [
                            'id_cuti' => $id_cuti,
                            'verifikator_2' => $appr,
                            'ttd_2' => $dok,
                        ];
                        $this->cuti->save($data_save);
                        $data = [
                            'status' => '1',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    }
                } else if ($role == 'admin' and str_contains($my_jabatan, "pptk")) {
                    if (strpos($data_cuti['verifikator_2'], 'Menunggu')) {
                        $data = [
                            'status' => '4',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else if (strpos($data_cuti['verifikator_2'], 'Ditolak')) {
                        $data = [
                            'status' => '5',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else if (!strpos($data_cuti['verifikator_3'], 'Menunggu')) {
                        $data = [
                            'status' => '3',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else {
                        if ($status == "1") {
                            $appr = "<span class=\"badge bg-success\">Dilihat oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        } else {
                            $appr = "<span class=\"badge bg-danger\">Ditolak oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        }
                        // update notif status
                        $get_notif_id = $this->notif->where('id_cuti', $id_cuti)->first();
                        $update_notif = [
                            'id_notif' => $get_notif_id['id_notif'],
                            'status_3' => 1,
                        ];
                        $this->notif->save($update_notif);

                        $data_save = [
                            'id_cuti' => $id_cuti,
                            'verifikator_3' => $appr,
                            'ttd_3' => $dok,
                        ];
                        $this->cuti->save($data_save);
                        $data = [
                            'status' => '1',
                            'redir' => 0
                        ];
                        return json_encode($data);
                    }
                } else if ($role == 'admin' and str_contains($my_jabatan, "kasubbag")) {
                    if (strpos($data_cuti['verifikator_3'], 'Menunggu')) {
                        $data = [
                            'status' => '4', // sebelumnya belum update
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else if (strpos($data_cuti['verifikator_3'], 'Ditolak')) {
                        $data = [
                            'status' => '5', // level sebelumnya menolak approval
                            'redir' => 0

                        ];
                        return json_encode($data);
                    } else if (!strpos($data_cuti['approval_1'], 'Menunggu')) {
                        $data = [
                            'status' => '3', // sudah di update
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else {
                        if ($status == "1") {
                            $appr = "<span class=\"badge bg-success\">Dilihat oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        } else {
                            $appr = "<span class=\"badge bg-danger\">Ditolak oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                        }
                        // update notif status
                        $get_notif_id = $this->notif->where('id_cuti', $id_cuti)->first();
                        $update_notif = [
                            'id_notif' => $get_notif_id['id_notif'],
                            'status_4' => 1,
                        ];
                        $this->notif->save($update_notif);

                        $data_save = [
                            'id_cuti' => $id_cuti,
                            'approval_1' => $appr,
                            'ttd_4' => $dok,
                        ];
                        $this->cuti->save($data_save);
                        $data = [
                            'status' => '1', // update
                            'redir' => 0

                        ];
                        return json_encode($data);
                    }
                } else if ($role == 'admin' and str_contains($my_jabatan, "ka pusyankeswannak")) {
                    if (strpos($data_cuti['approval_1'], 'Menunggu')) {
                        $data = [
                            'status' => '4', // sebelumnya belum update
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else if (strpos($data_cuti['approval_1'], 'Ditolak')) {
                        $data = [
                            'status' => '5',
                            'redir' => 0 // level sebelumnya menolak approval

                        ];
                        return json_encode($data);
                    } else if (!strpos($data_cuti['approval_2'], 'Menunggu')) {
                        $data = [
                            'status' => '3', // sudah di update
                            'redir' => 0
                        ];
                        return json_encode($data);
                    } else {
                        if ($status == "2") {
                            $appr = "<span class=\"badge bg-success\">Disetujui oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span></span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                            $get_notif_id = $this->notif->where('id_cuti', $id_cuti)->first();
                            $update_notif = [
                                'id_notif' => $get_notif_id['id_notif'],
                                'status_5' => 1,
                            ];
                            $this->notif->save($update_notif);

                            $data_save = [
                                'id_cuti' => $id_cuti,
                                'approval_2' => $appr,
                                'ttd_5' => $dok,
                            ];
                            $this->cuti->save($data_save);
                            $data = [
                                'status' => '1', // update
                                'redir' => $id_cuti
                            ];
                            return json_encode($data);
                        } else {
                            $appr = "<span class=\"badge bg-danger\">Ditolak oleh</span><span class=\"badge bg-primary text-white\">$my_name</span><span class=\"badge bg-secondary text-white\">$my_jabatan</span><span class=\"badge bg-secondary text-white\" style=\"display:none\">$my_nip</span>";
                            $get_notif_id = $this->notif->where('id_cuti', $id_cuti)->first();
                            $update_notif = [
                                'id_notif' => $get_notif_id['id_notif'],
                                'status_5' => 1,
                            ];
                            $this->notif->save($update_notif);

                            $data_save = [
                                'id_cuti' => $id_cuti,
                                'approval_2' => $appr,
                                'ttd_5' => $dok,
                            ];
                            $this->cuti->save($data_save);
                            $data = [
                                'status' => '1', // update
                                'redir' => 90
                            ];
                            return json_encode($data);
                        }
                    }
                } else {
                    $data = [
                        'status' => '99', // role tidak terdaftar
                        'redir' => '0' // role tidak terdaftar
                    ];
                    return json_encode($data);
                }
            }
        } else if ($url == "akun") {
            $id_user = $this->request->getPost('id_user');
            $nama = $this->request->getPost('nama');
            if ($this->session->role == "user") {
                $jabatan = $this->jabatan->where('nama_jabatan', $this->session->nama_jabatan)->first()['id_jabatan'];
                $role = $this->session->role;
            } else {
                $jabatan = $this->request->getPost('jabatan');
                $role = $this->request->getPost('role');
            }

            $password = $this->request->getPost('password');
            $nip = $this->request->getPost('nip');
            $id_pjlp = $this->request->getPost('id_pjlp');
            $lokasi_kerja = $this->request->getPost('lokasi_kerja');
            $foto = $this->request->getFile('foto');
            $dok = "";
            $nama_foto = "";
            $file_ok = "0";
            if ($foto->getName() != "") {
                if (!$this->validate([
                    'foto' => [
                        'rules' => 'uploaded[foto]|mime_in[foto,image/jpg,image/jpeg,image/gif,image/png]|max_size[foto,2024]',
                        'errors' => [
                            'uploaded' => 'Harus Ada File yang diupload',
                            'mime_in' => 'File harus berupa gambar',
                            'max_size' => 'Ukuran File Maksimal 2 MB'
                        ]
                    ]
                ])) {
                    session()->setFlashdata('error', $this->validator->listErrors());
                    return redirect()->to('/home/my-acccount');
                } else {
                    $file_ok = "1";
                    $data_foto = $foto;
                    $nama_foto = rand() . "_" . $data_foto->getName();
                    $dok = "/upload/foto-pegawai/$nama_foto";
                    if ($file_ok == "1") {
                        $data_foto->move('upload/foto-pegawai/', $nama_foto);
                    }
                }
            } else {
                // ambil foto user 
                $data_foto2 = $this->pegawai->where("id_user", $id_user)->first();
                $dok = $data_foto2['foto'];
            }
            if ($password == "") {
                $data = [
                    'id_user' => $id_user,
                    'id_pjlp' => $id_pjlp,
                    'nama' => $nama,
                    'nip' => $nip,
                    'role' => $role,
                    'id_jabatan' => $jabatan,
                    'lokasi_kerja' => $lokasi_kerja,
                    'foto' => $dok,
                ];
            } else {
                $data = [
                    'id_user' => $id_user,
                    'id_pjlp' => $id_pjlp,
                    'nama' => $nama,
                    'nip' => $nip,
                    'password' => sha1($password),
                    'role' => $role,
                    'id_jabatan' => $jabatan,
                    'lokasi_kerja' => $lokasi_kerja,
                    'foto' => $dok,
                ];
            }
            if ($this->pegawai->save($data)) {
                // renew session
                $session = session();
                $session->set('nama', $nama);
                $session->set('foto', $dok);
                $session->set('nip', $nip);
                $session->set('role', $role);
                $session->set('nama_jabatan', $this->jabatan->where('id_jabatan', $jabatan)->first()['nama_jabatan']);
                $session->set('wilayah', $lokasi_kerja);
                $this->session->setFlashdata('success', 'Data berhasil diupdate');
                if ($this->session->role == "user") {
                    return redirect()->to(base_url('/pegawai/my-account'));
                } else {
                    return redirect()->to(base_url('/home/my-account'));
                }
            } else {
                $this->session->setFlashdata('error', 'Data gagal diupdate');
                if ($this->session->role == "user") {
                    return redirect()->to(base_url('/pegawai/my-account'));
                } else {
                    return redirect()->to(base_url('/home/my-account'));
                }
            }
        } else if ($url == "lokasi-kerja") {
            $id_lokasi = $this->request->getPost('id_lokasi');
            $lokasi = $this->request->getPost('lokasi');
            $data = [
                'id_lokasi' => $id_lokasi,
                'lokasi' => ucwords($lokasi),
            ];
            if ($this->lokasikerja->save($data)) {
                $js = [
                    'status' => '1'
                ];
            } else {
                $js = [
                    'status' => '0'
                ];
            }
            return json_encode($js);
        }
    }

    public function delete($url)
    {
        if ($url == "pegawai") {
            $id_user = $this->request->getPost('id_user');
            if ($this->pegawai->delete($id_user)) {
                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == "jabatan") {
            $id_jabatan = $this->request->getPost('id_jabatan');
            if ($this->jabatan->delete($id_jabatan)) {
                $data = [
                    'status' => '1'
                ];
                return json_encode($data);
            } else {
                $data = [
                    'status' => '0'
                ];
                return json_encode($data);
            }
        } else if ($url == "lokasi-kerja") {
            $id_lokasi = $this->request->getPost('id_lokasi');
            $data = [
                'id_lokasi' => $id_lokasi,
            ];
            if ($this->lokasikerja->delete($data)) {
                $js = [
                    'status' => '1'
                ];
            } else {
                $js = [
                    'status' => '0'
                ];
            }
            return json_encode($js);
        }
    }

    public function login()
    {
        $nip = $this->request->getPost('nip');
        $password = $this->request->getPost('password');
        $data = [
            'nip' => $nip,
            'password' => sha1($password)
        ];
        // cek login data
        $cek = $this->pegawai->where($data)->countAllResults();
        if ($cek > 0) {
            // set session
            $this->session->set('nip', $nip);
            $this->session->set('role', $this->pegawai->where($data)->first()['role']);
            $this->session->set('id_user', $this->pegawai->where($data)->first()['id_user']);
            $this->session->set('nama', $this->pegawai->where($data)->first()['nama']);
            $this->session->set('nama_jabatan', $this->pegawai->where($data)->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')->first()['nama_jabatan']);
            $this->session->set('tahun', $this->pegawai->where($data)->first()['tahun']);
            $this->session->set('jatah_cuti_tahunan', $this->pegawai->where($data)->first()['jatah_cuti_tahunan']);
            $this->session->set('foto', $this->pegawai->where($data)->first()['foto']);
            $this->session->set('wilayah', $this->pegawai->where($data)->first()['lokasi_kerja']);

            // redirect to home page
            if ($this->session->role == 'user') {
                return redirect()->to(base_url('/pegawai'));
            } else {
                return redirect()->to(base_url('/home'));
            }
        } else {
            // redirect to login page and set error flashdata
            return redirect()->to(base_url())->with('error', 'NIP atau Password Salah');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}