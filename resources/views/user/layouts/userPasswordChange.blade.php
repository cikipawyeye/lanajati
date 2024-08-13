@extends('user.layouts.master')
@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Change Password</div>
   
                <div class="card-body">
                    <form method="POST" action="{{ route('change.password') }}">
                        @csrf 
   
                         @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                         @endforeach 
  
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right"> Password Lama </label>
  
                            <div class="col-md-6 input-group">
                                <input id="password" type="password" class="form-control" name="current_password" autocomplete="current-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right"> Password Baru</label>
  
                            <div class="col-md-6 input-group">
                                <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="current-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
  
                        <div class="form-group row">
                            <label for="new_confirm_password" class="col-md-4 col-form-label text-md-right">Konfirmasi Password Baru</label>
    
                            <div class="col-md-6 input-group">
                                <input id="new_confirm_password" type="password" class="form-control" name="new_confirm_password" autocomplete="current-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_confirm_password')">
                                        <i class="fa fa-eye-slash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <script>
                            function togglePassword(id) {
                                var input = document.getElementById(id);
                                if (input.type === "password") {
                                    input.type = "text";
                                    $('.fa-eye-slash').removeClass('fa-eye-slash').addClass('fa-eye');
                                } else {
                                    input.type = "password";
                                    $('.fa-eye').removeClass('fa-eye').addClass('fa-eye-slash');
                                }
                            }
                        </script>
   
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Ubah Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection