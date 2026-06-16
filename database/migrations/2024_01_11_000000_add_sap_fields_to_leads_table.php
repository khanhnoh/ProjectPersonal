<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->string('industry')->nullable()->after('company');
            $table->string('annual_revenue')->nullable()->after('industry');
            $table->string('legacy_erp')->nullable()->after('annual_revenue');
            $table->json('sap_modules')->nullable()->after('legacy_erp');
            $table->string('deployment_type')->nullable()->after('sap_modules');
        });

        // Đổi status enum sang pipeline stages của SAP presales
        DB::statement("ALTER TABLE leads MODIFY COLUMN status ENUM('prospect','qualified','proposal','won','lost') NOT NULL DEFAULT 'prospect'");
    }

    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn(['industry', 'annual_revenue', 'legacy_erp', 'sap_modules', 'deployment_type']);
        });

        DB::statement("ALTER TABLE leads MODIFY COLUMN status ENUM('new','in_progress','qualified','rejected') NOT NULL DEFAULT 'new'");
    }
};
