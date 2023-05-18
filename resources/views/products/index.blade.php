@extends('products.layout')
@section('content')
<a href="{{ url('/store/Products/create') }}" class="btn btn-success btn-lg fw-bold ms-2 shadow" title="THÊM MỚI SẢN PHẨM">
    <i class="bi bi-plus-circle"></i> THÊM MỚI
</a>
<div class="table-responsive mt-2 ps-2">

    <table class="table table-striped table-bordered border-black shadow bg-white">
        <thead>
            <tr class="text-center">
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Giá bán</th>
                <th>Tên Nhóm </th>
                <th>Số lượng</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
        @foreach($Products as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-start text-capitalize">{{ $item->name }}</td>
                <td class="text-start text-capitalize">{{ $item->price }}</td>
                <td class="text-start text-capitalize">{{ optional($item->category)->name }}</td>
                <td class="text-center text-capitalize">{{ $item->quantity }}</td>

                <td class="text-center">
                    <a href="{{ url('store/Products/' . $item->id) }}" title="View Sản phẩm"><button class="btn btn-info btn-lg ms-2"><i class="bi bi-eye me-2"></i>Xem</button></a>
                    <a href="{{ url('store/Products/' . $item->id . '/edit') }}" title="Edit Sản phẩm"><button class="btn btn-primary btn-lg ms-2"><i class="bi bi-vector-pen me-2"></i> Cập nhật </button></a>

                    <form method="POST" action="{{ url('/store/Products' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-lg ms-2" title="Delete Sản phẩm" onclick="return confirm('Confirm delete?')"><i class="bi bi-trash3 me-2"></i></i> Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection