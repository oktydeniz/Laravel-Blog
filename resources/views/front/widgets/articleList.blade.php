<?php if (count($articles)>0): ?>
@foreach ($articles as $key)
  <div class="post-preview">
    <a href="{{route('single',[$key->getCategoryName->slug,$key->slug])}}">
      <h2 class="post-title">
      {{$key->title}}
      </h2>
      <img class="imgPosts img-fluid" src='{{$key->image}}'/><br><br>
      <h3 class="post-subtitle">
        {!!Str::limit($key->content,78)!!}
      </h3>
    </a>
    <p class="post-meta">Category :
      <a href="#">{{$key->getCategoryName->name}}</a>
      <span class="float-right">{{$key->created_at->diffForHumans()}}</span>
    </p>
  </div>
  @if(!$loop->last) <hr> @endif
@endforeach

<div class="d-flex justify-content-center">
    {{$articles->links()}}
</div>
  @else <div class="alert alert-danger">{{$category->name}} kategorisine ait yazı bulunamadı :-( </div>
  <?php endif; ?>
