@extends('layouts.app')


@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.4/min/dropzone.min.css"
      integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
      crossorigin="anonymous" referrerpolicy="no-referrer"
/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css"
      type="text/css" media="screen" charset="utf-8"
>
@endsection


@section('navegacion')
    @include('ui.adminnav')
@endsection


@section('content')

    <h1 class="text-2xl text-center mt-10">Nueva vacante</h1>

    <form 
        class="max-w-lg mx-auto my-10" enctype="multipart/form-data"
        action="{{ route("vacantes.store") }}"
        method="POST">
        @csrf
        
        <div class="mb-5">
            <label for="titulo" class="block text-gray-700 text-sm mb-2">Titulo vacante:</label>
            <input id="titulo"
                    type="text"
                    class="p-3 bg-gray-100 rounded form-imput w-full focus:outline focus:shadow-outline @error('titulo') is-invalid @enderror"
                    name="titulo"
                    placeholder="Ejm: Desarrollador Web.."
                    value="{{ old('titulo') }}"
            >
            @include('layouts.error', ["nombre" => "titulo"])
        </div>

        <div class="mb-5">
            <label for="categoria" class="block text-gray-700 text-sm mb-2">Categoria:</label>
            <select name="categoria" id="categoria"
                    class="block appearance-none w-full border border-gray-200 
                            text-gray-700 rounded leading-tight focus:outline-none 
                            focus:bg-white focus:border-gray-500 p-3 bg-gray-100"
            >
                <option disabled selected>-Seleccione categoria-</option>

                @foreach ($categorias as $item)
                    <option value="{{$item->id}}"
                            {{ (old('categoria') == $item->id)? 'selected' : ''}}
                        >{{$item->nombre}}</option>
                @endforeach
            </select>
            @include('layouts.error', ["nombre" => "categoria"])
        </div>

        <div class="mb-5">
            <label for="experiencia" class="block text-gray-700 text-sm mb-2">Experiencia:</label>
            <select name="experiencia" id="experiencia"
                    class="block appearance-none w-full border border-gray-200 
                            text-gray-700 rounded leading-tight focus:outline-none 
                            focus:bg-white focus:border-gray-500 p-3 bg-gray-100"
            >
                <option disabled selected>-Seleccione experiencia-</option>

                @foreach ($experiencias as $item)
                    <option value="{{$item->id}}"
                            {{ (old('experiencia') == $item->id)? 'selected' : ''}}
                        >{{$item->nombre}}</option>
                @endforeach
            </select>
            @include('layouts.error', ["nombre" => "experiencia"])
        </div>

        <div class="mb-5">
            <label for="ubicacion" class="block text-gray-700 text-sm mb-2">Ubicación:</label>
            <select name="ubicacion" id="ubicacion"
                    class="block appearance-none w-full border border-gray-200 
                            text-gray-700 rounded leading-tight focus:outline-none 
                            focus:bg-white focus:border-gray-500 p-3 bg-gray-100"
            >
                <option disabled selected>-Seleccione ubicación-</option>

                @foreach ($ubicaciones as $item)
                    <option value="{{$item->id}}"
                            {{ (old('ubicacion') == $item->id)? 'selected' : ''}}
                        >{{$item->nombre}}</option>
                @endforeach
            </select>
            @include('layouts.error', ["nombre" => "ubicacion"])
        </div>

        <div class="mb-5">
            <label for="salario" class="block text-gray-700 text-sm mb-2">Salario:</label>
            <select name="salario" id="salario"
                    class="block appearance-none w-full border border-gray-200 
                            text-gray-700 rounded leading-tight focus:outline-none 
                            focus:bg-white focus:border-gray-500 p-3 bg-gray-100"
            >
                <option disabled selected>-Seleccione salario-</option>

                @foreach ($salarios as $item)
                    <option value="{{$item->id}}"
                            {{ (old('salario') == $item->id)? 'selected' : ''}}
                        >{{$item->nombre}}</option>
                @endforeach
            </select>
            @include('layouts.error', ["nombre" => "salario"])
        </div>

        <div class="mb-5">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2">Descripción:</label>
            <div class="editable p-3 bg-gray-100 rounded form-imput w-full text-gray-700 focus:outline-none focus:bg-white"></div>
            <input type="hidden" name="descripcion" id="descripcion">
        </div>

        <div class="mb-5">
            <label for="skills" class="block text-gray-700 text-sm mb-2">Habilidades:</label>
            @php
                $skills = ['HTML5', 'CSS3', "JavaScript", "PHP", "JAVA", "C++", "Diseño Web"];
            @endphp
            <lista-skills :skills="{{json_encode($skills)}}"></lista-skills>
        </div>

        <div class="mb-5">
            <label for="dropzone" class="block text-gray-700 text-sm mb-2">Imagen Relacional:</label>
            <div id="dropzone" class="dropzone rounded bg-gray-100"></div>
            <input type="hidden" name="imagen" id="imagen">
        </div>

        <button type="submit"
                class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">
            Publicar vacante
        </button>
    </form>

@endsection


@section('scripts')

<!-- Dropzone -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.4/min/dropzone.min.js"
        integrity="sha512-dGvmY7yzI6BpkyUDPksBkw5cb0uthau1dhw/2ZHU9nezEFOArD4H1+yx141qmm+V/QSZFOOjF2p6nUhhy4HJ1g=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</script>

<!-- MediumEditor -->
<script src="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/js/medium-editor.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', () => {


        // MediumEditor
        var editor = new MediumEditor('.editable', {
            toolbar: {
                buttons: ['bold', 'italic', 'underline', /*'strikethrough', 'subscript', 'superscript'*/,
                          'orderedlist', 'unorderedlist',
                          'h2', 'h3',
                          'justifyLeft', 'justifyCenter', 'justifyRight',
                          'justifyFull'],
                static: true,
                sticky: true
            },
            placeholder: {
                text: "Información de la vacante"
            }
        });

        // subscribiendo los cambios (obteniendo los cambios en tiempo real)
        editor.subscribe('editableInput', function(eventObj, editable) {
            const contenido = editor.getContent();
            document.querySelector('#descripcion').value = contenido;
        });


        
    });
    
    // Dropzone
    Dropzone.options.dropzone = {
        url: '/vacantes/imagen',
        addRemoveLinks: true,
        dictRemoveFile: "Borrar archivo",
        dictDefaultMessage: "Sube aquí una imagen..",
        acceptedFiles: ".png,.jpg,.jpeg,.gif,.bmp",
        maxFiles: 1,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
        },
        success: function(file, response) { // respuesta de la ruta img
            //console.log(response.correcto);
            // coloca la respuesta del servidor en el input hidden
            document.querySelector("#imagen").value = response.correcto;

            // Añadir al objeto de archivo el nombre del servidor
            file.nombreServidor = response.correcto;
        },
        maxfilesexceeded: function(file) {
            if( this.files[1] != null ) { // si existe la posicion 1 (se subio 2 img)
                this.removeFile(this.files[0]); // eliminamos el archivo anterior
                this.addFile(file);
            }
        },
        removedfile: function(file, response) {
            //console.log('El archivo borrado fue: ', file);

            file.previewElement.parentNode.removeChild(file.previewElement);

            params = {
                imagen: file.nombreServidor
            };

            axios.post("/vacantes/borrarimagen", params)
                .then(respuesta => console.log(respuesta));
        }
    };

</script>
@endsection

