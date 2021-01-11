<?php
use Illuminate\Support\Facades\Schema; use Illuminate\Database\Schema\Blueprint; use Illuminate\Database\Migrations\Migration; use Illuminate\Support\Facades\DB; class CreateLogsTable extends Migration { public function up() { Schema::create('logs', function (Blueprint $sp6e715d) { $sp6e715d->increments('id'); $sp6e715d->integer('user_id')->index(); $sp6e715d->string('ip'); $sp6e715d->string('address')->nullable(); $sp6e715d->integer('action')->default(\App\Log::ACTION_LOGIN); $sp6e715d->timestamp('created_at')->useCurrent(); }); } public function down() { Schema::dropIfExists('logs'); } }