<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    protected $fillable = [
        'dashboard',
        'administrador',
        'usuarios',
        'recepcion',
        'ajustes',
        'campanas',
        'contabilidad',
        'transferencias',
        'proveedor',
        'user_id'
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
