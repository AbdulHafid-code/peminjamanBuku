@props([
    'action',
    'trash' => false,
    'dataPesan' => "Apakah Anda Yakin Ingin Menghapus Data Ini"
])

@if (!$trash)
    <form action="{{$action}}" method="POST">
        @method('DELETE')
        @csrf
        <button id="btn-delete" data-pesan="{{$dataPesan}}" type="submit" class="rounded-sm bg-red-500 px-5 py-2 text-sm font-medium text-white hover:bg-red-600 flex items-center gap-2">
            <i class='bx bxs-trash' ></i> Hapus
        </button>
    </form>
@else
    <form action="{{$action}}" class="hidden md:block" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit" id="btn-delete" data-pesan="{{$dataPesan}}" class="hidden md:flex items-center justify-center px-2 py-2 gap-2 rounded-md bg-red-200 dark:bg-red-800/20 border border-red-600 text-red-800 dark:text-red-600 transition-all duration-300 hover:bg-red-600 hover:text-white" ><i class='bx bx-trash'></i></button>
    </form>
@endif
