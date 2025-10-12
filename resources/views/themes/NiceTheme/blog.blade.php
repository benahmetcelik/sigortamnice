@extends('themes.NiceTheme.layouts.app')

@section('title', 'Blog - Nice Yazılım')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-primary py-5 mb-5">
        <div class="container py-5">
            <div class="row align-items-center py-4">
                <div class="col-md-6 text-center text-md-left">
                    <h1 class="display-4 mb-4 mb-md-0 text-white">Blog</h1>
                </div>
                <div class="col-md-6 text-center text-md-right">
                    <div class="d-inline-flex align-items-center">
                        <a class="btn btn-lg btn-outline-light" href="{{ route('home') }}">Anasayfa</a>
                        <i class="fas fa-angle-double-right text-light mx-2"></i>
                        <a class="btn btn-lg btn-outline-light disabled" href="">Blog</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    @module('blogs_with_paginate')
@endsection 