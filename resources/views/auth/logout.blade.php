@extends ('auth.form-login')
@section('title', 'Logout')
@section('content')
<style>
    .logout-container {
        width: 400px;
        padding: 30px;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .logout-button {
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    .logout-button:hover {
        background-color: #0056b3;
    }
</style>
<div class="logout-container mx-auto mt-5">
    <h2 class="mb-4">Logout</h2>
    <p>Apakah Anda yakin ingin logout?</p>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-button mt-3">Logout</button>
    </form>
</div>
                    <input type="text" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" required autofocus>>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Masuk</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
        </div>
    </div>  
        </div>
    </div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
@endsection