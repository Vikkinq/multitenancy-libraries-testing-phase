<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantInfoSeeder extends Seeder
{
    public function run(array $data): void{
        DB::connection('tenant')->table('tenant_info')->insert([
            'tenant_id'   => $data['tenant_id'],
            'tenant_name' => $data['tenant_name'],
            'email'       => $data['email'],
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}