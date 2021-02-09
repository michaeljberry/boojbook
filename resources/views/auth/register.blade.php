@extends('layouts.app', ['page_title' => 'Register'])
@section('content')
<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">

        <div class="card card-primary">
          <div class="card-header"><h4>Register</h4></div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}" id="registerForm">
              @csrf
              <div class="form-group">
                <label for="name">First Name</label>
                <input id="name" type="text" class="form-control form-control-sm" name="name" value="{{ old('name') }}" autofocus>
              </div>

              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control form-control-sm" name="email" value="{{ old('email') }}">
                <div class="invalid-feedback"></div>
              </div>

              <div class="row">
                <div class="form-group col-6">
                  <label for="password" class="d-block">Password</label>
                  <input id="password" type="password" class="form-control form-control-sm pwstrength" data-indicator="pwindicator" name="password">
                  <div id="pwindicator" class="pwindicator">
                    <div class="bar"></div>
                    <div class="label"></div>
                  </div>
                </div>
                <div class="form-group col-6">
                  <label for="password2" class="d-block">Password Confirmation</label>
                  <input id="password2" type="password" class="form-control form-control-sm" name="password_confirmation">
                </div>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                  Register
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; Boojbook 2021
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('page-css')
<link rel="stylesheet" href="{{ url('assets/modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('page-js')
<script src="{{ url('assets/modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
<script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script>
$(document).ready(function () {
  <?php if($errors->any()){ ?>
  iziToast.error({
    title: 'Error!',
    message: '<?php echo $errors->first(); ?>',
    position: 'topRight'
  });
  <?php } ?>
});
</script>
@endsection