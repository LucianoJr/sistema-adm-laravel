<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimentos_financeiro extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'movimentos_financeiros';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['descricao', 'valor', 'data', 'tipo', 'empresa_id'];

    /**
     * Método responsável pela relação com a empres
     *
     * @return void
     */
    public function empresa()
    {
        return $this->belongsTo('App\Models\Empresa');
    }
    
    /**
     * Método que busca movimento por intervalo
     *
     * @param string $inicio
     * @param string $fim
     * @param integer $quantidade
     * @return void
     */
    public static function buscaPorIntervalo(string $inicio, string $fim, int $quantidade = 20)
    {
        return self::where('data', [$inicio, $fim])
                    ->with('empresa')
                    ->paginate($quantidade);
    }
}
