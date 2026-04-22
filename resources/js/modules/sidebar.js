/**
 * Global Alpine store for the primary mobile sidebar. Using a store (instead
 * of x-data on the layout wrapper) keeps state decoupled from DOM nodes so
 * wire:navigate + @persist swaps don't strand bindings against a destroyed
 * scope.
 */
export function registerSidebarStore(Alpine) {
    if (!Alpine) return;
    if (Alpine.store('sidebar')) return;

    Alpine.store('sidebar', {
        open: false,
        isDesktop: window.matchMedia('(min-width: 1024px)').matches,

        init() {
            const mq = window.matchMedia('(min-width: 1024px)');
            mq.addEventListener('change', (e) => {
                this.isDesktop = e.matches;
                if (e.matches) this.open = false;
            });

            window.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') this.open = false;
            });

            document.addEventListener('livewire:navigated', () => {
                this.open = false;
            });
        },

        toggle() { this.open = !this.open; },
        close()  { this.open = false; },
    });
}
