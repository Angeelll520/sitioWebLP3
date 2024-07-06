<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Capitulo extends Model
{
    protected $fillable = [
        'curso_id', 'titulo', 'descripcion', 'video_link',
    ];


}
