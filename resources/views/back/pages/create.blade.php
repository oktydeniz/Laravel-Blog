@extends('back.layouts.master')
@section('title','Yeni Sayfa Oluştur')
@section('content')

<div class="container-fluid">

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold float-right text-primary"> @yield('title')</h6>
    </div>
    <div class="card-body">
      @if($errors ->any())
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $e)
          <li>{{$e}}</li>
          @endforeach
          <ul>
      </div>
      @endif
      <form method="post" enctype="multipart/form-data" action="{{route('admin.page.create.post')}}">
        @csrf
        <div class="form-group">
          <label for="">Sayfanın Başlığı</label>
          <input type="text" class="form-control" required name="title">
        </div>
        <div class="form-group">
          <label for="">Sayfanın Fotoğrafı</label>
          <input type="file" class="form-control" required name="image">
        </div>
        <div class="form-group">
          <label for="">İçerik</label>
          <textarea id="summernote" class="form-control" rows="4" required name="content"></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Oluştur </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endSection
@section('css')
<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endSection
@section('js')
<!-- include summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  $(document).ready(function() {
    $('#summernote').summernote({
      'height': 300
    });
  });
</script>

@endSection