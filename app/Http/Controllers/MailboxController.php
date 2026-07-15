<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mailbox;
use Illuminate\Support\Facades\Auth;

class MailboxController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $query = Mailbox::query();

        if ($user->isPelakuUsaha()) {
            $query->where('target_user_id', $user->id);
        } elseif ($user->isBpn()) {
            $query->where('target_role', 'bpn');
        } elseif ($user->isDinasPu()) {
            $query->where('target_role', 'dinas_pu');
        } elseif ($user->isSatuPintu()) {
            $query->where('target_role', 'satu_pintu');
        } else {
            // Fallback for other roles
            $query->where('target_user_id', $user->id);
        }

        $mailboxes = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('mailbox.index', compact('mailboxes'));
    }

    public function read($id)
    {
        $mailbox = Mailbox::findOrFail($id);
        
        // Simple authorization check
        $user = Auth::user();
        $authorized = false;
        if ($user->isPelakuUsaha() && $mailbox->target_user_id === $user->id) $authorized = true;
        if ($user->isBpn() && $mailbox->target_role === 'bpn') $authorized = true;
        if ($user->isDinasPu() && $mailbox->target_role === 'dinas_pu') $authorized = true;
        if ($user->isSatuPintu() && $mailbox->target_role === 'satu_pintu') $authorized = true;
        
        if ($authorized) {
            $mailbox->is_read = true;
            $mailbox->save();
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        if ($mailbox->link) {
            return redirect($mailbox->link);
        }

        return redirect()->back();
    }
    
    public function markAllAsRead()
    {
        $user = Auth::user();
        $query = Mailbox::query();

        if ($user->isPelakuUsaha()) {
            $query->where('target_user_id', $user->id);
        } elseif ($user->isBpn()) {
            $query->where('target_role', 'bpn');
        } elseif ($user->isDinasPu()) {
            $query->where('target_role', 'dinas_pu');
        } elseif ($user->isSatuPintu()) {
            $query->where('target_role', 'satu_pintu');
        }

        $query->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Semua pesan telah ditandai sudah dibaca.');
    }

    public function getUnread()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false], 401);
        }

        $query = Mailbox::query()->where('is_read', false);

        if ($user->isPelakuUsaha()) {
            $query->where('target_user_id', $user->id);
        } elseif ($user->isBpn()) {
            $query->where('target_role', 'bpn');
        } elseif ($user->isDinasPu() || $user->isDinasPutr()) {
            $query->where('target_role', 'dinas_pu');
        } elseif ($user->isSatuPintu()) {
            $query->where('target_role', 'satu_pintu');
        } else {
            // Untuk DPN atau role lain jika dikirim langsung via target_user_id
            $query->where('target_user_id', $user->id);
        }

        $mailboxes = $query->orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $mailboxes
        ]);
    }
}
