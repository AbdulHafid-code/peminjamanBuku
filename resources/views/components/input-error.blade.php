@props(['name'])

@error($name)
    <p class="text-red-500 -mt-3">{{$message}}</p>
@enderror