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
    public function index()
    {
        //
        $datos['monsters']=Monster::paginate(5);
        return view('Monster.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Monster.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        //
        $campos=[
            'name'=>'required|string|max:100',
            'description'=>' required|string|max:100',
            'category'=>'required|string|max:100',
            'ubication'=>'required|string|max:100',
            'wk_elemental'=>'required|string|max:100',
            'wk_estate'=>'required|string|max:100',
            'img_monster'=>' required|max:10000|mimes: jpeg,png, jpg',
        ];

        $mensaje=[
        'required'=> 'El :attribute es requerido',

        ];

        if($request->hasFile('img_monster')){
          $campos=['img_monster'=>' required|max:10000|mimes: jpeg,png, jpg']; 
        $mensaje=['img_monster required'=> 'La foto requerida'];
        }   
         $this->validate($request, $campos, $mensaje);









        $datosMonster = request()->except('_token');
        if($request->hasFile('img_monster')){
            $datosMonster['img_monster']=$request->file('img_monster')->store('uploads','public');
        }
        Monster::insert($datosMonster);

   

        return redirect('Monster')->with('mensaje','Monster agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Monster $Monster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $Monster=Monster::findOrFail($id);

        return view('Monster.edit', compact('Monster') );
    

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $campos=[
            'name'=>'required|string|max:100',
            'description'=>' required|string|max:100',
            'category'=>'required|string|max:100',
            'ubication'=>'required|string|max:100',
            'wk_elemental'=>'required|string|max:100',
            'wk_estate'=>'required|string|max:100',
        
           
        ];

        $mensaje=[
        'required'=> 'El :attribute es requerido',
        'img_monster required'=> 'La foto requerida',
        ];

         $this->validate($request, $campos, $mensaje);


        //
        $datosMonster = request()->except(['_token', '_method']);

        if($request->hasFile('img_monster')){
            $Monster=Monster::findOrFail($id);
            Storage::delete('public/'.$Monster->img_monster);
            $datosMonster['img_monster']=$request->file('img_monster')->store('uploads','public');
        }





        Monster::where('id','=', $id)->update($datosMonster);

        $Monster=Monster::findOrFail($id);

        //return view('Monster.edit', compact('Monster') );
        return redirect('Monster')->with('mensaje','Monster Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $Monster=Monster::findOrFail($id);
        if(Storage::delete('public/'.$Monster->img_monster)){
            Monster::destroy($id);
        }
      
        return redirect('Monster')->with('mensaje','Monster Borrado');
    }
}
