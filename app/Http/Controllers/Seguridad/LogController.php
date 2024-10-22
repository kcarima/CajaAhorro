<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

final class LogController extends Controller
{
    public function index()
    {
        return view('seguridad.log.index');
    }

    public function show(int $id)
    {
        $actividad = Activity::findOrFail($id);

        return view('seguridad.log.show', ['actividad' => $actividad]);
    }
}
