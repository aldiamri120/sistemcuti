## USER

- Halaman "Data Cuti"
  > Menampilkan data permintaan cuti yang anda ajukan
  > Data yang tampil hanya data yang belum diketahui statusnya Ditolak/Disetujui
- Halaman "Ajukan cuti"
  > Anda dapat mengajukan cuti pada form tersebut
  > Jika tipe cutinya tahunan, maka jatah cuti tahunan anda harus dialokasikan terlebih dahulu oleh admin
- Halaman "Cuti Disetujui"
  > Halaman ini akan menampilkan semua permintaan cuti anda yang disetujui
- Halaman "Cuti Ditolak"
  > Halaman ini akan menampilkan semua permintaan cuti anda yang ditolak
- Dropdown "My account" \* pojok kanan atas
  > Untuk mengubah password , dan foto

## ADMIN/MASTER ADMIN

- Halaman "Home"
  > Report data cuti dari pegawai
- Halaman "Data Pegawai" (Master Admin)
  > Untuk menambah dan edit data pegawai, anda juga dapat mengalokasikan jatah cuti tahunan pegawai pada halaman ini
- Halaman "Data Admin" (Master Admin)
  > Untuk menambah dan edit data admin
- Halaman "Data Jabatan" (Master Admin)
  > Untuk menambah dan edit data jabatan
- Halaman "Data Lokasi Kerja" (Master Admin)
  > Untuk menambah dan edit data lokasi kerja
- Halaman "Data Cuti Pegawai"
  > Menampilkan data permintaan cuti yang diajukan pegawai
  > Data yang tampil hanya data yang belum diketahui statusnya Ditolak/Disetujui
- Halaman "Data Cuti Anda" (Pengawas)
  > Jika anda seorang pengawas maka halaman ini akan menampilkan data permintaan cuti yang anda ajukan
  > Data yang tampil hanya data yang belum diketahui statusnya Ditolak/Disetujui
- Halaman "Ajukan Cuti" (Pengawas)
  > Jika and aseorang pengawas, anda dapat mengajukan cuti pada halaman ini
- Halaman "Cuti Disetujui"
  > Halaman ini akan menampilkan semua permintaan cuti anda yang disetujui (**Jika anda seorang pengawas**)
  > Halaman ini akan menampilkan semua permintaan cuti pegawai yang disetujui (**Jika anda seorang KAPUS/Master admin**)
- Halaman "Cuti Ditolak"
  > Halaman ini akan menampilkan semua permintaan cuti anda yang ditolak (**Jika anda seorang pengawas**)
  > Halaman ini akan menampilkan semua permintaan cuti pegawai yang ditolak (**Jika anda seorang KAPUS/Master admin**)
- Dropdown "My account" \* pojok kanan atas
  > Untuk mengubah password , dan foto

## PROSES APPROVE

- Proses approve dilakukan bergantian bedasarkan jabatan dan hak aksesnya
- Jika jabatan 1 belum melakukan tindakan, maka jabatan selanjutnya tidak akan bisa melakukan tindakan juga
- Jabatan paling tinggi KAPUS, akan melakukan "APPROVE/REJECT"
- Jika KAPUS melakukan "APPROVE" Maka otomatis surat cuti akan dibuat dan muncul dihalaman "Cuti Disetujui" pegawai

## WILAYAH

- Admin dengan wilayah "A" hanya dapat menerima pengajuan cuti dari wilayah "A", kecuali status wilayah kerja admin adalah "Semua Lokasi"

## NOTIFIKASI

- Notifikasi akan muncul hanya jika sudah saatnya admin tersebut melakukan tindakan , CONTOH : ("verifikator 1 telah melihat permintaan cuti, maka verifikator 2 akan mendapatkan notif, begitupun seterusnya)
