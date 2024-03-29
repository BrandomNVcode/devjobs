<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Experiencia;
use App\Salario;
use App\Ubicacion;
use App\Vacante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class VacanteController extends Controller
{


    public function __construct()
    {
        $this->middleware(['auth' ,'verified']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Consultas
        $categorias = Categoria::all();
        $experiencias = Experiencia::all();
        $ubicaciones = Ubicacion::all();
        $salarios = Salario::all();

        return view('vacantes.create')
            ->with('categorias', $categorias)
            ->with('experiencias', $experiencias)
            ->with('ubicaciones', $ubicaciones)
            ->with('salarios', $salarios);
    }




    public function store(Request $request)
    {

        $request->validate([
            "titulo" => "required|min:2",
            "categoria" => "required",
            "experiencia" => "required",
            "ubicacion" => "required",
            "salario" => "required",
            "descripcion" => "required|min:50",
            "imagen" => "required",
            "skills" => "required"
        ]);

        return "desde store";
    }


    

    public function show(Vacante $vacante)
    {
        //
    }


    

    public function edit(Vacante $vacante)
    {
        //
    }


    

    public function update(Request $request, Vacante $vacante)
    {
        //
    }


    

    public function destroy(Vacante $vacante)
    {
        //
    }



    public function imagen(Request $request)
    {

        $imagen = $request->file('file');
        $nombreImg = time() . "." . $imagen->extension();
        $imagen->move(public_path('storage/vacantes'), $nombreImg);

        //return request()->all();
        return response()->json(["correcto" => $nombreImg]);
    }


    public function borrarimagen(Request $request)
    {   
        if($request->ajax()) { // es una peticion de ajax?
            $imagen = $request->get("imagen");
            //$rutaServer = 'vacantes/' . $imagen;
            if(File::exists(public_path("storage/vacantes/".$imagen))) {
                File::delete(public_path("storage/vacantes/".$imagen));

                return response("Imagen Eliminada", 200);
            }

            return response("Imagen no existe", 200);
        }

        return response(("No se elimino, no es una peticion ajax"), 200);
    }


}
