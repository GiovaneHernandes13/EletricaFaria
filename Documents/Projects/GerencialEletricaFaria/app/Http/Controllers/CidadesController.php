<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function getCidadesPorEstado($id_estado)
    {
        $cidades = Cidade::where('id_estado', $id_estado)->get();
        return response()->json($cidades);
    }
}

