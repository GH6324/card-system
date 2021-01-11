<?php
namespace App\Http\Controllers\Shop; use Illuminate\Database\Eloquent\Relations\Relation; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use App\Library\Response; class Product extends Controller { function get(Request $spa20801) { $sp664160 = (int) $spa20801->post('category_id'); if (!$sp664160) { return Response::forbidden('请选择商品分类'); } $spdd6a6c = \App\Category::where('id', $sp664160)->first(); if (!$spdd6a6c) { return Response::forbidden('商品分类未找到'); } if ($spdd6a6c->password_open && $spa20801->post('password') !== $spdd6a6c->password) { return Response::fail('分类密码输入错误'); } $sp0d1474 = \App\Product::where('category_id', $sp664160)->where('enabled', 1)->orderBy('sort')->get(); foreach ($sp0d1474 as $sp0a72f9) { $sp0a72f9->setForShop(); } return Response::success($sp0d1474); } function verifyPassword(Request $spa20801) { $sp17d280 = (int) $spa20801->post('product_id'); if (!$sp17d280) { return Response::forbidden('请选择商品'); } $sp0a72f9 = \App\Product::where('id', $sp17d280)->first(); if (!$sp0a72f9) { return Response::forbidden('商品未找到'); } if ($sp0a72f9->password_open && $spa20801->post('password') !== $sp0a72f9->password) { return Response::fail('商品密码输入错误'); } return Response::success(); } }