@extends('back.layouts.master')
@section('title','Silinen içerikler')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">Aşağıda tüm yazıların en güncel tarihten başlayarak sıralanmıştır.</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary"><span>{{$articles->count()}} Yazı Bulundu</span>

                <a href="{{route('admin.makaleler.index')}}" class="btn btn-info btn-sm p-2 m-1">Aktif Makaleler</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Fotoğraf</th>
                            <th>Başlık</th>
                            <th>Kategori</th>
                            <th>Tarih</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                        <tr>
                            <td>
                                <img src="{{$article->image}}" width="100" height="100" />
                            </td>
                            <td>{{$article->title}}</td>
                            <td>{{$article->getCategoryName->name}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td>
                                <a href="{{route('admin.recover.article',$article->id)}}" title="Geri Al" class="btn btn-sm btn-success"><i class="fas fa-recycle"></i></a>
                                <a href="{{route('admin.deleting.article',$article->id)}}" title="Komple Sil" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endSection

@section('css')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endSection


@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

@endSection