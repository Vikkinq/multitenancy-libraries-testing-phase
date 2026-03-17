<?php

namespace App\TenantFinder;

use Illuminate\Http\Request;
use Spatie\Multitenancy\Contracts\IsTenant;
use Spatie\Multitenancy\TenantFinder\TenantFinder;

class HeaderTenantFinder extends TenantFinder
{
    public function findForRequest(Request $request): ?IsTenant
    {
        $tenantKey = $request->header('X-Tenant');

        if (! $tenantKey) {
            return null;
        }

        return \App\Models\Tenant::where('id', $tenantKey)->first();
    }
}