<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Desabrigado extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'desabrigados';

    /**
     * @var string[]
     */
    protected $fillable = [
        'certidao_nascimento',
        'cartao_sus',
        'nome',
        'sobrenome',
        'rg',
        'cpf'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return HasMany
     */
    public function visitas(): HasMany
    {
        return $this->hasMany(VisitaCabecalho::class);
    }
}
