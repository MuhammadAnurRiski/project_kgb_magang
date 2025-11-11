@extends('auth.form-login')

@section('title', 'Login')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
  <div class="card shadow p-4" style="width: 360px;">
    <h3 class="text-center mb-4">Login Admin</h3>

    @if($errors->has('login_error'))
      <div class="alert alert-danger">{{ $errors->first('login_error') }}</div>
    @endif

    <form action="{{ route('login.process') }}" method="POST">
      @csrf
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
  </div>
</div>
@endsection
