<?php
namespace App\Http\Controllers\Merchant; use App\Library\Response; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use Illuminate\Support\Facades\Auth; class Log extends Controller { function get(Request $sp26e527) { $sp699450 = $sp26e527->input('user_id'); $sp9a9cb6 = $sp26e527->input('action', \App\Log::ACTION_LOGIN); $spcfdf85 = \App\Log::where('action', $sp9a9cb6); $spcfdf85->where('user_id', Auth::id()); $sp6bf7ca = $sp26e527->input('start_at'); if (strlen($sp6bf7ca)) { $spcfdf85->where('created_at', '>=', $sp6bf7ca . ' 00:00:00'); } $sp7d8b2f = $sp26e527->input('end_at'); if (strlen($sp7d8b2f)) { $spcfdf85->where('created_at', '<=', $sp7d8b2f . ' 23:59:59'); } $sp81cf40 = (int) $sp26e527->input('current_page', 1); $sp8de1f1 = (int) $sp26e527->input('per_page', 20); $spccc256 = $spcfdf85->orderBy('created_at', 'DESC')->paginate($sp8de1f1, array('*'), 'page', $sp81cf40); return Response::success($spccc256); } }