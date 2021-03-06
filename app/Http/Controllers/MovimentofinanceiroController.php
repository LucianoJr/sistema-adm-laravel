<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Movimentos_financeiro;
use App\Http\Requests\MovimentoFinanceiroRequest;

class MovimentofinanceiroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (!$request->filled('data_inicial') || !$request->filled('data_final')) {
            return \redirect()->route('movimentos_financeiros.index', [
                'data_inicial' => (new \DateTime('first day of this month'))->format('d/m/Y'),
                'data_final' => (new \DateTime('last day of this month'))->format('d/m/Y')
            ]);
        }

        $movimentos_financeiros = Movimentos_financeiro::buscaPorIntervalo(
            $request->data_inicial,
            $request->data_final
        );      

        return view('movimentos_financeiros.index', compact('movimentos_financeiros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('movimentos_financeiros.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(MovimentoFinanceiroRequest $request)
    {        
        Movimentos_financeiro::create($request->all());

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);

        return view('movimentos_financeiros.show', compact('movimentos_financeiro'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);

        return view('movimentos_financeiros.edit', compact('movimentos_financeiro'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'descricao' => 'required|string|max:255',
			'data' => 'required',
			'tipo' => 'required',
			'empresa_id' => 'required'
		]);
        $requestData = $request->all();
        
        $movimentos_financeiro = Movimentos_financeiro::findOrFail($id);
        $movimentos_financeiro->update($requestData);

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        Movimentos_financeiro::destroy($id);

        return redirect('movimentos_financeiros')->with('flash_message', 'Movimentos_financeiro deleted!');
    }
}
