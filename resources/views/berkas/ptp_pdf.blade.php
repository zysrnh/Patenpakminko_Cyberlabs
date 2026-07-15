<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Formulir PTP - {{ $app_number }}</title>
    <style>
        body { font-family: "Times New Roman", Times, serif; font-size: 11pt; line-height: 1.5; padding: 20px; }
        .text-center { text-align: center; }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .title { font-size: 12pt; font-weight: bold; text-align: center; text-decoration: underline; margin-bottom: 20px; }
        
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 2px 4px; }
        .col-num { width: 3%; }
        .col-label { width: 35%; }
        .col-colon { width: 2%; text-align: center; }
        .col-val { width: 60%; }

        .section-title { font-weight: bold; text-align: center; margin-top: 30px; margin-bottom: 20px; font-size: 11pt; }
    </style>
</head>
<body>

    <p>Kepada Yth.<br>Kepala Kantor Pertanahan Kota Sukabumi<br>di tempat.</p>

    <table style="margin-bottom: 15px;">
        <tr>
            <td colspan="4">Yang bertanda tangan di bawah ini:</td>
        </tr>
        <tr>
            <td class="col-num">1.</td>
            <td class="col-label">Nama Lengkap</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $nama }}</td>
        </tr>
        <tr>
            <td class="col-num">2.</td>
            <td class="col-label">Nomor Induk Kependudukan (NIK)</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $nik }}</td>
        </tr>
        <tr>
            <td class="col-num">3.</td>
            <td class="col-label">Nomor Induk Berusaha (NIB)</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $nib }}</td>
        </tr>
        <tr>
            <td class="col-num">4.</td>
            <td class="col-label">Alamat</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $alamat }}</td>
        </tr>
        <tr>
            <td class="col-num">5.</td>
            <td class="col-label">No. Handphone</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $phone_number }}</td>
        </tr>
        <tr>
            <td class="col-num">6.</td>
            <td class="col-label">Bertindak untuk dan atas nama</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $bertindak_atas_nama }}</td>
        </tr>
        <tr>
            <td class="col-num">7.</td>
            <td class="col-label">Anggaran Dasar Perusahaan</td>
            <td class="col-colon">:</td>
            <td class="col-val">Tanggal {{ $anggaran_dasar_tanggal }} Nomor {{ $anggaran_dasar_no }}</td>
        </tr>
    </table>

    <p style="text-align: justify; margin-bottom: 10px;">
        dengan ini mengajukan permohonan Pertimbangan Teknis Pertanahan untuk kegiatan : ***)<br>
        1. Penerbitan Kesesuaian Kegiatan Pemanfaatan Ruang; terdiri dari :<br>
        &nbsp;&nbsp;&nbsp;a. Pertimbangan Teknis Pertanahan untuk Kegiatan Berusaha;<br>
        &nbsp;&nbsp;&nbsp;b. Pertimbangan Teknis Pertanahan untuk Kegiatan NonBerusaha;<br>
        &nbsp;&nbsp;&nbsp;c. Pertimbangan Teknis Pertanahan/RKKPR untuk Kegiatan yang bersifat Strategis Nasional.<br>
        2. Penegasan Status dan Rekomendasi Penguasaan Tanah Timbul;<br>
        3. Penyelenggaraan Kebijakan Penggunaan dan Pemanfaatan Tanah.
    </p>

    <table>
        <tr>
            <td style="width: 45%;">Rencana Kegiatan / Penggunaan<br>dan Pemanfaatan Tanah</td>
            <td class="col-colon" style="width: 2%;">:</td>
            <td class="col-val">{{ $rencana_kegiatan }}</td>
        </tr>
        <tr>
            <td>Kode dan nama KBLI ***)</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $kbli }}</td>
        </tr>
    </table>

    <p style="font-style: italic; font-size: 10pt; margin-bottom: 10px;">***) Klasifikasi Baku Lapangan usaha Indonesia (untuk pemohon pelaku usaha)</p>

    <p style="margin-bottom: 5px;">dengan keterangan sebagai berikut :</p>
    
    <table>
        <tr>
            <td class="col-num">1.</td>
            <td colspan="3">Letak tanah yang dimohon :</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">a. Jalan, nomor, RT / RW</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $letak_tanah_jalan }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">b. Kelurahan</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $letak_tanah_kelurahan }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">c. Kecamatan, Kota</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $letak_tanah_kecamatan }}</td>
        </tr>
        <tr>
            <td class="col-num">2.</td>
            <td class="col-label">Luas tanah yang dimohon</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $luas_tanah }}</td>
        </tr>
        <tr>
            <td class="col-num">3.</td>
            <td class="col-label">Status / penguasaan tanah</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $status_penguasaan }}</td>
        </tr>
        <tr>
            <td class="col-num">4.</td>
            <td class="col-label">Penggunaan tanah saat ini</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $penggunaan_saat_ini }}</td>
        </tr>
    </table>

    <p style="margin-top: 15px; margin-bottom: 5px;">Sebagai kelengkapan permohonan, bersama ini kami lampirkan :</p>
    <table style="font-size: 10pt; line-height: 1.3;">
        <tr><td class="col-num">1.</td><td>Peta atau Sketsa lokasi yang dimohon.</td></tr>
        <tr><td class="col-num">2.</td><td>Surat Kuasa (apabila dikuasakan).</td></tr>
        <tr><td class="col-num">3.</td><td>Fotocopy Kartu Tanda Penduduk (KTP).</td></tr>
        <tr><td class="col-num">4.</td><td>Fotocopy Nomor Pokok Wajib Pajak (NPWP).</td></tr>
        <tr><td class="col-num">5.</td><td>Fotocopy Akta Pendirian dan Pengesahan Badan Hukum (untuk badan hukum).</td></tr>
        <tr><td class="col-num">6.</td><td>Nomor Induk Berusaha (NIB) (untuk pemohon Pelaku Usaha apabila sudah memiliki NIB) *).</td></tr>
        <tr><td class="col-num">7.</td><td>Proposal rencana kegiatan berusaha (untuk pelaku usaha).</td></tr>
        <tr><td class="col-num">8.</td><td>Dokumen Pertek Pertanahan dan Bukti Penguasaan Fisik Lainnya (Akta/Perjanjian Sewa Menyewa/Perjanjian Pinjam Pakai atau lainnya yg menerangkan penguasaan dan penggunaan tanah).</td></tr>
        <tr><td></td><td style="font-style: italic;">(Semua kelengkapan permohonan di menggunakan Kertas ukuran F4)</td></tr>
    </table>

    <div style="font-size: 9pt; font-style: italic; margin-top: 10px; line-height: 1.2;">
        *) untuk pemohon Pelaku Usaha yang sudah memiliki NIB<br>
        **) khusus untuk pemohon badan hukum<br>
        ***) pilih salah satu<br>
        ****) Klasifikasi Baku Lapangan usaha Indonesia (untuk pemohon pelaku usaha)
    </div>

    <p style="text-align: justify; margin-top: 15px;">Demikian permohonan ini kami sampaikan, kami bertanggung jawab atas kebenaran persyaratan yg dilampirkan di atas, dan kami menyatakan akan mematuhi semua ketentuan dan persyaratan yang ditetapkan dalam pertimbangan teknis pertanahan.</p>

    <table style="width: 100%; margin-top: 30px; text-align: center;">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                Sukabumi, ....................................<br>
                Pemohon,<br><br><br><br><br>
                ( {{ $nama }} )
            </td>
        </tr>
    </table>

    <div style="page-break-before: always;"></div>

    <div class="section-title">
        RINGKASAN KELENGKAPAN BERKAS PERMOHONAN<br>
        PERTIMBANGAN TEKNIS PERTANAHAN DALAM RANGKA<br>
        PENERBITAN PERSETUJUAN KKPR UNTUK KEGIATAN BERUSAHA /<br>
        NON BERUSAHA / KEBIJAKAN
    </div>

    <table style="margin-bottom: 20px;">
        <tr>
            <td class="col-num">1.</td>
            <td colspan="3">Identitas Pemohon</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">a. Nama</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $nama }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">b. Alamat</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $alamat }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">c. Nomor Telepon</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $phone_number }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">d. E-mail</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $email }}</td>
        </tr>
        
        <tr>
            <td class="col-num" style="padding-top: 10px;">2.</td>
            <td colspan="3" style="padding-top: 10px;">Lokasi yang dimohon</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">a. Jalan, Nomor, RT/RW</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $letak_tanah_jalan }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">b. Desa/Kelurahan</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $letak_tanah_kelurahan }}</td>
        </tr>
        <tr>
            <td></td>
            <td class="col-label">c. Kecamatan</td>
            <td class="col-colon">:</td>
            <td class="col-val">{{ $letak_tanah_kecamatan }}</td>
        </tr>
        <tr>
            <td class="col-num" style="padding-top: 10px;">3.</td>
            <td class="col-label" style="padding-top: 10px;">Luas tanah yang dimohon</td>
            <td class="col-colon" style="padding-top: 10px;">:</td>
            <td class="col-val" style="padding-top: 10px;">{{ $luas_tanah }}</td>
        </tr>
    </table>

    <style>
        .table-border { border-collapse: collapse; width: 100%; font-size: 10pt; }
        .table-border th, .table-border td { border: 1px solid black; padding: 4px; }
        .text-center { text-align: center; }
    </style>

    <table class="table-border" style="margin-bottom: 20px;">
        <tr>
            <th rowspan="2" style="width: 5%;">No</th>
            <th rowspan="2" style="width: 45%;">Kelengkapan</th>
            <th colspan="2" style="width: 25%;">Ceklist (v)</th>
            <th rowspan="2" style="width: 25%;">Keterangan</th>
        </tr>
        <tr>
            <th>Ada</th>
            <th>Tidak Ada</th>
        </tr>
        <tr><td class="text-center">1</td><td>Surat Permohonan Pertimbangan Teknis Pertanahan</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">2</td><td>Peta atau Sketsa Lokasi yang dimohon</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">3</td><td>Surat Kuasa apabila dikuasakan</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">4</td><td>Kartu Tanda Penduduk (KTP)</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">5</td><td>Nomor Pokok Wajib Pajak (NPWP) pemohon</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">6</td><td>Fotocopy Akta Pendirian dan Pengesahan Badan Hukum</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">7</td><td>Keterangan Rencana Penggunaan Dan Pemanfaatan Tanah</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">8</td><td>Nomor Induk Berusaha (NIB) jika telah terdaftar dalam Sistem OSS *)</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">9</td><td>Klasifikasi Baku Lapangan Usaha Indonesia (KBLI) yang diajukan *)</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">10</td><td>Proposal Rencana Kegiatan Berusaha *)</td><td></td><td></td><td></td></tr>
        <tr><td class="text-center">11</td><td>Dokumen Pertek Pertanahan dan Bukti Penguasaan Fisik Lainnya</td><td></td><td></td><td></td></tr>
    </table>

    <table class="table-border">
        <tr>
            <th style="width: 65%;">Tim PTP dan/atau Satuan Tugas</th>
            <th colspan="2" style="width: 35%;">Pemohon</th>
        </tr>
        <tr>
            <td>1. AHMAD FAHMI, S.E., M.Si.<br>NIP. 19841210 201101 1 003</td>
            <td style="vertical-align: bottom;">1...................</td>
            <td rowspan="5" style="vertical-align: bottom; text-align: center;">1...................</td>
        </tr>
        <tr>
            <td>2. NURBELLA SRI BANON, S.H., M.Kn.<br>NIP. 19950119 202204 2 001</td>
            <td style="vertical-align: bottom;">2...................</td>
        </tr>
        <tr>
            <td>3. WAHYUDI, S.Kom.<br>NIP. PPPK. 19880628 202321 1 017</td>
            <td style="vertical-align: bottom;">3...................</td>
        </tr>
        <tr>
            <td>4. RINALDI SURYAGRAHANA, S.E.<br>NIP. PPPK. 19880818 202321 1 018</td>
            <td style="vertical-align: bottom;">4...................</td>
        </tr>
        <tr>
            <td>5. SIKALVY ARIYANTI SURYANA<br>NIP. PPPK. 19910927 202321 2 065</td>
            <td style="vertical-align: bottom;">5...................</td>
        </tr>
    </table>

</body>
</html>

