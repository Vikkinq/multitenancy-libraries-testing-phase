<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenantDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tenant = tenant(); // gets the current tenant context

        // SEEDS

        DB::table('tenant_info')->insert([
            'tenant_id'    => $tenant->id,
            'tenant_name'  => $tenant->tenant_name,
            'owner_name'   => $tenant->owner_name,
            'owner_email'  => $tenant->owner_email,
            'password'     => bcrypt($tenant->password),
            'role'         => 'owner',
            'plan'         => $tenant->plan,
            'created_at'   => now(),
            'updated_at'   => now(),
        ]);
    }
}