@extends('layouts.default', ['title' => 'Login - SCRUM'])

@section('body')
<div
    class="container-fluid bg-gradient-primary"
    style="min-height: 100vh;"
>
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-12 col-md-6">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
                                </div>
                                <form class="user" action="{{ route('login') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="nip" value="{{ old('nip') }}" class="form-control form-control-user @error('nip') is-invalid @enderror" placeholder="Masukkan NIP">
                                        @error('nip')
                                            <div class="alert alert-danger mt-2 form-control-user">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                        @error('password')
                                            <div class="alert alert-danger mt-2 form-control-user">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="/register">Buat Akun!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
