
@extends('layouts.app')
@section('content')
{{-- message --}}
{!! Toastr::message() !!}
<div class="row justify-content-center h-100 align-items-center">
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <h1>Admin</h1>
                        </div>
                        <h4 class="text-center mb-4">Sign in your account</h4>
                        <form action="{{ route('login') }}" method="POST" id="login_form" name="login_form">
                            @csrf
                            <div class="mb-3">
                                <label class="mb-1"><strong>Email</strong></label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror" name="username">
                            </div>
                            <div class="mb-3">
                                <label class="mb-1"><strong>Password</strong></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block">Sign Me In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
<script>
    $(document).ready( function () {
        $("#login_form").validate({
            rules: {
                username: "required",
                password: "required"
            },
            messages: {
                username: "Please enter email",
                password: "Please enter password"
            }
        });
    } );
</script>
@endsection
@endsection
