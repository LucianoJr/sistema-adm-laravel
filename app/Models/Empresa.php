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
     * DEfine dados para serialização
     *
     * @var array
     */                        
    protected $visible = ['id', 'text'];

    /**
     * Anexa dados para serialização
     *
     * @var array
     */
    protected $appends = ['text'];

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

    public static function buscaPorNomeTipo(string $nome, string $tipo)
    {
        //termo de busca
        $nome = '%'. $nome . '%';

        return self::where('nome', 'LIKE', $nome)
                        ->where('tipo', $tipo)
                        ->get();
    }

    /**
     * Cria acessor para ser usado na serialização
     *
     * @return void
     */
    public function getTextAttribute(): string
    {
        return \sprintf(
            '%s (%s)',
            $this->attributes['nome'],
            $this->attributes['razao_social']
        );
    }
}
