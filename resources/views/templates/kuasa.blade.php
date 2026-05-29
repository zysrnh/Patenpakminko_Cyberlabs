<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Surat Kuasa</title>
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
            text-decoration: underline;
            margin-bottom: 30px;
            font-weight: bold;
        }

        p.text {
            font-size: 14px;
            line-height: 1.6;
            text-align: justify;
        }

        .section-header {
            font-size: 14px;
            font-weight: bold;
            margin-top: 15px;
            margin-bottom: 5px;
        }

        .biodata-table {
            width: 100%;
            margin: 10px 0 20px;
            border-collapse: collapse;
        }
        .biodata-table td {
            padding: 5px 0;
            vertical-align: top;
            font-size: 14px;
        }
        .biodata-table td.label {
            width: 30%;
            padding-left: 15px;
        }
        .biodata-table td.separator {
            width: 3%;
        }

        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: space-between;
        }

        .sig-box {
            width: 45%;
            text-align: center;
            font-size: 14px;
        }

        .materai-box {
            border: 1px dashed #7f8c8d;
            width: 120px;
            height: 70px;
            margin: 25px auto 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #7f8c8d;
            font-weight: bold;
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
        <a href="javascript:history.back()" class="btn-back">? Kembali ke Form</a>
        <button onclick="window.print()" class="btn-print">??? Cetak / Simpan PDF</button>
    </div>

    <!-- Document Page -->
    <div class="document-page">
        <h2 class="title">SURAT KUASA</h2>

        <p class="text">Yang bertanda tangan di bawah ini:</p>
        
        <div class="section-header">PEMBERI KUASA (PIHAK KESATU):</div>
        <table class="biodata-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">NIK / Nomor KTP</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
        </table>

        <div class="section-header">PENERIMA KUASA (PIHAK KEDUA):</div>
        <table class="biodata-table">
            <tr>
                <td class="label">Nama Lengkap</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">NIK / Nomor KTP</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">Pekerjaan</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
            <tr>
                <td class="label">Alamat Lengkap</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
        </table>

        <p class="text" style="text-indent: 30px;">
            Secara khusus, dengan surat ini Pihak Kesatu memberikan kuasa penuh kepada Pihak Kedua untuk bertindak atas nama Pihak Kesatu dalam melakukan pengurusan pengajuan berkas permohonan Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang (PKPR) Non-Berusaha pada sistem portal <strong>PATEN PAK MIKO</strong>.
        </p>

        <p class="text" style="text-indent: 30px; margin-top: 10px;">
            Kuasa ini meliputi hak untuk menandatangani berkas permohonan, melampirkan berkas fisik tanah/bangunan, menghadiri proses koordinasi dengan instansi teknis terkait, serta melakukan segala tindakan administrasi yang diperlukan hingga terbitnya Dokumen Persetujuan Resmi PPKPR Non-Berusaha.
        </p>

        <p class="text" style="margin-top: 15px;">
            Demikian surat kuasa ini dibuat untuk dipergunakan sebagaimana mestinya.
        </p>

        <div class="signature-section">
            <div class="sig-box">
                <p>Penerima Kuasa (Pihak Kedua),</p>
                <div style="height: 105px;"></div>
                <p style="font-weight: bold; text-decoration: underline;">( ................................................... )</p>
                <p style="font-size: 12px; color: #555;">NIK: ................................................</p>
            </div>
            <div class="sig-box">
                <p>........................, ............................. 20...</p>
                <p style="margin-top: 5px;">Pemberi Kuasa (Pihak Kesatu),</p>
                
                <div class="materai-box">
                    MATERAI<br>Rp. 10.000
                </div>
                
                <p style="font-weight: bold; text-decoration: underline;">( ................................................... )</p>
                <p style="font-size: 12px; color: #555;">NIK: ................................................</p>
            </div>
        </div>
    </div>

</body>
</html>
