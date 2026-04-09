/**
 * Toast Notification System (with stacking support)
 *
 * Usage:
 *   window.showToast('Profile updated!', 'success');
 *   window.showToast('An error occurred', 'error');
 *   window.showToast('Please wait...', 'info');
 */

export function initToast() {
    let toastCounter = 0;

    /**
     * Show a toast notification (creates new toast element for stacking)
     *
     * @param {string} message - The message to display
     * @param {string} type - The type: 'success', 'error', 'info', 'warning'
     * @param {number} duration - Duration in milliseconds (default: 10000)
     */
    window.showToast = function(message, type = 'success', duration = 10000) {
        const container = document.getElementById('toast-container');

        if (!container) {
            console.warn('Toast container not found in DOM');
            return;
        }

        // Create unique toast ID
        const toastId = `toast-${++toastCounter}`;

        // Determine icon based on type
        const icons = {
            success: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>',
            error: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>',
            warning: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>',
            info: '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>',
        };

        // Map type to CSS variable
        const colorVar = {
            success: '--ui-success',
            error: '--ui-danger',
            warning: '--ui-warning',
            info: '--ui-info',
        }[type] || '--ui-info';

        const iconSvg = icons[type] || icons.info;

        // Create toast element
        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = 'opacity-0 translate-x-[50px] transition-all duration-300 transform pointer-events-auto cursor-pointer';

        toast.innerHTML = `
            <div class="rounded-lg backdrop-blur-sm px-6 py-3 text-sm shadow-lg flex items-center gap-3 min-w-[300px] max-w-[500px]"
                 style="border: 1px solid rgb(var(${colorVar}) / 0.3); background-color: rgb(var(${colorVar}) / 0.1); color: rgb(var(${colorVar}))">
                <span class="h-5 w-5 shrink-0" style="color: rgb(var(${colorVar}) / 0.8)">
                    ${iconSvg}
                </span>
                <span class="flex-1" style="color: rgb(var(${colorVar}))">${message}</span>
            </div>
        `;

        // Add to container
        container.appendChild(toast);

        // Trigger animation (after DOM insertion)
        requestAnimationFrame(function() {
            toast.classList.remove('opacity-0', 'translate-x-[50px]');
            toast.classList.add('opacity-100', 'translate-x-0');
        });

        // Function to remove toast
        const removeToast = function() {
            const currentHeight = toast.offsetHeight;

            toast.classList.remove('opacity-100', 'translate-x-0');
            toast.classList.add('opacity-0', 'translate-x-[50px]');

            // Pull the toast up by its full height plus gap
            toast.style.marginTop = `-${currentHeight + 12}px`; // 12px = gap-3

            // Remove from DOM after animation
            setTimeout(function() {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 300);
        };

        // Allow clicking toast to dismiss
        toast.addEventListener('click', removeToast);

        // Auto-hide after duration
        if (duration > 0) {
            setTimeout(removeToast, duration);
        }
    };

    /**
     * Hide all toast notifications
     */
    window.hideAllToasts = function() {
        const container = document.getElementById('toast-container');
        if (container) {
            while (container.firstChild) {
                container.removeChild(container.firstChild);
            }
        }
    };
}
