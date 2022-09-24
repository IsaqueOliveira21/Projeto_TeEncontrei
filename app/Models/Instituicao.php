<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Instituicao extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected  $table = 'instituicoes';

    /**
     * @var string[]
     */
    protected $fillable = [
      'enderecos_id',
      'nomeclatura',
      'capacidade',
      'numero_endereco'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function endereco(): BelongsTo
    {
        return $this->belongsTo(Endereco::class);
    }

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
    public function visitas(): HasMany
    {
        return $this->hasMany(VisitaCabecalho::class);
    }
}
