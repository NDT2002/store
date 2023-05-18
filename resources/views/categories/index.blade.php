@extends('categories.layout')
@section('content')
<a href="{{ url('/store/categories/create') }}" class="btn btn-success btn-lg fw-bold" title="THÊM MỚI NHÓM HÀNG">
    <i class="bi bi-plus-circle"></i> THÊM MỚI
</a>
<div class="table-responsive mt-2">
    <table class="table table-striped table-bordered border-dark-subtle shadow">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th class="col-6">Tên nhóm</th>
                <th class="col-5">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($categories as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-start text-capitalize">{{ $item->name }}</td>

                <td class="text-center">
                    <a href="{{ url('/store/categories/' . $item->id) }}" title="View nhóm hàng"><button class="btn btn-info btn-lg ms-2"><i class="bi bi-eye me-2"></i> Xem</button></a>
                    <a href="{{ url('/store/categories/' . $item->id . '/edit') }}" title="Edit nhóm hàng"><button class="btn btn-primary btn-lg ms-2"><i class="bi bi-vector-pen me-2"></i> Cập nhật</button></a>

                    <form method="POST" action="{{ url('/store/categories' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-lg ms-2" title="Delete nhóm hàng" onclick="return confirm("Confirm delete?")"><i class="bi bi-trash3 me-2"></i></i> Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection