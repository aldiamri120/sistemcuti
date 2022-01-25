<?php

namespace App\Controllers;

class Akses extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function cek()
    {
        if ($this->session->role == 'user') {
            return 0;
        } else {
            return 1;
        }
    }

    public function onlyMaster()
    {
        if ($this->session->role == "master admin") {
            return 1;
        } else {
            return 0;
        }
    }
}