<?php

namespace App\Http\Controllers\SCA;
use App\Models\SCA\archivoSinu;
use App\Models\SCA\Socio;
use App\Models\SCA\conceptos;

use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CargaSinuController extends Controller
{
    public $path;
    public $error = 0;

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

    public function cuenta_data($modo,$vector){ //modo 1= socios, 4=conceptos
        $aux_lineas = $vector;
        $data = "";
        $i=0;
        foreach( $aux_lineas as $linea ){
            $detalle_linea = explode(";",$linea);                
            $data .= ($i == 0 ? $detalle_linea[$modo] : '///'.$detalle_linea[$modo] );
            $i++;
        }            
        
        return count(array_unique(explode("///",trim($data))));
    }

    public function verifica_errores($vector){
        $html = '<br>';
        $aux_lineas = $vector;
        $cuenta_socios_errores = 0;
        $cuenta_conceptos_errores = 0;
        $i = 0;
        $data_s = '';
        $data_c = '';
        // Carga los vectoires de Socios y Conceptos
        foreach( $aux_lineas as $linea ){
            $detalle_linea = explode(";",$linea);
            $data_s .= ($i == 0 ? $detalle_linea[1].'*;*'.$detalle_linea[2].'*;*'.$detalle_linea[3] : '///'.$detalle_linea[1].'*;*'.$detalle_linea[2].'*;*'.$detalle_linea[3] );
            $data_c .= ($i == 0 ? $detalle_linea[4].'*;*'.$detalle_linea[5] : '///'.$detalle_linea[4].'*;*'.$detalle_linea[5] );
            $i++;
        }

        /*Informacion de los socios*/

        $data_tabla = '<div class="content" style="max-height: 200px; overflow-y: auto;">';
        $data_tabla .= '<table>';
        $data_tabla .= '  <tr>';
        $data_tabla .= '      <td colspan="3"><b class="text-danger">Fichas Con Errores: </b></td>';
        $data_tabla .= '  </tr>';

        $vector_ordenado =collect(explode("///",trim($data_s)))->sort()->unique();
        $html .= 'Cantidad de socios: <b>'.count($vector_ordenado).'</b>.<br>'; 

        foreach( $vector_ordenado as $vect_socio ){     
            $detalle_concep = explode("*;*",$vect_socio);
            // Buscar el socio por su ficha
            $socio = Socio::where('ficha', $detalle_concep[0])->first();
            // Verificar si se encontró al socio
            if (!$socio) {                
                if ( $cuenta_socios_errores == 0 ){
                    $this->error = 1;
                    $html .= '<b class="text-danger">Error: </b><br>'.$data_tabla;
                }
                $html .= '<tr>';
                $html .= '  <td>'.$detalle_concep[0].'</td>';
                $html .= '  <td>'.$detalle_concep[1].'</td>';
                $html .= '  <td>'.$detalle_concep[2].'</td>';
                $html .= '</tr>';
                $cuenta_socios_errores++;
            }
        }
        
        if ( $cuenta_socios_errores > 0 ){
            $html .= '</table></div>';
            $html .= '<br>Socios con errores: <b class="text-danger">'.$cuenta_socios_errores.'</b>.<br>';
        }

        /*Informacion de los conceptos*/
        $vector_ordenado =collect(explode("///",trim($data_c)))->sort()->unique();
        $html .= '<br>Cantidad de Conceptos: <b>'.count($vector_ordenado).'</b>.<br>'; 

        $data_tabla = '<div class="content" style="max-height: 200px; overflow-y: auto;">';
        $data_tabla .= '<table>';
        $data_tabla .= '  <tr>';
        $data_tabla .= '      <td colspan="2"><b class="text-danger">Conceptos con Errores: </b></td>';        
        $data_tabla .= '  </tr>';
        foreach( $vector_ordenado as $vect_c ){
            $detalle_concep = explode("*;*",$vect_c);
            // Buscar el socio por su ficha
            $concepto = conceptos::where('codigo', $detalle_concep[0])->first();
            // Verificar si se encontró al socio
            if (!$concepto) {
                if ( $cuenta_conceptos_errores == 0 ){
                    $this->error = 1;
                    $html .= '<b class="text-danger">Error: </b><br>'.$data_tabla;
                }
                $html .= '<tr>';
                $html .= '  <td>'.$detalle_concep[0].'</td>';
                $html .= '  <td>'.$detalle_concep[1].'</td>';
                $html .= '</tr>';
                $cuenta_conceptos_errores++;
               /* $solicitud = conceptos::create([
                    'codigo' => $detalle_concep[0],
                    'descripcion' => $detalle_concep[1],
                    'accion' => '+',
                    'status' => 1
                ]);*/
            }
        }

        if ( $cuenta_conceptos_errores > 0 ){
            $html .= '</table></div>';
            $html .= '<br>Conceptos con errores: <b class="text-danger">'.$cuenta_conceptos_errores.'</b>.<br>';
        }

        if ( $this->error == 0 ){
            $html .= '<br><button   type="button" id="procesar"
                                class="rounded-md btn-success text-white hover:bg-green-800 lg:w-1/3 w-full h-10 text-lg">Procesar</button>';
        }

        return $html;
    }

    public function analisis(Request $request){
        $html = '';
        $query = archivoSinu::find($request->id);
        if ( $query ){
            $contents = Storage::disk('txt')->get($query->id.'.txt');
            $lineas = explode("\n",trim($contents));            
            $html = $this->verifica_errores($lineas);
            $data = ['mensaje' => $html];
        }else{
            $data = ['mensaje' => 'Error: Problemas con el archivo: '.$request->id.'.txt'];
        }        
        return response()->json($data);        
    }
}
