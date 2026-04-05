{{-- Hub UI Theme Script (inline, synchronous — prevents FOUC) --}}
<script>
    (function() {
        var stored = localStorage.getItem('hub-ui-theme');
        var defaultMode = '{{ config("hub-ui.theme.default_mode", "dark") }}';
        var preference = stored || defaultMode;

        function apply(mode) {
            document.documentElement.classList.toggle('light', mode === 'light');
        }

        apply(preference);

        window.hubUiSetTheme = function(mode) {
            localStorage.setItem('hub-ui-theme', mode);
            apply(mode);
        };

        window.hubUiToggleTheme = function() {
            var current = document.documentElement.classList.contains('light') ? 'light' : 'dark';
            window.hubUiSetTheme(current === 'dark' ? 'light' : 'dark');
        };

        window.hubUiGetTheme = function() {
            return document.documentElement.classList.contains('light') ? 'light' : 'dark';
        };
    })();
</script>
