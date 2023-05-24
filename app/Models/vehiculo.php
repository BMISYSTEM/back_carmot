<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'placa',
        'kilometraje',
        'foto1',
        'foto2',
        'foto3',
        'foto4',
        'marcas',
        'modelos',
        'estados',
        'valor',
        'peritaje',

    ];


    public function marcas()
    {
        return $this->belongsTo(marcas::class,'marcas');
    }

    public function modelos()
    {
        return $this->belongsTo(modelo::class,'modelos');
    }
    
    public function estados()
    {
        return $this->belongsTo(estado::class,'estados');
    }
}
