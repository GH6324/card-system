<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class AddAllToFundRecords extends Migration { public function up() { if (!Schema::hasColumn('fund_records', 'all')) { Schema::table('fund_records', function (Blueprint $sp580417) { $sp580417->integer('all')->nullable()->after('amount'); $sp580417->integer('frozen')->nullable()->after('all'); $sp580417->integer('paid')->nullable()->after('frozen'); }); } } public function down() { foreach (array('all', 'frozen', 'paid') as $sp3dcdfd) { try { Schema::table('fund_records', function (Blueprint $sp580417) use($sp3dcdfd) { $sp580417->dropColumn($sp3dcdfd); }); } catch (\Throwable $sp6a7295) { } } } }