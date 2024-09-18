<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReacoesSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $projects = Project::all();
        $qtd_projects = Project::all()->count();

        foreach ($users as $user) {
            $likedProjects = $projects->random(rand(1, $qtd_projects));
            foreach ($likedProjects as $project) {
                DB::table('likes')->insert([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $favoriteProjects = $projects->random(rand(1, $qtd_projects));
            foreach ($favoriteProjects as $project) {
                DB::table('favorites')->insert([
                    'user_id' => $user->id,
                    'project_id' => $project->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        foreach ($projects as $project) {
            $project->n_curtidas = $project->likes()->count();
            $project->n_favoritos = $project->favorites()->count();
            $project->save();
        }
    }
}
