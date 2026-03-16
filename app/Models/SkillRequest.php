<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SkillRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'skill_offer_id',
        'skill_wanted_id',
        'status',
        'mensagem',
    ];

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function skillOffer()
    {
        return $this->belongsTo(Skill::class, 'skill_offer_id');
    }

    public function skillWanted()
    {
        return $this->belongsTo(Skill::class, 'skill_wanted_id');
    }
}