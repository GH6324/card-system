<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; class AddAddressToLogs extends Migration { public function up() { if (!Schema::hasColumn('logs', 'address')) { Schema::table('logs', function (Blueprint $sp6e715d) { $sp6e715d->string('address')->nullable()->after('ip'); }); } } public function down() { } }