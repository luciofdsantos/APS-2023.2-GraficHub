<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public function imagesProjects():HasMany
    {
        return $this->hasMany(ImagesProject::class);
    }

    protected $fillable = [
        'user_id',
        'titulo',
        'imagem_capa',
        'ferramentas',
        'descricao',
        'tags',
        'arquivo',
        'arquivo_publico'
    ];
}
