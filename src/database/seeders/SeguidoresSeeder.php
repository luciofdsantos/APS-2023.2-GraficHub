<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeguidoresSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $qtd_users = $users->count()-1;

        foreach ($users as $user) {
            $usersToFollow = $users->where('id', '!=', $user->id)
            ->random(rand(1, $qtd_users));

            foreach ($usersToFollow as $seguindo) {
                DB::table('followers')->insert([
                    'seguidor_id' => $user->id,
                    'seguindo_id' => $seguindo->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($users as $user) {
            $user->num_seguidores = $user->seguidores()->count();
            $user->num_seguidos = $user->seguindo()->count();
            $user->save();
        }
    }
}
