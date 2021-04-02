@extends('back.layouts.master')
@section('title','Kategoriler')
@section('content')

<div class="row">

    <div class="col-md-4">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
            </div>
            <div class="card-body">
                <form action="{{route('admin.category.create')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input type="text" class="form-control" name="category" require>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-block btn-primary">Ekle</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <div class="col-md-8">

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"> @yield('title')</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kategori Adı</th>
                                <th>içerik Sayısı</th>
                                <th>Durum</th>
                                <th>İşlemler</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $item)
                            <tr>
                                <td>{{$item->name}}</td>
                                <td>{{$item->articleCount()}}</td>

                                <td>
                                    <input class="switch" category-id="{{$item->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" @if($item->status==1) checked @endif data-toggle="toggle" data-onstyle="outline-success" data-offstyle="outline-danger">
                                </td>
                                <td>
                                    <a category-id="{{$item->id}}" title="düzenle" class="btn btn-primary edit-click">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a category-id="{{$item->id}}" category-name="{{$item->name}}" category-count="{{$item->articleCount()}}" title="düzenle" class="btn btn-danger remove-click">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>

                                <td>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

</div>
<!-- Modal -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Kategoriyi Düzenle</h5>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.category.update')}}">
                    @csrf
                    <div class="form-group">
                        <label>Kategori Adı</label>
                        <input id="category" type="text" class="form-control" name="category">
                        <input type="hidden" name="id" id="category_id" />
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input id="slug" type="text" class="form-control" name="slug">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                <button type="submit" class="btn btn-success">Kaydet</button>
            </div>
            </form>

        </div>
    </div>
</div>


<!-- Modal Remove -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kategoriyi sil</h5>
                <button type="button" class="close" data-dismiss="modal">
                    &times;
                </button>
            </div>
            <div id="body" class="modal-body">
                <div id="article-alert" class="alert alert-danger">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal">Kapat</button>
                <form action="{{route('admin.category.delete')}}" method="post">
                    @csrf
                    <input type="hidden" name="id" id="remove-id">

                    <button type="submit" id="deleteBtn" class="btn btn-danger">Sil</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endSection

@section('css')

<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endSection

@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
    $('.edit-click').click(function() {

        id = $(this)[0].getAttribute('category-id');
        $.ajax({
            type: 'GET',
            url: "{{route('admin.category.getdata')}}",
            data: {
                id: id
            },
            success: function(data) {
                console.log(data);
                $('#category').val(data.name);
                $('#slug').val(data.slug);
                $('#category_id').val(data.id);
                $('#editModal').modal();
            }
        })
    })

    //remove 
    $('.remove-click').click(function() {
        id = $(this)[0].getAttribute('category-id');
        count = $(this)[0].getAttribute('category-count');
        name = $(this)[0].getAttribute('category-name');

        if (id == 8) {
            $('#article-alert').html(name + ' kategorisini Silemezsin. Bu kategori tüm içerikleri kapsar !');
            $('#deleteBtn').hide();
            $('#deleteModal').modal();
            return;
        }
        $('#deleteBtn').show();
        $('#remove-id').val(id);
        if (count > 0) {

            $('#article-alert').html('Bu kategoriye ait ' + count + ' adet içerik bulunuyor. Silmek İstediğinize Emin Misiniz ?');
        }
        if (count < 1) {
            $('#article-alert').html('Silmek İstediğinize Emin Misiniz ?');

        }
        $('#deleteModal').modal();
    })

    $(function() {

        $(".switch").change(function() {
            id = $(this)[0].getAttribute('category-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.category.switch')}}", {
                id: id,
                statu: statu
            }, function(data, statu) {})
        })

        $('#dataTable').DataTable();
        $('#dataTable tbody').on("click", ".switch", function() {
            console.log($(this)[0].getAttribute('category-id'));
            id = $(this)[0].getAttribute('category-id');
            statu = $(this).prop('checked');
            $.get("{{route('admin.category.switch')}}", {
                id: id,
                statu: statu
            }, function(data, statu) {})
        })

    })
</script>

@endSection