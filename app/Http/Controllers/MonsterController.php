<?php

namespace App\Http\Controllers;

use App\Models\Monster;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MonsterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id = null)
{
    $monsters = Monster::all(); // Cargamos todos los monstruos
    $selectedMonster = null;

    if ($id) {
        // Cargar el monstruo seleccionado solo si se selecciona uno
        $selectedMonster = Monster::find($id);
    }

    return view('Monster.index', compact('monsters', 'selectedMonster'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Monster.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Reglas de validación
        $campos = [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:300',
            'category' => 'required|string|max:100',
            'ubication' => 'required|string|max:100',
            'wk_elemental' => 'required|string|max:100',
            'wk_estate' => 'required|string|max:100',
            'img_monster' => 'required|max:2048|mimes:jpeg,png,jpg,webp',  /* Se asigna 2048 a el campo para admitir mejores resoluciones en formato png*/ 
            'img_logo' => 'required|max:2048|mimes:jpeg,png,jpg,webp',
        ];

        // Mensajes personalizados
        $mensaje = [
            'required' => 'El :attribute es requerido',
            'img_monster.required' => 'La imagen del monstruo es requerida',
            'img_logo.required' => 'El logo del monstruo es requerido',
        ];

        // Validar la solicitud
        $this->validate($request, $campos, $mensaje);

        // Procesar los archivos subidos
        $datosMonster = $request->except('_token');

        // Guardar imagen del monstruo
        if ($request->hasFile('img_monster')) {
            $datosMonster['img_monster'] = $request->file('img_monster')->store('uploads', 'public');
        }

        // Guardar logo del monstruo
        if ($request->hasFile('img_logo')) {
            $datosMonster['img_logo'] = $request->file('img_logo')->store('uploads', 'public');
        }

        // Insertar los datos en la base de datos
        Monster::insert($datosMonster);

        return redirect('Monster')->with('mensaje', 'Monster agregado con éxito');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $Monster = Monster::findOrFail($id);
        return view('Monster.edit', compact('Monster'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $campos = [
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:300',
            'category' => 'required|string|max:100',
            'ubication' => 'required|string|max:100',
            'wk_elemental' => 'required|string|max:100',
            'wk_estate' => 'required|string|max:100',
        ];

        $mensaje = [
            'required' => 'El :attribute es requerido',
            'img_monster.required' => 'La imagen del monstruo es requerida',
            'img_logo.required' => 'El logo del monstruo es requerido',
        ];

        // Validar la solicitud
        $this->validate($request, $campos, $mensaje);

        // Actualizar datos
        $datosMonster = $request->except(['_token', '_method']);

        // Actualizar imagen del monstruo
        if ($request->hasFile('img_monster')) {
            $Monster = Monster::findOrFail($id);
            Storage::delete('public/' . $Monster->img_monster);
            $datosMonster['img_monster'] = $request->file('img_monster')->store('uploads', 'public');
        }

        // Actualizar logo del monstruo
        if ($request->hasFile('img_logo')) {
            $Monster = Monster::findOrFail($id);
            Storage::delete('public/' . $Monster->img_logo);
            $datosMonster['img_logo'] = $request->file('img_logo')->store('uploads', 'public');
        }

        Monster::where('id', '=', $id)->update($datosMonster);

        return redirect('Monster')->with('mensaje', 'Monster modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Monster = Monster::findOrFail($id);

        if (Storage::delete('public/' . $Monster->img_monster) && Storage::delete('public/' . $Monster->img_logo)) {
            Monster::destroy($id);
        }

        return redirect('Monster')->with('mensaje', 'Monster borrado con éxito');
    }


    public function show($id)
    {
        $monster = Monster::findOrFail($id);
        return view('Monster.details', compact('monster'));
    }
    
    


}
