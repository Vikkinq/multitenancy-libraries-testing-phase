<?php

// app/Models/Tenant.php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant
{
    protected $connection = 'landlord';

    protected $fillable = ['name', 'database', 'domain'];

    protected static function booted(): void
    {
        static::creating(function (Tenant $tenant) {
            if (empty($tenant->database)) {
                $tenant->database = 'tenant_' . str($tenant->name)->slug('_');
            }
            if (empty($tenant->domain)) {
                $tenant->domain = str($tenant->name)->slug('_') . '.test';
            }
        });

        static::created(function (Tenant $tenant) {
            // Create the PostgreSQL database
            DB::connection('landlord')
                ->statement("CREATE DATABASE \"{$tenant->database}\"");

            // Switch to tenant and run migrations
            $tenant->makeCurrent();

            Artisan::call('migrate', [
                '--database' => 'tenant',
                '--path'     => 'database/migrations/tenant',
                '--force'    => true,
            ]);

            Tenant::forgetCurrent();
        });
    }
}