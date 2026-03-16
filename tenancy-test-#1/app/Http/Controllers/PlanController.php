<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tenant;

class PlanController extends Controller
{
    public function index(){
        return response()->json([
            'plans' => [
                [
                    'name'  => 'Standard',
                    'price' => 9.99,
                ],
                [
                    'name'  => 'Pro',
                    'price' => 19.99,
                ],
                [
                    'name'  => 'Supreme',
                    'price' => 49.99,
                ],
            ]
        ]);
    }

    public function avail(Request $request, string $plan){
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $tenant = Tenant::create([
            'id'          => str()->slug($request->name),
            'tenant_name' => $request->name . "'s Workspace",
            'owner_name'  => $request->name,
            'owner_email' => $request->email,
            'password'    => $request->password,
            'plan'        => $plan,
        ]);

        $domain = str()->slug($request->name) . '.test';

        $tenant->domains()->create(['domain' => $domain]);

        return response()->json([
            'message' => 'Tenant created successfully!',
            'tenant'  => [
                'id'          => $tenant->id,
                'tenant_name' => $tenant->tenant_name,
                'owner_name'  => $tenant->owner_name,
                'owner_email' => $tenant->owner_email,
                'plan'        => $tenant->plan,
                'domain'      => $domain,
            ]
        ], 201);
    }
}
