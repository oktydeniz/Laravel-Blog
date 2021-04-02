<?php if (isset($categories)): ?>
  <div class="col-md-3">
    <div class="card">
      <div class="card-header">
          Kategoriler
        </div>
        <div class="list-group">
            <?php foreach ($categories as $categorie): ?>
              <li class="list-group-item @if(Request::segment(2)==$categorie->slug) active @endif" >
              <a @if(Request::segment(2)!=$categorie->slug)   href="{{route('categoryRoot',$categorie->slug)}}" @endif>{{$categorie->name}}</a><span class="badge float-right bg-danger text-white">{{$categorie->articleCount()}}</span></li>
            <?php endforeach; ?>
          </div>
    </div>
  </div>
<?php endif; ?>
