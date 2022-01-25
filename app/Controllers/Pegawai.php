<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\usersModel;
use App\Models\jabatanModel;
use App\Models\cutiModel;
use App\Models\lokasikerjaModel;
// load 404 exception error message
use CodeIgniter\Exceptions\PageNotFoundException;

class Pegawai extends BaseController
{
    public function __construct()
    {
        $this->cekAuth = new Akses();
        $this->notFound = new PageNotFoundException();
        $this->session = \Config\Services::session();
        $this->pegawai = new usersModel();
        $this->jabatan = new jabatanModel();
        $this->cuti = new cutiModel();
        $this->lokasikerja = new lokasikerjaModel();
    }
    public function index()
    {
        if ($this->cekAuth->cek() == 1) {
            return redirect()->to(base_url('/'));
        }
        // join data pegawai dan permintaan cuti
        $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where('user.id_user', $this->session->id_user)->like('approval_2', 'menunggu')->find();
        $data = [
            'title' => 'Data Permintaan Cuti Anda',
            'data_cuti' => $data_cuti,
        ];
        return view('pegawai/data_cuti', $data);
    }

    public function page($url)
    {

        if ($this->cekAuth->cek() == 1) {
            return redirect()->to(base_url('/'));
        }
        if ($url == "pengajuan-cuti") {
            // join data pegawai dan permintaan cuti
            $es = date("m/d/Y");
            $es = strtotime($es);
            $es = strtotime("+7 day", $es);
            $e = date("Y-m-d", $es);
            $data = [
                'title' => 'Pengajuan Cuti',
                'sisa_cuti' => $this->pegawai->where('id_user', $this->session->id_user)->first()['jatah_cuti_tahunan'],
                'data_lokasi' => $this->lokasikerja->findAll(),
                'data_jabatan' => $this->jabatan->findAll(),
                'date' => $e,
            ];
            return view('pegawai/pengajuan_cuti', $data);
        } else if ($url == "my-account") {
            $data = [
                'title' => 'My Account',
                'data_user' => $this->pegawai->where('id_user', $this->session->id_user)->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->first(),
                'data_lokasi' => $this->lokasikerja->findAll(),
            ];
            return view('pegawai/my_account', $data);
        } else if ($url == "cuti-disetujui") {
            // join data pegawai dan permintaan cuti
            $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where(['lokasi_kerja' => $this->session->wilayah, 'user.id_user' => $this->session->id_user])->like('approval_2', 'Disetujui')->find();
            $data = [
                'title' => 'Cuti Disetujui',
                'data_cuti' => $data_cuti,
            ];
            return view('pegawai/cuti_disetujui', $data);
        } else if ($url == "cuti-ditolak") {
            // join data pegawai dan permintaan cuti
            $data_cuti = $this->cuti->join('user', 'permintaan_cuti.id_user = user.id_user')->join('jabatan', 'jabatan.id_jabatan = user.id_jabatan')->where(['lokasi_kerja' => $this->session->wilayah, 'user.id_user' => $this->session->id_user])->like('approval_2', 'Ditolak')->find();
            $data = [
                'title' => 'Cuti Ditolak',
                'data_cuti' => $data_cuti,
            ];
            return view('pegawai/cuti_ditolak', $data);
        }
    }
}