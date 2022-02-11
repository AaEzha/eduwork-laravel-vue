@extends('layouts.auth')

@section('title','Login')
@section('content')
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h6 class="fw-light">{{ __('Reset Password') }}</h6>

                @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

              <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                <div class="form-group">
                  <input id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                </div>
                <div class="mt-3 d-grid gap-2">
                  <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn">  {{ __('Send Password Reset Link') }} </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
