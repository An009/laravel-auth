@extends('layouts.layout')
@section('content')
<main class="login-form">
    <div class="cotainer">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="{{ route('register.post') }}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label textmd-right">Name</label>
                                <div class="col-md-6">
                                    <input type="text" id="name" class="form-control 
@error('name') border border-danger @enderror" name="name" value={{old('name')}}>
                                    @error('name')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email_address" class="col-md-4 col-formlabel text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input type="text" id="email_address" class="formcontrol @error('email') border border-danger @enderror" name="email" value={{old('email')}}>
                                    @error('email')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label 
text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="password" class="formcontrol @error('password') border border-danger @enderror" name="password" value={{old('password')}}>
                                    @error('password')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="confirmPassword" class="col-md-4 col-formlabel text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input type="password" id="confirmPassword" class="form-control @error('confirmPassword') border border-danger @enderror" name="confirmPassword">
                                    @error('confirmPassword')
                                    <span class="text-danger">{{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection