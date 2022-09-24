<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Endereco extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'enderecos';

    /**
     * @var string[]
     */
    protected $fillable = [
      'tipo_logradouro',
      'logradouro',
      'cep',
      'cidade',
      'uf'
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
    public function colaboradores(): HasMany
    {
        return $this->hasMany(Colaborador::class);
    }

    /**
     * @return HasMany
     */
    public function instituicoes(): HasMany
    {
        return $this->hasMany(Instituicao::class);
    }
}
