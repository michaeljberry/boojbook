@extends('layouts.app', ['page_title' => 'Password Reset'])
@section('content')
<section class="section">
  <div class="container mt-5">
    <div class="row">
      <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
        <div class="card card-primary">
          <div class="card-header"><h4>Reset Password</h4></div>

          <div class="card-body">
            <p class="text-muted">We will send a link to reset your password</p>
            <form method="POST" action="{{ route('password.email') }}">
              @csrf
              <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="form-control form-control-sm" name="email" tabindex="1" required autofocus>
              </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                  Reset Password
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="simple-footer">
          Copyright &copy; 2021
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
<script src="{{ url('assets/modules/izitoast/js/iziToast.min.js') }}"></script>
<script>
$(document).ready(function () {
  <?php if($errors->any()){ ?>
  iziToast.error({
    title: 'Error!',
    message: "<?php echo $errors->first(); ?>",
    position: 'topRight'
  });
  <?php } ?>
});
</script>
@endsection