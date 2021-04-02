<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
//Models
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use App\Models\Config;

class HomePage extends Controller
{
  public function __construct()
  {
    if (Config::find(1)->active == 0) {
      return redirect()->to('site-bakimda')->send();
    }
    view()->share('pages', Page::where('status', 1)->orderBy('order', 'ASC')->get());
    view()->share('categories', Category::where('status', 1)->inRandomOrder()->get());
  }
  public function Index()
  {
    $data['articles'] = Article::with('getCategoryName')->where('status', 1)->whereHas('getCategoryName', function ($query) {
      $query->where('status', 1);
    })->orderBy('created_at', 'DESC')->paginate(4);
    $data['articles']->withPath(url('/yazilar'));
    //  $data['categories']= Category::inRandomOrder()->get();
    //  $data['pages'] = Page::orderBy('order','ASC')->get();
    return view('front.homepage', $data);
  }

  public function Single($category, $slug)
  {
    $category = Category::where('slug', $category)->first() ?? abort(403, 'Böyle Bir Kategori Bulunamadı !');
    //article tablosundaki bir başlığa ait ve bu kategoriye ait
    //bir makale varsa getir.
    $article = Article::where('slug', $slug)->where('category_id', $category->id)->first() ?? abort(403, 'Böyle Bir Yazı Bulunamadı !');
    $article->increment('hit');  //tık+1
    $data['article'] = $article;
    //$data['categories']= Category::inRandomOrder()->get();
    return view('front.single', $data);
  }

  public function Category($ctrgy)
  {
    $category = Category::where('slug', $ctrgy)->first() ?? abort(403, "Böyle Bir Kategori Bulunamadı");
    $data['category'] = $category;
    $data['articles'] = Article::where('category_id', $category->id)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(2);
    //  $data['categories']= Category::inRandomOrder()->get();
    return view('front.categorie', $data);
  }
  public function Page($slug)
  {
    $page = Page::where('slug', $slug)->first() ?? abort(403, $slug . ' Sayfası Bulunamadı !');
    $data['page'] = $page;
    //  $data['pages'] = Page::orderBy('order','ASC')->get();
    return view('front.page', $data);
  }

  public function Contact()
  {

    return view('front.contact');
  }


  public function ContactPost(Request $request)
  {
    $rules = [
      'name' => 'required | min:6',
      'email' => 'required | email',
      'topic' => 'required',
      'message' => 'required | min:10',
    ];

    $validator = Validator::make($request->post(), $rules);

    if ($validator->fails()) {
      return redirect()->route('contact')->withErrors($validator)->withInput();
    } else {

      Mail::send(
        [],
        [],
        function ($message) use ($request) {
          $message->from('iletişim@blogsitesi.com', 'Blog Sitesi');
          $message->to('dnzdnz077@hotmail.com');
          $message->setBody('Mesajın Gönderilme Tarihi : ' . now() . '<br><br>' .
            'Mesajı Gönderen : ' . $request->name . '<br>' .
            'Mesajı Gönderen Mail : ' . $request->email . '<br>' .
            'Mesajın Konusu : ' . $request->topic . '<br>' .
            'Mesaj : ' . $request->message . '<br>', 'text/html');
          $message->subject($request->name . 'adlı kullanıcıdan bir mail var.');
        }
      );
      /*
      $contact = new Contact;
      $contact->name = $request->name;
      $contact->email = $request->email;
      $contact->topic = $request->topic;
      $contact->message = $request->message;
      $contact->save();*/

      return redirect()->route('contact')->with('success', 'Mesajınız İletildi !. Teşekkür ederiz');
    }
  }
}