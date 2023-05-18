@extends('layout.master')
        @section('main')
                <article class="bg-primary fw-bold text-light p-2 mb-2">
                    <h2>DANH MỤC NHÓM HÀNG</h2>
                </article>
                <section class=" p-0 bg-primary-subtle p-2">
                    @yield('content')
                </section>

        @endsection