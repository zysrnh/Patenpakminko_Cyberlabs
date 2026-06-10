<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengelolaan Berkas - PATEN PAK MIKO</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --clr-primary: #1A365D;
            --clr-accent: #3182CE;
            --clr-bg: #F7FAFC;
            --clr-card-bg: #FFFFFF;
            --clr-text: #2D3748;
            --clr-muted: #718096;
            --clr-line: #E2E8F0;
            --clr-green: #38A169;
            --clr-green-light: #C6F6D5;
            --clr-red: #E53E3E;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--clr-bg);
            color: var(--clr-text);
            line-height: 1.6;
        }

        header {
            background-color: var(--clr-primary); color: #FFFFFF;
            padding: 16px 0; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: sticky; top: 0; z-index: 100;
        }
        .container { max-width: 1400px; width: 95%; margin: 0 auto; padding: 0 20px; }
        .header-inner { display: flex; justify-content: space-between; align-items: center; }
        .logo-wrap { display: flex; align-items: center; gap: 12px; text-decoration: none; color: #FFFFFF; }
        .logo-text strong { display: block; font-size: 15px; font-weight: 800; }
        .logo-text span { display: block; font-size: 11px; color: #A0AEC0; }
        
        main { padding: 40px 0; }
        
        .page-header { margin-bottom: 24px; display: flex; justify-content: space-between; align-items: flex-end; }
        .page-title { font-size: 24px; font-weight: 800; color: var(--clr-primary); }
        .page-subtitle { font-size: 14px; color: var(--clr-muted); margin-top: 4px; }
        
        .card {
            background-color: var(--clr-card-bg);
            border: 1.5px solid var(--clr-line);
            border-radius: 16px; padding: 24px;
            margin-bottom: 24px; box-shadow: 0 4px 6px rgba(0,0,0,0.02);
        }

        /* Forms */
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-group { margin-bottom: 16px; }
        .form-group label { display: block; font-size: 13px; font-weight: 700; margin-bottom: 8px; color: var(--clr-text); }
        .form-control {
            width: 100%; padding: 10px 14px;
            border: 1.5px solid var(--clr-line); border-radius: 8px;
            font-family: inherit; font-size: 14px;
        }
        .form-control:focus { outline: none; border-color: var(--clr-accent); }
        
        .btn {
            display: inline-flex; align-items: center; justify-content: center; gap: 8px;
            padding: 10px 20px; font-weight: 700; font-size: 14px; border-radius: 8px;
            cursor: pointer; text-decoration: none; border: none; font-family: inherit;
        }
        .btn-primary { background-color: var(--clr-accent); color: white; }
        .btn-primary:hover { background-color: #2b6cb0; }
        .btn-danger { background-color: var(--clr-red); color: white; padding: 6px 12px; font-size: 12px; }
        .btn-outline { background-color: transparent; border: 1.5px solid var(--clr-line); color: var(--clr-text); }
        .btn-outline:hover { background-color: var(--clr-bg); }

        /* Alert */
        .alert { padding: 12px 16px; border-radius: 8px; margin-bottom: 24px; font-size: 14px; font-weight: 600; }
        .alert-success { background-color: var(--clr-green-light); color: #22543d; }
        .alert-error { background-color: #fed7d7; color: #9b2c2c; }

        /* Table */
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; text-align: left; }
        th { padding: 14px 16px; background-color: var(--clr-bg); font-size: 12px; font-weight: 700; color: var(--clr-muted); text-transform: uppercase; border-bottom: 2px solid var(--clr-line); }
        td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--clr-line); }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 700; background: var(--clr-bg); border: 1px solid var(--clr-line); }

        /* Filters */
        .filters { display: flex; gap: 12px; margin-bottom: 20px; align-items: center; }
        .filters form { display: flex; gap: 12px; width: 100%; }
        .filters select, .filters input { padding: 8px 12px; border: 1.5px solid var(--clr-line); border-radius: 6px; font-size: 13px; }

        /* Pagination Fix */
        nav[role="navigation"] svg { width: 20px; height: 20px; }
        nav[role="navigation"] p { margin-top: 12px; font-size: 13px; color: var(--clr-muted); }
        nav[role="navigation"] a, nav[role="navigation"] span { padding: 6px 12px; border: 1px solid var(--clr-line); border-radius: 6px; color: var(--clr-primary); font-size: 13px; text-decoration: none; }
        nav[role="navigation"] .flex.justify-between { display: flex; justify-content: space-between; align-items: center; }
        nav[role="navigation"] .hidden { display: none; }

        /* Slide Modal */
        .modal-backdrop {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0,0,0,0.5); z-index: 999;
            opacity: 0; pointer-events: none; transition: opacity 0.3s;
        }
        .modal-backdrop.show { opacity: 1; pointer-events: auto; }
        
        .modal-slide {
            position: fixed; top: 0; right: -600px; width: 600px; max-width: 90%; height: 100vh;
            background: #fff; z-index: 1000; box-shadow: -4px 0 20px rgba(0,0,0,0.1);
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column;
        }
        .modal-slide.open { right: 0; }
        .modal-header {
            padding: 16px 24px; border-bottom: 1px solid var(--clr-line);
            display: flex; justify-content: space-between; align-items: center;
        }
        .modal-title { font-size: 16px; font-weight: 700; color: var(--clr-primary); }
        .btn-close {
            background: transparent; border: none; font-size: 24px; color: var(--clr-muted);
            cursor: pointer; line-height: 1; padding: 4px;
        }
        .modal-body { flex: 1; padding: 0; background: #f0f0f0; }
        .modal-body iframe { width: 100%; height: 100%; border: none; }
    </style>
</head>
<body>

    <header>
        <div class="container header-inner">
            <a href="{{ route('dashboard') }}" class="logo-wrap">
                <div class="logo-text">
                    <strong>PATEN PAK MIKO</strong>
                    <span>Pengelolaan Berkas Terpadu</span>
                </div>
            </a>
            <a href="{{ route('dashboard') }}" style="color: #fff; text-decoration: none; font-size: 14px; font-weight: 600;">Kembali ke Dashboard</a>
        </div>
    </header>

    <main class="container">
        <div class="page-header">
            <div>
                <h1 class="page-title">📂 Pengelolaan Berkas</h1>
                <p class="page-subtitle">Unggah, simpan, dan kelola dokumen lintas instansi (BPN & PU).</p>
            </div>
            <div>
                <form action="{{ route('berkas.sync') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-outline" style="border-color: var(--clr-primary); color: var(--clr-primary);">
                        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 2v6h-6"/><path d="M3 12a9 9 0 0115-6.7L21 8"/><path d="M3 22v-6h6"/><path d="M21 12a9 9 0 01-15 6.7L3 16"/></svg>
                        Tarik Data (Pemohon)
                    </button>
                </form>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-error">
                <ul style="margin-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card">
            <h3 style="font-size: 16px; font-weight: 800; margin-bottom: 16px;">Unggah Berkas Baru</h3>
            <form action="{{ route('berkas.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label>Nama Berkas</label>
                        <input type="text" name="nama_berkas" class="form-control" required placeholder="Contoh: Sketsa Lokasi Tanah Timbul">
                    </div>
                    <div class="form-group">
                        <label>Kategori (Modul)</label>
                        <select name="kategori" class="form-control" required>
                            <option value="">-- Pilih Jenis Dokumen --</option>
                            @if(Auth::user()->isSatuPintu())
                                <option value="Dokumen Pertimbangan Teknis Pertanahan">Dokumen Pertimbangan Teknis Pertanahan</option>
                            @else
                                <option value="Peta Lokasi">Peta Lokasi</option>
                                <option value="Surat Kuasa">Surat Kuasa</option>
                                <option value="FC KTP">FC KTP / Identitas</option>
                                <option value="FC NPWP">FC NPWP</option>
                                <option value="FC Akta Pendirian">FC Akta Pendirian</option>
                                <option value="Rencana Penggunaan Tanah">Rencana Penggunaan Tanah</option>
                                <option value="NIB">NIB</option>
                                <option value="KBLI">KBLI</option>
                                <option value="Proposal Kegiatan">Proposal Kegiatan</option>
                                <option value="Formulir PTP">Formulir PTP</option>
                                <option value="Dokumen Pertimbangan Teknis Pertanahan">Dokumen Pertimbangan Teknis Pertanahan</option>
                                <option value="Dokumen Penilaian (PU)">Dokumen Penilaian (PU)</option>
                                <option value="Dokumen PKKPR Final (PTSP)">Dokumen PKKPR Final (PTSP)</option>
                                <option value="Persyaratan Lainnya">Lainnya</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Pilih File (PDF, JPG, PNG, DOCX - Max 10MB)</label>
                    <input type="file" name="file" class="form-control" required accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
                </div>
                <div class="form-group">
                    <label>Keterangan Tambahan (Opsional)</label>
                    <textarea name="keterangan" class="form-control" rows="2" placeholder="Tuliskan keterangan mengenai dokumen ini..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Unggah Dokumen</button>
            </form>
        </div>

        <div class="card">
            <h3 style="font-size: 16px; font-weight: 800; margin-bottom: 16px;">Daftar Berkas Tersimpan</h3>
            
            <div class="filters">
                <form action="{{ route('berkas.index') }}" method="GET">
                    <input type="text" name="search" placeholder="Cari nama berkas..." value="{{ request('search') }}" style="flex: 1;">
                    <select name="kategori">
                        @if(Auth::user()->isSatuPintu())
                            <option value="Dokumen Pertimbangan Teknis Pertanahan" {{ request('kategori') == 'Dokumen Pertimbangan Teknis Pertanahan' ? 'selected' : '' }}>Dokumen Pertimbangan Teknis Pertanahan</option>
                        @else
                            <option value="">Semua Jenis Dokumen</option>
                            <option value="Peta Lokasi" {{ request('kategori') == 'Peta Lokasi' ? 'selected' : '' }}>Peta Lokasi</option>
                            <option value="FC KTP" {{ request('kategori') == 'FC KTP' ? 'selected' : '' }}>FC KTP</option>
                            <option value="FC NPWP" {{ request('kategori') == 'FC NPWP' ? 'selected' : '' }}>FC NPWP</option>
                            <option value="Surat Kuasa" {{ request('kategori') == 'Surat Kuasa' ? 'selected' : '' }}>Surat Kuasa</option>
                            <option value="FC Akta Pendirian" {{ request('kategori') == 'FC Akta Pendirian' ? 'selected' : '' }}>FC Akta Pendirian</option>
                            <option value="Rencana Penggunaan Tanah" {{ request('kategori') == 'Rencana Penggunaan Tanah' ? 'selected' : '' }}>Rencana Penggunaan Tanah</option>
                            <option value="NIB" {{ request('kategori') == 'NIB' ? 'selected' : '' }}>NIB</option>
                            <option value="KBLI" {{ request('kategori') == 'KBLI' ? 'selected' : '' }}>KBLI</option>
                            <option value="Proposal Kegiatan" {{ request('kategori') == 'Proposal Kegiatan' ? 'selected' : '' }}>Proposal Kegiatan</option>
                            <option value="Formulir PTP" {{ request('kategori') == 'Formulir PTP' ? 'selected' : '' }}>Formulir PTP</option>
                            <option value="Dokumen Pertimbangan Teknis Pertanahan" {{ request('kategori') == 'Dokumen Pertimbangan Teknis Pertanahan' ? 'selected' : '' }}>Dokumen Pertimbangan Teknis Pertanahan</option>
                            <option value="Dokumen Penilaian (PU)" {{ request('kategori') == 'Dokumen Penilaian (PU)' ? 'selected' : '' }}>Dokumen Penilaian (PU)</option>
                            <option value="Dokumen PKKPR Final (PTSP)" {{ request('kategori') == 'Dokumen PKKPR Final (PTSP)' ? 'selected' : '' }}>Dokumen PKKPR Final (PTSP)</option>
                            <option value="Persyaratan Lainnya" {{ request('kategori') == 'Persyaratan Lainnya' ? 'selected' : '' }}>Persyaratan Lainnya</option>
                        @endif
                    </select>
                    <button type="submit" class="btn btn-outline" style="padding: 8px 16px;">Filter</button>
                    @if(request('search') || request('kategori'))
                        <a href="{{ route('berkas.index') }}" class="btn btn-outline" style="padding: 8px 16px;">Reset</a>
                    @endif
                </form>
            </div>

            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Berkas</th>
                            <th>Kategori</th>
                            <th>Informasi File</th>
                            <th>Pengaju / Pengunggah</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($berkas as $item)
                        <tr>
                            <td>
                                <strong>{{ $item->nama_berkas }}</strong>
                                @if($item->keterangan)
                                    <div style="font-size: 12px; color: var(--clr-muted); margin-top: 4px;">{{ Str::limit($item->keterangan, 50) }}</div>
                                @endif
                            </td>
                            <td><span class="badge">{{ $item->kategori ?? 'Umum' }}</span></td>
                            <td>
                                <span class="badge" style="background:#EBF8FF;color:#2B6CB0;border:none;">{{ strtoupper($item->tipe_file) }}</span>
                                <span style="font-size:12px;color:var(--clr-muted);margin-left:6px;">{{ $item->ukuran_file }}</span>
                            </td>
                                                        @php
                                $pengajuInfo = null;
                                if (strpos($item->nama_berkas, '[') === 0 && strpos($item->nama_berkas, '] ') !== false) {
                                    $parts = explode('] ', $item->nama_berkas);
                                    if (count($parts) >= 2) {
                                        $appNo = trim($parts[1]);
                                        if (strpos($appNo, 'BERUSAHA-') === 0) {
                                            $app = \App\Models\PpkprBerusahaApplication::where('application_number', $appNo)->first();
                                            $pengajuInfo = $app ? ($app->nama_pengaju ?: $app->nama_pemilik_usaha) : null;
                                        } elseif (strpos($appNo, 'NON-BERUSAHA-') === 0) {
                                            $app = \App\Models\PpkprNonBerusahaApplication::where('application_number', $appNo)->first();
                                            $pengajuInfo = $app ? $app->nama_pengaju : null;
                                        } elseif (strpos($appNo, 'PSN-') === 0) {
                                            $app = \App\Models\PsnApplication::where('application_number', $appNo)->first();
                                            $pengajuInfo = $app ? $app->nama_pengaju : null;
                                        } elseif (strpos($appNo, 'TANAH-TIMBUL-') === 0) {
                                            $app = \App\Models\TanahTimbulApplication::where('application_number', $appNo)->first();
                                            $pengajuInfo = $app ? $app->nama_pengaju : null;
                                        } elseif (strpos($appNo, 'KEBIJAKAN-') === 0) {
                                            $app = \App\Models\KebijakanApplication::where('application_number', $appNo)->first();
                                            $pengajuInfo = $app ? $app->nama_pengaju : null;
                                        }
                                    }
                                }
                                $finalName = $pengajuInfo ?: ($item->user->name ?? 'Admin');
                            @endphp
                            <td>
                                <span style="font-weight: 500; color: #003B64;">{{ $finalName }}</span><br>
                                <span style="font-size: 11px; color: var(--clr-muted);">(Akun: PMH{{ str_pad($item->user->id ?? 0, 3, '0', STR_PAD_LEFT) }})</span>
                            </td>
                            <td>{{ $item->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div style="display: flex; gap: 6px;">
                                    <button type="button" class="btn btn-outline" style="padding: 6px 12px; font-size: 12px; border-color: var(--clr-accent); color: var(--clr-accent);" onclick="openPreview('{{ route('berkas.preview', $item->id) }}', '{{ $item->nama_berkas }}')">
                                        Lihat
                                    </button>
                                    <a href="{{ route('berkas.download', $item->id) }}" class="btn btn-primary" style="padding: 6px 12px; font-size: 12px;">Unduh</a>
                                    <form action="{{ route('berkas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berkas ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="background: transparent; border: 1.5px solid var(--clr-red); color: var(--clr-red);">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 40px 20px; color: var(--clr-muted);">
                                Belum ada berkas yang diunggah.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div style="margin-top: 20px;">
                    {{ $berkas->links() }}
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Preview -->
    <div class="modal-backdrop" id="previewBackdrop" onclick="closePreview()"></div>
    <div class="modal-slide" id="previewModal">
        <div class="modal-header">
            <div class="modal-title" id="previewTitle">Preview Dokumen</div>
            <button class="btn-close" onclick="closePreview()">&times;</button>
        </div>
        <div class="modal-body">
            <iframe id="previewFrame" src=""></iframe>
        </div>
    </div>

    <script>
        function openPreview(url, title) {
            document.getElementById('previewTitle').innerText = title;
            document.getElementById('previewFrame').src = url;
            document.getElementById('previewBackdrop').classList.add('show');
            document.getElementById('previewModal').classList.add('open');
        }

        function closePreview() {
            document.getElementById('previewBackdrop').classList.remove('show');
            document.getElementById('previewModal').classList.remove('open');
            setTimeout(() => {
                document.getElementById('previewFrame').src = '';
            }, 300);
        }
    </script>
</body>
</html>
