<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SupportCase extends Model
{
    use HasFactory;

    protected $table = 'supportcases';

    protected $fillable = [
        'requester_id',
        'agent_id',
        'status',
        'entry_date',
        'closed_at',
    ];

    protected $dates = [
        'entry_date',
        'closed_at',
    ];

    public function requester() {
        return $this->belongsTo(User::class, 'requester_id');
    }

    public function agent() {
        return $this->belongsTo(User::class, 'agent_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
