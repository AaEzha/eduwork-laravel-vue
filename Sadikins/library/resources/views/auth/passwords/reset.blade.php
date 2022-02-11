@extends('layouts.auth')

@section('title','Login')
@section('content')
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                 <div class="card-header">{{ __('Reset Password') }}</div>
              </div>
              <h6 class="fw-light">Reset Password.</h6>
              <form method="POST" action="{{ route('password.update') }}" class="pt-3">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                  <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                 <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                      <input type="password" class="form-control form-control-lg" id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Password">
                </div>
                <div class="mt-3 d-grid gap-2">
                  <button type="submit" class="btn btn-primary btn-lg font-weight-medium auth-form-btn">  {{ __('Reset Password') }} </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection
