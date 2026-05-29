<?php
// Template Berkas Persyaratan Terintegrasi PPKPR Non-Berusaha
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Berkas Persyaratan PPKPR Non-Berusaha</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #f0f4f8;
            margin: 0;
            padding: 40px 0;
        }

        .action-bar {
            max-width: 800px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            padding: 15px 24px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .btn-print {
            background: #218AC9;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: bold;
            font-family: 'Plus Jakarta Sans', sans-serif;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn-print:hover {
            background: #003B64;
        }

        .btn-back {
            color: #2C5272;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .document-page {
            width: 210mm;
            min-height: 297mm;
            padding: 25mm 20mm;
            margin: 0 auto;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            box-sizing: border-box;
            position: relative;
        }

        h2.title {
            text-align: center;
            font-size: 16px;
            margin-bottom: 5px;
            font-weight: bold;
            text-transform: uppercase;
        }
        p.subtitle {
            text-align: center;
            font-size: 12px;
            margin-top: 0;
            margin-bottom: 30px;
            letter-spacing: 0.05em;
        }

        p.text, li {
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }

        .section-header {
            font-size: 14px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-bottom: 1.5px solid #000;
            padding-bottom: 3px;
            text-transform: uppercase;
        }

        .form-table {
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }
        .form-table td {
            padding: 8px 0;
            vertical-align: top;
            font-size: 14px;
        }
        .form-table td.label {
            width: 35%;
        }
        .form-table td.separator {
            width: 3%;
        }

        .checklist-table {
            width: 100%;
            margin: 15px 0 25px;
            border-collapse: collapse;
        }
        .checklist-table th, .checklist-table td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 13px;
        }
        .checklist-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: left;
        }
        .checklist-table td.center {
            text-align: center;
        }

        .signature-section {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
        }

        .sig-box {
            width: 45%;
            text-align: center;
            font-size: 14px;
        }

        @media print {
            body {
                background: none;
                padding: 0;
                margin: 0;
            }
            .action-bar {
                display: none;
            }
            .document-page {
                box-shadow: none;
                margin: 0;
                width: 100%;
                height: 100%;
                padding: 10mm 15mm;
            }
        }
    </style>
</head>
<body>

    <!-- Action Bar (Hidden when print) -->
    <div class="action-bar">
        <a href="javascript:history.back()" class="btn-back">← Kembali ke Form</a>
        <button onclick="window.print()" class="btn-print">🖨️ Cetak / Simpan PDF</button>
    </div>

    <!-- Document Page -->
    <div class="document-page">
        <h2 class="title">KUMPULAN DOKUMEN PERSYARATAN PERMOHONAN PPKPR NON-BERUSAHA</h2>
        <p class="subtitle">PORTAL PELAYANAN PATEN PAK MIKO</p>

        <div class="section-header">I. Identitas Pengaju & Usaha</div>
        <table class="form-table">
            <tr>
                <td class="label">Nama Pemilik Usaha</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">Nama Pengaju (Pemohon)</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">Hubungan Pengaju Dengan Pemilik</td>
                <td class="separator">:</td>
                <td>.................................................................................................... (cth: Pemilik/Kuasa/Staf)</td>
            </tr>
            <tr>
                <td class="label">Nomor WhatsApp Pengaju</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
        </table>

        <div class="section-header">II. Checklist Dokumen Lampiran Fisik (Wajib Digabungkan)</div>
        <p class="text">Silakan centang (v) dokumen yang telah Anda lampirkan di dalam berkas tunggal yang akan diunggah:</p>
        
        <table class="checklist-table">
            <thead>
                <tr>
                    <th style="width: 8%; text-align: center;">Centang</th>
                    <th style="width: 35%;">Nama Persyaratan Dokumen</th>
                    <th>Keterangan / Kelengkapan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Peta/sketsa lokasi yang dimohon</strong></td>
                    <td>Peta atau sketsa lokasi aktual.</td>
                </tr>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Surat kuasa (apabila dikuasakan)</strong></td>
                    <td>Surat kuasa bermaterai jika pengajuan diwakilkan.</td>
                </tr>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Fotokopi KTP</strong></td>
                    <td>KTP pengaju atau pemilik yang masih berlaku.</td>
                </tr>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Fotokopi NPWP</strong></td>
                    <td>NPWP Pribadi atau NPWP Badan.</td>
                </tr>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Fotokopi Akta Pendirian dan Pengesahan</strong></td>
                    <td>Hanya untuk Badan Hukum / Yayasan.</td>
                </tr>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Rencana Penggunaan dan Pemanfaatan Tanah</strong></td>
                    <td>Dokumen penjelasan rencana penggunaan ruang/tanah.</td>
                </tr>
                <tr>
                    <td class="center">[  ]</td>
                    <td><strong>Persyaratan lainnya yang diperlukan</strong></td>
                    <td>Dokumen tambahan pendukung sesuai arahan petugas (opsional).</td>
                </tr>
            </tbody>
        </table>

        <p class="text"><em>*Catatan: Seluruh berkas di atas wajib disusun secara berurutan dan dipindai (scan) menjadi satu file PDF atau di-compress ke format ZIP/RAR untuk diunggah ke sistem.</em></p>

        <div class="signature-section">
            <div class="sig-box">
                <p>Mengetahui,</p>
                <p style="margin-top: 5px; font-weight: bold;">Pemilik Usaha,</p>
                <br><br><br>
                <p style="margin-top: 15px;">( ................................................... )</p>
                <p style="font-size: 11px; color: #555;">Tanda Tangan & Nama Terang</p>
            </div>
            <div class="sig-box">
                <p>Bandung, ............................................. 20...</p>
                <p style="margin-top: 5px; font-weight: bold;">Pengaju / Pemohon,</p>
                <br><br><br>
                <p style="margin-top: 15px;">( ................................................... )</p>
                <p style="font-size: 11px; color: #555;">Tanda Tangan & Nama Terang</p>
            </div>
        </div>
    </div>

</body>
</html>
