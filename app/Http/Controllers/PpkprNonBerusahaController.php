<?php

namespace App\Http\Controllers;

use App\Models\PpkprApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PpkprNonBerusahaController extends Controller
{
    /**
     * Tampilkan daftar pengajuan PPKPR.
     */
    public function index()
    {
        $user = Auth::user();

        // Jika Pelaku Usaha, tampilkan permohonan miliknya sendiri
        if ($user->isPelakuUsaha()) {
            $applications = PpkprApplication::where('user_id', $user->id)
                ->orderBy('created_at', 'desc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika BPN, tampilkan permohonan yang menunggu verifikasi BPN
        if ($user->isBpn()) {
            $applications = PpkprApplication::where('status', 'menunggu_bpn')
                ->orderBy('created_at', 'asc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika Dinas PU, tampilkan permohonan yang menunggu verifikasi Dinas PU
        if ($user->isDinasPu()) {
            $applications = PpkprApplication::where('status', 'menunggu_dinas_pu')
                ->orderBy('created_at', 'asc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika Satu Pintu, tampilkan permohonan yang menunggu verifikasi Satu Pintu
        if ($user->isSatuPintu()) {
            $applications = PpkprApplication::where('status', 'menunggu_satu_pintu')
                ->orderBy('created_at', 'asc')
                ->get();
            return view('non-berusaha.index', compact('applications'));
        }

        // Jika DPN (Super Admin/Notifier), tampilkan semua permohonan
        if ($user->isDpn()) {
            $applications = PpkprApplication::orderBy('created_at', 'desc')->get();
            return view('non-berusaha.index', compact('applications'));
        }

        abort(403, 'Peran akun Anda tidak terdaftar dalam sistem.');
    }

    /**
     * Tampilkan form pengajuan baru.
     */
    public function create()
    {
        if (!Auth::user()->isPelakuUsaha()) {
            abort(403, 'Hanya Pelaku Usaha yang dapat membuat pengajuan permohonan.');
        }
        return view('non-berusaha.create');
    }

    /**
     * Simpan permohonan baru.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->isPelakuUsaha()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $request->validate([
            'applicant_name' => 'required|string|max:100',
            'applicant_nik' => 'required|numeric|digits:16',
            'location_address' => 'required|string|max:1000',
            'land_size' => 'required|integer|min:1',
            'coordinates' => 'required|string|max:100',
            'land_purpose' => 'required|string',
            
            // 5 Berkas Wajib
            'doc_ktp' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_sertifikat' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_pernyataan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_desain' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_foto_lapangan' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            
            // Berkas Opsional
            'doc_pbb' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_surat_kuasa' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_akta_yayasan' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_rekomendasi_tetangga' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'doc_pendukung' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ], [
            'applicant_nik.digits' => 'NIK harus tepat terdiri dari 16 digit.',
            'applicant_nik.numeric' => 'NIK harus berupa angka.',
            'doc_ktp.required' => 'Dokumen KTP wajib diunggah.',
            'doc_sertifikat.required' => 'Dokumen Sertifikat Tanah wajib diunggah.',
            'doc_pernyataan.required' => 'Surat Pernyataan Kebenaran wajib diunggah.',
            'doc_desain.required' => 'Dokumen Rencana Pembangunan/Desain wajib diunggah.',
            'doc_foto_lapangan.required' => 'Foto Lapangan wajib diunggah.',
        ]);

        $data = $request->only([
            'applicant_name', 'applicant_nik', 'location_address', 'land_size', 'coordinates', 'land_purpose'
        ]);

        $data['user_id'] = Auth::id();
        $data['status'] = 'menunggu_bpn';
        
        // Generate Nomor Permohonan
        $data['application_number'] = 'PPKPR-NON-' . date('Ymd') . '-' . strtoupper(Str::random(5));

        // Upload Berkas Wajib
        $data['doc_ktp'] = $request->file('doc_ktp')->store('ppkpr_docs', 'public');
        $data['doc_sertifikat'] = $request->file('doc_sertifikat')->store('ppkpr_docs', 'public');
        $data['doc_pernyataan'] = $request->file('doc_pernyataan')->store('ppkpr_docs', 'public');
        $data['doc_desain'] = $request->file('doc_desain')->store('ppkpr_docs', 'public');
        $data['doc_foto_lapangan'] = $request->file('doc_foto_lapangan')->store('ppkpr_docs', 'public');

        // Upload Berkas Opsional
        $optionalDocs = [
            'doc_pbb', 'doc_surat_kuasa', 'doc_akta_yayasan', 'doc_rekomendasi_tetangga', 'doc_pendukung'
        ];
        foreach ($optionalDocs as $docName) {
            if ($request->hasFile($docName)) {
                $data[$docName] = $request->file($docName)->store('ppkpr_docs', 'public');
            }
        }

        PpkprApplication::create($data);

        return redirect()->route('non-berusaha.index')->with('success', 'Permohonan PPKPR Non Berusaha Anda berhasil diajukan! Silakan pantau proses verifikasi.');
    }

    /**
     * Tampilkan detail permohonan.
     */
    public function show($id)
    {
        $application = PpkprApplication::findOrFail($id);
        $user = Auth::user();

        // Keamanan: Pelaku usaha hanya boleh melihat permohonannya sendiri
        if ($user->isPelakuUsaha() && $application->user_id !== $user->id) {
            abort(403, 'Anda tidak diizinkan mengakses permohonan ini.');
        }

        return view('non-berusaha.show', compact('application'));
    }

    /**
     * Proses Verifikasi oleh Instansi Terkait (Staged Verification).
     */
    public function verify(Request $request, $id)
    {
        $application = PpkprApplication::findOrFail($id);
        $user = Auth::user();

        $request->validate([
            'action' => 'required|in:approve,reject',
            'notes' => 'required|string|max:1000',
            'approval_document' => 'nullable|file|mimes:pdf|max:4096', // khusus Satu Pintu
        ], [
            'notes.required' => 'Catatan verifikasi wajib diisi.',
            'approval_document.mimes' => 'Dokumen PPKPR harus berformat PDF.',
            'approval_document.max' => 'Ukuran maksimal berkas dokumen adalah 4MB.',
        ]);

        $action = $request->input('action');
        $notes = $request->input('notes');

        // 1. Verifikasi oleh BPN
        if ($user->isBpn() && $application->status === 'menunggu_bpn') {
            $application->bpn_notes = $notes;
            if ($action === 'approve') {
                $application->status = 'menunggu_dinas_pu';
                $msg = 'Permohonan disetujui BPN. Berkas diteruskan ke Dinas PU.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh BPN.';
            }
        }
        // 2. Verifikasi oleh Dinas PU
        elseif ($user->isDinasPu() && $application->status === 'menunggu_dinas_pu') {
            $application->dinas_pu_notes = $notes;
            if ($action === 'approve') {
                $application->status = 'menunggu_satu_pintu';
                $msg = 'Permohonan disetujui Dinas PU (Tata Ruang). Berkas diteruskan ke Dinas Satu Pintu.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh Dinas PU.';
            }
        }
        // 3. Verifikasi oleh Dinas Satu Pintu (Penerbitan PPKPR)
        elseif ($user->isSatuPintu() && $application->status === 'menunggu_satu_pintu') {
            $application->satu_pintu_notes = $notes;
            if ($action === 'approve') {
                // Satu Pintu harus mengunggah dokumen PPKPR final
                if (!$request->hasFile('approval_document')) {
                    return redirect()->back()->withErrors(['approval_document' => 'Dokumen PPKPR Final dalam format PDF wajib diunggah saat menyetujui.']);
                }
                
                $path = $request->file('approval_document')->store('ppkpr_approvals', 'public');
                $application->approval_document = $path;
                $application->status = 'disetujui';
                $msg = 'Permohonan disetujui! Dokumen PPKPR resmi telah diterbitkan.';
            } else {
                $application->status = 'ditolak';
                $msg = 'Permohonan ditolak oleh Dinas Satu Pintu.';
            }
        } else {
            abort(403, 'Anda tidak memiliki otoritas untuk memverifikasi permohonan ini pada tahap saat ini.');
        }

        $application->save();

        return redirect()->route('non-berusaha.show', $id)->with('success', $msg);
    }
}
