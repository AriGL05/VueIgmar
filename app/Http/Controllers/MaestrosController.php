<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maestro;
use App\Models\Carrera;
use App\Models\Materia;
use Inertia\Inertia;
use Inertia\Response;

class MaestrosController extends Controller
{
    public function index() : Response {
        $maestros = Maestro::with('materia')->get();

        return Inertia::render('Maestros/VerMaestros', [
            'maestros' => $maestros,
        ]);
    }
    public function create() : Response {

        return Inertia::render('Maestros/Create');
    }
    public function store(Request $request) {
        $request->validate([
            "name" => "required|min:3|max:30",
            "lastname" => "required|min:5|max:30",
            "email" => "required|unique:maestros|email",
            "genero" =>"required|max:1",
            "materia_id"=>"required",
        ]);
        $mae = new Maestro();
        $mae->name = $request->get('name') ;
        $mae->lastname = $request->get('lastname');
        $mae->email = $request->get('email') ;
        $mae->genero = $request->get('genero');
        $mae->materia_id = $request->get('materia_id') ;
        $mae->save();
        return redirect()->route('maestros.vermaestros');
    }
    public function edit(int $id) : Response {
        $maestro = Maestro::with('materia')->find($id);
        if ($maestro){
        
            return Inertia::render('Maestros/Edit', [
                'maestro' => $maestro
            ]);
        }
        else{
            return redirect()->route('maestros.vermaestros');
        }
    }
    public function update(Request $request, int $id) {
        $maestro = Maestro::find($id);
        if (!$maestro) return to_route('404', [], 303);
        $request->validate([
            "name" => "required|min:3|max:30",
            "lastname" => "required|min:5|max:30",
            "email" => "required|unique:maestros|email",
            "genero" =>"required|max:1",
            "materia_id"=>"required",
        ]);
        $maestro->name = $request->get('name', $maestro->name);
        $maestro->lastname = $request->get('lastname', $maestro->lastname);
        $maestro->email = $request->get('email', $maestro->email);
        $maestro->genero = $request->get('genero', $maestro->genero);
        $maestro->materia_id = $request->get('materia_id', $maestro->materia_id);
        $maestro->save();
        return redirect()->route('maestros.vermaestros');
    }
    public function destroy(int $id) {
        $mae = Maestro::find($id);
        if (!$mae) return to_route('404', [], 303);
        $mae->delete();

        return to_route('maestros.vermaestros', [], 303);
    }
}
