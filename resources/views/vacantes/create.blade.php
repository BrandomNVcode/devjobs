@extends('layouts.app')


@section('styles')
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/css/medium-editor.min.css"
      type="text/css" media="screen" charset="utf-8">
@endsection


@section('navegacion')
    @include('ui.adminnav')
@endsection


@section('content')

    <h1 class="text-2xl text-center mt-10">Nueva vacante</h1>

    <form class="max-w-lg mx-auto my-10">
        <div class="mb-5">
            <label for="titulo" class="block text-gray-700 text-sm mb-2">Titulo vacante:</label>
            <input id="titulo"
                    type="text"
                    class="p-3 bg-gray-100 rounded form-imput w-full focus:outline focus:shadow-outline @error('titulo') is-invalid @enderror"
                    name="titulo"
            >
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
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
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
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
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
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
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
                    <option value="{{$item->id}}">{{$item->nombre}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-5">
            <label for="descripcion" class="block text-gray-700 text-sm mb-2">Descripción:</label>
            <div class="editable p-3 bg-gray-100 rounded form-imput w-full text-gray-700 focus:outline-none focus:bg-white"></div>
            <input type="hidden" name="descripcion" id="descripcion">
        </div>

        <button type="submit"
                class="bg-teal-500 w-full hover:bg-teal-600 text-gray-100 font-bold p-3 focus:outline focus:shadow-outline uppercase">
            Publicar vacante
        </button>
    </form>

@endsection


@section('scripts')
<script src="//cdn.jsdelivr.net/npm/medium-editor@latest/dist/js/medium-editor.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
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
</script>
@endsection

