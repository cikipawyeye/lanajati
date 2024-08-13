@extends('owner.layouts.master')

@section('title','Order Detail')

@section('main-content')
<div class="card">
<h5 class="card-header"> Detail Pesanan<a href="{{route('owner.pesanan.pdf',$order->id)}}" class=" btn btn-sm btn-primary shadow-sm float-right">
  <i class="fas fa-download fa-sm text-white-50"></i> Cetak Pesanan</a>
  </h5>
  <div class="card-body">
    @if($order)
    <table class="table table-striped table-hover">
      <thead>
        <tr>
            <th>Id</th>
            <th>Nomor Pesanan</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Jumlah</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <tr>
            <td>{{$order->id}}</td>
            <td>{{$order->order_number}}</td>
            <td>{{$order->first_name}} {{$order->last_name}}</td>
            <td>{{$order->email}}</td>
            <td>{{$order->quantity}}</td>
            <td>{{number_format($order->total_amount)}}</td>
            <td>
                @if($order->status=='new')
                  <span class="badge badge-primary">Baru</span>
                @elseif($order->status=='process')
                  <span class="badge badge-warning">Proses</span>
                @elseif($order->status=='delivered')
                  <span class="badge badge-success">Diterima</span>
                @else
                  <span class="badge badge-danger">{{$order->status}}</span>
                @endif
            </td>
            <td>
                  @csrf
                  @method('delete')
                      <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>

        </tr>
      </tbody>
    </table>

    <section class="confirmation_part section_padding">
      <div class="order_boxes">
        <div class="row">
          <div class="col-lg-6 col-lx-4">
            <div class="order-info">
              <h4 class="text-center pb-4">INFORMASI PESANAN</h4>
              <table class="table">
                    <tr class="">
                        <td>No. Pesanan</td>
                        <td> : {{$order->order_number}}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Pesanan</td>
                        <td> : {{$order->created_at->format('D d M, Y')}} pada {{$order->created_at->format('g : i a')}} </td>
                    </tr>
                    <tr>
                        <td>Jumlah</td>
                        <td> : {{$order->quantity}}</td>
                    </tr>
                    <tr>
                        <td>Status Pesanan</td>
                        <td> : {{$order->status}}</td>
                    </tr>
                    <tr>
                      <td>Kupon</td>
                      <td> : Rp. {{number_format($order->coupon)}}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td> : Rp.{{number_format($order->total_amount)}}</td>
                    </tr>
                    <tr>
                        <!-- <td>Payment Method</td>
                        <td> : @if($order->payment_method=='cod') Cash on Delivery @else {{$order->payment_method}} @endif</td> -->
                        <td>Metode Pembayaran</td>
                        <td> : 
                            @if($order->payment_method == 'cod')
                                Cash on Delivery
                            @elseif($order->payment_method == 'banktransfer')
                                Bank Transfer
                            @elseif($order->payment_method == 'ewallet')
                                E-Wallet
                            @endif
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Payment Status</td>
                        <td> : {{$order->payment_status}}</td>
                    </tr> -->
                    <tr>
                      <td>Status Pembayaran</td>
                      <td> : 
                         
                          @if($order->payment_status == 'unpaid')
                              <span class="badge badge-danger">Belum Lunas</span>
                          @elseif($order->payment_status == 'pending')
                              <span class="badge badge-warning">Pending</span>
                          @elseif($order->payment_status == 'paid')
                              <span class="badge badge-success">Lunas</span>
                          @else
                              {{$order->payment_status}}
                          @endif
                      </td>
                  </tr>

              </table>
            </div>
          </div>

          <div class="col-lg-6 col-lx-4">
         
              <h4 class="text-center pb-4">INFORMASI PENGIRIMAN</h4>
              <table class="table">
                    <tr class="">
                        <td>Nama Lengkap</td>
                        <td> : {{$order->first_name}} {{$order->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td> : {{$order->email}}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon </td>
                        <td> : {{$order->phone}}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td> : {{$order->address1}}, {{$order->address2}}</td>
                    </tr>
                    <tr>
                        <td>Negara</td>
                        <td> : {{$order->country}}</td>
                    </tr>
                    <tr>
                        <td>Kode Pos</td>
                        <td> : {{$order->post_code}}</td>
                    </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
    @endif

  </div>
</div>
@endsection

@push('styles')

@endpush
