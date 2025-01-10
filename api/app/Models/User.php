<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'role',
    ];

    // Casos donde el usuario es el solicitante
    public function requestedCases() {
        return $this->hasMany(SupportCase::class, 'requester_id');
    }

    // Casos donde el usuario es el agente asignado
    public function assignedCases() {
        return $this->hasMany(SupportCase::class, 'assignee_id');
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }


}
