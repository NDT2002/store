@extends('categories.layout')
@section('content')
<article class="text-start">
    <h4 class="text-dark fw-bold text-capitalize">Nhóm Hàng:  {{ $Categories->name }} </h4>
</article>

<ul>
    <table class="table table-striped table-bordered border-dark-subtle shadow">
        <thead>
            <tr class="text-center" >
                <th class="col-1">#</th>
                <th class="col-6">Tên Sản Phẩm</th>
                <th class="col-5">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-start text-capitalize">{{ $product->name }}</td>

                <td class="text-center">
                    <a href="{{ url('/store/Products/' . $product->id) }}" title="View nhóm hàng"><button class="btn btn-info btn-lg ms-2"><i class="bi bi-eye me-2" aria-hidden="true"></i>Xem</button></a>
                    <a href="{{ url('/store/Products/' . $product->id . '/edit') }}" title="Edit nhóm hàng"><button class="btn btn-primary btn-lg ms-2"><i class="bi bi-vector-pen me-2"></i> Cập Nhật</button></a>

                    <form method="POST" action="{{ url('/store/Products' . '/' . $product->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-lg ms-2" title="Delete nhóm hàng" onclick="return confirm("Confirm delete?")"><i class="bi bi-trash3 me-2"></i></i> Xóa</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</ul>
@endsection