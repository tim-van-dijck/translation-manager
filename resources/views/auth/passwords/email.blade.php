@extends('layouts.login')

@section('content')
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <h1 class="text-center">Translation manager</h1>
        <h2 class="text-center">{{ trans('system.login') }}</h2>

         @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @error('email')
        <div class="alert alert-danger" role="alert">
            {{ $message }}
        </div>
        @enderror

        <div class="form-group">
            <label for="email">{{ trans('system.username') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="far fa-envelope"></i>
                        </span>
                </div>
                <input id="email" class="form-control" name="email" type="text">
            </div>
        </div>
        <button type="submit" class="btn btn-green">
            {{ __('Send Password Reset Link') }}
        </button>
    </form>

@endsection
