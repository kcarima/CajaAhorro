<?php

namespace App\Http\Controllers\SCA;
use App\Models\SCA\archivoSinu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CargaSinuController extends Controller
{
    public $path;

    public function index()
    {
        return view('sca.archivo-sinu.index');
    }    

    public function detalle(Request $request){
        $query = archivoSinu::find($request->id);
        if ( $query ){
            return view('sca.archivo-sinu.detalle',compact('query'));
        }else{
            abort(404);
        }        
    }

    public function analisis(Request $request){
        dd($request->id);
    }
}
