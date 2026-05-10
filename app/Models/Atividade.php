<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Atividade extends Model
{
    protected $table = 'atividades';

    protected $fillable = [
        'colaborador_id',
        'data',
        'titulo',
        'descricao',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    public function colaborador(): BelongsTo
    {
        return $this->belongsTo(Colaborador::class);
    }
}