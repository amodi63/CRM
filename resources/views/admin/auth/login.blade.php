@extends('layouts.admin_auth')
@section('content')
    <h6 class="font-weight-light ">Sign in to continue.</h6>
    <form class="pt-3" id="login-form" action="{{ route('login') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="email" class="form-control form-control-lg" id="exampleInputEmail1" name="email"
                placeholder="Username">
        </div>
        <div class="form-group">
            <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="password"
                placeholder="Password">
        </div>
        <div class="mt-3">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium login-form-btn">
                <span class="spinner-border spinner-border-sm marigin-left-2" style="display: none;" role="status"
                    aria-hidden="true"></span>
                SIGN IN
            </button>
        </div>
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted">
                    <input type="checkbox" class="form-check-input"> Keep me signed in </label>
            </div>
            <a href="#" class="auth-link text-black">Forgot password?</a>
        </div>
        {{-- <div class="mb-2">
            <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                <i class="mdi mdi-facebook me-2"></i>Connect using facebook </button>
        </div> --}}
        {{-- <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="{{ route('register') }}"
                class="text-primary">Create</a> --}}
        </div>
    </form>
@endsection
@push('scripts')
    <script>
        $("#login-form").validate({
            errorClass: 'errors',

            rules: {
                email: "required",
                password: "required",

            },
            messages: {
                email: {
                    required: "Email field is requeired"
                },
                password: {
                    required: "Password field is requeired"
                },

            },
            highlight: function(element) {
                $(element).addClass('borderError'); // Add class to input on error
            },
            unhighlight: function(element) {
                $(element).removeClass('borderError'); // Remove class from input on success
            },
        });


        $('#login-form').submit(function(e) {
            e.preventDefault();
            if (!$('#login-form').valid()) return;
            let button = $('.login-form-btn');
            let loginForm = $(this);

            let LoginUrl = loginForm.attr("action");
            let _data = new FormData(loginForm[0]);

            $.ajax({
                url: LoginUrl,
                data: _data,
                method: "POST",
                contentType: false,
                processData: false,
                beforeSend: function(response) {
                    button.prop('disabled', true);
                    button.find('.spinner-border').show();
                },
                success: function(response) {
                    window.location.replace('/home');
                },
                complete: function() {
                    button.find('.spinner-border').hide();
                    button.prop('disabled', false);
                },
                error: function(error) {
             
                    button.find('.spinner-border').hide();
                    button.prop('disabled', false);
                    var response = JSON.parse(error.responseText);
                    var errorString = '<ul class="list-unstyled">';
                    $.each(error.responseJSON.errors, function(key, value) {
                        errorString += '<li>' + value + '</li>';
                    });
                    errorString += '</ul>';
                    toastr.error(errorString)
                
                }

            });
        });
    </script>
@endpush
