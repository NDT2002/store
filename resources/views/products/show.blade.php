@extends('Products.layout')
@section('content')
    <div class="card mb-3" style="max-width: ;">
        <div class="row m-0 bg-dark-subtle">
            <div class="col-md-3 ps-0">
                @if ($product->image_url!=null)
                    
                @foreach (json_decode($product->image_url) as $image)
                    <img class="img-fluid rounded-start " src="{{ asset('').$image }}" alt="Ảnh sản phẩm">
                @endforeach
                @endif
            </div>
            <div class="col-md-9  ">
                <div class="card-body ">
                    <h5 class="card-title">Tên Sản Phẩm: {{ $product->name }}</h5>
                    <p class="card-text">Loại: {{ $categories }}</p>
                    <p class="card-text">Mô Tả: {{ $product->description }}</p>
                    <p class="card-text">Giá Bán: $ {{ $product->price }} </p>
                    <p class="card-text">Số Lượng Còn Lại: {{ $product->quantity }} </p>
                    <p class="card-text"><small class="text-muted">Last updated {{ $product->updated_at }} </small></p>
                </div>
            </div>
            <div class="col-12 text-end pe-3 mb-2">
                <a href="{{ url('/store/Products/' . $product->id . '/edit') }}" title="Edit Sản phẩm"><button class="btn btn-warning btn-lg"><i class="bi bi-vector-pen me-2"></i> Cập nhật</button></a>

                    <form method="POST" action="{{ url('/store/Products' . '/' . $product->id) }}" accept-charset="UTF-8" style="display:inline">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-lg" title="Delete Sản phẩm" onclick="return confirm("Confirm delete?")"><i class="bi bi-trash3 me-2"></i></i> Xóa</button>
                    </form>
            </div>
        </div>
    </div>
@endsection
