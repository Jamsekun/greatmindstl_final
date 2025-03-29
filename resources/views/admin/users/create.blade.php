@extends('layouts.admin.main')

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">Manage Users</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li>User List</li>
	<li class="active">New User</li>
</ol>
@endsection

@section('content')
<!---------------------------------->
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        <a href="{{ route('admin.users.index') }}" class="btn btn-purple">Back</a>
    </div>
</div>
<!---------------------------------->

<div class="row">
	<div class="col-sm-8 col-md-9">
        <div id="alert-message">
            
        </div>

		<div class="panel panel-primary">
            <!--Panel heading-->
            <div class="panel-heading">
                <div class="panel-control">

                    <!--Nav tabs-->
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-1">Account Information</a></li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form class="form-horizontal" id="form-account_information" method="POST" action="{{ route('admin.users.store') }}">
                            @csrf

                            <p class="text-main text-bold">Account Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Confirm Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>

                           
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-footer text-right">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        <button type="button" id="btn-create_user" class="btn btn-default btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>

@endsection

@push('js')
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
        this._Datepicker();
        this._validate();
    }

    p._Datepicker = function () {
        $('[data-input="datepicker"]').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd', 
            todayBtn: 'linked',
            todayHighlight: false
        }).on('changeDate show', function(e) {
            $('#form-account_information').bootstrapValidator('revalidateField', $(e.currentTarget).attr('name'));
        });
    }

    p._validate = function () {
        var form = $('#form-account_information').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                username: {
                    message: 'The username is not valid',
                    validators: {
                        stringLength: {
                            message: 'The username must be more than 4 and less than 30 characters long',
                            min: 4,
                            max: 30
                        },
                        notEmpty: {
                            message: 'The username is required.'
                        },
                        regexp: {
                            message: 'The username can only consist of alphabetical, number, dot and underscore',
                            regexp: /^[a-zA-Z0-9_\.]+$/,
                        },
                        notEmpty: {
                            message: 'The username is required.'
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
            }
        })
        .on('success.form.bv', function(e) {
            e.preventDefault();

            $('#alert-message').html('');
            $('button').attr('disabled', 'disabled');

            var form_data = new FormData($(e.target)[0]);

            axios({
                method: 'POST',
                url: form.attr('action'),
                data: form_data
            }).then(function (response) {
                 $('#alert-message').append('<div class="alert alert-success">\
                        <button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>\
                        <strong>' + response.data.message + '</strong>\
                    </div>\
                ');

                form.find('.form-group').removeClass('has-success');
                form.bootstrapValidator('resetForm', true);
                
                $('button').removeAttr('disabled');
            }).catch(function (error) {
                var error_message = $('<div>', {
                    class: 'alert alert-danger',
                    html:  '<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>\
                            <strong>Something went wrong!</strong>\
                            <ul id="error_list"></ul>'
                })

                if(!_.some(error.response.data.errors, _.isEmpty)) {
                    _.forEach(error.response.data.errors, function (row) {
                        _.forEach(row, function (row) {
                            error_message.find('ul').append('<li>' + row + '</li>');
                        })
                    })
                }
                
                error_message.appendTo($('#alert-message'));
                $('button').removeAttr('disabled');
            });
        });

        $('#btn-create_user').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush