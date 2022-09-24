<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VisitaCabecalho extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'visitas_cabecalhos';

    /**
     * @var string[]
     */
    protected $fillable = [
        'instituicao_id',
        'desabrigado_id'
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
    public function instituicao(): BelongsTo
    {
        return $this->belongsTo(Instituicao::class);
    }

    /**
     * @return BelongsTo
     */
    public function desabrigado(): BelongsTo
    {
        return $this->belongsTo(Desabrigado::class);
    }

    /**
     * @return HasMany
     */
    public function detalhes(): HasMany
    {
        return $this->hasMany(VisitaDetalhe::class);
    }
}
