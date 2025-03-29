<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Greatmind STL | Login</title>
    
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/nifty/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/themify-icons/themify-icons.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/nifty/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/css/nifty.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/css/demo/nifty-demo-icons.min.css') }}" rel="stylesheet">
    <link href="{{ secure_asset('assets/nifty/css/themes/type-a/theme-ocean.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/pace/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('assets/nifty/plugins/pace/pace.min.js') }}"></script>
    <link href="{{ asset('assets/nifty/css/demo/nifty-demo.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/bootstrap-validator/bootstrapValidator.min.css') }}">

    <script src="{{ asset('assets/nifty/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/nifty/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/nifty/js/nifty.min.js') }}"></script>
    <script src="{{ asset('assets/nifty/plugins/bootstrap-validator/bootstrapValidator.min.js') }}"></script>
    <script type="text/javascript">
        $(function (namespace, $) {
            'use strict';

            var js = function () {
                var o = this;

                $(document).ready(function () {
                    o.initialize()
                })
            }

            var p = js.prototype;

            p.initialize = function () {
                this._validate();
            }

            p._validate = function () {
                var form = $('form').bootstrapValidator({
                    message: 'This value is not valid',
                    fields: {
                        username: {
                            message: 'The username is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The username is required.'
                                }
                            }
                        },
                        password: {
                            message: 'The password is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The password is required.'
                                }
                            }
                        }
                    }
                })

                $('button').click(function () {
                    var v = form.data('bootstrapValidator').validate();

                    if (v.isValid()) {
                        form.bootstrapValidator('defaultSubmit');
                    }
                })
            }

            namespace.js = new js;

        }(this, jQuery));
    </script>
</head>
<body>
    <div id="container" class="cls-container">
        
        <!-- BACKGROUND IMAGE -->
        <!--===================================================-->
        <div id="bg-overlay"></div>
        
        
        <!-- LOGIN FORM -->
        <!--===================================================-->

        <div class="cls-content">
            @error('username')            
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="alert alert-danger">
                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
            @enderror
            <div class="cls-content-sm panel">
                <div class="panel-body">

                    <div class="mar-ver pad-btm">
                        <h1 class="h3">Account Login</h1>
                        <p>Sign In to your account</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="username" class="form-control" placeholder="Username" autofocus="" autocomplete="off" value="{{ old('username') }}">
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" class="magic-checkbox" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="demo-form-checkbox">Remember me</label>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="button">Sign In</button>
                    </form>
                </div>

                <div class="pad-all">
                    <a href="{{ route('register') }}" class="btn-link mar-lft">Create a new account</a>
                </div>
            </div>
        </div>
        <!--===================================================-->
    </div>
</body>
</html>