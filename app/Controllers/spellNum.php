<?php

namespace App\Controllers;

class spellNum extends BaseController
{
    public function __construct()
    {
        $this->session = \Config\Services::session();
    }
    public function convert($num)
    {
        $data = [
            1 => 'satu',
            2 => 'dua',
            3 => 'tiga',
            4 => 'empat',
            5 => 'lima',
            6 => 'enam',
            7 => 'tujuh',
            8 => 'delapan',
            9 => 'sembilan',
            10 => 'sepuluh',
            11 => 'sebelas',
            12 => 'dua belas',

        ];
        return $data[$num];
    }
}