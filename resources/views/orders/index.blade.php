@php
    use Carbon\Carbon;
    
@endphp
@extends('Orders.layout')
@section('content')
    <a href="{{ url('/store/Orders/create') }}" class="btn btn-success btn-lg fw-bold" title="THÊM MỚI HÓA ĐƠN">
        <i class="bi bi-plus-circle me-2"></i> THÊM MỚI
    </a>
    <div class="table-responsive mt-2">

        <table class="table table-striped table-bordered border-dark-subtle shadow">
            <thead>
                <tr class="text-center text-capitalize">
                    <th>#</th>
                    <th>Tên khách hàng</th>
                    <th>Số điên thoại</th>
                    <th>Tổng tiền </th>
                    <th>Ngày lập</th>
                    <th>Loại hóa đơn</th>
                    <th class="col-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Orders as $item)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-start text-capitalize">{{ $item->customer_name }}</td>
                        <td class="text-start text-capitalize">{{ $item->customer_phone }}</td>
                        <td class="text-center text-capitalize">{{ $item->total_price }}</td>
                        <td class="text-center text-capitalize">
                            {{ \Carbon\Carbon::parse($item->order_date)->format('H:i d/m/Y') }}
                        </td>
                        <td class="text-center text-capitalize">{{ ($item->order_type=='0')?'Nhập':'Xuất'; }}</td>

                        <td class="text-center">
                            <a href="{{ url('/store/Orders/' . $item->id) }}" title="View Hóa đơn"><button
                                    class="btn btn-info btn-lg ms-1"><i class="bi bi-eye me-2"></i> Xem</button></a>
                            <form method="POST" action="{{ url('/store/Orders' . '/' . $item->id) }}"
                                accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-lg ms-1" title="Delete Hóa đơn"
                                    onclick="return confirm("Confirm delete?")"><i class="bi bi-trash3 me-2"></i></i>
                                    Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endsection
