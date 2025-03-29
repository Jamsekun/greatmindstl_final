<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Greatmind STL | Register</title>

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
                        first_name: {
                            message: 'The first name is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The first name is required.'
                                }
                            }
                        },
                        last_name: {
                            message: 'The last name is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The last name is required.'
                                }
                            }
                        },
                        email: {
                            message: 'The email is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The email is required.'
                                },
                                emailAddress: {
                                    message: 'The input is not a valid email address'
                                }
                            }
                        },
                        username: {
                            message: 'The username is not valid',
                            validators: {
                                stringLength: {
                                    min: 4,
                                    max: 30,
                                    message: 'The username must be more than 4 and less than 30 characters long'
                                },
                                notEmpty: {
                                    message: 'The username is required.'
                                },
                                regexp: {
                                    regexp: /^[a-zA-Z0-9_\.]+$/,
                                    message: 'The username can only consist of alphabetical, number, dot and underscore'
                                },
                                remote: {
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    },
                                    url: '{{ route('admin.users.search') }}',       
                                    message: 'The username is already taken',       
                                    delay: 1000,
                                    type: 'POST',   
                                    data: function (validator) {
                                        return {
                                            username: $('input[name="username"]').val(),         
                                            method: "check_username" 
                                        };
                                    }
                                }
                            }
                        },
                        password: {
                            message: 'The password is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The password is required.'
                                },
                                different: {
                                    field: 'username',
                                    message: 'The password cannot be the same as username'
                                }
                            }
                        },
                        password_confirmation: {
                            validators: {
                                notEmpty: {
                                    message: 'The confirm password is required and can\'t be empty'
                                },
                                identical: {
                                    field: 'password',
                                    message: 'The password and its confirm are not the same'
                                }
                            }
                        },
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
    
    
        <!-- REGISTRATION FORM -->
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

            @error('message')            
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="alert alert-success">
                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>
                        <strong>{{ $message }}</strong>
                    </div>
                </div>
            </div>
            @enderror

            <div class="cls-content-lg panel">
                <div class="panel-body">
                    <div class="mar-ver pad-btm">
                        <h1 class="h3">Create a New Account</h1>
                        <p>Come join the Nifty community! Let's set up your account.</p>
                    </div>

                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{ old('first_name') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{ old('last_name') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                                
                            </div>
                        </div>
                        <div class="checkbox pad-btm text-left">
                            <input id="demo-form-checkbox" name="terms_and_condition" class="magic-checkbox" type="checkbox">
                            <label for="demo-form-checkbox">I agree with the <a href="#" class="btn-link text-bold">Terms and Conditions</a></label>
                        </div>
                        <button class="btn btn-primary btn-lg btn-block" type="button">Register</button>
                    </form>
                </div>
                <div class="pad-all">
                    Already have an account ? <a href="{{ route('login') }}" class="btn-link mar-rgt text-bold">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>