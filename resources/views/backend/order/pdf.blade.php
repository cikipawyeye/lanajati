@extends('backend.layouts.master')

@section('title','Order Pdf')

@section('main-content')
<!DOCTYPE html>
<html>
<head>
  <title>
    @if(isset($order))
      Pesanan - {{ $order->id ?? '' }}
    @else
      Pesanan
    @endif
  </title>
  <style type="text/css">
    @media print {
      .table tfoot, .table thead {
        display: none !important;
      }
      .print-only {
        display: block !important;
      }
    }
  </style>
</head>
<body>
@if(isset($order))
  <div class="invoice-header print-only">
    <div class="float-left site-logo">
      <img src="{{ asset('backend/img/logo.png') }}" alt="">
    </div>
    <div class="float-right site-address">
      <h4>{{ env('APP_NAME') }}</h4>
      <p>{{ env('APP_ADDRESS') }}</p>
      <p>Phone: <a href="tel:{{ env('APP_PHONE') }}">{{ env('APP_PHONE') }}</a></p>
      <p>Email: <a href="mailto:{{ env('APP_EMAIL') }}">{{ env('APP_EMAIL') }}</a></p>
    </div>
    <div class="clearfix"></div>
  </div>
  <div class="invoice-description print-only">
    <div class="invoice-left-top float-left">
      <h6>Invoice to</h6>
      <h3>{{ $order->first_name }} {{ $order->last_name }}</h3>
      <div class="address">
        <p><strong>Negara: </strong>{{ $order->country }}</p>
        <p><strong>Alamat Lengkap: </strong>{{ $order->address1 }} OR {{ $order->address2 }}</p>
        <p><strong>Nomor telepon:</strong> {{ $order->phone }}</p>
        <p><strong>Email:</strong> {{ $order->email }}</p>
      </div>
    </div>
    <div class="invoice-right-top float-right text-right">
      <h3>Invoice #{{ $order->order_number }}</h3>
      <p>{{ $order->created_at->format('D d m Y') }}</p>
    </div>
    <div class="clearfix"></div>
  </div>
  <section class="order_details pt-3 print-only">
    <div class="table-header">
      <h5>Detail Pesanan</h5>
    </div>
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col" class="col-6">Produk</th>
          <th scope="col" class="col-3">Jumlah</th>
          <th scope="col" class="col-3">Total</th>
        </tr>
      </thead>
      <tbody>
      @foreach($order->cart_info as $cart)
        @php 
          $product = DB::table('products')->select('title')->where('id', $cart->product_id)->first();
        @endphp
        <tr>
          <td>{{ $product->title ?? '' }}</td>
          <td>x{{ $cart->quantity }}</td>
          <td>Rp.{{ number_format($cart->price, 2) }}</td>
        </tr>
      @endforeach
      </tbody>
      <tfoot>
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Subtotal:</th>
          <th scope="col">Rp.{{ number_format($order->sub_total, 2) }}</th>
        </tr>
        <tr>
          <th scope="col" class="empty"></th>
          <th scope="col" class="text-right">Total:</th>
          <th>Rp.{{ number_format($order->total_amount, 2) }}</th>
        </tr>
      </tfoot>
    </table>
  </section>
  <div class="thanks mt-3 print-only">
    <h4>Terima Kasih Atas Pesanan Anda</h4>
  </div>
  <div class="authority float-right mt-5 print-only">
    <p>-----------------------------------</p>
    <h5>Toko Lana Jati</h5>
  </div>
  <div class="clearfix"></div>
@else
  <h5 class="text-danger">Invalid</h5>
@endif
</body>
</html>

@endsection
@end

