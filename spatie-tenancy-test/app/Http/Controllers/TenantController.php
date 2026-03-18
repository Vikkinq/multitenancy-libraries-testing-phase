<?php


namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    // List all tenants
    public function index(){
        return response()->json(Tenant::all());
    }

    // Create a tenant (auto-creates its DB)
    public function store(Request $request){
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
        ]);

        $tenant = Tenant::create($request->only('name'));
        $tenant->setupDatabase(email: $request->email);

        return response()->json([
            'message' => 'Tenant created',
            'tenant'  => $tenant,
        ], 201);
    }

    // Prove tenant identification + DB switching
    public function whoami(){
        $tenant = Tenant::current();

        if (!$tenant) {
            return response()->json(['message' => 'No tenant identified'], 400);
        }

        $tenantInfo = DB::connection('tenant')->table('tenant_info')->first();

        return response()->json([
            'tenant_id'   => $tenant->id,
            'tenant_name' => $tenant->name,
            'tenant_db'   => $tenant->database,
            'tenant_domain' => $tenant->domain,
            'active_db'   => DB::connection('tenant')->getDatabaseName(),
            'tenant_info' => $tenantInfo,
        ]);
    }
}