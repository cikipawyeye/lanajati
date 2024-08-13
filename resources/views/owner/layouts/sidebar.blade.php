<!-- resources/views/owner/layouts/sidebar.blade.php -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar  -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('owner') }}">
    <div class="sidebar-brand-icon rotate-n-10">
      <i class="fa fa-house-user"></i>
    </div>
    <div class="sidebar-brand-text mx-1">HALAMAN OWNER</div>
  </a>
  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('owner') }}">
      <i class="fas fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider">
      <!-- Heading -->
      <div class="sidebar-heading">
          Toko Lana Jati
      </div>
  </a>
 <!--Orders -->
    
 <li class="nav-item">
  <a class="nav-link" href="{{route('owner.pesanan.index')}}">
    <i class="fas fa-rocket"></i>
    <span>Pesanan</span>
  </a>
    
  <!-- Reviews -->
  <li class="nav-item">
    <a class="nav-link" href="{{route('owner.review.index')}}">
        <i class="fas fa-comments"></i>
        <span>Review</span></a>
</li>
  <!-- Divider -->
  <!-- Lana Jati Furnitur -->
  <hr class="sidebar-divider">

    <!-- Laporan Penjualan -->
    <li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#ReportCollapse" aria-expanded="true" aria-controls="ReportCollapse">
        <i class="fas fa-database"></i>
        <span>Manajemen Laporan</span>
      </a>
  
      <div id="ReportCollapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
          <h6 class="collapse-header">Pilihan Laporan:</h6>
          <a class="collapse-item" href="{{ route('owner.salesreport.orderp') }}">Penjualan</a>
          <a class="collapse-item" href="{{ route('owner.salesreport.stock') }}">Stok Produk</a>
          <a class="collapse-item" href="{{ route('owner.salesreport.payment') }}">Pembayaran</a>

        </div></div>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
   <!-- Heading -->
  <div class="sidebar-heading">
      Pengaturan
  </div>

   <!-- Users -->
   <li class="nav-item">
      <a class="nav-link" href="{{ route('owner.users.index') }}">
          <i class="fas fa-users"></i>
          <span>Users</span></a>
  </li>
   <!-- General settings -->
   <li class="nav-item">
      <a class="nav-link" href="{{ route('owner.pengaturan') }}">
          <i class="fas fa-cog"></i>
          <span>Pengaturan</span></a>
  </li>
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
