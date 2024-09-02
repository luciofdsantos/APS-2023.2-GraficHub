<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    public $fillable = [
        'comentario',
        'project_id',
        'user_id',
        'comentario_pai',
        'apagado'
    ];

    public function respostas(): HasMany
    {
        return $this->hasMany(Comment::class, 'comentario_pai', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
