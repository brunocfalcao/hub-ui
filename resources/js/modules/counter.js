/**
 * Number counter factory for Alpine x-data.
 *
 * Usage:
 *   <span x-data="hubUiCounter()" x-effect="target = stats.total" x-text="shown.toLocaleString()"></span>
 *
 * Animates `shown` to `target` over ~600ms with a cubic ease-out. The first
 * assignment snaps without animation so initial paint matches the real value.
 */
export function registerCounter() {
    if (window.hubUiCounter) return;

    window.hubUiCounter = function (options = {}) {
        const duration = options.duration ?? 600;

        return {
            target: 0,
            shown: 0,
            _firstRun: true,
            _raf: null,
            init() {
                this.shown = Number(this.target) || 0;
                this.$watch('target', () => {
                    if (this._firstRun) {
                        this._firstRun = false;
                        this.shown = Number(this.target) || 0;
                        return;
                    }
                    this._animate();
                });
            },
            _animate() {
                if (this._raf) cancelAnimationFrame(this._raf);
                const from = Number(this.shown) || 0;
                const to = Number(this.target) || 0;
                if (from === to) return;
                const start = performance.now();
                const step = (ts) => {
                    const p = Math.min((ts - start) / duration, 1);
                    const eased = 1 - Math.pow(1 - p, 3);
                    this.shown = from + (to - from) * eased;
                    if (p < 1) {
                        this._raf = requestAnimationFrame(step);
                    } else {
                        this.shown = to;
                        this._raf = null;
                    }
                };
                this._raf = requestAnimationFrame(step);
            },
        };
    };
}
