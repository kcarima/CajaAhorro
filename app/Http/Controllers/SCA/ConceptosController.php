<?php

namespace App\Http\Controllers\SCA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConceptosController extends Controller
{
    //
    public function index()
    {
        return view('sca.conceptos.index');
    }
}
