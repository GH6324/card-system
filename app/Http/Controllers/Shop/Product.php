<?php
namespace App\Http\Controllers\Shop; use Illuminate\Database\Eloquent\Relations\Relation; use Illuminate\Http\Request; use App\Http\Controllers\Controller; use App\Library\Response; class Product extends Controller { function get(Request $spba756f) { $sp55f32c = (int) $spba756f->post('category_id'); if (!$sp55f32c) { return Response::forbidden('请选择商品分类'); } $sp1cd1e4 = \App\Category::where('id', $sp55f32c)->first(); if (!$sp1cd1e4) { return Response::forbidden('商品分类未找到'); } if ($sp1cd1e4->password_open && $spba756f->post('password') !== $sp1cd1e4->password) { return Response::fail('分类密码输入错误'); } $spde3992 = \App\Product::where('category_id', $sp55f32c)->where('enabled', 1)->orderBy('sort')->get(); foreach ($spde3992 as $sp9dfc99) { $sp9dfc99->setForShop(); } return Response::success($spde3992); } function verifyPassword(Request $spba756f) { $sp1b83a8 = (int) $spba756f->post('product_id'); if (!$sp1b83a8) { return Response::forbidden('请选择商品'); } $sp9dfc99 = \App\Product::where('id', $sp1b83a8)->first(); if (!$sp9dfc99) { return Response::forbidden('商品未找到'); } if ($sp9dfc99->password_open && $spba756f->post('password') !== $sp9dfc99->password) { return Response::fail('商品密码输入错误'); } return Response::success(); } }