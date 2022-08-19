@error($nombre)
    <div class="bg-red-100 border border-red-400 text-red-500 px-4 py-3 rounded relative mt-3 mb-6" role="alert">
        <strong class="font-bold">!Error.. </strong>
        <span class="block">{{$message}}</span>
    </div>
@enderror