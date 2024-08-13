@extends('frontend.layouts.master')

@section('title','Checkout page')

@section('main-content')

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="bread-inner">
                        <ul class="bread-list">
                            <li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
                            <li class="active"><a href="javascript:void(0)">Checkout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Breadcrumbs -->
            
    <!-- Start Checkout -->
    <section class="shop checkout section">
        <div class="container">
                <form class="form" method="POST" action="{{route('cart.order')}}">
                    @csrf
                    <div class="row"> 

                        <div class="col-lg-8 col-12">
                            <div class="checkout-form">
                                <h2>SELESAIKAN PESENANMU</h2>
                                <p>Hanya beberapa langkah lagi untuk menyelesaikan pembelian Anda!</p>
                                <!-- Form -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nama Depan<span>*</span></label>
                                            <input type="text" name="first_name" placeholder="" value="{{old('first_name')}}" value="{{old('first_name')}}" required>
                                            @error('first_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Nama Belakang<span>*</span></label>
                                            <input type="text" name="last_name" placeholder="" value="{{old('lat_name')}}" required>
                                            @error('last_name')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>E-mail Aktif<span>*</span></label>
                                            <input type="email" name="email" placeholder="" value="{{old('email')}}" required>
                                            @error('email')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label> Nomor Telepon Aktif<span>*</span></label>
                                            <input type="number" name="phone" placeholder="" required value="{{old('phone')}}">
                                            @error('phone')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Negara<span>*</span></label>
                                            <select name="country" id="country" required>
                                                <option value="ID">Indonesia</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Alamat<span>*</span></label>
                                            <input type="text" name="address1" placeholder="" value="{{old('address1')}}">
                                            @error('address1')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Detail Alamat</label>
                                            <input type="text" name="address2" placeholder="" value="{{old('address2')}}">
                                            @error('address2')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <div class="form-group">
                                            <label>Kode Pos</label>
                                            <input type="text" name="post_code" placeholder="" value="{{old('post_code')}}">
                                            @error('post_code')
                                                <span class='text-danger'>{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <!--/ End Form -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-12">
                            <div class="order-details">
                                <!-- Order Widget -->
                                <div class="single-widget">
                                    <h2>Total Pesanan</h2>
                                    <div class="content">
                                        
                                       <!-- Order Details --> 

                                            <ul>
										    <li class="order_subtotal" data-price="{{Helper::totalCartPrice()}}">Subtotal<span>Rp.{{number_format(Helper::totalCartPrice(),2)}}</span></li>
                                          
                                            @if(session('coupon'))
                                            <li class="coupon_price" data-price="{{session('coupon')['value']}}">You Save<span>Rp.{{number_format(session('coupon')['value'],2)}}</span></li>
                                            @endif
                                            @php
                                                $total_amount=Helper::totalCartPrice();
                                                if(session('coupon')){
                                                    $total_amount=$total_amount-session('coupon')['value'];
                                                }
                                            @endphp
                                            @if(session('coupon'))
                                                <li class="last"  id="order_total_price">Total<span>Rp.{{number_format($total_amount,2)}}</span></li>
                                            @else
                                                <li class="last"  id="order_total_price">Total<span>Rp.{{number_format($total_amount,2)}}</span></li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!--/ End Order Widget -->
                       
                                <!-- Order Widget -->
                               
                        <div class="single-widget">
                            <h2>Metode Pembayaran</h2>
                            <div class="content">
                                    <div class="form-group"><form id="paymentForm">
                                        <label for="payment_method"></label>
                                        <select id="payment_method" name="payment_method" class="form-control" onchange="togglePaymentDetails()">
                                            <option value="" disabled selected> Pilih Metode Pembayaran:</option>
                                            <option value="cod">Cash On Delivery</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="e_wallet">E-Wallet</option>
                                        </select>
                                    </div>

                                <div id="bankTransferDetails" style="display: none;">
                                    <h6>Pilih Bank</h6><br>
                                    <label for="bank_account_mandiri">Bank Mandiri</label>
                                    <a href="https://api.whatsapp.com/send?phone=6281212345678&text=Halo%20saya%20ingin%20melakukan%20pembayaran%20melalui%20Bank%20Mandiri" target="_blank">
                                    <input id="bank_account_mandiri" name="bank_account_mandiri" value="1234567890 a/n Toko Lana Jati" readonly></a><br>

                                    <label for="bank_account_bca">BCA</label>
                        
                                    <input id="bank_account_bca" name="bank_account_bca" value="1234567890 a/n Toko Lana Jati" readonly></a><br>

                                    <label for="bank_account_bni">BNI</label>
                                 
                                    <input id="bank_account_bni" name="bank_account_bni" value="1234567890 a/n Toko Lana Jati" readonly></a><br>

                                    <label for="bank_account_bri">BRI</label>
                                 
                                    <input id="bank_account_bRi" name="bank_account_bri" value="1234567890 a/n Toko Lana Jati" readonly></a><br>
                                </div>

                                <div id="eWalletDetails" style="display: none;">
                                    <h6>Pilih E-Wallet</h6><br>
                                    <label for="ovo">OVO</label>
                                    <input type="text" id="ovo" name="ovo" value="081234567890 a/n Toko Lana Jati" readonly><br>
                                    <label for="dana">Dana</label>
                                    <input type="text" id="dana" name="dana" value="081234567890 a/n Toko Lana Jati" readonly><br>
                                </div>
                            </form>
                        </div>
                    </div>
                
                      <!--/ End Order Widget -->
                             <div style="border: 1px solid #e8f0fe; padding: 10px; margin-bottom: 10px;">
                                <p class="content" style="font-size: 12px" text-align="justify"><B> Lakukan pembayaran Anda langsung ke rekening bank kami, pilih nomer Rekening/e-wallet sesuai pilihan Anda.
                                    Pesanan Anda akan diproses/dikirim setelah kami menerima pembayaran, wajib kirim bukti ke Nomor WhatsApp kami==>>
                                    <a href="https://api.whatsapp.com/send?phone=6287816571598" target="_blank" style="text-decoration: none; color: #007bff;"><u><b>087816571598</b></u></a> Terima Kasih :)</B></p> 
                            </div> 
                             
                                    <div class="single-widget payement">
                                    <div class="content">
                                        <img src="{{('backend/img/payment-method.png')}}" alt="#">
                                    </div>
                                </div>
                                <!--/ End Payment Method Widget -->
                                <!-- Button Widget -->
                                <div class="single-widget get-button">
                                    <div class="content">
                                        <div class="button">
                                            <button type="submit" class="btn">Proses checkout</button>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Button Widget -->
                            </div>
                        </div>
                    </div>
                </form>
        </div>
    </section>
    <!--/ End Checkout -->
    
    <!-- Start Shop Services Area  -->
    <section class="shop-services section home">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-rocket"></i>
                        <h4>Bebas pengiriman area tertentu</h4>
                        <p>Pengiriman di area tertentu</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-reload"></i>
                        <h4>Pilih Produk </h4>
                        <p> Sesuai Kebutuhan & Kriteria</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-lock"></i>
                        <h4> Pembayaran Aman</h4>
                        <p>100% secure payment</p>
                    </div>
                    <!-- End Single Service -->
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Service -->
                    <div class="single-service">
                        <i class="ti-tag"></i>
                        <h4>bahan berkualitas</h4>
                        <p> Harga terbaik</p>
                    </div>
                    <!-- End Single Service -->
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Services -->
    
    <!-- Start Shop Newsletter  -->
    <section class="shop-newsletter section">
        <div class="container">
            <div class="inner-top">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2 col-12">
                        <!-- Start Newsletter Inner -->
                        <div class="inner">
                            <h4>Newsletter</h4>
                            <p> Subscribe to our newsletter and get <span>10%</span> off your first purchase</p>
                            <form action="mail/mail.php" method="get" target="_blank" class="newsletter-inner">
                                <input name="EMAIL" placeholder="Your email address" required="" type="email">
                                <button class="btn">Subscribe</button>
                            </form>
                        </div>
                        <!-- End Newsletter Inner -->
                    </div>
                </div>
            </div>
        </div>
    </section>
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
      
                    input[readonly] {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        box-sizing: border-box;
                        background-color: #e8f0fe;  
                    }
                    
                    label {
                        margin-bottom: 10px;
                    }

                    select.form-control {
                        width: 50%;
                        padding: 10px;
                        margin-bottom: 20px;
                    }

                    #bankTransferDetails, #eWalletDetails {
                        width: 50%;
                        margin: auto;
                    }

                    input[readonly] {
                        width: 100%;
                        padding: 10px;
                        margin-bottom: 10px;
                        box-sizing: border-box;
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
                function togglePaymentDetails() {
                    var paymentMethod = document.getElementById('payment_method').value;
                    var bankTransferDetails = document.getElementById('bankTransferDetails');
                    var eWalletDetails = document.getElementById('eWalletDetails');

                    bankTransferDetails.style.display = 'none';
                    eWalletDetails.style.display = 'none';

                    if (paymentMethod === 'bank_transfer') {
                        bankTransferDetails.style.display = 'block';
                    } else if (paymentMethod === 'e_wallet') {
                        eWalletDetails.style.display = 'block';
                    }
                }
                </script>

	<script>
		$(document).ready(function(){
				let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
				let subtotal = parseFloat( $('.order_subtotal').data('price') ); 
				let coupon = parseFloat( $('.coupon_price').data('price') ) || 0; 
				// alert(coupon);
				$('#order_total_price span').text('Rp.'+(subtotal + cost-coupon).toFixed(2));
			});

	</script>

<script>
    $(document).ready(function() {
        $('input[name="payment_method"]').change(function() {
            if ($(this).val() === 'bank_transfer') {
                $('#bankTransferDetails').show();
            } else {
                $('#bankTransferDetails').hide();
            }
        });
    });
</script>
@endpush