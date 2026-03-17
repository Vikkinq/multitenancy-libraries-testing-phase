<?php

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
    }

    public function setupDatabase(): void
    {
        $databaseName = $this->database;
        DB::connection('landlord')->statement("CREATE DATABASE \"{$databaseName}\"");
        $this->makeCurrent();
        Artisan::call('migrate', [
            '--database' => 'tenant',
            '--path'     => 'database/migrations/tenant',
            '--force'    => true,
        ]);

        self::forgetCurrent();
    }
}