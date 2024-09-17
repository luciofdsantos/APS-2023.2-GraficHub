<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    public $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome'
    ];

    public static function verificaTag(string $nome): int
    {
        $nome = Str::lower($nome);
        $tag = Tag::where('nome', $nome)->first();
        if( $tag != null ){
            return $tag->id;
        }else{
            $tag = Tag::create([
                'nome' => $nome,
            ]);
            return $tag->id;
        }
    }

}
