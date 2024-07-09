<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos'; 

    protected $fillable = [
        'nombre', 'precio', 'descripcion', 'duracion', 'instructor', 'imagen', 'disponible'
       
    ];

    public $timestamps = false; 


    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'compras', 'curso_id', 'user_id')
                    ->withTimestamps(); 
    }
    public function capitulos()
    {
        return $this->hasMany(Capitulo::class);
    }

    
    

}
