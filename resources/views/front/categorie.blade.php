@extends('front.layouts.master')
@section('title',$category->name." Kategorisindeki Yazılar | "." ".count($articles)." adet yazı bulundu. ")
@section('content')
<div class="col-md-9 mx-auto">
    @include('front.widgets.articleList')
</div>
@include('front.widgets.categoriewidget')
@endsection