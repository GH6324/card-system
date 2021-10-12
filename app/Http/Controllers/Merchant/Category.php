<?php
namespace App\Http\Controllers\Merchant; use App\Library\Helper; use App\Library\Response; use App\System; use Illuminate\Http\Request; use App\Http\Controllers\Controller; class Category extends Controller { function get(Request $spe5a184) { $sp32b355 = (int) $spe5a184->input('current_page', 1); $sp048014 = (int) $spe5a184->input('per_page', 20); $spa8a4ff = $this->authQuery($spe5a184, \App\Category::class); $sp8336a0 = $spe5a184->input('search', false); $spdbda3a = $spe5a184->input('val', false); if ($sp8336a0 && $spdbda3a) { if ($sp8336a0 == 'simple') { return Response::success($spa8a4ff->get(array('id', 'name'))); } elseif ($sp8336a0 == 'id') { $spa8a4ff->where('id', $spdbda3a); } else { $spa8a4ff->where($sp8336a0, 'like', '%' . $spdbda3a . '%'); } } $sp89bdae = $spe5a184->input('enabled'); if (strlen($sp89bdae)) { $spa8a4ff->whereIn('enabled', explode(',', $sp89bdae)); } $spdf0cee = $spa8a4ff->withCount('products')->orderBy('sort')->paginate($sp048014, array('*'), 'page', $sp32b355); foreach ($spdf0cee->items() as $spf6286b) { $spf6286b->setAppends(array('url')); } return Response::success($spdf0cee); } function sort(Request $spe5a184) { $this->validate($spe5a184, array('id' => 'required|integer')); $spf6286b = $this->authQuery($spe5a184, \App\Category::class)->findOrFail($spe5a184->post('id')); $spf6286b->sort = (int) $spe5a184->post('sort', 1000); $spf6286b->save(); return Response::success(); } function edit(Request $spe5a184) { $this->validate($spe5a184, array('name' => 'required|string|max:128')); $spbc4c78 = $spe5a184->post('name'); $sp89bdae = (int) $spe5a184->post('enabled'); $sp82efe0 = $spe5a184->post('sort'); $sp82efe0 = $sp82efe0 === NULL ? 1000 : (int) $sp82efe0; if (System::_getInt('filter_words_open') === 1) { $spde3725 = explode('|', System::_get('filter_words')); if (($spa64ee0 = Helper::filterWords($spbc4c78, $spde3725)) !== false) { return Response::fail('提交失败! 分类名称包含敏感词: ' . $spa64ee0); } } if ($sp82efe0 < 0 || $sp82efe0 > 1000000) { return Response::fail('排序需要在0-1000000之间'); } $spc3374e = $spe5a184->post('password'); $spe99a30 = $spe5a184->post('password_open') === 'true'; if ((int) $spe5a184->post('id')) { $spf6286b = $this->authQuery($spe5a184, \App\Category::class)->findOrFail($spe5a184->post('id')); } else { $spf6286b = new \App\Category(); $spf6286b->user_id = $this->getUserIdOrFail($spe5a184); } $spf6286b->name = $spbc4c78; $spf6286b->sort = $sp82efe0; $spf6286b->password = $spc3374e; $spf6286b->password_open = $spe99a30; $spf6286b->enabled = $sp89bdae; $spf6286b->saveOrFail(); return Response::success(); } function enable(Request $spe5a184) { $this->validate($spe5a184, array('ids' => 'required|string', 'enabled' => 'required|integer|between:0,1')); $sp8152f4 = $spe5a184->post('ids', ''); $sp89bdae = (int) $spe5a184->post('enabled'); $this->authQuery($spe5a184, \App\Category::class)->whereIn('id', explode(',', $sp8152f4))->update(array('enabled' => $sp89bdae)); return Response::success(); } function delete(Request $spe5a184) { $this->validate($spe5a184, array('ids' => 'required|string')); $sp8152f4 = $spe5a184->post('ids', ''); $this->authQuery($spe5a184, \App\Category::class)->whereIn('id', explode(',', $sp8152f4))->delete(); return Response::success(); } }