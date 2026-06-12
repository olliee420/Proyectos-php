<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'nombre'         => 'Admin',
                'email'          => 'admin@hustlehouse.com',
                'password'       => Hash::make('admin123'),
                'rol'            => 'admin',
                'fecha_creacion' => now(),
            ],
            [
                'nombre'         => 'Fabian',
                'email'          => 'fabian@hustlehouse.com',
                'password'       => Hash::make('pollito00'),
                'rol'            => 'cliente',
                'fecha_creacion' => now(),
            ],
        ];

        $collection = DB::connection('mongodb')->table('usuarios');

        foreach ($users as $user) {
            $exists = $collection->where('email', $user['email'])->first();
            if (!$exists) {
                $maxId = $collection->max('id') ?? 0;
                $user['id'] = (int)$maxId + 1;
                $collection->insert($user);
                echo "  ✅ Created: {$user['email']}\n";
            } else {
                echo "  ⏭️  Skipped (exists): {$user['email']}\n";
            }
        }
    }
}
