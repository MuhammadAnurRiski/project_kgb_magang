@extends('auth.form-login')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: url('{{ asset("image/Gedung_2.png") }}') no-repeat center center fixed;
        background-size: cover;
        
    }

    .login-box {
        width: 380px;
        z-index: 2;
        position: relative;
    }

    /* Tambahkan efek gelap sedikit agar card terlihat jelas */
      /* Overlay Transparan */
    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.5); /* Ubah angka 0.5 untuk transparansi */
        z-index: -1;
    }
</style>

<div class="card">
<div class="login-box mt-4">
    
    <!-- Logo -->
    <div class="login-logo">
        <img src="{{ asset('image/logo_kemenkum.png') }}" 
             alt="Logo" 
             style="height: 80px; width:80px; border-radius:10px; object-fit:cover;">
        <h3 class="mt-3">
            <strong>KGB</strong> kemenkum
        </h3>
    </div>

    <!-- Card Login -->
    <div class="card">
        <div class="card-body login-card-body">

            @if($errors->has('login_error'))
                <div class="alert alert-danger py-2 px-3">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <!-- Username -->
                <div class="input-group mb-3">
                    <input type="text" 
                           name="username" 
                           class="form-control" 
                           placeholder="Username" 
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <!-- Password -->
                <div class="input-group mb-3">
                    <input type="password" 
                           name="password" 
                           class="form-control" 
                           placeholder="Password" 
                           required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <!-- Login Button -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" 
                                class="btn btn-primary btn-block">
                            Login
                        </button>
                    </div>
                </div>

            </form>

        </div>
    </div>

</div>
</div>

@endsection
