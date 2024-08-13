@extends('backend.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
  <h5 class="card-header">Edit Pesanan</h5>
  <div class="card-body">
    <form action="{{route('order.update',$order->id)}}" method="POST">
      @csrf
      @method('PATCH')
      
      <!-- Status Pesanan -->
      <div class="form-group">
        <label for="status">Status :</label>
        <select name="status" id="" class="form-control">
          <option value="new" {{($order->status=='delivered' || $order->status=="process" || $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='new')? 'selected' : '')}}>Baru</option>
          <option value="process" {{($order->status=='delivered'|| $order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='process')? 'selected' : '')}}>Proses</option>
          <option value="delivered" {{($order->status=="cancel") ? 'disabled' : ''}}  {{(($order->status=='delivered')? 'selected' : '')}}>Diterima</option>
          <option value="cancel" {{($order->status=='delivered') ? 'disabled' : ''}}  {{(($order->status=='cancel')? 'selected' : '')}}>Dibatalkan</option>
        </select>
      </div>

      <!-- Payment Status -->
      <div class="form-group">
        <label for="payment_status">Status Pembayaran :</label>
        <select name="payment_status" id="" class="form-control">
            <option value="unpaid" {{(($order->payment_status=='unpaid')? 'selected' : '')}} selected>Belum Lunas</option>
            <option value="pending" {{(($order->payment_status=='pending')? 'selected' : '')}}>Pending</option>
            <option value="paid" {{(($order->payment_status=='paid')? 'selected' : '')}}>Lunas</option>
        </select>
      </div>
      <!--Metode Pembayaran -->
      <div class="form-group">
        <label for="payment_method">Metode Pembayaran :</label>
        <select name="payment_method" id="" class="form-control">
            <option value="cod" {{(($order->payment_method=='cod')? 'selected' : '')}}>Cash on Delivery</option>
            <option value="ewallet" {{(($order->payment_method=='ewallet')? 'selected' : '')}}>E-Wallet</option>
            <option value="banktransfer" {{(($order->payment_method=='banktransfer')? 'selected' : '')}}>Bank Transfer</option>
        </select>
      </div>
  
      <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div></div>
    </div>
</div>

@endsection

@push('styles')

@endpush
