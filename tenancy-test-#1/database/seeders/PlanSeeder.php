<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name'  => 'Standard',
                'slug'  => 'standard',
                'amount' => 99.9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'  => 'Pro',
                'slug'  => 'pro',
                'amount' => 199.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'  => 'Supreme',
                'slug'  => 'supreme',
                'amount' => 499.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('plans')->insert($plans);
    }
}