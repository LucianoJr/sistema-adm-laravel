<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovimentosEstoque extends Model
{
    /**
     * Define o nome da tabela
     *
     * @var string
     */
    protected $table = 'movimentos_estoque';

    /**
     * Campos permitos em definição em massa
     *
     * @var array
     */
    protected $fillable = ['produto_id', 'quantidade', 'valor','tipo'];

    /**
     * Define a relação com produtos
     *
     * @return void
     */
    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}


