{{-- Default Hub UI Logo --}}
{{-- Override by setting 'app.logo' in config/hub-ui.php --}}
<svg viewBox="0 0 40 40" {{ $attributes->merge(['class' => 'w-14 h-14 text-white']) }}>
    {{-- Center hub --}}
    <circle cx="20" cy="20" r="6" fill="#10b981"/>
    {{-- Corner nodes --}}
    <circle cx="8" cy="8" r="3" fill="currentColor" opacity="0.6"/>
    <circle cx="8" cy="32" r="3" fill="currentColor" opacity="0.6"/>
    <circle cx="32" cy="8" r="3" fill="currentColor" opacity="0.6"/>
    <circle cx="32" cy="32" r="3" fill="currentColor" opacity="0.6"/>
    {{-- Connection lines --}}
    <line x1="14" y1="16" x2="10" y2="10" stroke="currentColor" stroke-width="1.5" opacity="0.4"/>
    <line x1="14" y1="24" x2="10" y2="30" stroke="currentColor" stroke-width="1.5" opacity="0.4"/>
    <line x1="26" y1="16" x2="30" y2="10" stroke="currentColor" stroke-width="1.5" opacity="0.4"/>
    <line x1="26" y1="24" x2="30" y2="30" stroke="currentColor" stroke-width="1.5" opacity="0.4"/>
    {{-- Inner glow --}}
    <circle cx="20" cy="20" r="3" fill="#6ee7b7"/>
</svg>
