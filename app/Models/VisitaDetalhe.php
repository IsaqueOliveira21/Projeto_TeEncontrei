<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitaDetalhe extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'visitas_detalhes';

    /**
     * @var string[]
     */
    protected $fillable = [
        'visita_cabecalho_id',
        'colaborador_id',
        'tipo'
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
    public function cabecalho(): BelongsTo
    {
        return $this->belongsTo(VisitaCabecalho::class);
    }

    /**
     * @return BelongsTo
     */
    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
    }
}
