<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'request_id',
        'data_sessao',
        'start_time',
        'end_time',
        'status',
        'observacoes',
    ];

    public function skillRequest()
    {
        return $this->belongsTo(SkillRequest::class, 'request_id');
    }

    public function avaliacoes()
    {
        return $this->hasMany(Avaliacao::class, 'session_id');
    }
}
