@extends('layout.master')
<link rel="stylesheet" href="{{ asset('/resources/css/app.css') }}">

        @section('main')
                <article class="bg-primary text-light p-2 mb-2">
                    <h2>DANH MỤC SẢN PHẨM</h2>
                </article>
                <section class=" p-0 bg-primary-subtle p-2">
                    @yield('content')
                </section>

        @endsection
