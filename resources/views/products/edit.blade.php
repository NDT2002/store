@extends('Products.layout')
@section('content')
    <div class="card" style="margin:20px;">
        <title class="card-header">Thêm mới Sản Phẩm</title>
        <div class="card-body">
            <form action="{{ url('store/Products/' . $product->id) }}" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                @method('PUT')
                @csrf
                {{-- <input type="hidden" name="id" id="id" value="{{$product->id}}" class="form-control"> --}}
                <div class="d-flex ">
                    @if ($product->image_url != null)
                        @foreach (json_decode($product->image_url) as $image)
                            <img class="img-fluid rounded-start me-3" src="{{ asset('') . $image }}" style="max-width:400px" alt="Ảnh sản phẩm">
                        @endforeach
                    @endif
                    <label class="picture h-100" style="max-height: 20rem" for="image-product"  tabIndex="0">
                        <span class="picture_image" ></span>
                    </label>
                    <input  type="file" name="images[]" multiple class="form-control-file" id="image-product" multiple>

                </div>
                <div class="input-boxes row">

                    <div class="input-box col-md-7">
                        <label>Tên Sản Phẩm</label>
                        <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control">
                    </div>
                    <div class="input-box col-md-5">
                        <label>Giá Bán</label>
                        <input type="text" name="price" id="price" value="{{ $product->price }}" class="form-control">
                    </div>
                    <div class="input-box col-md-7" style="">
                        <label>Nhóm Hàng</label>
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Floating label select example">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"
                                        {{ $item->id == $product->category_id ? 'selected' : '' }}>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="input-box col-md-5">
                        <label>Số Lượng</label>
                        <input type="number" name="quantity" id="quantity" value="0" class="form-control">
                    </div>
                    <div class="input-box">
    
                        <label for="description">Ghi Chú</label>
                        <textarea name="description" id="description" placeholder="Thông tin mô tả" class="form-control" >{{ $product->description }}</textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 float-end ps-2 pe-3">
                    <h5><i class="bi bi-save me-2"></i> Lưu</h5>
                </button>
            </form>

        </div>
    </div>
    <script>
        const inputFile = document.querySelector("#image-product");
        const productImage = document.querySelector(".picture_image");
        const pictureImageTxt = "Chọn ảnh mới";
        productImage.innerHTML = pictureImageTxt;

        inputFile.addEventListener("change", function(e) {
            const inputTarget = e.target;
            const file = inputTarget.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener("load", function(e) {
                    const readerTarget = e.target;

                    const img = document.createElement("img");
                    img.src = readerTarget.result;
                    img.classList.add("picture_img");

                    productImage.innerHTML = "";
                    productImage.appendChild(img);
                });

                reader.readAsDataURL(file);
            } else {
                productImage.innerHTML = pictureImageTxt;
            }
        });
    </script>
@endsection
