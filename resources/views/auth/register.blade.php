@extends('layouts.auth')

@section('content')
<section id="auth" style="max-height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Register</h2>
            </div>
        </div>
        <div class="row">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div style="margin-bottom: 20px"></div>

                    <form role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label for="first_name">First Name</label>

                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label for="last_name">Last Name</label>

                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender">Gender</label>

                                <select name="gender" id="gender" class="form-control">
                                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('birthdate') ? ' has-error' : '' }}">
                                <label for="birthdate">Birthdate</label>

                                <input id="birthdate" type="date" class="form-control" name="birthdate" value="{{ old('birthdate') }}" required>

                                @if ($errors->has('birthdate'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('birthdate') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email">E-Mail Address</label>

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password">Password</label>

                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password-confirm">Confirm Password</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <div class="col-md-6 col-md-offset-4">
                                    {!! app('captcha')->display() !!}

                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block">
                                            <strong>Please validate if you are a human</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
