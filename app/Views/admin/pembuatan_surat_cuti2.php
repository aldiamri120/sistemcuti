<!DOCTYPE html>

<html lang="en">

<head>
    <title><?= $title ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <style>
        @media print {
            footer {
                page-break-after: always;
            }
        }

        body {
            font-family: "arial";
            font-size: 12px;
        }

        pre {
            font-family: "arial";
            font-size: 12px;
        }


        #tabl {
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border: 1px solid black;
        }

        #tabl td {
            border: 1px solid black;
            padding: 5px;
        }

        #tabl tr {
            border: 1px solid black;
        }


        .bld {
            font-weight: bold !important;
        }

        #tabl tr:nth-child(even) {
            background-color: white;
        }

        #tabl tr:hover {
            background-color: #ddd;
        }

        #tabl th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            padding: 5px;
            background-color: white;
            color: black;
            border: 1px solid black;
        }

        .al-center {
            text-align: center;
        }

        .al-right {
            text-align: right !important;
        }

        .md {
            width: 200px;
        }

        .kc {
            width: 80px;
        }

        .up {
            width: 100px;
        }

        .tp {
            width: 120px;
        }

        .mn {
            width: 50px;
        }

        .text_center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }


        .px-12 {
            font-size: 12px;
            text-align: left;
        }

        .bottom {
            position: fixed;
            bottom: 0;
        }

        .mt-10 {
            margin-top: 25px;
        }

        .payinfohead {
            background-color: #2b6abd;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <!-- head -->
    <div style="float:right;width:25%;border-top:0px solid black;border-bottom:0px solid black">
        <div class="mt-5">
            <p>Kepada</p>
            <p>Yth</p>
            <p>Kepala Pusat Pelayanan Kesehatan Hewan dan Peternakan</p>

            <p>Di Jakarta</p>
        </div>
    </div>
    <div class="container mt-2">
        <div class="text-center">
            <h3 class="bld">FORMULIR PERMINTAAN DAN PEMBERIAN CUTI</h3>
        </div>
        <div class="">
            <pre>Nomor   :          /<?= $nomor_cuti ?>
            
Tanggal : <?= date('d/m/Y') ?>
            </pre>
        </div>
    </div>
    <!-- end head -->
    <!-- info pegawai -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=4>I DATA PEGAWAI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mn">Nama</td>
                    <td><?= strtoupper($data['nama']) ?></td>
                    <td class="md">Nik</td>
                    <td><?= $data['nip'] ?></td>
                </tr>
                <tr>
                    <td class="mn">Jabatan</td>
                    <td><?= strtoupper($data['nama_jabatan']) ?></td>
                    <td class="mn">Lokasi Kerja</td>
                    <td><?= strtoupper($data['lokasi_kerja']) ?></td>

                </tr>
            </tbody>

        </table>
    </div>

    <!-- jenis cuti -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=6>II JENIS CUTI YANG DIAMBIL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mn text-center">1.</td>
                    <td class="md">Cuti Tahunan</td>
                    <?php if ($data['tipe_cuti'] == 'tahunan') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                    <td class="mn text-center">2.</td>
                    <td class="md">Cuti Melahirkan</td>
                    <?php if ($data['tipe_cuti'] == 'cuti melahirkan') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td class="mn text-center">3.</td>
                    <td class="md">Cuti Kecelakaan Kerja</td>
                    <?php if ($data['tipe_cuti'] == 'cuti kecelakaan kerja') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                    <td class="mn text-center">4.</td>
                    <td class="md">Cuti Sakit/Rawat Inap</td>
                    <?php if ($data['tipe_cuti'] == 'sakit rawat inap') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- alasan cuti -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th>III ALASAN CUTI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= ucwords($data['alasan_cuti']) ?></td>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- lama cuti -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=5>IV LAMA CUTI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Selama <?= $num ?> (<?= ucwords($spell) ?>) Hari</td>
                    <td class="mn text-center">
                        Dari
                    </td>
                    <td class="text-center">
                        <?= date('d/m/Y', strtotime($data['tanggal_awal'])) ?>
                    </td>
                    <td class="mn text-center">
                        Sampai
                    </td>
                    <td class="text-center"> <?= date('d/m/Y', strtotime($data['tanggal_akhir'])) ?>
                    </td>
                </tr>


                </tr>
            </tbody>

        </table>
    </div>
    <!-- catatan cuti -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=6>V CATATAN CUTI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="mn text-center">1.</td>
                    <td colspan=4>Cuti Tahunan</td>
                    <?php if ($data['tipe_cuti'] == 'tahunan') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td class="mn text-center" colspan=3>Tahun</td>
                    <td class="mn text-center" colspan=3>Sisa</td>
                </tr>
                <?php foreach ($data_cuti2 as $d) : ?>
                    <tr>
                        <td class="mn text-center" colspan=3><?= $d['tahun'] ?></td>
                        <td class="mn text-center" colspan=3><?= $d['jatah_cuti_tahunan'] ?> Hari</td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="mn text-center">2.</td>
                    <td colspan=4>Cuti Melahirkan</td>
                    <?php if ($data['tipe_cuti'] == 'cuti melahirkan') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td class="mn text-center">3.</td>
                    <td colspan=4>Cuti Kecelakaan Kerja</td>
                    <?php if ($data['tipe_cuti'] == 'cuti kecelakaan kerja') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td class="mn text-center">4.</td>
                    <td colspan=4>Cuti Sakit/Rawat Inap</td>
                    <?php if ($data['tipe_cuti'] == 'sakit rawat inap') : ?>
                        <td class="mn text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="mn text-center">-</td>
                    <?php endif; ?>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- alamat cuti -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=3>VI ALAMAT SELAMA MENJALANKAN CUTI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="md" rowspan=2>Jakarta</td>
                    <td class="mn text-center">TELP</td>
                    <td class="mn text-center"></td>
                </tr>
                <tr>
                    <td class="md text-center" colspan='2'>
                        <pre>Hormat


                        <img src="
                        <?= $data['ttd'] ?>" width="70px">

<?= strtoupper($data['nama']) ?>

NIK : <?= $data['nip'] ?>
                        </pre>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <footer></footer>
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=2>VII PERTIMBANGAN LANGSUNG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">DISETUJUI</td>
                    <td class="text-center">TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <?php if (str_contains($data['verifikator_1'], "Dilihat")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                    <?php if (str_contains($data['verifikator_1'], "Ditolak")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                </tr>

                <tr>
                    <td class="text-center" colspan=2>
                        <pre>Pengawas

</pre>
                        <img src="
                        <?= $data['ttd_2'] ?>" width="70px">
                        <br>
                        <br>
                        <?php if (str_contains($data['verifikator_1'], "Dilihat")) : ?>
                            <?php $nk = strip_tags(str_replace("pengawas", " ", str_replace("Dilihat oleh", " ", $data['verifikator_2']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php else : ?>
                            <?php $nk = strip_tags(str_replace("pengawas", " ", str_replace("Ditolak oleh", " ", $data['verifikator_2']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php endif ?>

                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- v2 -->

    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=2>VII PERTIMBANGAN LANGSUNG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">DISETUJUI</td>
                    <td class="text-center">TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <?php if (str_contains($data['verifikator_2'], "Dilihat")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                    <?php if (str_contains($data['verifikator_2'], "Ditolak")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                </tr>

                <tr>
                    <td class="text-center" colspan=2>
                        <pre>KASATLAK

</pre>
                        <img src="
                        <?= $data['ttd_2'] ?>" width="70px">
                        <br>
                        <br>
                        <?php if (str_contains($data['verifikator_2'], "Dilihat")) : ?>
                            <?php $nk = strip_tags(str_replace("kasatlak", " ", str_replace("Dilihat oleh", " ", $data['verifikator_2']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php else : ?>
                            <?php $nk = strip_tags(str_replace("kasatlak", " ", str_replace("Ditolak oleh", " ", $data['verifikator_2']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php endif ?>

                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- v3 -->

    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=2>VIII PERTIMBANGAN LANGSUNG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">DISETUJUI</td>
                    <td class="text-center">TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <?php if (str_contains($data['verifikator_3'], "Dilihat")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                    <?php if (str_contains($data['verifikator_3'], "Ditolak")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                </tr>

                <tr>
                    <td class="text-center" colspan=2>
                        <pre>PPTK PJLP

</pre>
                        <img src="
                        <?= $data['ttd_3'] ?>" width="70px">
                        <br>
                        <br>
                        <?php if (str_contains($data['verifikator_3'], "Dilihat")) : ?>
                            <?php $nk = strip_tags(str_replace("pptk pjlp", " ", str_replace("Dilihat oleh", " ", $data['verifikator_3']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php else : ?>
                            <?php $nk = strip_tags(str_replace("pptk pjlp", " ", str_replace("Ditolak oleh", " ", $data['verifikator_3']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php endif ?>

                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- TU -->

    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=2>IX PERTIMBANGAN LANGSUNG</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">DISETUJUI</td>
                    <td class="text-center">TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <?php if (str_contains($data['approval_1'], "Dilihat")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                    <?php if (str_contains($data['approval_1'], "Ditolak")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                </tr>

                <tr>
                    <td class="text-center" colspan=2>
                        <pre>Kepala Sub Bagian Tata Usaha

</pre>
                        <img src="
                        <?= $data['ttd_4'] ?>" width="70px">
                        <br>
                        <br>
                        <?php if (str_contains($data['approval_1'], "Dilihat")) : ?>
                            <?php $nk = strip_tags(str_replace("kasubbag tu", " ", str_replace("Dilihat oleh", " ", $data['approval_1']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php else : ?>
                            <?php $nk = strip_tags(str_replace("kasubbag tu", " ", str_replace("Ditolak oleh", " ", $data['approval_1']))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php endif ?>

                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    <!-- KA -->
    <div class="container mt-2">
        <table class="table" id="tabl">
            <thead>
                <tr>
                    <th colspan=2>X KEPUTUSAN PEJABAT YANG BERWENANG MEMBERIKAN CUTI</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center">DISETUJUI</td>
                    <td class="text-center">TIDAK DISETUJUI</td>
                </tr>
                <tr>
                    <?php if (str_contains($data['approval_2'], "Disetujui")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                    <?php if (str_contains($data['approval_2'], "Ditolak")) : ?>
                        <td class="text-center">&#10004;</td>
                    <?php else : ?>
                        <td class="text-center">-</td>
                    <?php endif; ?>
                </tr>

                <tr>
                    <td class="text-center" colspan=2>
                        <pre>Kepala Pusat Pelayanan
Kesehatan Hewan dan Peternakan

</pre>
                        <img src="
                        <?= $data['ttd_5'] ?>" width="70px">
                        <br>
                        <br>
                        <?php if (str_contains($data['approval_2'], "Disetujui")) : ?>
                            <?php $nk = strtoupper(strip_tags(str_replace("ka pusyankeswannak", " ", str_replace("Disetujui oleh", " ", $data['approval_2'])))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>

                        <?php else : ?>
                            <?php $nk = strtoupper(strip_tags(str_replace("ka pusyankeswannak", " ", str_replace("Ditolak oleh", " ", $data['approval_2'])))) ?>
                            <p><?= strtoupper(preg_replace('/[^a-zA-Z]/', ' ', $nk)) ?></p>
                            <p>NIK : <?= strtoupper(preg_replace('/[^0-9]/', ' ', $nk)) ?></p>
                        <?php endif ?>


                    </td>
                </tr>
            </tbody>

        </table>
    </div>

</body>

</html>