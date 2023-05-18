@extends('categories.layout')
@section('content')
<div class="card" style="margin:20px;">
    <title class="card-header">Thêm mới Nhóm Hàng </title>
    <div class="card-body">
        
      <form action="{{ url('store/categories') }}" method="post">
        {!! csrf_field() !!}
        <label>Tên Nhóm</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <input type="submit" value="Lưu" class="btn btn-success"></br>
    </form>
  
    </div>
  </div>
    
@endsection