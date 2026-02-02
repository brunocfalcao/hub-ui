/**
 * UI Skeleton - Main Entry Point
 *
 * This file exports the toast and confirmation modules for use in your application.
 *
 * Usage in your app.js:
 *
 *   import { initToast, initConfirmation } from './vendor/ui-skeleton/ui-skeleton.js';
 *
 *   // Initialize on page load
 *   document.addEventListener('DOMContentLoaded', function() {
 *       initToast();
 *       initConfirmation();
 *   });
 *
 *   // Or with Turbo/Livewire:
 *   document.addEventListener('turbo:load', function() {
 *       initToast();
 *       initConfirmation();
 *   });
 */

export { initToast } from './modules/toast.js';
export { initConfirmation } from './modules/confirmation.js';
