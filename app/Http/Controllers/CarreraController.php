<?php

namespace App\Http\Controllers;
use App\Models\Carrera;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;

class CarreraController extends Controller
{
    public function index() : Response {
        $carreras = Carrera::all();

        return Inertia::render('Carreras/VerCarreras', [
            'carreras' => $carreras,
        ]);
    }
    public function info(){
        $carreras = Carrera::all();

        return response()->json($carreras);
    }
    public function create() : Response {

        return Inertia::render('Carreras/Create');
    }
    public function store(Request $request) {
        $request->validate([
            "name" => "required|min:3|max:30",
            "enfoque" => "required|min:10|max:150",
        ]);
        $car = new Carrera();
        $car->name = $request->get('name') ;
        $car->enfoque = $request->get('enfoque');
        $car->save();
        return redirect()->route('carreras.vercarreras');
    }

    public function edit(int $id) : Response {
        $car = Carrera::find($id);
        if ($car){
        
            return Inertia::render('Carreras/Edit', [
                'carrera' => $car
            ]);
        }
        else{
            return redirect()->route('carreras.vercarreras');
        }
    }
    public function update(Request $request, int $id) {
        $car = Carrera::find($id);
        if (!$car) return to_route('404', [], 303);
        $request->validate([
            "name" => "required|min:3|max:30",
            "enfoque" => "required|min:10|max:150",
        ]);
        $car->name = $request->get('name', $car->name) ;
        $car->enfoque = $request->get('enfoque', $car->enfoque);
        $car->save();
        return redirect()->route('carreras.vercarreras');
    }
    public function destroy(int $id) {
        $car = Carrera::find($id);
        if (!$car) return to_route('404', [], 303);
        $car->delete();

        return to_route('carreras.vercarreras', [], 303);
    }
}
