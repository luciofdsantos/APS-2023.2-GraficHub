<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    public $primaryKey = 'id';
    protected $fillable = [
        'id',
        'user_id',
        'titulo',
        'imagem_capa',
        'ferramentas',
        'descricao',
        'tags',
        'arquivo',
        'arquivo_publico',
        'created_at',
        'n_curtidas',
        'n_favoritos'
    ];

    public function imagesProjects(): HasMany
    {
        return $this->hasMany(ImagesProject::class);
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comment::class)->where('comentario_pai', null);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'project_tags', 'project_id', 'tag_id');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes', 'project_id', 'user_id');
    }

    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorites', 'project_id', 'user_id');
    }
}
