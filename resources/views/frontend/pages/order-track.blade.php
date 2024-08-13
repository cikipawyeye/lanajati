@extends('frontend.layouts.master')

@section('title','Lana-Jati Furnitur || Lihat Pesanan')

@section('main-content')
    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0);">Track Pesanan</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</section>
@endsection