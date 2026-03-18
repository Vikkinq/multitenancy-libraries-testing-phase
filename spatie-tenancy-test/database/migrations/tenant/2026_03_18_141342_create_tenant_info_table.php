<?php
 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    protected $connection = 'tenant';
 
    public function up(): void
    {
        Schema::create('tenant_info', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id');
            $table->string('tenant_name');
            $table->string('email');
            $table->timestamps();
        });
    }
 
    public function down(): void
    {
        Schema::connection('tenant')->dropIfExists('tenant_info');
    }
};
 