/**
 * Confirmation Modal System
 *
 * Usage:
 *   window.showConfirmation({
 *     title: 'Delete All Files',
 *     message: 'This action cannot be undone.',
 *     confirmText: 'Delete',
 *     cancelText: 'Cancel',
 *     type: 'danger', // 'danger', 'warning', 'info'
 *     onConfirm: () => { ... },
 *     onCancel: () => { ... }
 *   });
 */

export function initConfirmation() {
    let currentOnConfirm = null;
    let currentOnCancel = null;

    const modal = document.getElementById('confirmation-modal');
    const backdrop = document.getElementById('confirmation-backdrop');
    const content = document.getElementById('confirmation-content');
    const titleEl = document.getElementById('confirmation-title');
    const messageEl = document.getElementById('confirmation-message');
    const confirmBtn = document.getElementById('confirmation-confirm');
    const cancelBtn = document.getElementById('confirmation-cancel');
    const iconEl = document.getElementById('confirmation-icon');

    if (!modal) {
        console.warn('Confirmation modal not found in DOM');
        return;
    }

    function show(options) {
        // Set content
        titleEl.textContent = options.title || 'Are you sure?';
        messageEl.textContent = options.message || '';
        confirmBtn.textContent = options.confirmText || 'Confirm';
        cancelBtn.textContent = options.cancelText || 'Cancel';

        // Store callbacks
        currentOnConfirm = options.onConfirm || null;
        currentOnCancel = options.onCancel || null;

        // Set type styling
        const type = options.type || 'danger';

        // Reset classes
        iconEl.className = 'flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center';
        confirmBtn.className = 'px-4 py-2 text-sm font-medium rounded-lg transition-colors';

        const svgEl = iconEl.querySelector('svg');

        if (type === 'danger') {
            iconEl.classList.add('bg-red-500/20');
            svgEl.setAttribute('class', 'w-5 h-5 text-red-400');
            confirmBtn.classList.add('bg-red-600', 'hover:bg-red-500', 'text-white');
        } else if (type === 'warning') {
            iconEl.classList.add('bg-amber-500/20');
            svgEl.setAttribute('class', 'w-5 h-5 text-amber-400');
            confirmBtn.classList.add('bg-amber-600', 'hover:bg-amber-500', 'text-white');
        } else {
            iconEl.classList.add('bg-blue-500/20');
            svgEl.setAttribute('class', 'w-5 h-5 text-blue-400');
            confirmBtn.classList.add('bg-blue-600', 'hover:bg-blue-500', 'text-white');
        }

        // Show modal
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';

        // Animate in
        requestAnimationFrame(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
            content.classList.remove('opacity-0', 'scale-95');
            content.classList.add('opacity-100', 'scale-100');
        });
    }

    function hide() {
        // Animate out
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        content.classList.remove('opacity-100', 'scale-100');
        content.classList.add('opacity-0', 'scale-95');

        // Hide after animation
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = '';
        }, 200);
    }

    function confirm() {
        if (currentOnConfirm) {
            currentOnConfirm();
        }
        hide();
    }

    function cancel() {
        if (currentOnCancel) {
            currentOnCancel();
        }
        hide();
    }

    // Event listeners
    confirmBtn.addEventListener('click', confirm);
    cancelBtn.addEventListener('click', cancel);
    backdrop.addEventListener('click', cancel);

    // Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            cancel();
        }
    });

    // Global function
    window.showConfirmation = show;
}
