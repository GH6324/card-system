<?php
namespace App\Library; class Response { public static function json($spac70ab = array(), $sp0f5dbe = 200, array $spfeddd9 = array(), $sp4c11cc = 0) { return response()->json($spac70ab, $sp0f5dbe, $spfeddd9, $sp4c11cc); } public static function success($spac70ab = array()) { return self::json(array('message' => 'success', 'data' => $spac70ab)); } public static function fail($sp93a168 = 'fail', $spac70ab = array()) { return self::json(array('message' => $sp93a168, 'data' => $spac70ab), 500); } public static function forbidden($sp93a168 = 'forbidden', $spac70ab = array()) { return self::json(array('message' => $sp93a168, 'data' => $spac70ab), 403); } }