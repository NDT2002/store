@extends('Products.layout')
@section('content')
    <div class="card" style="margin:20px;">
        <title class="card-header">Thêm mới Sản Phẩm</title>
        <div class="card-body ">
            <form action="{{ url('store/Products') }}" class="row" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <div class="input-box col-md-5  d-flex align-items-center">
                    <label class="picture" for="image-product" tabIndex="0">
                        <span class="picture_image"></span>
                    </label>
                    <input type="file" name="images[]" multiple class="form-control-file" id="image-product" multiple>
                </div>
                <div class="col-md-6">

                    <div class="input-box">
                        <label for="name">Tên Sản Phẩm</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="input-box">
                        <label for="price">Giá Bán</label>
                        <input type="number" min=0 value="0" name="price" id="price" class="form-control">
                    </div>
                    <div class="input-box">
    
                        <label for="description">Ghi Chú</label>
                        <textarea name="description" id="description" placeholder="Thông tin mô tả" class="form-control" ></textarea>
                    </div>
                    <div class="input-box">
                        <label for="category_id">Nhóm Hàng</label>
                        <div class="form-floating">
                            <select class="form-select" name="category_id" id="category_id"
                                aria-label="Floating label select example">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <label for="category_id">Chọn Nhóm Sản Phẩm</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3 float-end ps-2 pe-3">
                    <h5><i class="bi bi-save "></i> Lưu</h5>
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
