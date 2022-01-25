<?php

namespace App\Models;

use CodeIgniter\Model;

class cutiModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'permintaan_cuti';
    protected $primaryKey           = 'id_cuti';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['id_user', 'tanggal_awal', 'tanggal_akhir', 'tipe_cuti', 'alasan_cuti', 'dokumen', 'verifikator_1', 'verifikator_2', 'verifikator_3', 'approval_1', 'approval_2', 'surat_cuti', 'ttd_1', 'ttd_2', 'ttd_3', 'ttd_4', 'ttd_5'];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];
}