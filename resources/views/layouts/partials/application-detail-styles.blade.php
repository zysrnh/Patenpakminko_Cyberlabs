{{-- ═══════════════════════════════════════════════════════
     PATEN PAK MIKO — Shared Styles & UX Enhancement for Application Show Pages
     resources/views/layouts/partials/application-detail-styles.blade.php
     ═══════════════════════════════════════════════════════ --}}

<style>
    @keyframes appDetailFadeUp {
        from { opacity: 0; transform: translateY(8px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    :root {
        --clr-blue:     #218AC9;
        --clr-blue-dk:  #003B64;
        --clr-blue-lt:  #E3F0F9;
        --clr-yellow:   #FFCB05;
        --clr-green:    #16A34A;
        --clr-green-dk: #15803D;
        --clr-green-lt: #DCFCE7;
        --clr-ink:      #003B64;
        --clr-mid:      #334155;
        --clr-muted:    #64748B;
        --clr-line:     #D6E4EF;
        --clr-surface:  #F4F7FA;
        --clr-white:    #FFFFFF;
        --clr-primary:  #003B64;
    }

    fieldset {
        border: none;
        padding: 0;
        margin: 0;
        min-width: 0;
    }

    /* Flatpickr overrides */
    .flatpickr-calendar .flatpickr-day.flatpickr-disabled:not(.prevMonthDay):not(.nextMonthDay) {
        color: #DC2626 !important;
        background-color: #FEF2F2 !important;
        font-weight: 700 !important;
        opacity: 1 !important;
        border-radius: 4px;
    }
    textarea[name="custom_wa_message"] {
        display: none !important;
    }
    .form-control-v.flatpickr-input[readonly],
    .flatpickr-input[readonly] {
        background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="%23003B64"><path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20a2 2 0 0 0 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/></svg>');
        background-repeat: no-repeat;
        background-position: right 10px center;
        padding-right: 36px;
        cursor: pointer;
        background-color: #FFFFFF;
    }

    /* ─── TOP WORKSPACE HERO CARD (WITH INLINE SLA) ─────────── */
    .detail-hero-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 16px 20px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 18px;
        flex-wrap: wrap;
        animation: appDetailFadeUp .22s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .detail-hero-left {
        flex: 1;
        min-width: 260px;
    }
    .detail-hero-top-row {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 8px;
    }
    .detail-back-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        height: 28px;
        padding: 0 10px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #F8FAFC;
        color: #003B64;
        font-size: 12px;
        font-weight: 700;
        text-decoration: none;
        transition: background .15s ease, border-color .15s ease, transform .1s ease;
    }
    .detail-back-btn:hover {
        background: #E3F0F9;
        border-color: #218AC9;
    }
    .detail-back-btn:active { transform: scale(0.97); }
    .detail-reg-pill {
        font-family: 'DM Mono', monospace;
        font-size: 11.5px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        border: 1px solid #BFD9EC;
        padding: 3px 9px;
        border-radius: 4px;
    }
    .detail-status-pill {
        display: inline-flex;
        align-items: center;
        font-size: 11.5px;
        font-weight: 700;
        padding: 3px 10px;
        border-radius: 4px;
        color: #FFFFFF;
    }
    .detail-hero-title {
        font-size: 18px;
        font-weight: 800;
        color: #003B64;
        letter-spacing: -0.02em;
        margin: 0 0 4px;
        line-height: 1.25;
    }
    .detail-hero-meta {
        font-size: 12.5px;
        color: #64748B;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .detail-hero-meta strong {
        color: #0F172A;
        font-weight: 700;
    }
    .detail-admin-tools {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 10px;
    }
    .detail-tool-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 30px;
        padding: 0 11px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #334155;
        font-family: inherit;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
        transition: background .15s ease, border-color .15s ease, color .15s ease, transform .1s ease;
    }
    .detail-tool-btn:hover {
        background: #F1F5F9;
        border-color: #94B8D4;
        color: #003B64;
    }
    .detail-tool-btn.is-open {
        background: #E3F0F9;
        border-color: #218AC9;
        color: #003B64;
    }
    .detail-tool-btn--warn.is-open {
        background: #FFF7ED;
        border-color: #FDBA74;
        color: #C2410C;
    }
    .detail-tool-btn:active { transform: scale(0.97); }

    .detail-hero-sla-slot {
        flex-shrink: 0;
    }
    /* Override floating-sla so it renders inline inside hero card cleanly without overlapping */
    .floating-sla {
        position: static !important;
        top: auto !important;
        right: auto !important;
        z-index: 1 !important;
        width: 260px !important;
        box-shadow: none !important;
        border-radius: 4px !important;
    }

    /* Collapsible Admin Drawers (Rollback / SLA Settings) */
    .admin-drawer-card {
        display: none;
        background: #FFFFFF !important;
        border: 1px solid #D6E4EF !important;
        border-radius: 4px !important;
        padding: 18px 20px !important;
        margin-bottom: 16px !important;
        box-shadow: none !important;
        animation: appDetailFadeUp .18s ease-out both;
    }
    .admin-drawer-card.is-open {
        display: block;
    }

    /* Banner Pertek & Final Cert (flat solid override) */
    .pertek-ready-banner {
        background: #ECFDF5 !important;
        border: 1px solid #A7F3D0 !important;
        border-radius: 4px !important;
        padding: 14px 18px !important;
        margin-bottom: 16px !important;
        box-shadow: none !important;
    }
    .pertek-ready-btn {
        background: #16A34A !important;
        box-shadow: none !important;
        border-radius: 4px !important;
    }
    .pertek-ready-btn:hover {
        background: #15803D !important;
        transform: none !important;
    }
    .btn-download-cert {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        background: #16A34A;
        color: #FFFFFF;
        padding: 12px 18px;
        border-radius: 4px;
        font-size: 13.5px;
        font-weight: 700;
        text-decoration: none;
        margin-bottom: 16px;
        transition: background .15s ease, transform .1s ease;
    }
    .btn-download-cert:hover { background: #15803D; color: #FFFFFF; }
    .btn-download-cert:active { transform: scale(0.99); }

    /* ─── WORKSPACE 2-COLUMN LAYOUT ──────────────────────────── */
    .layout-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.55fr) minmax(310px, 1fr);
        gap: 18px;
        align-items: start;
    }
    .ws-main-col {
        display: flex;
        flex-direction: column;
        gap: 16px;
        min-width: 0;
    }

    /* ─── CARDS & VERIFY PANELS ──────────────────────────────── */
    .card,
    .verify-card {
        background: #FFFFFF !important;
        border: 1px solid #D6E4EF !important;
        border-radius: 4px !important;
        padding: 20px 22px !important;
        box-shadow: none !important;
        margin-bottom: 16px;
        animation: appDetailFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .card:last-child,
    .verify-card:last-child {
        margin-bottom: 0;
    }
    .card-title,
    .verify-title {
        font-size: 14.5px !important;
        font-weight: 800 !important;
        color: #003B64 !important;
        margin: 0 0 14px !important;
        padding-bottom: 10px !important;
        border-bottom: 1px solid #E8F0F6 !important;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* Clean Verification Form Controls */
    .form-group-v {
        margin-bottom: 14px;
    }
    .form-group-v label {
        display: block;
        font-size: 12.5px;
        font-weight: 700;
        color: #003B64;
        margin-bottom: 6px;
    }
    .form-control-v,
    .form-select-v {
        width: 100%;
        padding: 9px 12px;
        font-family: inherit;
        font-size: 13px;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        background: #FFFFFF;
        color: #0F172A;
        outline: none;
        transition: border-color .15s ease, box-shadow .15s ease;
    }
    .form-control-v:focus,
    .form-select-v:focus {
        border-color: #218AC9;
        box-shadow: 0 0 0 2px #E3F0F9;
    }
    .form-grid-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 14px;
    }
    .btn-submit-v {
        background: #003B64;
        color: #FFFFFF;
        border: none;
        padding: 9px 18px;
        font-family: inherit;
        font-weight: 700;
        font-size: 13px;
        border-radius: 4px;
        cursor: pointer;
        transition: background .15s ease, transform .1s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: 8px;
    }
    .btn-submit-v:hover { background: #218AC9; }
    .btn-submit-v:active { transform: scale(0.98); }

    /* Step Radio Options & Checklist Chips */
    .verify-step-badge {
        background: #E3F0F9;
        color: #003B64;
        font-weight: 700;
        font-size: 10px;
        padding: 2px 7px;
        border-radius: 4px;
        text-transform: uppercase;
        margin-left: 6px;
        letter-spacing: 0.04em;
    }
    .bpn-panel-step {
        animation: appDetailFadeUp .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .ws-verify-stack > .bpn-panel-step:not(.verify-card) {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 20px 22px;
        margin-bottom: 16px;
    }

    /* ─── IDENTITAS KEY-VALUE 2 COLUMN GRID ──────────────────── */
    .detail-list {
        list-style: none;
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 10px 18px;
    }
    .detail-item {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        justify-content: flex-start;
        padding: 10px 12px;
        background: #F8FAFC;
        border: 1px solid #E8F0F6;
        border-radius: 4px;
        gap: 3px;
        font-size: 13px;
    }
    .detail-item--full {
        grid-column: 1 / -1;
        background: transparent;
        border: none;
        padding: 6px 0 0;
    }
    .detail-label {
        font-size: 11px;
        font-weight: 700;
        color: #64748B;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }
    .detail-val {
        font-weight: 700;
        color: #003B64;
        text-align: left;
        word-break: break-word;
    }
    .app-num {
        font-family: 'DM Mono', monospace;
        color: #218AC9;
        font-size: 13px;
    }
    .badge-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11.5px;
        font-weight: 700;
        padding: 3px 9px;
        border-radius: 4px;
        color: #FFFFFF;
    }

    /* ─── ENHANCED DOCUMENT CHECKLIST GRID ───────────────────── */
    .doc-check-card {
        background: #FFFFFF;
        border: 1px solid #D6E4EF;
        border-radius: 4px;
        padding: 18px 20px;
        animation: appDetailFadeUp .24s cubic-bezier(0.22, 1, 0.36, 1) .03s both;
    }
    .doc-check-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        padding-bottom: 10px;
        margin-bottom: 14px;
        border-bottom: 1px solid #E8F0F6;
    }
    .doc-check-head h2 {
        font-size: 14.5px;
        font-weight: 800;
        color: #003B64;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .doc-count-chip {
        font-size: 11px;
        font-weight: 700;
        color: #003B64;
        background: #E3F0F9;
        padding: 2px 8px;
        border-radius: 4px;
    }
    .doc-grid-list {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 8px;
    }
    .doc-file-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 9px 11px;
        border: 1px solid #E2E8F0;
        border-radius: 4px;
        background: #F8FAFC;
        transition: border-color .14s ease, background-color .14s ease;
        min-width: 0;
    }
    .doc-file-card:hover {
        border-color: #94B8D4;
        background: #F0F7FC;
    }
    .doc-file-info {
        display: flex;
        align-items: center;
        gap: 8px;
        min-width: 0;
        flex: 1;
    }
    .doc-file-icon {
        width: 28px;
        height: 28px;
        border-radius: 4px;
        background: #E3F0F9;
        color: #003B64;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .doc-file-name {
        font-size: 12px;
        font-weight: 600;
        color: #0F172A;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .doc-file-actions {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        flex-shrink: 0;
    }
    .doc-btn-preview {
        height: 26px;
        padding: 0 9px;
        border-radius: 4px;
        border: 1px solid #BFD9EC;
        background: #FFFFFF;
        color: #003B64;
        font-family: inherit;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: background .14s ease, border-color .14s ease;
    }
    .doc-btn-preview:hover {
        background: #003B64;
        border-color: #003B64;
        color: #FFFFFF;
    }
    .doc-btn-tab {
        width: 26px;
        height: 26px;
        border-radius: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #475569;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-size: 12px;
        transition: background .14s ease, color .14s ease;
    }
    .doc-btn-tab:hover {
        background: #E3F0F9;
        color: #003B64;
        border-color: #218AC9;
    }
    .btn-doc {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #003B64;
        text-decoration: none;
        font-weight: 700;
        font-size: 12px;
    }
    .btn-doc:hover { color: #218AC9; text-decoration: underline; }

    /* ─── DOCUMENT PREVIEW MODAL ─────────────────────────────── */
    @keyframes docModalIn {
        from { opacity: 0; transform: translateY(8px) scale(0.985); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }
    .doc-preview-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 30, 56, 0.58);
        z-index: 999999;
        align-items: center;
        justify-content: center;
        padding: 16px;
    }
    .doc-preview-backdrop.open {
        display: flex;
    }
    .doc-preview-box {
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 6px;
        width: 100%;
        max-width: 980px;
        height: calc(100vh - 48px);
        max-height: 780px;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: docModalIn .2s cubic-bezier(0.22, 1, 0.36, 1) both;
    }
    .doc-preview-head {
        background: #003B64;
        color: #FFFFFF;
        padding: 12px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-shrink: 0;
    }
    .doc-preview-title {
        font-size: 14px;
        font-weight: 700;
        color: #FFFFFF;
        margin: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .doc-preview-nav {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-shrink: 0;
    }
    .doc-prev-btn {
        height: 28px;
        padding: 0 10px;
        border-radius: 4px;
        border: 1px solid rgba(255,255,255,0.22);
        background: rgba(255,255,255,0.1);
        color: #FFFFFF;
        font-family: inherit;
        font-size: 11.5px;
        font-weight: 600;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .doc-prev-btn:hover:not(:disabled) { background: rgba(255,255,255,0.22); }
    .doc-prev-btn:disabled { opacity: 0.4; cursor: not-allowed; }
    .doc-preview-body {
        flex: 1;
        min-height: 0;
        background: #F1F5F9;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: auto;
        padding: 12px;
    }
    .doc-preview-body iframe {
        width: 100%;
        height: 100%;
        border: none;
        background: #FFFFFF;
        border-radius: 4px;
    }
    .doc-preview-body img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        border-radius: 4px;
    }

    /* ─── RIGHT COLUMN: TIMELINE (CLEAN FLAT) ────────────────── */
    .timeline-sticky-card {
        position: sticky;
        top: 74px;
        max-height: calc(100vh - 92px);
        overflow-y: auto;
        padding: 0 !important;
        display: flex;
        flex-direction: column;
    }
    .timeline-sticky-card::-webkit-scrollbar { width: 5px; }
    .timeline-sticky-card::-webkit-scrollbar-thumb { background: #CBD5E1; border-radius: 2px; }
    .timeline-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px 18px 14px;
        border-bottom: 1px solid #E8F0F6;
        background: #F8FAFC;
    }
    .timeline-service-logo {
        width: 42px;
        height: 42px;
        object-fit: contain;
        flex-shrink: 0;
        transform: none !important;
    }
    .timeline-service-label {
        font-size: 10px;
        font-weight: 700;
        color: #218AC9;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 2px;
    }
    .timeline-service-title {
        font-size: 13.5px;
        font-weight: 800;
        color: #003B64;
        line-height: 1.25;
    }
    .timeline-step-count {
        font-size: 11px;
        color: #64748B;
        font-weight: 600;
        margin-top: 2px;
    }
    .timeline {
        position: relative;
        padding: 16px 18px 16px 50px;
    }
    .timeline::before {
        content: '';
        position: absolute;
        top: 26px;
        left: 26px;
        bottom: 26px;
        width: 2px;
        background: #D6E4EF;
    }
    .timeline-step {
        position: relative;
        margin-bottom: 8px;
        border-radius: 4px;
        transition: background-color .15s ease;
    }
    .timeline-step:last-child { margin-bottom: 0; }
    .timeline-dot {
        position: absolute;
        left: -34px;
        top: 10px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #FFFFFF;
        border: 2px solid #CBD5E1;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0;
    }
    .timeline-content {
        border-radius: 4px;
        padding: 9px 12px;
        border: 1px solid transparent;
        transition: border-color .15s ease, background-color .15s ease;
    }
    .timeline-step:not(.completed):not(.active):not(.rejected) .timeline-content {
        padding: 6px 8px;
    }
    .timeline-title {
        font-size: 12.5px;
        font-weight: 700;
        color: #334155;
        margin-bottom: 2px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 6px;
    }
    .timeline-desc {
        font-size: 11px;
        color: #64748B;
        line-height: 1.45;
    }
    .timeline-step.completed .timeline-dot {
        background: #16A34A;
        border-color: #16A34A;
    }
    .timeline-step.completed .timeline-dot::after {
        content: '✓';
        color: #FFFFFF;
        font-size: 11px;
        font-weight: 800;
    }
    .timeline-step.completed .timeline-content {
        background: #F0FDF4;
        border-color: #BBF7D0;
    }
    .timeline-step.completed .timeline-title { color: #166534; }
    .timeline-step.completed .timeline-desc { color: #15803D; }

    .timeline-step.active .timeline-dot {
        border-color: #218AC9;
        background: #FFFFFF;
        box-shadow: 0 0 0 3px #E3F0F9;
    }
    .timeline-step.active .timeline-dot::after {
        content: '';
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #218AC9;
        display: block;
    }
    .timeline-step.active .timeline-content {
        background: #E3F0F9;
        border-color: #94B8D4;
        box-shadow: none;
    }
    .timeline-step.active .timeline-title { color: #003B64; }
    .timeline-step.active .timeline-desc { color: #334155; }

    .timeline-step.rejected .timeline-dot {
        background: #DC2626;
        border-color: #DC2626;
    }
    .timeline-step.rejected .timeline-dot::after {
        content: '✕';
        color: #FFFFFF;
        font-size: 10px;
        font-weight: 800;
    }
    .timeline-step.rejected .timeline-content {
        background: #FEF2F2;
        border-color: #FECACA;
    }
    .timeline-step.rejected .timeline-title { color: #991B1B; }

    .timeline-notes {
        margin-top: 6px;
        padding: 6px 10px;
        background: #FFFFFF;
        border: 1px solid #FECACA;
        color: #991B1B;
        font-size: 11px;
        border-radius: 4px;
        line-height: 1.45;
    }
    .timeline-step.completed .timeline-notes {
        border-color: #BBF7D0;
        color: #166534;
    }
    .timeline-step.viewing-step {
        outline: none !important;
        background: transparent !important;
        padding-left: 0 !important;
        margin-left: 0 !important;
    }
    .timeline-step.viewing-step .timeline-content {
        border-color: #003B64 !important;
        box-shadow: inset 3px 0 0 #003B64 !important;
    }
    .timeline-step.viewing-step .timeline-title::after {
        display: none !important;
    }
    .btn-cek-detail {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 6px;
        padding: 3px 8px;
        font-size: 10.5px;
        font-weight: 700;
        color: #003B64;
        background: #FFFFFF;
        border: 1px solid #CBD5E1;
        border-radius: 4px;
        cursor: pointer;
        transition: background .14s ease, border-color .14s ease;
    }
    .timeline-step.viewing-step .btn-cek-detail {
        background: #003B64;
        color: #FFFFFF;
        border-color: #003B64;
    }
    .global-nav-buttons {
        display: flex;
        justify-content: space-between;
        padding: 12px 18px;
        background: #F8FAFC;
        border-top: 1px solid #D6E4EF;
    }
    .btn-nav-global {
        padding: 6px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 4px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        border: 1px solid #CBD5E1;
        background: #FFFFFF;
        color: #003B64;
        box-shadow: none;
        transition: background .14s ease, border-color .14s ease;
    }
    .btn-nav-global:hover:not(:disabled) {
        background: #E3F0F9;
        border-color: #218AC9;
    }
    .btn-nav-global:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

    @media (max-width: 1024px) {
        .layout-grid {
            grid-template-columns: 1fr;
        }
        .timeline-sticky-card {
            position: static;
            max-height: none;
        }
    }
    @media (max-width: 768px) {
        .detail-hero-card {
            padding: 14px 16px;
        }
        .floating-sla {
            width: 100% !important;
        }
        .detail-hero-sla-slot {
            width: 100%;
        }
        .detail-list,
        .doc-grid-list,
        .form-grid-2 {
            grid-template-columns: 1fr !important;
        }
        .card, .verify-card, .doc-check-card {
            padding: 16px !important;
        }
    }
    @media (prefers-reduced-motion: reduce) {
        .detail-hero-card, .card, .verify-card, .doc-check-card, .bpn-panel-step, .doc-preview-box {
            animation: none !important;
        }
    }
</style>

<!-- Document Preview Modal -->
<div id="docPreviewModal" class="doc-preview-backdrop" role="dialog" aria-modal="true" aria-labelledby="docPreviewTitle">
    <div class="doc-preview-box">
        <div class="doc-preview-head">
            <h3 id="docPreviewTitle" class="doc-preview-title">Preview Berkas</h3>
            <div class="doc-preview-nav">
                <button type="button" id="docPrevBtn" class="doc-prev-btn">← Sebelumnya</button>
                <span id="docCounterText" style="font-size: 11px; color: #BFD9EC; font-weight: 600; padding: 0 4px;">1 / 1</span>
                <button type="button" id="docNextBtn" class="doc-prev-btn">Berikutnya →</button>
                <a id="docOpenTabLink" href="#" target="_blank" class="doc-prev-btn">Buka Tab ↗</a>
                <button type="button" onclick="closeDocPreviewModal()" class="doc-prev-btn" aria-label="Tutup preview">✕</button>
            </div>
        </div>
        <div class="doc-preview-body" id="docPreviewBody"></div>
    </div>
</div>

<script>
(function() {
    let docItems = [];
    let activeDocIdx = 0;

    function renderDocPreview(idx) {
        if (!docItems.length) return;
        activeDocIdx = Math.max(0, Math.min(idx, docItems.length - 1));
        const item = docItems[activeDocIdx];
        const titleEl = document.getElementById('docPreviewTitle');
        const counterEl = document.getElementById('docCounterText');
        const tabLink = document.getElementById('docOpenTabLink');
        const prevBtn = document.getElementById('docPrevBtn');
        const nextBtn = document.getElementById('docNextBtn');
        const bodyEl = document.getElementById('docPreviewBody');

        if (titleEl) titleEl.textContent = item.label;
        if (counterEl) counterEl.textContent = (activeDocIdx + 1) + ' / ' + docItems.length;
        if (tabLink) tabLink.href = item.url;
        if (prevBtn) prevBtn.disabled = activeDocIdx === 0;
        if (nextBtn) nextBtn.disabled = activeDocIdx === docItems.length - 1;

        if (bodyEl) {
            bodyEl.innerHTML = '';
            if (item.isImage) {
                const img = document.createElement('img');
                img.src = item.url;
                img.alt = item.label;
                bodyEl.appendChild(img);
            } else {
                const iframe = document.createElement('iframe');
                iframe.src = item.url;
                iframe.title = item.label;
                bodyEl.appendChild(iframe);
            }
        }
    }

    window.openDocPreviewModal = function(idx) {
        const modal = document.getElementById('docPreviewModal');
        if (!modal) return;
        if (modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }
        renderDocPreview(idx);
        modal.classList.add('open');
    };

    window.closeDocPreviewModal = function() {
        const modal = document.getElementById('docPreviewModal');
        const bodyEl = document.getElementById('docPreviewBody');
        if (modal) modal.classList.remove('open');
        if (bodyEl) bodyEl.innerHTML = '';
    };

    window.toggleAdminDrawer = function(type, btn) {
        const drawer = document.querySelector('.admin-drawer-card[data-drawer="' + type + '"]');
        if (!drawer) return;
        const isOpen = drawer.classList.toggle('is-open');
        if (btn) btn.classList.toggle('is-open', isOpen);
    };

    document.addEventListener('DOMContentLoaded', function() {
        // 1. Mount .floating-sla inside #detailSlaSlot
        const slaSlot = document.getElementById('detailSlaSlot');
        const floatingSla = document.querySelector('.floating-sla');
        if (slaSlot && floatingSla) {
            slaSlot.appendChild(floatingSla);
        }

        // 2. Transform sticky timeline card styling
        document.querySelectorAll('.layout-grid > div:last-child .card').forEach(function(el) {
            if (el.querySelector('.timeline')) {
                el.classList.add('timeline-sticky-card');
            }
        });

        // 3. Wrap verification panels + left detail card smoothly into left workspace
        const layoutGrid = document.querySelector('.layout-grid');
        if (layoutGrid) {
            const leftCol = layoutGrid.firstElementChild;
            if (leftCol) {
                leftCol.classList.add('ws-main-col');
                const rawSteps = Array.from(document.querySelectorAll('.bpn-panel-step, [id*="panel-"]')).filter(function(el) {
                    return el.closest('.layout-grid') === null && el.closest('main, .content') !== null;
                });
                const panelContainers = [];
                const seenContainers = new Set();
                rawSteps.forEach(function(el) {
                    const outerVerify = el.closest('.verify-card:not(.admin-drawer-card)');
                    const targetNode = outerVerify || el;
                    if (!seenContainers.has(targetNode)) {
                        seenContainers.add(targetNode);
                        panelContainers.push(targetNode);
                    }
                });
                const infoCard = leftCol.querySelector('.card');
                if (panelContainers.length && infoCard) {
                    const panelAnchor = document.createElement('div');
                    panelAnchor.className = 'ws-verify-stack';
                    panelContainers.forEach(function(p) {
                        panelAnchor.appendChild(p);
                    });
                    leftCol.insertBefore(panelAnchor, infoCard);
                }

                // Move Berkas Lampiran Persyaratan out of detail-list into dedicated visual doc-check-card
                const docItemsContainers = Array.from(leftCol.querySelectorAll('.detail-item')).filter(function(li) {
                    return li.textContent.includes('Berkas Lampiran Persyaratan');
                });
                docItemsContainers.forEach(function(docContainer) {
                    const card = document.createElement('div');
                    card.className = 'doc-check-card';

                    const head = document.createElement('div');
                    head.className = 'doc-check-head';

                    const h2 = document.createElement('h2');
                    h2.innerHTML = '<svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#218AC9" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg> <span>Pengecekan Berkas Persyaratan</span>';

                    const listGrid = document.createElement('div');
                    listGrid.className = 'doc-grid-list';

                    const rows = Array.from(docContainer.children).filter(function(ch) {
                        return ch.tagName === 'DIV';
                    });

                    rows.forEach(function(row) {
                        const labelEl = row.querySelector('span');
                        const labelText = labelEl ? labelEl.textContent.trim() : 'Dokumen';
                        const links = Array.from(row.querySelectorAll('a[href]'));
                        if (!links.length) return;

                        const primaryUrl = links[0].getAttribute('href');
                        const isDownloadOnly = primaryUrl && primaryUrl.includes('action=download');
                        const isImg = /\.(jpg|jpeg|png|gif|webp)(\?|$)/i.test(primaryUrl);
                        const idx = docItems.length;
                        if (!isDownloadOnly) {
                            docItems.push({ label: labelText, url: primaryUrl, isImage: isImg });
                        }

                        const fileCard = document.createElement('div');
                        fileCard.className = 'doc-file-card';

                        const info = document.createElement('div');
                        info.className = 'doc-file-info';
                        info.innerHTML = '<div class="doc-file-icon"><svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg></div><span class="doc-file-name" title="' + labelText.replace(/"/g, '&quot;') + '">' + labelText + '</span>';

                        const actions = document.createElement('div');
                        actions.className = 'doc-file-actions';

                        if (!isDownloadOnly) {
                            const prevBtn = document.createElement('button');
                            prevBtn.type = 'button';
                            prevBtn.className = 'doc-btn-preview';
                            prevBtn.textContent = 'Preview';
                            prevBtn.addEventListener('click', function() {
                                window.openDocPreviewModal(idx);
                            });
                            actions.appendChild(prevBtn);
                        }

                        links.forEach(function(a, linkIdx) {
                            const ext = document.createElement('a');
                            ext.href = a.getAttribute('href');
                            ext.target = '_blank';
                            ext.className = 'doc-btn-tab';
                            ext.title = a.textContent.trim() || 'Buka di Tab Baru';
                            ext.textContent = (links.length > 1 && linkIdx === 1) ? '⬇' : '↗';
                            actions.appendChild(ext);
                        });

                        fileCard.appendChild(info);
                        fileCard.appendChild(actions);
                        listGrid.appendChild(fileCard);
                    });

                    const countChip = document.createElement('span');
                    countChip.className = 'doc-count-chip';
                    countChip.textContent = rows.length + ' Berkas';

                    head.appendChild(h2);
                    head.appendChild(countChip);
                    card.appendChild(head);
                    card.appendChild(listGrid);

                    if (infoCard && infoCard.parentElement === leftCol) {
                        leftCol.insertBefore(card, infoCard);
                    }
                    docContainer.remove();
                });
            }
        }

        // Modal controls
        const pBtn = document.getElementById('docPrevBtn');
        const nBtn = document.getElementById('docNextBtn');
        const modal = document.getElementById('docPreviewModal');
        if (pBtn) pBtn.addEventListener('click', () => renderDocPreview(activeDocIdx - 1));
        if (nBtn) nBtn.addEventListener('click', () => renderDocPreview(activeDocIdx + 1));
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) window.closeDocPreviewModal();
            });
        }
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && modal.classList.contains('open')) {
                window.closeDocPreviewModal();
            }
        });
    });
})();
</script>
