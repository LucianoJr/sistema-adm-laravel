<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Database\Eloquent\SoftDeletes;

class Empresa extends Model
{
    use SoftDeletes;

    protected $fillable = ['tipo','nome', 'razao_social', 
                           'documento', 'ie_rg', 
                           'nome_contato', 'celular', 
                           'email', 'telefone',
                           'cep', 'logradouro',
                           'bairro', 'cidade',
                           'estado', 'observacao'];

    /**
     * Método para filtrar empresa por tipo
     *
     * @param string $tipo
     * @return AbstractPaginator
     */
    public static function todasPorTipo(string $tipo, int $quantidade=10): AbstractPaginator
    {
        return self::where('tipo', $tipo)->paginate($quantidade);
    }
}
