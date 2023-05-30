<?php

namespace Database\Seeders;

use App\Models\RecoveryPassword;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RecoveryPasswordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RecoveryPassword::create([
            'encryption' => '$2y$10$t.nN4he7szG5lQn0rD/TaObAlZdbRhLFPbCiJOjzrMKAcaeF/Pvd2',
            'is_active' => 1,
            'user_id' => 1
        ]);
    }
}
