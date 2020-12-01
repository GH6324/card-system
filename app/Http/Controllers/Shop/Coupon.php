<?php
namespace App\Http\Controllers\Shop; use App\Category; use App\Product; use App\Library\Response; use Carbon\Carbon; use Illuminate\Http\Request; use App\Http\Controllers\Controller; class Coupon extends Controller { function info(Request $spa27895) { $sp980f44 = (int) $spa27895->post('category_id', -1); $sp112a12 = (int) $spa27895->post('product_id', -1); $sp2a00ee = $spa27895->post('coupon'); if (!$sp2a00ee) { return Response::fail('请输入优惠券'); } if ($sp980f44 > 0) { $spd14ca3 = Category::findOrFail($sp980f44); $sp258cf6 = $spd14ca3->user_id; } elseif ($sp112a12 > 0) { $sp1a3ec5 = Product::findOrFail($sp112a12); $sp258cf6 = $sp1a3ec5->user_id; } else { return Response::fail('请先选择分类或商品'); } $sp6de18e = \App\Coupon::where('user_id', $sp258cf6)->where('coupon', $sp2a00ee)->where('expire_at', '>', Carbon::now())->whereRaw('`count_used`<`count_all`')->get(); foreach ($sp6de18e as $sp2a00ee) { if ($sp2a00ee->category_id === -1 || $sp2a00ee->category_id === $sp980f44 && ($sp2a00ee->product_id === -1 || $sp2a00ee->product_id === $sp112a12)) { $sp2a00ee->setVisible(array('discount_type', 'discount_val')); return Response::success($sp2a00ee); } } return Response::fail('您输入的优惠券信息无效<br>如果没有优惠券请不要填写'); } }