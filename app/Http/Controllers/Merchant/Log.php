<?php
namespace App\Http\Controllers\Merchant; use App\Library\Response; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use Illuminate\Support\Facades\Auth; class Log extends Controller { function get(Request $spba756f) { $spf5ae13 = $spba756f->post('user_id'); $sp898a26 = $spba756f->post('action', \App\Log::ACTION_LOGIN); $spca8acc = \App\Log::where('action', $sp898a26); $spca8acc->where('user_id', Auth::id()); $sp5a57fe = $spba756f->post('start_at'); if (strlen($sp5a57fe)) { $spca8acc->where('created_at', '>=', $sp5a57fe . ' 00:00:00'); } $sp4e495c = $spba756f->post('end_at'); if (strlen($sp4e495c)) { $spca8acc->where('created_at', '<=', $sp4e495c . ' 23:59:59'); } $sp881a75 = $spba756f->post('current_page', 1); $sp2a01a9 = $spba756f->post('per_page', 20); $spfea7ce = $spca8acc->orderBy('created_at', 'DESC')->paginate($sp2a01a9, array('*'), 'page', $sp881a75); return Response::success($spfea7ce); } }