<?php
namespace App; use Illuminate\Database\Eloquent\Model; use Illuminate\Database\Eloquent\SoftDeletes; use Illuminate\Support\Facades\DB; class Card extends Model { protected $guarded = array(); use SoftDeletes; protected $dates = array('deleted_at'); const STATUS_NORMAL = 0; const STATUS_SOLD = 1; const STATUS_USED = 2; const TYPE_ONETIME = 0; const TYPE_REPEAT = 1; function orders() { return $this->hasMany(Order::class); } function product() { return $this->belongsTo(Product::class); } function getCountAttribute() { return $this->count_all - $this->count_sold; } public static function add_cards($spf93fb1, $spfb3e15, $sp915043, $sp24b3a3, $spb26d17, $spd6240b) { DB::statement('call add_cards(?,?,?,?,?,?)', array($spf93fb1, $spfb3e15, $sp915043, $sp24b3a3, $spb26d17, (int) $spd6240b)); } public static function _trash($spc64cdd) { DB::transaction(function () use($spc64cdd) { $sp331291 = clone $spc64cdd; $sp331291->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count_left`')->groupBy('product_id')->orderByRaw('`product_id`')->chunk(100, function ($spc894da) { foreach ($spc894da as $spbded80) { $sp94204a = \App\Product::where('id', $spbded80->product_id)->lockForUpdate()->first(); if ($sp94204a) { $sp94204a->count_all -= $spbded80->count_left; $sp94204a->saveOrFail(); } } }); $spc64cdd->delete(); return true; }); } public static function _restore($spc64cdd) { DB::transaction(function () use($spc64cdd) { $sp331291 = clone $spc64cdd; $sp331291->selectRaw('`product_id`,SUM(`count_all`-`count_sold`) as `count_left`')->groupBy('product_id')->orderByRaw('`product_id`')->chunk(100, function ($spc894da) { foreach ($spc894da as $spbded80) { $sp94204a = \App\Product::where('id', $spbded80->product_id)->lockForUpdate()->first(); if ($sp94204a) { $sp94204a->count_all += $spbded80->count_left; $sp94204a->saveOrFail(); } } }); $spc64cdd->restore(); return true; }); } }