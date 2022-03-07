<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class MovimentoEstoqueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'produto_id' => 'required',
            'quantidaed' => 'required||numeric',
            'valor' => 'required|numeric',
            'tipo' => ['required', Rule::in(['entrada', 'saida'])],
            'empresa_id' => 'required'
		
        ];
    }

    /**
     * Limpar os valores
     */

    public function validationData()
    {
        $campos = $this->all();

        $campos['valor'] = \str_replace(['.',','], ['','.'], $campos['valor']);

        $this->replace($campos);

        return $campos;
    }

    /**
     * Verifica o tipo do método para ver se verifica o tipo de empresa
     *
     * @return void
     */
    private function validarTipo()
    {
        if ($this->method() === 'POST') {
            return ['required', Rule::in(['clientes', 'fornecedor'])];
        }

        return [];
       
    }
}
