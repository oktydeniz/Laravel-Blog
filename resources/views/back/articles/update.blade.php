@extends('back.layouts.master')
@section('title',$article->title)
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
            <form method="post" enctype="multipart/form-data" action="{{route('admin.makaleler.update',$article->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">İçeriğin Başlığı</label>
                    <input type="text" value="{{$article->title}}" class="form-control" required name="title">
                </div>
                <div class="form-group">
                    <label for="">İçeriğin Ketegorisi</label>
                    <select class="form-control" name="category" required>
                        <option value="">Seçiniz</option>
                        @foreach($categories as $ctgr)
                        <option @if($article->category_id==$ctgr->id) selected @endif
                            value="{{$ctgr->id}}">{{$ctgr->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">İçeriğin Fotoğrafı</label><br>
                    <img src="{{asset($article->image)}}" class="rounded img-thumbnail m-2" width="200">
                    <input type="file" class="form-control" name="image">
                </div><br>
                <div class="form-group">
                    <label for="">İçerik </label>
                    <textarea id="summernote" class="form-control" rows="4" required name="content">{{$article->content}}</textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
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