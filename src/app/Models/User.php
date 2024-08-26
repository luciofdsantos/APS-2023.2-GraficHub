<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'nome',
        'apelido',
        'disponivel',
        'numero_telefone',
        'email',
        'password',
        'foto',
    ];

    use HasFactory, Notifiable;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * retorna todos os usuarios que seguem o user atual
     */
    public function seguidores(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'seguindo_id', 'seguidor_id');

    }

    public function isSeguindo(int $seguindo_id): bool
    {
        return $this->seguindo()->where('seguindo_id', $seguindo_id)->exists();
    }

    /**
     * retorna todos os usuarios que o user atual segue
     */
    public function seguindo(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'seguidor_id', 'seguindo_id');
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function follow(int $id){
        $this->seguindo()->attach($id);
    }

    public function unfollow(int $id){
        $this->seguindo()->detach($id);
    }
}
