@props([
    'href',
    'store' => false
])

@if (!$store)
    <a href="{{$href}}" class="flex items-center gap-2 w-fit h-fit p-2.5 font-medium text-white bg-violet-600 rounded-sm">
        <i class='bx bx-plus' ></i> {{$slot}} 
    </a>
@else
    <button type="submit" class="rounded-sm bg-violet-600 px-5 py-2 text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2">
        <i class='bx bx-plus' ></i> Tambah
    </button>
@endif
