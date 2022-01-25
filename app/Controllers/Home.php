<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\usersModel;
use App\Models\jabatanModel;
use App\Models\cutiModel;
use App\Models\lokasikerjaModel;
use App\Models\nomorCutiModel;
use App\Models\notifModel;
// load 404 exception error message
use CodeIgniter\Exceptions\PageNotFoundException;

class Home extends BaseController
{
    public function __construct()
    {
        $this->spellNum = new spellNum();
        $this->cekAuth = new Akses();
        $this->notFound = new PageNotFoundException();
        $this->session = \Config\Services::session();
        $this->pegawai = new usersModel();
        $this->jabatan = new jabatanModel();
        $this->cuti = new cutiModel();
        $this->notif = new notifModel();
        $this->nomorCuti = new nomorCutiModel();
        $this->lokasikerja = new lokasikerjaModel();
    }
    public function index()
    {
        if ($this->cekAuth->cek() == 0) {
            return redirect()->to(base_url('/'));
        }
        // count total users as pegawai 
        $total_pegawai = $this->pegawai->countAll();
        $total_divisi = $this->jabatan->countAll();

        // data cuti
        $data_cuti = $this->cuti->join('user', 'user.id_user = permintaan_cuti.id_user')->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->notLike('approval_2', 'menunggu')->find();

        $data = [
            'title' => 'Dashboard',
            'total_pegawai' => $total_pegawai,
            'total_jabatan' => $total_divisi,
            'data_cuti' => $data_cuti,
        ];
        return view('admin/home', $data);
    }

    public function lihatCuti($id)
    {
        if ($this->cekAuth->cek() == 0) {
            return redirect()->to(base_url('/'));
        }

        // get data cuti user from id
        $data = $this->cuti->where('id_cuti', $id)->join('user', 'user.id_user = permintaan_cuti.id_user')->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')->first();

        if ($data) {

            if ($this->session->get('wilayah') == $data['lokasi_kerja'] || $this->session->get('wilayah') == "semua lokasi") {
                if ($this->session->role == 'master admin' and $this->session->nama_jabatan == "admin") {
                    $get_notif_id = $this->notif->where('id_cuti', $id)->first();
                    $update_notif = [
                        'id_notif' => $get_notif_id['id_notif'],
                        'status_6' => 1,
                    ];
                    $this->notif->save($update_notif);
                }
                $get = [
                    'title' => 'Detail Approval Cuti',
                    'data' => $data,
                ];

                return view('/admin/approval_cuti', $get);
            } else {
                echo "Anda tidak berhak mengakses halaman ini.";
                die();
            }
        } else {
            // throw 404
            throw $this->notFound;
        }
    }

