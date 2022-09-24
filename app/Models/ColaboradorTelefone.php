<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ColaboradorTelefone extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'colaboradores_telefones';

    /**
     * @var string[]
     */
    protected $fillable = [
        'colaborador_id',
        'numero_telefone'
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
    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
    }
}
