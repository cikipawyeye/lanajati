@extends('owner.layouts.master')

@section('main-content')
<div class="card shadow mb-4">
    <div class="row">
        <div class="col-md-12">
            @include('owner.layouts.notification')
        </div>
    </div>
    <div class="card-header py-3">
        <h4 class="m-0 font-weight-bold text-primary float-left">Laporan Stok Produk</h4>
        <button class="btn btn-success float-right ml-2" a href="{{ route('owner.salesreport.export-pdf') }}" class="btn btn-primary float-right">export pdf</a></button>
        
        <form class="form-inline float-right" method="GET" action="{{ route('owner.salesreport.stock') }}">
            <div class="form-group mr-2">
                <input type="text" class="form-control" id="search" name="search" placeholder="Cari Produk..." value="{{ request()->get('search') }}">
            </div>
            <button type="submit" class="btn btn-primary ml-2">Cari</button>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" id="user-dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th style="background-color: #f2f2f2">ID</th>
                        <th style="background-color: #f2f2f2">Nama Produk</th>
                        <th style="background-color: #f2f2f2">Kategori</th>
                        <th style="background-color: #f2f2f2">Harga Satuan</th>
                        <th style="background-color: #f2f2f2">Diskon</th>
                        <th style="background-color: #f2f2f2">Stok</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="sorttable">{{ $product->id }}</td>
                            <td>{{ $product->title }}</td>
                            <td>{{ $product->category->title ?? 'N/A' }}</td>
                            <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td>{{ number_format($product->discount) . '%' }}</td>
                            <td>{{ $product->stock }}</td>
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
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script>
    $(document).ready(function() {
      $("#user-dataTable").DataTable();
      $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
      });
    });

    function printReport() {
      var divToPrint = document.getElementById('user-dataTable');
      var newWin = window.open('', 'Print-Window');
      newWin.document.open();
      newWin.document.write('<html><body onload="window.print()">' + divToPrint.outerHTML + '</body></html>');
      newWin.document.close();
      setTimeout(function(){newWin.close();}, 10);
    }
  </script>
@endpush
