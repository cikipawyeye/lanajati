@extends('owner.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('owner.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary float-left">Laporan Pembayaran</h6>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('owner.salesreport.payment') }}">
            <div class="row">
                <div class="col-md-5">
                    <input type="text" name="start_date" class="form-control datepicker" placeholder="Start Date" value="{{ request('start_date') }}">
                </div>
                <div class="col-md-5">
                    <input type="text" name="end_date" class="form-control datepicker" placeholder="End Date" value="{{ request('end_date') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>
        <br>
        <table id="data-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID Order</th>
                    <th>Email Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pesanan</th>
                    <th>Total</th>
                    <th>Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $order)
                    <tr>    
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ date('d M Y H:i:s', strtotime($order->created_at)) }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->status }}</td>
                        <td>Rp{{ number_format($order->total_amount, 0, ",", ".") }}</td>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No records found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
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
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $("#data-table").DataTable();
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd'
            });
        });
    </script>
@endpush