<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('back.categories.index', compact('categories'));
    }

    public function switch(Request $request)
    {
        $ctgr = Category::findOrFail($request->id);
        $ctgr->status = $request->statu == "true" ? 1 : 0;
        $ctgr->save();
    }
    public function create(Request $request)
    {
        $isExists = Category::whereSlug(Str::slug($request->category))->first();

        if ($isExists) {
            toastr()->error($request->category . ' Adında Kategori Mevcut !');
            return redirect()->back();
        }

        $category = new Category();
        $category->name = $request->category;
        $category->slug = Str::slug($request->category);
        $category->save();
        toastr()->success('Kategori Eklendi');
        return redirect()->back();
    }


    public function getData(Request $request)
    {
        $ctgr = Category::findOrFail($request->id);
        return response()->json($ctgr);
    }




    public function update(Request $request)
    {
        $isSlugExists = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id', [$request->id])->first();
        $isNameExists = Category::whereName($request->name)->whereNotIn('id', [$request->id])->first();
        if ($isSlugExists or  $isNameExists) {
            toastr()->error($request->category . ' Adında Kategori Mevcut !');
            return redirect()->back();
        }

        $category = Category::findOrFail($request->id);
        $category->name = $request->category;
        $category->slug = Str::slug($request->slug);
        $category->save();
        toastr()->success('Kategori Güncellendi');
        return redirect()->back();
    }
    public function delete(Request $request)
    {
        $ctgr = Category::findOrFail($request->id);
        $count = $ctgr->articleCount();
        $defaultCtgry = Category::find(8);
        $message = " ";
        if ($ctgr->id == 8) {
            toastr()->error('Bu Kategori Silinemez');
            return redirect()->back();
        }
        if ($count > 0) {
            Article::where('category_id', $ctgr->id)->update(['category_id' => 8]);
           
            $message = $count . ' içerik ' . $defaultCtgry->name . ' Kategorisine Taşındı Silinmesini İstiyorsanız içerikler Bölümüne Gidiniz !';
        }
        $ctgr->delete();
        toastr()->success($message, $request->name . ' Kategorisi Silindi.');
        return redirect()->back();
    }
}
