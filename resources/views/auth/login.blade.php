@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2" style="padding-top: 80px;">

            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/signin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('person_username') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="person_username" type="text" class="form-control" name="person_username" value="{{ old('person_username') }}">

                                @if ($errors->has('person_username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('person_username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('person_password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="person_password" type="password" class="form-control" name="person_password">

                                @if ($errors->has('person_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('person_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection
