<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template Surat Pernyataan Kebenaran Dokumen</title>
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
            font-family: 'Poppins', sans-serif;
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
            font-family: 'Poppins', sans-serif;
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
            margin-bottom: 5px;
            font-weight: bold;
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

        .biodata-table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        .biodata-table td {
            padding: 6px 0;
            vertical-align: top;
            font-size: 14px;
        }
        .biodata-table td.label {
            width: 30%;
        }
        .biodata-table td.separator {
            width: 3%;
        }

        .dotted-line {
            border-bottom: 1px dotted #000;
            display: inline-block;
            width: 60%;
            height: 16px;
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
        <h2 class="title">SURAT PERNYATAAN KEBENARAN DAN KEASLIAN DOKUMEN</h2>
        <p class="subtitle">NOMOR: ......................................................</p>

        <p class="text">Yang bertanda tangan di bawah ini:</p>

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
            <tr>
                <td class="label">Nomor Telepon / HP</td>
                <td class="separator">:</td>
                <td>....................................................................................................</td>
            </tr>
        </table>

        <p class="text">Dengan ini menyatakan dengan sebenar-benarnya dan di bawah sumpah bahwa:</p>
        
        <ol style="margin-left: 20px; padding-left: 0;">
            <li style="margin-bottom: 8px;">Seluruh data, informasi, dokumen, serta berkas persyaratan yang saya unggah dalam pengajuan permohonan Persetujuan Kesesuaian Kegiatan Pemanfaatan Ruang (PKPR) Non-Berusaha pada sistem PATEN PAK MIKO adalah <strong>BENAR, ASLI, SAH,</strong> dan sesuai dengan kondisi faktual di lapangan.</li>
            <li style="margin-bottom: 8px;">Apabila di kemudian hari ditemukan atau dibuktikan bahwa dokumen yang saya sampaikan tidak benar, palsu, atau hasil manipulasi, maka saya bersedia menerima sanksi administratif berupa pembatalan dokumen PKKPR yang diterbitkan, serta dituntut sesuai dengan hukum pidana/perdata yang berlaku.</li>
            <li style="margin-bottom: 8px;">Pernyataan ini dibuat dengan kesadaran penuh, sukarela, dan tanpa ada paksaan dari pihak manapun untuk dipergunakan sebagaimana mestinya.</li>
        </ol>

        <div class="signature-section">
            <div class="sig-box">
                <!-- Spacing -->
            </div>
            <div class="sig-box">
                <p>........................, ............................. 20...</p>
                <p style="margin-top: 5px;">Yang Membuat Pernyataan,</p>
                
                <div class="materai-box">
                    MATERAI<br>Rp. 10.000
                </div>
                
                <p style="margin-top: 15px; font-weight: bold; text-decoration: underline;">( ................................................... )</p>
                <p style="font-size: 12px; color: #555; margin-top: 2px;">Nama Jelas & Tanda Tangan</p>
            </div>
        </div>
    </div>

</body>
</html>
