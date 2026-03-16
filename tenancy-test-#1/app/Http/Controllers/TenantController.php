<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant;

use Illuminate\Support\Facades\DB;

class TenantController extends Controller
{
    public function index(){
        return response()->json([
            'tenants' => Tenant::with('domains')->get()
        ]);
    }

    public function current(Request $request){
        return response()->json([
            'message'     => 'You are inside a tenant!',
            'tenant_id'   => tenant('id'),
            'tenant_info' => DB::table('tenant_info')->first(),
        ]);
    }

    public function test(Request $request){
        return response()->json([
            'tenant_id' => tenant('id'),
            'db'        => DB::connection()->getDatabaseName(),
        ]);
    }
}
