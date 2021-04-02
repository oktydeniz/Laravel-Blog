@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')

      <div class="col-md-9 mx-auto">
        @include('front.widgets.articleList')
    </div>
        <!-- Pager
        <br>

        <div class="clearfix">
          <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
        </div>  <br>-->
@include('front.widgets.categoriewidget')
@endsection
