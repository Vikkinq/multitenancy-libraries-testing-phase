<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Tenant;
use App\Models\Plan;

class PlanController extends Controller
{
    public function index(){
        return response()->json([
            "plans" => Plan::all(),
        ]);
    }

    public function avail(Request $request, string $plan){
        $request->validate([
            'name'  => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $selectedPlan = Plan::where('name', $plan)->firstOrFail();

        // Creation of Tenant
        $tenant = Tenant::create([
            'id'          => str()->slug($request->name),
            'tenant_name' => $request->name . "'s Workspace",
            'owner_name'  => $request->name,
            'owner_email' => $request->email,
            'password'    => $request->password,
            'plan'        => $selectedPlan->name,
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
                'plan'        => $selectedPlan->name,
                'plan_price'  => $selectedPlan->amount,
                'domain'      => $domain,
            ]
        ], 201);
    }
}
