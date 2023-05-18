@extends('Products.layout')
@section('content')
    <div class="card" style="margin:20px;">
        <title class="card-header">Thêm mới Sản Phẩm</title>
        <div class="card-body">
            <form action="{{ url('store/Products/' . $product->id) }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @method('PUT')
                @csrf
                    @if ($product->image_url != null)
                        @foreach (json_decode($product->image_url) as $image)
                            <img class="img-fluid rounded-start " src="{{ asset('') . $image }}" alt="Ảnh sản phẩm">
                            @endforeach
                            @endif
                            
                            {{-- <input type="hidden" name="id" id="id" value="{{$product->id}}" class="form-control"> --}}
                <label>Tên Sản Phẩm</label>
                <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control">
                <label>Giá Bán</label>
                <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control">
                <label>Ghi Chú</label>
                <input type="text" name="description" id="description" value="{{ $product->description }}"
                    class="form-control">
                <label>Nhóm Hàng</label>
                <div class="form-floating">
                    <select class="form-select" name="category_id" id="category_id"
                        aria-label="Floating label select example">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                {{ $item->name }}</option>
                        @endforeach
                    </select>
                    <label for="category_id">Chọn Nhóm Sản Phẩm</label>
                    <label>Hình ảnh</label>
                    <input type="file" name="images[]" multiple class="form-control-file" multiple>
                </div>
                <input type="submit" value="Lưu" class="btn btn-success">
            </form>
            
        </div>
    </div>
@endsection
