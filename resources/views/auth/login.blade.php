<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>Adiguna</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.bootstrap.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/dataTables.responsive.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet'
          type='text/css'>
</head>
<body>
<div class="row" style="margin-top: 7%">
    <div class="col-md-4" style="margin: 0 auto; float: none">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Login</h4>
            </div>
            <div class="card-content" style="padding-left: 10%;padding-right: 8%">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label>E-Mail</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                               required autofocus style="padding-left: 1%">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control" name="password" required style="padding: 1%">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </div>
                    <div class="form-group">
                        <button href="#" type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/chartist.min.js') }}"></script>
<script src="{{ asset('js/arrive.min.js') }}"></script>
<script src="{{ asset('js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap-notify.js') }}"></script>
<script src="{{ asset('js/material-dashboard.js?v=1.2.0') }}"></script>
</html>