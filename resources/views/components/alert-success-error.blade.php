@props([
    'type' => 'success',
    'session' => null
])

@if ($type == 'success' && $session)
    <div class="flex my-3 items-center gap-3 rounded-lg border border-green-300 bg-green-50 dark:bg-green-900/20 px-4 py-3 text-sm text-green-700 dark:text-green-400">
        <i class='bx bx-check-circle text-lg'></i>
        <span>{{ $session }}</span>
    </div>
@endif

@if ($type == 'error' && $session)
    <div class="flex my-3 items-center gap-3 rounded-lg border border-red-300 bg-red-50 dark:bg-red-900/20 px-4 py-3 text-sm text-red-700 dark:text-red-400">
        <i class='bx bx-x-circle text-lg'></i>
        <span>{{ $session }}</span>
    </div>
@endif
