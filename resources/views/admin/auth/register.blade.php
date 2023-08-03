@extends('layouts.admin_auth')

@push('styles')
@endpush
@section('content')
    <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
    <form class="pt-3">
        <div class="form-group">
            <input type="text" class="form-control form-control-lg" id="exampleInputUsername1" placeholder="Username">
        </div>
        <div class="form-group">
            <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Email">
        </div>
        <div class="form-group">
            <select class="form-control form-control-lg selectpicker" data-live-search="true" name="country" id="countries">
              @isset($countries)
                @foreach ($countries as $key => $country)
                  <option value="{{ $key }}">{{ $country }}</option>
                @endforeach
              @endisset
            </select>
        </div>
        
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
        </div>
        <div class="mb-4">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
            </div>
        </div>
        <div class="mt-3">
            <input type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" value="SIGN UP" >
        </div>
        <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="{{ route("login") }}"
            class="text-primary">Login</a>
        </div>
    </form>
@endsection
