@extends('layouts.default', ['title' => 'Register | SCRUM'])

@section('body')
<div
    class="container-fluid bg-gradient-primary"
    style="min-height: 100vh;"
>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Buat sebuah Akun!</h1>
                                </div>
                                <form class="user" action="{{ route('register') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" value="{{ old('name') }}" class="form-control form-control-user @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap">
                                        @error('name')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="nip" value="{{ old('nip') }}" class="form-control form-control-user @error('nip') is-invalid @enderror" placeholder="Masukkan NIP">
                                        @error('nip')
                                            <div class="alert alert-danger mt-2 form-control-user">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    {{-- <div class="form-group">
                                        <input type="text" name="username" value="{{ old('username') }}" class="form-control form-control-user @error('username') is-invalid @enderror" placeholder="Masukkan Username">
                                        @error('username')
                                            <div class="alert alert-danger mt-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div> --}}
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" name="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Masukkan Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" name="password_confirmation"  class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Repeat Password">
                                        </div>
                                        <div class="col-sm-12">
                                            @error('password')
                                                <div class="alert alert-danger mt-2 form-control-user">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Register Account
                                    </button>
                                    <hr>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="/login">Already have an account? Login!</a>
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
