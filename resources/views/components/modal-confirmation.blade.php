{{-- Modal Confirmation Component --}}
{{-- Usage: window.showConfirmation({ title, message, confirmText, cancelText, type, onConfirm }) --}}

<div id="confirmation-modal" class="fixed inset-0 z-[9999] hidden">
    {{-- Backdrop with blur --}}
    <div id="confirmation-backdrop" class="absolute inset-0 bg-black/60 backdrop-blur-sm opacity-0 transition-opacity duration-200"></div>

    {{-- Modal --}}
    <div class="absolute inset-0 flex items-center justify-center p-4">
        <div id="confirmation-content" class="w-full max-w-md rounded-xl shadow-2xl opacity-0 scale-95 transition-all duration-200 ui-elevated" style="background-color: rgb(var(--ui-bg-card))">
            {{-- Header --}}
            <div class="p-6 pb-4">
                <div class="flex items-start gap-4">
                    <div id="confirmation-icon" class="flex-shrink-0 w-10 h-10 rounded-full flex items-center justify-center" style="background-color: rgb(var(--ui-danger) / 0.2)">
                        <svg class="w-5 h-5 ui-text-danger" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                        </svg>
                    </div>

                    <div class="flex-1">
                        <h3 id="confirmation-title" class="text-lg font-semibold ui-text">Are you sure?</h3>
                        <p id="confirmation-message" class="mt-2 text-sm ui-text-muted"></p>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 px-6 py-4" style="border-top: 1px solid rgb(var(--ui-border))">
                <button id="confirmation-cancel" class="ui-btn ui-btn-ghost ui-btn-md">
                    Cancel
                </button>
                <button id="confirmation-confirm" class="ui-btn ui-btn-danger ui-btn-md">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>
