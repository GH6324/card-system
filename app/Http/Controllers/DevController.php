<?php
namespace App\Http\Controllers; use App\System; use Illuminate\Http\Request; use Illuminate\Support\Facades\Log; use Illuminate\Support\Facades\Mail; class DevController extends Controller { private function check_readable_r($spbc0e03) { if (is_dir($spbc0e03)) { if (is_readable($spbc0e03)) { $sp8a1688 = scandir($spbc0e03); foreach ($sp8a1688 as $spdbc829) { if ($spdbc829 != '.' && $spdbc829 != '..') { if (!self::check_readable_r($spbc0e03 . '/' . $spdbc829)) { return false; } else { continue; } } } echo $spbc0e03 . '   ...... <span style="color: green">R</span><br>'; return true; } else { echo $spbc0e03 . '   ...... <span style="color: red">R</span><br>'; return false; } } else { if (file_exists($spbc0e03)) { return is_readable($spbc0e03); } } echo $spbc0e03 . '   ...... 文件不存在<br>'; return false; } private function check_writable_r($spbc0e03) { if (is_dir($spbc0e03)) { if (is_writable($spbc0e03)) { $sp8a1688 = scandir($spbc0e03); foreach ($sp8a1688 as $spdbc829) { if ($spdbc829 != '.' && $spdbc829 != '..') { if (!self::check_writable_r($spbc0e03 . '/' . $spdbc829)) { return false; } else { continue; } } } echo $spbc0e03 . '   ...... <span style="color: green">W</span><br>'; return true; } else { echo $spbc0e03 . '   ...... <span style="color: red">W</span><br>'; return false; } } else { if (file_exists($spbc0e03)) { return is_writable($spbc0e03); } } echo $spbc0e03 . '   ...... 文件不存在<br>'; return false; } private function checkPathPermission($spffbc51) { self::check_readable_r($spffbc51); self::check_writable_r($spffbc51); } public function install() { $sp11e67e = array(); @ob_start(); self::checkPathPermission(base_path('storage')); self::checkPathPermission(base_path('bootstrap/cache')); $sp11e67e['permission'] = @ob_get_clean(); return view('install', array('var' => $sp11e67e)); } public function test(Request $spba756f) { } }