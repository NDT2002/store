@extends('layout.master')
<link href="{{ asset('resources/css/app.css') }}" rel="stylesheet" integrity="" crossorigin="anonymous">
        @section('main')
                <article class="bg-primary fw-bold text-light p-2 mb-2">
                    <h2>DANH MỤC HÓA ĐƠN</h2>
                </article>
                <section class="bg-primary-subtle p-2">
                    @yield('content')
                </section>

        @endsection