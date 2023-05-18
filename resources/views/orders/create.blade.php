@extends('Orders.layout')
@section('content')
    <div class="card" style="margin:20px;">
        <title class="card-header bg-primary text-white">Thêm Hóa Đơn mới</title>
        <form action="{{ url('store/Orders') }}" method="post">
            {!! csrf_field() !!}
            <div class="p-2 row">
                <h4 class="text-capitalize fw-bold">Thông Tin Khách Hàng</h4>
                <div class="form-group col-md-6">
                    <label class="text-capitalize fw-bold" for="order_type">Loại Hóa Đơn</label>
                    <div class="">

                        <select class="form-select" id="order_type" name="order_type">
                            <option value="0">Nhập</option>
                            <option value="1">Xuất</option>
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label class="text-capitalize fw-bold" for="order_date">Ngày lập hóa đơn</label>
                    <input type="date" class="form-control" id="order_date" name="order_date" value="{{ $now }}"
                        placeholder="Enter order date">
                </div>
                <div class="form-group col-md-6">
                    <label class="text-capitalize fw-bold" for="customer_name">Tên khách hàng</label>
                    <input type="text" class="form-control" id="customer_name" name="customer_name"
                        placeholder="Enter customer name">
                </div>
                <div class="form-group col-md-6">
                    <label class="text-capitalize fw-bold" for="customer_email">Email</label>
                    <input type="email" class="form-control" id="customer_email" name="customer_email"
                        placeholder="Enter customer email">
                </div>

                <div class="form-group col-md-6">
                    <label class="text-capitalize fw-bold" for="customer_phone">Số điện thoại</label>
                    <input type="tel" class="form-control" id="customer_phone" name="customer_phone"
                        placeholder="Enter customer phone number">
                </div>


            </div>
            <div class="order-detail p-2 bg-info-subtle">
                <h4 class="text-capitalize fw-bold">Thông Tin đơn hàng :</h4>
                <div class="search-product row  m-0 align-items-center">
                    <label for="searchProducts" class="text-capitalize fw-bold col-2">Tìm kiếm sản phẩm: </label>
                    <input class="form-control col-md-6 mx-2" list="products" id="searchProducts"
                        placeholder="Type to search..." autocomplete="off">
                    <div class="btn btn-info col-1 " id="btn-add" class="col-1 ">Thêm</div>
                </div>
                <datalist id="products"> 
                </datalist>

                <div id="result" class="text-danger p-2 m-2 fw-bold"></div>
                <table class="table  table-striped table-hover">
                    <thead class="border-primary">
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-4">Tên sản phẩm</th>
                            <th class="col-2">Giá</th>
                            <th class="col-2">Số lượng</th>
                            <th class="col-2">Tổng tiền</th>
                            <th class="col-1"></th>
                        </tr>
                    </thead>
                    <tbody id="order-items">
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-end p-3  align-items-center">
                <label for="total-price" class="fw-bold text-info">Giá Trị Đơn Hàng:</label>
                <input type="text" id="total-price" name="total_price" class=" outline-none plaintext ms-2" value="0" readonly>
                <input type="submit" id="btn-save" class="btn btn-success btn-lg fw-bold ms-2" value="Hoàn Tất">
            </div>
            
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script> var url="{{ route('products.search') }}";</script>
    <script src="{{ asset('resources/js/app.js') }}"></script>
@endsection
