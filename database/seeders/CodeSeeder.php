<?php

namespace Database\Seeders;

use App\Models\Code;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('role', 'admin')->first();
        Code::factory(3)->create(['user_id' => $user->id]);
    }
}
