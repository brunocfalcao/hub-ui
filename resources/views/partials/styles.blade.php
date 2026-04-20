{{-- Hub UI Theme Styles --}}
<style>
    /* Dark mode (default) */
    :root {
{!! \HubUI\Theme::cssVariables('dark') !!}
    }

    /* Light mode */
    :root.light {
{!! \HubUI\Theme::cssVariables('light') !!}
    }

    [x-cloak] { display: none !important; }

    /* ── Navigate fade animation ── */
    @keyframes navigateFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    .navigate-fade { animation: navigateFadeIn 300ms ease-in-out; }

    /* ── Surface utilities ── */
    .ui-bg-body     { background-color: rgb(var(--ui-bg-body)); }
    .ui-bg-sidebar  { background-color: rgb(var(--ui-bg-sidebar)); }
    .ui-bg-card     { background-color: rgb(var(--ui-bg-card)); }
    .ui-bg-input    { background-color: rgb(var(--ui-bg-input)); }
    .ui-bg-elevated { background-color: rgb(var(--ui-bg-elevated)); }

    /* ── Border utilities ── */
    .ui-border       { border-color: rgb(var(--ui-border)); }
    .ui-border-light { border-color: rgb(var(--ui-border-light)); }

    /* ── Text utilities ── */
    .ui-text        { color: rgb(var(--ui-text)); }
    .ui-text-muted  { color: rgb(var(--ui-text-muted)); }
    .ui-text-subtle { color: rgb(var(--ui-text-subtle)); }

    /* ── Semantic color utilities ── */
    .ui-text-primary   { color: rgb(var(--ui-primary)); }
    .ui-text-secondary { color: rgb(var(--ui-secondary)); }
    .ui-text-success   { color: rgb(var(--ui-success)); }
    .ui-text-warning   { color: rgb(var(--ui-warning)); }
    .ui-text-danger    { color: rgb(var(--ui-danger)); }
    .ui-text-info      { color: rgb(var(--ui-info)); }

    .ui-bg-primary   { background-color: rgb(var(--ui-primary)); }
    .ui-bg-secondary { background-color: rgb(var(--ui-secondary)); }
    .ui-bg-success   { background-color: rgb(var(--ui-success)); }
    .ui-bg-warning   { background-color: rgb(var(--ui-warning)); }
    .ui-bg-danger    { background-color: rgb(var(--ui-danger)); }
    .ui-bg-info      { background-color: rgb(var(--ui-info)); }

    /* ── Form input base ── */
    .ui-input {
        background-color: rgb(var(--ui-bg-input));
        border-color: rgb(var(--ui-border));
        color: rgb(var(--ui-text));
        --tw-ring-offset-color: rgb(var(--ui-ring-offset));
    }
    .ui-input:focus {
        border-color: rgb(var(--ui-primary));
        --tw-ring-color: rgb(var(--ui-primary));
    }
    .ui-input::placeholder {
        color: rgb(var(--ui-text-subtle));
    }
    .ui-input-error {
        border-color: rgb(var(--ui-danger)) !important;
        background-color: rgb(var(--ui-danger) / 0.05);
    }
    .ui-input-error:focus {
        --tw-ring-color: rgb(var(--ui-danger));
    }

    .ui-label    { color: rgb(var(--ui-text-muted)); }
    .ui-hint     { color: rgb(var(--ui-text-subtle)); }
    .ui-required { color: rgb(var(--ui-primary)); }
    .ui-error    { color: rgb(var(--ui-danger)); }

    /* ── Checkbox ── */
    .ui-checkbox {
        border-color: rgb(var(--ui-border));
        background-color: rgb(var(--ui-bg-input));
        color: rgb(var(--ui-primary));
        --tw-ring-offset-color: rgb(var(--ui-ring-offset));
    }
    .ui-checkbox:focus {
        --tw-ring-color: rgb(var(--ui-primary));
    }

    /* ── Button variants ── */
    .ui-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-weight: 500;
        border-radius: 0.75rem;
        transition: all 150ms ease-in-out;
        cursor: pointer;
        border: 1px solid transparent;
    }
    .ui-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    .ui-btn-sm  { padding: 0.375rem 0.75rem; font-size: 0.75rem; }
    .ui-btn-md  { padding: 0.5rem 1rem; font-size: 0.875rem; }
    .ui-btn-lg  { padding: 0.625rem 1.25rem; font-size: 1rem; }

    .ui-btn-primary {
        background-color: rgb(var(--ui-primary));
        color: #fff;
    }
    .ui-btn-primary:hover:not(:disabled) {
        background-color: rgb(var(--ui-primary-hover));
    }

    .ui-btn-secondary {
        background-color: rgb(var(--ui-bg-input));
        border-color: rgb(var(--ui-border));
        color: rgb(var(--ui-text));
    }
    .ui-btn-secondary:hover:not(:disabled) {
        background-color: rgb(var(--ui-bg-elevated));
    }

    .ui-btn-danger {
        background-color: rgb(var(--ui-danger));
        color: #fff;
    }
    .ui-btn-danger:hover:not(:disabled) {
        background-color: rgb(var(--ui-danger-hover));
    }

    .ui-btn-ghost {
        background-color: transparent;
        color: rgb(var(--ui-text-muted));
    }
    .ui-btn-ghost:hover:not(:disabled) {
        background-color: rgb(var(--ui-bg-elevated));
        color: rgb(var(--ui-text));
    }

    .ui-btn-link {
        background-color: transparent;
        color: rgb(var(--ui-primary));
        padding: 0;
        border: none;
    }
    .ui-btn-link:hover:not(:disabled) {
        color: rgb(var(--ui-primary-hover));
        text-decoration: underline;
    }

    /* ── Card ── */
    .ui-card {
        background-color: rgb(var(--ui-bg-card));
        border: 1px solid rgb(var(--ui-border));
        border-radius: 1rem;
    }
    .ui-card-header {
        border-bottom: 1px solid rgb(var(--ui-border));
    }
    .ui-card-footer {
        border-top: 1px solid rgb(var(--ui-border));
    }

    /* ── Alert types ── */
    .ui-alert-info    { color: rgb(var(--ui-info));    background-color: rgb(var(--ui-info) / 0.1);    border-color: rgb(var(--ui-info) / 0.3); }
    .ui-alert-success { color: rgb(var(--ui-success)); background-color: rgb(var(--ui-success) / 0.1); border-color: rgb(var(--ui-success) / 0.3); }
    .ui-alert-warning { color: rgb(var(--ui-warning)); background-color: rgb(var(--ui-warning) / 0.1); border-color: rgb(var(--ui-warning) / 0.3); }
    .ui-alert-error   { color: rgb(var(--ui-danger));  background-color: rgb(var(--ui-danger) / 0.1);  border-color: rgb(var(--ui-danger) / 0.3); }
    .ui-alert-danger  { color: rgb(var(--ui-danger));  background-color: rgb(var(--ui-danger) / 0.1);  border-color: rgb(var(--ui-danger) / 0.3); }

    /* ── Badge types ── */
    .ui-badge-default   { background-color: rgb(var(--ui-bg-elevated)); color: rgb(var(--ui-text-muted)); }
    .ui-badge-primary   { background-color: rgb(var(--ui-primary)); color: #fff; }
    .ui-badge-secondary { background-color: rgb(var(--ui-secondary)); color: #fff; }
    .ui-badge-success   { background-color: rgb(var(--ui-success)); color: #fff; }
    .ui-badge-warning   { background-color: rgb(var(--ui-warning)); color: #fff; }
    .ui-badge-danger    { background-color: rgb(var(--ui-danger)); color: #fff; }
    .ui-badge-info      { background-color: rgb(var(--ui-info)); color: #fff; }
    .ui-badge-online    { background-color: rgb(var(--ui-success)); color: #fff; }
    .ui-badge-offline   { background-color: rgb(var(--ui-bg-elevated)); color: rgb(var(--ui-text-muted)); }
    .ui-badge-pending   { background-color: rgb(var(--ui-primary) / 0.8); color: #fff; }

    /* ── Status indicator ── */
    .ui-status-dot { background-color: var(--status-color); }
    .ui-status-text { color: var(--status-color); }

    /* ── Modal / Elevated surfaces ── */
    .ui-elevated {
        background-color: rgb(var(--ui-bg-elevated));
        border: 1px solid rgb(var(--ui-border));
    }

    /* ── Dropdown ── */
    .ui-dropdown {
        background-color: rgb(var(--ui-bg-elevated));
        border: 1px solid rgb(var(--ui-border));
    }
    .ui-dropdown-link {
        color: rgb(var(--ui-text-muted));
    }
    .ui-dropdown-link:hover {
        background-color: rgb(var(--ui-bg-card));
        color: rgb(var(--ui-text));
    }

    /* ── Sidebar ── */
    .ui-sidebar-text       { color: rgb(var(--ui-text-subtle)); }
    .ui-sidebar-text-active { color: rgb(var(--ui-text)); }
    .ui-sidebar-tile       { background-color: rgb(var(--ui-bg-elevated)); }

    /* ── Data table ── */
    .ui-table {
        border-color: rgb(var(--ui-border));
    }
    .ui-table th {
        color: rgb(var(--ui-text-muted));
        border-bottom: 1px solid rgb(var(--ui-border));
    }
    .ui-table td {
        color: rgb(var(--ui-text));
        border-bottom: 1px solid rgb(var(--ui-border) / 0.5);
    }
    .ui-table tr:hover td {
        background-color: rgb(var(--ui-bg-elevated) / 0.5);
    }

    /* ── Keycap ── */
    .ui-kbd {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 1.25rem;
        height: 1.25rem;
        padding: 0 0.375rem;
        font-family: 'JetBrains Mono', ui-monospace, monospace;
        font-size: 0.6875rem;
        font-weight: 500;
        color: rgb(var(--ui-text-muted));
        background-color: rgb(var(--ui-bg-elevated));
        border: 1px solid rgb(var(--ui-border));
        border-bottom-width: 2px;
        border-radius: 0.25rem;
        line-height: 1;
    }

    /* ── Tabular nums ── */
    .ui-tabular { font-variant-numeric: tabular-nums; }

    /* ── Subtle divider line ── */
    .ui-divider-v {
        width: 1px;
        align-self: stretch;
        background-color: rgb(var(--ui-border));
    }

    /* ── Ticker shimmer (subtle animation for 'alive' elements) ── */
    @keyframes uiShimmer {
        0% { background-position: -200% 0; }
        100% { background-position: 200% 0; }
    }
    .ui-shimmer {
        background: linear-gradient(
            90deg,
            rgb(var(--ui-bg-elevated)) 0%,
            rgb(var(--ui-border-light)) 50%,
            rgb(var(--ui-bg-elevated)) 100%
        );
        background-size: 200% 100%;
        animation: uiShimmer 1.6s ease-in-out infinite;
    }

    /* ── Pulse ring accent (for status indicators and live moments) ── */
    @keyframes uiPulseRing {
        0% { box-shadow: 0 0 0 0 rgb(var(--ui-success) / 0.5); }
        70% { box-shadow: 0 0 0 6px rgb(var(--ui-success) / 0); }
        100% { box-shadow: 0 0 0 0 rgb(var(--ui-success) / 0); }
    }
    .ui-pulse-ring { animation: uiPulseRing 2.2s ease-out infinite; }

    /* ── Scrollbar ── */
    .ui-scrollbar::-webkit-scrollbar { width: 8px; height: 8px; }
    .ui-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .ui-scrollbar::-webkit-scrollbar-thumb {
        background: rgb(var(--ui-border));
        border-radius: 4px;
        border: 2px solid transparent;
        background-clip: padding-box;
    }
    .ui-scrollbar::-webkit-scrollbar-thumb:hover {
        background: rgb(var(--ui-border-light));
        border: 2px solid transparent;
        background-clip: padding-box;
    }
    /* Firefox fallback */
    @supports not selector(::-webkit-scrollbar) {
        .ui-scrollbar {
            scrollbar-width: thin;
            scrollbar-color: rgb(var(--ui-border)) transparent;
        }
    }
</style>
