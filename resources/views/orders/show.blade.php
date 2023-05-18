@extends('Orders.layout')
@section('content')
    <article class="text-start">
        <h3 class="text-capitalize fw-bold">Thông tin Khách hàng : </h3>
        <div class="customer-info bg-white p-2 mb-2 row mx-1">
            <h5 class="text-black text-capitalize col-md-6">Họ Tên: {{ $Orders->customer_name }} </h5>
            <h5 class="text-black text-capitalize col-md-6">Địa Chỉ Email : {{ $Orders->customer_email }} </h5>
            <h5 class="text-black text-capitalize col-md-6 ">Số điện thoại : {{ $Orders->customer_phone }} </h5>
            <h5 class="text-black text-capitalize col-md-6 fw-bold">Tổng Giá Trị Đơn hàng : ${{ $Orders->total_price }} </h5>
        </div>
    </article>
    <h3 class="text-capitalize fw-bold">Chi Tiết đơn hàng : </h3>
    <table class="table table-striped table-bordered border-dark-subtle shadow bg-white">
        <thead>
            <tr class="text-center text-capitalize">
                <th class="col-1">#</th>
                <th class="col-5">Tên Sản Phẩm</th>
                <th class="col-2">Số Lượng</th>
                <th class="col-2">Giá Tiền</th>
                <th class="col-3">Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($Orders->Order_item as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-start text-capitalize">{{ $item->product->name }}</td>
                    <td class="text-center text-capitalize">{{ $item->quantity }}</td>
                    <td class="text-center text-capitalize">{{ $item->price }}</td>

                    <td class="text-center">
                        <a href="{{ url('/store/Products/' . $item->product->id) }}" title="View nhóm hàng"><button
                                class="btn btn-info btn-lg ms-2"><i class="bi bi-eye me-2"
                                    aria-hidden="true"></i>Xem</button></a>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
