@props(['route', 'waType', 'btnText', 'btnColor' => 'var(--clr-blue)'])

<form action="{{ $route }}" method="POST" style="margin-top: 16px;">
    @csrf
    <input type="hidden" name="step" value="resend_wa">
    <input type="hidden" name="wa_type" value="{{ $waType }}">
    <div class="form-group-v" style="margin-bottom: 12px; text-align: left;">
        <label style="font-size: 11px; color: var(--clr-muted);">Edit Pesan WA (Opsional):</label>
        <textarea name="custom_wa_message" class="form-control-v" rows="2" placeholder="Tuliskan pesan khusus jika ingin mengganti template bawaan..."></textarea>
    </div>
    <button type="submit" class="btn-submit-v" style="background: {{ $btnColor }}; width: 100%; justify-content: center;">
        <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z"/></svg>
        {{ $btnText }}
    </button>
</form>
