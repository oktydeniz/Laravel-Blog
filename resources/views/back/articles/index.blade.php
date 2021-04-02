@extends('back.layouts.master')
@section('title','Tüm içerikler')
@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <p class="mb-4">Aşağıda tüm yazıların en güncel tarihten başlayarak sıralanmıştır.</p>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary"><span>{{$articles->count()}} Yazı Bulundu</span>

                <a href="{{route('admin.trashes.articles')}}" class="btn btn-warning btn-sm p-2 m-1"><i class="fa fa-trash"></i>Silinenler</a>
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
                            <th>Tıklanma</th>
                            <th>Tarih</th>
                            <th>Durum</th>
                            <th>İşlemler
                            </th>
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
                            <td>{{$article->hit}}</td>
                            <td>{{$article->created_at->diffForHumans()}}</td>
                            <td><input class="switch" article-id="{{$article->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" @if($article->status==1) checked @endif data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger"></td>
                            <td> <a target="_blank" href="{{route('single',[$article->getCategoryName->slug,$article->slug])}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.makaleler.edit',$article->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.delete.article',$article->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
<script>
    $(function() {

        $(".switch").change(function() {
            id = $(this)[0].getAttribute('article-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {})
        })

        $('#dataTable').DataTable();
        $('#dataTable tbody').on("click", ".switch", function() {
            console.log($(this)[0].getAttribute('article-id'));
            id = $(this)[0].getAttribute('article-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.switch')}}", {
                id: id,
                statu: statu
            }, function(data, status) {})
        })

    })
</script>
@endSection