<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
        'agent_id',
        'support_case_id',
        'comments',
    ];

    protected $casts = [
        'comments' => 'array',
    ];

    public function setCommentsAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['comments'] = json_encode([[
                'text' => $value,
                'timestamp' => now()->toDateTimeString()
            ]]);
        } else {
            $this->attributes['comments'] = json_encode($value);
        }
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function supportCase() {
        return $this->belongsTo(SupportCase::class);
    }
}