    public function link($url)
    {
        if ($this->cekAuth->cek() == 0) {
            return redirect()->to(base_url('/'));
        }
        if ($url == "data-pegawai") {
            if ($this->cekAuth->onlyMaster() == 0) {
                return redirect()->to(base_url('/'));
            }
            // join user ,jabatan,
            $data_user = $this->pegawai->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')->where('role', 'user')->findAll();
            // ambil data jabatan
            $data_jabatan = $this->jabatan->findAll();
            // ambil datalokasi
            $data_lokasi = $this->lokasikerja->findAll();
            $data = [
                'title' => 'Data Pegawai',
                'data_pegawai' => $data_user,
                'data_jabatan' => $data_jabatan,
                'data_lokasi' => $data_lokasi,
            ];
            return view('admin/data_pegawai', $data);
        } else if ($url == "lokasi-kerja") {
            if ($this->cekAuth->onlyMaster() == 0) {
                return redirect()->to(base_url('/'));
            }
            $data = [
                'title' => 'Lokasi Kerja',
                'lokasi_kerja' => $this->lokasikerja->findAll(),
            ];
            return view('admin/lokasi_kerja', $data);
        } else if ($url == "data-admin") {
            if ($this->cekAuth->onlyMaster() == 0) {
                return redirect()->to(base_url('/'));
            }
            // join user ,jabatan,
            $data_user = $this->pegawai->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan')->whereNotIn('role', ['user'])->whereNotIn('nip', [$this->session->nip])->findAll();
            // ambil data jabatan
            $data_jabatan = $this->jabatan->findAll();
            // data lokasi
            $data_lokasi = $this->lokasikerja->findAll();
            $data = [
                'title' => 'Data Admin',
                'data_pegawai' => $data_user,
                'data_jabatan' => $data_jabatan,
                'data_lokasi' => $data_lokasi,
            ];
            return view('admin/data_admin', $data);
        } else if ($url == "jabatan") {
            if ($this->cekAuth->onlyMaster() == 0) {
                return redirect()->to(base_url('/'));
            }
            $data_jabatan = $this->jabatan->findAll();
            $data = [
                'title' => 'Data Jabatan',
                'data_jabatan' => $data_jabatan,
            ];
            return view('admin/jabatan', $data);
        } else if ($url == "permintaan-cuti") {
            // join data pegawai dan permintaan cuti
            if ($this->session->wilayah == "semua lokasi") {
                $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->like('approval_2', 'menunggu')->find();
            } else {
                if ($this->session->nama_jabatan == "pengawas") {
                    $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->whereNotIn('jabatan.nama_jabatan', [$this->session->nama_jabatan])->like('approval_2', 'menunggu')->find();
                } else {
                    $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->like('approval_2', 'menunggu')->find();
                }
            }

            $data = [
                'title' => 'Data Permintaan Cuti',
                'data_cuti' => $data_cuti,
            ];
            return view('admin/permintaan_cuti', $data);
        } else if ($url == "my-account") {
            $data_user = $this->pegawai->where('id_user', $this->session->get('id_user'))->first();
            $data_jabatan = $this->jabatan->findAll();
            $data = [
                'title' => 'My Account',
                'data_user' => $data_user,
                'data_jabatan' => $data_jabatan,
                'data_lokasi' => $this->lokasikerja->findAll(),
            ];
            return view('admin/akun', $data);
        } else if ($url == "permintaan-cuti-anda") {
            // join data pegawai dan permintaan cuti
            $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('user.id_user', $this->session->id_user)->like('approval_2', 'menunggu')->findAll();
            $data = [
                'title' => 'Data Permintaan Cuti Anda',
                'data_cuti' => $data_cuti,
            ];
            return view('admin/history_cuti_anda', $data);
        } else if ($url == "permintaan-cuti-pengawas") {
            // join data pegawai dan permintaan cuti
            $es = date("m/d/Y");
            $es = strtotime($es);
            $es = strtotime("+7 day", $es);
            $e = date("Y-m-d", $es);
            $data = [
                'title' => 'Data Permintaan Cuti Anda',
                'data_lokasi' => $this->lokasikerja->findAll(),
                'data_jabatan' => $this->jabatan->findAll(),
                'date' => $e,
            ];
            return view('admin/permintaan_cuti_pengawas', $data);
        } else if ($url == "cuti-disetujui") {
            // join data pegawai dan permintaan cuti
            if ($this->session->wilayah == "semua lokasi") {
                $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->like('approval_2', 'Disetujui')->find();
            } else {
                if ($this->session->nama_jabatan == "pengawas") {
                    $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->like('approval_2', 'Disetujui')->where('user.id_user', $this->session->id_user)->find();
                } else {
                    $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->like('approval_2', 'Disetujui')->find();
                }
            }
            $data = [
                'title' => 'Data Permintaan Cuti',
                'data_cuti' => $data_cuti,
            ];
            return view('admin/cuti_disetujui', $data);
        } else if ($url == "cuti-ditolak") {
            // join data pegawai dan permintaan cuti
            if ($this->session->wilayah == "semua lokasi") {
                $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->like('approval_2', 'Ditolak')->find();
            } else {
                if ($this->session->nama_jabatan == "pengawas") {
                    $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->like('approval_2', 'Ditolak')->where('user.id_user', $this->session->id_user)->find();
                } else {
                    $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('lokasi_kerja', $this->session->wilayah)->like('approval_2', 'Ditolak')->find();
                }
            }

            $data = [
                'title' => 'Data Permintaan Cuti',
                'data_cuti' => $data_cuti,
            ];
            return view('admin/cuti_ditolak', $data);
        }
    }
    public function readme()
    {
        return view('readme');
    }
    public function buatSuratCuti($id)
    {
        $user = $this->cuti->where('id_cuti', $id)->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->first();

        if ($this->cekAuth->cek() == 0) {
            return redirect()->to(base_url('/'));
        }
        if ($user) {
            if ($this->session->get('wilayah') == $user['lokasi_kerja']) {
                $n_cuti = $this->nomorCuti->first();
                if ($n_cuti['nomor_cuti'] < 10) {
                    $n_cuti = "000" . $n_cuti['nomor_cuti'];
                } else if ($n_cuti['nomor_cuti'] > 10 and $n_cuti['nomor_cuti'] < 100) {
                    $n_cuti = "00" . $n_cuti['nomor_cuti'];
                } else if ($n_cuti['nomor_cuti'] > 10 and $n_cuti['nomor_cuti'] > 100 and $n_cuti['nomor_cuti'] < 1000) {
                    $n_cuti = "0" . $n_cuti['nomo_cuti'];
                } else {
                    $n_cuti = $n_cuti['nomor_cuti'];
                }
                $start = strtotime($user['tanggal_awal']);
                $end = strtotime($user['tanggal_akhir']);
                $jarak = $end - $start;
                $cuti_b_hari = $jarak / 60 / 60 / 24; // ambil cuti berapa hari ?
                // ambil tahun dan sisa cuti
                $data_cuti2 = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->where('id_cuti', $id)->find();

                $get = [
                    'title' => 'Surat Cuti ' . date("d/m/Y"),
                    'data' => $user,
                    'nomor_cuti' => $n_cuti,
                    'spell' => $this->spellNum->convert($cuti_b_hari),
                    'num' => $cuti_b_hari,
                    'data_cuti2' => $data_cuti2
                ];
                // mpdf
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8',
                    'margin_top' => 5,
                    'margin_left' => 5,
                    'margin_right' => 5
                ]);
                $mpdf->showImageErrors = false;
                $mpdf->SetCompression(true);
                $mpdf->writeHTML(view('admin/pembuatan_surat_cuti2', $get));
                // update nomor cuti
                $data_n = [
                    'id_nomor_cuti' => 1,
                    'nomor_cuti' => $n_cuti + 1,
                ];
                $this->nomorCuti->save($data_n);
                //return view('admin/pembuatan_surat_cuti2', $get);
                //return redirect()->to($mpdf->Output('cuti.pdf', 'I'));
                $mpdf->Output('upload/surat_cuti/' . 'Surat_Cuti_' . $n_cuti . '_' . date("d_m_y") . '.pdf', 'F'); // save pdf
                //simpan ke database
                $simpan_cuti = [
                    'id_cuti' => $id,
                    'surat_cuti' => '/upload/surat_cuti/' . 'Surat_Cuti_' . $n_cuti . '_' . date("d_m_y") . '.pdf',
                ];
                $this->cuti->save($simpan_cuti);
                // flashdata success
                $this->session->setFlashdata('success', 'Berhasil melakukan approval dan surat cuti berhasil dibuat');
                return redirect()->to(base_url('/home/cuti-disetujui'));
            } else {
                echo "Anda tidak berhak mengakses halaman ini.";
                die();
            }
        } else {
            // throw 404
            throw $this->notFound;
        }
    }
    public function login()
    {

        // cek if session exist 
        if ($this->session->nama) {
            if ($this->session->role != 'user') {
                return redirect()->to(base_url('home'));
            } else {
                return redirect()->to(base_url('pegawai'));
            }
        } else {

            return view('login');
        }
    }
}