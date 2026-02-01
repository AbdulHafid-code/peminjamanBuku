@props([
     'href',
     'edit' => false,
     'update' => false,
])

@if ($update)
     <button type="submit" class="rounded-sm bg-violet-600 px-5 py-2 text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2">
          <i class='bx bx-edit-alt' ></i> Edit
     </button>
@elseif (!$edit)
     <a href="{{ $href }}" class="rounded-sm bg-violet-600 px-5 py-2 text-sm font-medium text-white hover:bg-violet-700 flex items-center gap-2" >
          <i class='bx bx-edit-alt' ></i> Edit
     </a>
@else
    	<a href="{{$href}}" class="hidden md:flex items-center justify-center w-fit h-fit px-2 py-1.5 gap-2 rounded-md text-white bg-violet-700 hover:bg-violet-800"><i class='bx bx-edit-alt'></i> Edit</a>
@endif
