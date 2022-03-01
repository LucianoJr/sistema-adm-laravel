<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\EmpresaRequest;
use Symfony\Component\HttpFoundation\Response;

class EmpresaController extends Controller
{
    /**
     * Listagem de empresas por tipo, usando o método todasPorTipo
     *
     * @param Request $request
     * @return void
     */
    public function index(Request $request): View
    {
        $tipo = $request->tipo;
        $this->validaTipo($tipo);

        $empresas = Empresa::todasPorTipo($tipo);

        return view('empresa.index', \compact('empresas', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request): View
    {
        $this->validaTipo($request->tipo);      
        
        return view('empresa.create',[
            'tipo' => $request->tipo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmpresaRequest $request): Response
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
    public function show(Empresa $empresa)
    {
        return view('empresa.show', \compact('empresa'));
    }

    /**
     * Editando os dados do cadastro
     *
     * @param Empresa $empresa
     * @return void
     */
    public function edit(Empresa $empresa): View
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
    public function update(EmpresaRequest $request, Empresa $empresa): Response
    {
        $empresa->update($request->all());

        return \redirect()->route('empresas.show', $empresa);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa, Request $request)
    {
        $this->validaTipo($request->tipo);        
    
        $empresa->delete();

        return \redirect()->route('empresas.index', ['tipo'=>$request->tipo]);
    }

    /**
     * Verifica se o tipo é cliente ou fornecedor
     *
     * @param string $tipo
     * @return void
     */
    private function validaTipo(string $tipo): void
    {
        if ($tipo !== 'cliente' && $tipo !== 'fornecedor') {
            \abort(404);
        }
    }
}
