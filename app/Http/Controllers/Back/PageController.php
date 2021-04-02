<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('back.pages.index', compact('pages'));
    }
    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu == 'true' ? 1 : 0;
        $page->save();
    }
    public function create()
    {
        return view('back.pages.create');
    }


    public function postCreate(Request $request)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $last = Page::orderBy('order', 'desc')->first();

        $page = new Page;
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($request->title);
        $page->order = $last->order + 1;
        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }
        $page->save();
        toastr()->success('Sayfa Oluşturuldu !');
        return redirect()->route('admin.pages.index');
    }


    public function updatePage($id)
    {
        $page = Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }

    public function editPage(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->content = $request->content;
        $page->slug = Str::slug($request->title);

        if ($request->hasFile('image')) {
            $imageName = Str::slug($request->title) . "." . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = 'uploads/' . $imageName;
        }

        $page->save();
        toastr()->success(' Sayfa Güncellendi !');
        return redirect()->route('admin.pages.index');
    }
    public function deletePage($id)
    {
        $page = Page::find($id);
        if (File::exists($page->image)) {
            File::delete(public_path($page->image));
        }

        $page->delete();
        toastr()->success('Sayfa Silindi!');
        return redirect()->route('admin.pages.index');
    }
    public function order(Request $request)
    {
        foreach ($request->get('page') as $key => $order) {
            Page::where('id', $order)->update(['order' => $key]);
        }
    }
}
