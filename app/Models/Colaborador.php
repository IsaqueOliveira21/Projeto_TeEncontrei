<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Colaborador extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected  $table = 'colaboradores';

    /**
     * @var string[]
     */
    protected $fillable = [
        'instituicao_id',
        'user_id',
        'endereco_id',
        'cargo',
        'numero_endereco',
        'data_nascimento',
        'ativo'
    ];

    /**
     * @var string[]
     */
    protected $dates = [
        'data_nascimento',
        'created_at',
        'updated_at'
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

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
    public function telefones(): HasMany
    {
        return $this->hasMany(ColaboradorTelefone::class);
    }

    /**
     * @return HasMany
     */
    public function visitas(): HasMany
    {
        return $this->hasMany(VisitaDetalhe::class);
    }
}
