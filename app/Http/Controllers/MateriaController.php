<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;
use Inertia\Inertia;
use Inertia\Response;

class MateriaController extends Controller
{
    public function index() : Response {
        $materias = Materia::with('carrera')->get();

        return Inertia::render('Materias/VerMaterias', [
            'materias' => $materias,
        ]);
    }
    public function info(){
        $materias = Materia::all();

        return response()->json($materias);
    }
    public function create() : Response {

        return Inertia::render('Materias/Create');
    }
    public function store(Request $request) {
        $request->validate([
            "name" => "required|min:3|max:30",
            "unidades"=> "required|string|max:1",
            "carrera_id" =>"required"
        ]);
        $materia = new Materia();
        $materia->name = $request->get('name');
        $materia->unidades = $request->get('unidades');
        $materia->carrera_id = $request->get('carrera_id');
        $materia->save();
        
        $materia->save();
        return redirect()->route('materias.vermaterias');
    }
    public function destroy(int $id) {
        $materia = Materia::find($id);
        if (!$materia) return to_route('404', [], 303);
        $materia->delete();

        return to_route('materias.vermaterias', [], 303);
    }

    public function edit(int $id) : Response {
        $mae = Materia::find($id);
        if ($mae){
        
            return Inertia::render('Materias/Edit', [
                'materia' => $mae
            ]);
        }
        else{
            return redirect()->route('materias.vermaterias');
        }
    }
    public function update(Request $request, int $id) {
        $mae = Materia::find($id);
        if (!$mae) return to_route('404', [], 303);
        $request->validate([
            "name" => "required|min:3|max:30",
            "unidades"=> "required|string|max:1",
            "carrera_id" =>"required"
        ]);
        $mae->name = $request->get('name', $mae->name) ;
        $mae->unidades = $request->get('unidades', $mae->unidades);
        $mae->carrera_id = $request->get('carrera_id', $mae->carrera_id);
        $mae->save();
        return redirect()->route('materias.vermaterias');
    }
}
