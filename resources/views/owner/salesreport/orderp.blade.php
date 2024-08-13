@extends('owner.layouts.master')

@section('main-content')
<style>
  @media print {
    body * {
      visibility: hidden;
    }
    #user-dataTable, #user-dataTable * {
      visibility: visible;
    }
    #user-dataTable {
      position: absolute;
      left: 0;
      top: 0;
    }
  }
</style>
<div class="card shadow mb-4">
  <div class="row">
    <div class="col-md-12">
      @include('owner.layouts.notification')
    </div>
  </div>
  <div class="card-header py-3">
    <h4 class="m-0 font-weight-bold text-primary float-left">Laporan Penjualan</h4>
  </div>
  <div class="card-header py-3">
    <button onclick="printReport()" class="btn btn-success float-right ml-2">Cetak Laporan</button>
    <form class="form-inline float-right" method="GET" action="{{ route('owner.salesreport.orderp') }}">
      <div class="form-group mr-2">
        <label for="start_date">Dari tanggal:</label>
        <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="{{ request()->get('start_date') }}">
      </div>
      <div class="form-group">
        <label for="end_date">Sampai tanggal:</label>
        <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="{{ request()->get('end_date') }}">
      </div>
      <button type="submit" class="btn btn-primary ml-2">Tampilkan</button>
    </form>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered table-hover" id="user-dataTable" width="100%" cellspacing="0">
        <thead>
          <th>ID</th>
          <th>Kode Order</th>
          <th>Nama Pelanggan</th>
          <th>Email</th>
          <th>Nomor</th>
          <th>Jumlah</th>
          <th>Nama produk</th>
          <th>Subtotal</th>
          <th>Tanggal</th>
          <th>Status</th>
        </thead>
        <tbody>
          @foreach ($orders as $order)
          <tr>
              <td>{{ $order->id }}</td>
              <td>{{ $order->order_number }}</td>
              <td>{{ $order->first_name.' '.$order->last_name }}</td>
              <td>{{ $order->email }}</td>
              <td>{{ $order->phone }}</td>
              <td>{{ $order->carts->sum('quantity') }}</td>
              <td>
                  @foreach($order->carts as $cart)
                      @if($cart->product)
                          {{ $cart->product->title }}<br>
                      @else
                          Produk tidak ditemukan<br>
                      @endif
                  @endforeach
              </td>
              <td>Rp{{ number_format($order->sub_total, 0, ',', '.') }}</td>
              <td>{{ date('d-m-Y H:i:s', strtotime($order->created_at)) }}</td>
              <td>{{ $order->status }}</td>
          </tr>
      @endforeach
      
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection

@push('style-alt')
  <!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endpush

@push('script-alt')
  <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
  <script>
    function printReport() {
      var divToPrint = document.getElementById('user-dataTable');
      var newWin = window.open('', 'Print-Window');
      newWin.document.open();
      newWin.document.write('<html><head><title>Cetak Laporan</title></head><body onload="window.print()">' + divToPrint.outerHTML + '</body></html>');
      newWin.document.close();
      setTimeout(function(){newWin.close();}, 10);
    }
  </script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      $("#user-dataTable").DataTable();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
      });
    });
  </script>
@endpush
