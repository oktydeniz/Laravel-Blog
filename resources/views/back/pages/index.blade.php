@extends('back.layouts.master')
@section('title','Sayfalama İşlemleri')
@section('content')

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold float-right text-primary"><span>{{$pages->count()}} Sayfa Bulundu</span>
            </h6>
        </div>

        <div class="card-body">
            <div id="orderSuccess" style="display: none;" class="alert alert-success">Sıralama Güncellendi</div>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Sıralama</th>
                            <th>Fotoğraf</th>
                            <th>Başlık</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody id="orders">
                        @foreach($pages as $item)
                        <tr id="page_{{$item->id}}">
                            <td style="width: 50px;" class="text-center">
                                <i class="fas fa-expand-arrows-alt fa-2x handle" style="cursor: move;"></i>
                            </td>
                            <td>
                                <img src="{{$item->image}}" width="100" height="100" />
                            </td>
                            <td>{{$item->title}}</td>
                            <td>
                                <input class="switch" page-id="{{$item->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" @if($item->status==1) checked @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a target="_blank" href="{{route('page',$item->slug)}}" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.page.edit',$item->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.page.delete',$item->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.13.0/Sortable.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
    $('#orders').sortable({
        handle: '.handle',
        update: function() {
            var siralama = $('#orders').sortable('serialize');
            $.get("{{route('admin.page.order')}}?" + siralama, function(data, status) {
                //$('#orderSuccess').show();
                /*setTimeout(function() {
                    $('#orderSuccess').hide();
                }, 1100);*/
                $('#orderSuccess').show().delay(1100).fadeOut();

            });
        }
    });
</script>

<script>
    $(function() {

        $(".switch").change(function() {
            id = $(this)[0].getAttribute('page-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.page.switch')}}", {
                id: id,
                statu: statu,
            }, function(data, statu) {});
        });
        $('#dataTable').DataTable();
        $('#dataTable tbody').on("click", ".switch", function() {
            console.log($(this)[0].getAttribute('page-id'));
            id = $(this)[0].getAttribute('page-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.page.switch')}}", {
                id: id,
                statu: statu
            }, function(data, statu) {})
        });
    })
</script>
@endSection