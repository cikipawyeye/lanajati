@extends('frontend.layouts.master')
@section('title','Cart Page')
@section('main-content')
	<!-- Breadcrumbs -->
	<div class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="bread-inner">
						<ul class="bread-list">
							<li><a href="{{('home')}}">Home<i class="ti-arrow-right"></i></a></li>
							<li class="active"><a href="">Keranjang</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End Breadcrumbs -->

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								
								<th>PRODUK</th>
								<th>NAMA</th>
								<th class="text-center">HARGA SATUAN</th>
								<th class="text-center">JUMLAH</th>
								<th class="text-center">DISKON</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="{{route('cart.update')}}" method="POST">
								@csrf
								@if(Helper::getAllProductFromCart())
									@foreach(Helper::getAllProductFromCart() as $key=>$cart)
										<tr>
											@php
											$photo=explode(',',$cart->product['photo']);
											@endphp
											<td class="image" data-title="No"><img src="{{$photo[0]}}" alt="{{$photo[0]}}"></td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="{{route('product-detail',$cart->product['slug'])}}" target="_blank">{{$cart->product['title']}}</a></p>
												<p class="product-des">{!!($cart['summary']) !!}</p>
											</td>
											<td class="price" data-title="Price"><span>Rp.{{number_format($cart->product['price'])}}</span></td>
											<td class="qty" data-title="Qty">
												<div class="input-group">
													<div class="button minus">
														<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[{{$cart->id}}]">
															<i class="ti-minus"></i>
														</button>
													</div>
													<input type="text" name="quant[{{$cart->id}}]" class="input-number"  data-min="1" data-max="100" value="{{$cart->quantity*$cart->product['price']}}">
													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$cart->id}}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</td>
											</td>
											<td class="discount" data-title="Discount"><span class="money">{{number_format($cart->product['discount'])}}%</span></td>

											<td class="total-amount cart_single_price" data-title="Total"><span class="money">Rp.{{number_format($cart['price'])}}</span></td>

											<td class="action" data-title="Remove"><a href="{{route('cart-delete',$cart->id)}}"><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									@endforeach
									<track>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td class="float-right">
											<button class="btn float-right" type="submit">Refresh</button>
										</td>
									</track>
								@else
										<tr>
											<td class="text-center">
												Tidak ada produk di keranjang. <a href="{{route('product-grids')}}" style="color:blue;">Lanjutkan Belanja</a>
											</td>
										</tr>
								@endif

							</form>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left">
									<div class="coupon">
									<form action="{{route('coupon-store')}}" method="POST">
											@csrf
											<input name="code" placeholder="Masukkan Kupon Valid">
											<button class="btn">Tambah Kupon</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Subtotal<span>Rp.{{number_format(Helper::totalCartPrice())}}</span></li>

										@if(session()->has('coupon'))
										<li class="coupon_price" data-price="{{Session::get('coupon')['value']}}">Kamu Dapat<span>Rp.{{number_format(Session::get('coupon')['value'])}}</span></li>
										@endif
										@php
											$total_amount=Helper::totalCartPrice();
											if(session()->has('coupon')){
												$total_amount=$total_amount-Session::get('coupon')['value'];
											}
										@endphp
										@if(session()->has('coupon'))
											<li class="last" id="order_total_price">Total pesanan<span>Rp.{{number_format($total_amount)}}</span></li>
										@else
											<li class="last" id="order_total_price">Total pesanan<span>Rp.{{number_format($total_amount)}}</span></li>
										@endif
									</ul>
									<div class="button5">
										<a href="{{route('checkout')}}" class="btn">Checkout</a>
										<a href="{{route('product-grids')}}" class="btn">Lanjut Belanja</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
		</div>
	</div>
	<!--/ End Shopping Cart -->

	<!-- Start Shop Services Area  -->
	<section class="shop-services section">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-rocket"></i>
						<h4>Bebas pengiriman</h4>
						<p>Pengiriman di area tertentu</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-reload"></i>
						<h4>Produk Dengan Ukiran Khas Jepara</h4>
						<p>Produk dengan bahan berkualitas</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-lock"></i>
						<h4>Pembayaran aman</h4>
						<p>Pembayaran aman dan terpercaya</p>
					</div>
					<!-- End Single Service -->
				</div>
				<div class="col-lg-3 col-md-6 col-12">
					<!-- Start Single Service -->
					<div class="single-service">
						<i class="ti-tag"></i>
						<h4>Bahan berkualitas</h4>
						<p>Harga terbaik</p>
					</div>
					<!-- End Single Service -->
				</div>
			</div>
		</div>
	</section>
	<!-- End Shop Newsletter -->

	<!-- Start Shop Newsletter  -->
	@include('frontend.layouts.newsletter')
	<!-- End Shop Newsletter -->

@endsection
@push('styles')
	<style>
	
		.input-group-icon .icon {
			position: absolute;
			left: 20px;
			top: 0;
			line-height: 40px;
			z-index: 3;
		}
		.form-select {
			height: 30px;
			width: 100%;
		}
		.form-select .nice-select {
			border: none;
			border-radius: 0px;
			height: 40px;
			background: #f6f6f6 !important;
			padding-left: 45px;
			padding-right: 40px;
			width: 100%;
		}
		.list li{
			margin-bottom:0 !important;
		}
		.list li:hover{
			background:#F7941D !important;
			color:white !important;
		}
		.form-select .nice-select::after {
			top: 14px;
		}
	</style>
@endpush
@push('scripts')
	<script src="{{asset('frontend/js/nice-select/js/jquery.nice-select.min.js')}}"></script>
	<script src="{{ asset('frontend/js/select2/js/select2.min.js') }}"></script>
	<script>
		$(document).ready(function() { $("select.select2").select2(); });
  		$('select.nice-select').niceSelect();
	</script>
<script>
    function singleAddToCart(slug, quantity, price, discount) {
        $.ajax({
            url: '/single-add-to-cart',
            method: 'POST',
            data: {
                slug: slug,
                quant: [null, quantity],
                price: price,
                discount: discount,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status) {
                    // Update jumlah dan amount di frontend
                    var quantityElement = $('#cart-quantity-' + slug);
                    var subtotalElement = $('#cart-subtotal');
                    var totalElement = $('#cart-total');

                    quantityElement.text(response.quantity);
                    subtotalElement.text(response.subtotal);
                    totalElement.text(response.total);

                    alert('Product has been added to cart');
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>

@endpush
