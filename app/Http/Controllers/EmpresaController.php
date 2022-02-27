<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;

class EmpresaController extends Controller
{
    /**
     * Listagem de empresas por tipo, usando o método todasPorTipo
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            return \abort(404);
        }

        $empresas = Empresa::todasPorTipo($tipo);

        return view('empresa.index', \compact('empresas', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $tipo = $request->tipo;

        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            return \abort(404);
        }
        
        return view('empresa.create', \compact('tipo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request)
    {
        $empresa = Empresa::create($request->all());

        return \redirect()->route('empresas.show', $empresa->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 'estou aqui';
    }

    /**
     * Editando os dados do cadastro
     *
     * @param Empresa $empresa
     * @return void
     */
    public function edit(Empresa $empresa)
    {
        return view('empresa.edit', \compact('empresa'));
    }

   /**
    * Salvar os dados alterados
    *
    * @param EmpresaRequest $request
    * @param Empresa $empresa
    * @return void
    */
    public function update(EmpresaRequest $request, Empresa $empresa)
    {
        return \redirect()->route('empresas.show', $empresa);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
