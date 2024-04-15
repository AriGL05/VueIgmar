<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;
use Inertia\Inertia;
use Inertia\Response;

class AlumnosController extends Controller
{
    public function index() : Response {
        $alumnos = Alumno::with('carrera')->get();

        return Inertia::render('Alumnos/VerAlumnos', [
            'alumnos' => $alumnos,
        ]);
    }
    public function create() : Response {

        return Inertia::render('Alumnos/Create');
    }
    public function store(Request $request) {
        $request->validate([
            "name" => "required|min:3|max:30",
            "lastname" => "required|min:5|max:30",
            "genero" =>"required|max:1",
            "carrera_id"=>"required",
        ]);
        $alumn = new Alumno();
        $alumn->name = $request->get('name') ;
        $alumn->lastname = $request->get('lastname');
        $alumn->genero = $request->get('genero');
        $alumn->carrera_id = $request->get('carrera_id') ;
        $alumn->save();
        return redirect()->route('alumnos.veralumnos');
    }
    public function edit(int $id) : Response {
        $alumn = Alumno::find($id);
        if ($alumn){
        
            return Inertia::render('Alumnos/Edit', [
                'alumno' => $alumn
            ]);
        }
        else{
            return redirect()->route('alumnos.veralumnos');
        }
    }
    public function update(Request $request, int $id) {
        $alumn = Alumno::find($id);
        if (!$alumn) return to_route('404', [], 303);
        $request->validate([
            "name" => "required|min:3|max:30",
            "lastname" => "required|min:5|max:30",
            "genero" =>"required|max:1",
            "carrera_id"=>"required",
        ]);
        $alumn->name = $request->get('name', $alumn->name);
        $alumn->lastname = $request->get('lastname', $alumn->lastname);
        $alumn->genero = $request->get('genero', $alumn->genero);
        $alumn->carrera_id = $request->get('carrera_id', $alumn->carrera_id);
        $alumn->save();
        return redirect()->route('alumnos.veralumnos');
    }
    public function destroy(int $id) {
        $alumn = Alumno::find($id);
        if (!$alumn) return to_route('404', [], 303);
        $alumn->delete();

        return to_route('alumnos.veralumnos', [], 303);
    }
}
