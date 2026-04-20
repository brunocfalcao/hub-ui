@props([
    'widthModel' => 'sidebarWidth',
    'resizeFn' => 'startSidebarResize',
])

{{-- Sidebar pane --}}
<div
    class="flex-shrink-0 border-r ui-border overflow-hidden flex flex-col ui-bg-sidebar"
    :style="'width:' + {{ $widthModel }} + 'px'"
>
    {{ $slot }}
</div>

{{-- Resize Handle --}}
<div
    class="w-1 flex-shrink-0 cursor-col-resize relative transition-colors hub-ui-resize-handle"
    @mousedown.prevent="{{ $resizeFn }}($event)"
>
    <div class="absolute inset-y-0 -left-1 -right-1"></div>
</div>

@once
    <style>
        .hub-ui-resize-handle:hover {
            background-color: rgb(var(--ui-primary) / 0.3);
        }
    </style>
@endonce
