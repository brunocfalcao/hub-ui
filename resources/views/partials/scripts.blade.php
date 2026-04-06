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

    /**
     * Hub UI Fetch — standard AJAX helper.
     *
     * Handles CSRF, JSON headers, response parsing, and error extraction.
     * Returns { ok, data } where data is the parsed JSON body.
     *
     * Usage:
     *   const { ok, data } = await hubUiFetch('/api/endpoint', { body: { key: 'value' } });
     *   if (!ok) console.error(data.error);
     *
     * Options:
     *   method  — HTTP method (default: 'POST')
     *   body    — Request body (will be JSON.stringified)
     *   headers — Extra headers (merged with defaults)
     */
    window.hubUiFetch = async function(url, options = {}) {
        var method = options.method || 'POST';
        var token = document.querySelector('meta[name="csrf-token"]');

        var headers = Object.assign({
            'Content-Type': 'application/json',
            'Accept': 'application/json',
        }, token ? { 'X-CSRF-TOKEN': token.getAttribute('content') } : {}, options.headers || {});

        var fetchOptions = { method: method, headers: headers };

        if (options.body && method !== 'GET') {
            fetchOptions.body = JSON.stringify(options.body);
        }

        try {
            var res = await fetch(url, fetchOptions);
            var data = await res.json();
            return { ok: res.ok, status: res.status, data: data };
        } catch (e) {
            return { ok: false, status: 0, data: { error: 'Network error. Please try again.' } };
        }
    };
</script>
