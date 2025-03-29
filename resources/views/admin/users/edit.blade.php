@extends('layouts.admin.main')

@push('css')
<style type="text/css">
.k-avatar {
    position: relative;
    display: inline-block;
}
.k-avatar .k-avatar__holder {
    width: 120px;
    height: 120px;
    border-radius: 3px;
    background-repeat: no-repeat;
    background-size: contain;
}
.k-avatar .k-avatar__upload {
    cursor: pointer;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: absolute;
    right: -10px;
    top: -10px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: #ffffff;
    -webkit-box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}
.k-avatar .k-avatar__upload input {
    width: 0 !important;
    height: 0 !important;
    overflow: hidden;
    opacity: 0;
}
.k-avatar .k-avatar__upload i {
    color: #385aeb;
    font-size: 0.9rem;
}
.k-avatar .k-avatar__upload:hover {
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    background-color: #385aeb;
}
.k-avatar .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar .k-avatar__cancel {
    cursor: pointer;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    position: absolute;
    top: auto;
    right: -10px;
    bottom: -5px;
    width: 22px;
    height: 22px;
    border-radius: 50%;
    background-color: #ffffff;
    -webkit-box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    display: none;
}
.k-avatar .k-avatar__cancel i {
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    color: #a1a8c3;
    font-size: 0.9rem;
}
.k-avatar .k-avatar__cancel:hover i {
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
    color: #385aeb;
}
.k-avatar.k-avatar--changed .k-avatar__cancel {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
}
.k-avatar.k-avatar--brand .k-avatar__upload i {
    color: #385aeb;
}
.k-avatar.k-avatar--brand .k-avatar__upload:hover {
    background-color: #385aeb;
}
.k-avatar.k-avatar--brand .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--metal .k-avatar__upload i {
    color: #d3dae6;
}
.k-avatar.k-avatar--metal .k-avatar__upload:hover {
    background-color: #d3dae6;
}
.k-avatar.k-avatar--metal .k-avatar__upload:hover i {
    color: #586272;
}
.k-avatar.k-avatar--light .k-avatar__upload i {
    color: #ffffff;
}
.k-avatar.k-avatar--light .k-avatar__upload:hover {
    background-color: #ffffff;
}
.k-avatar.k-avatar--light .k-avatar__upload:hover i {
    color: #282a3c;
}
.k-avatar.k-avatar--dark .k-avatar__upload i {
    color: #645ca1;
}
.k-avatar.k-avatar--dark .k-avatar__upload:hover {
    background-color: #645ca1;
}
.k-avatar.k-avatar--dark .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--accent .k-avatar__upload i {
    color: #00c5dc;
}
.k-avatar.k-avatar--accent .k-avatar__upload:hover {
    background-color: #00c5dc;
}
.k-avatar.k-avatar--accent .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--focus .k-avatar__upload i {
    color: #9816f4;
}
.k-avatar.k-avatar--focus .k-avatar__upload:hover {
    background-color: #9816f4;
}
.k-avatar.k-avatar--focus .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--primary .k-avatar__upload i {
    color: #5867dd;
}
.k-avatar.k-avatar--primary .k-avatar__upload:hover {
    background-color: #5867dd;
}
.k-avatar.k-avatar--primary .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--success .k-avatar__upload i {
    color: #1dc9b7;
}
.k-avatar.k-avatar--success .k-avatar__upload:hover {
    background-color: #1dc9b7;
}
.k-avatar.k-avatar--success .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--info .k-avatar__upload i {
    color: #5578eb;
}
.k-avatar.k-avatar--info .k-avatar__upload:hover {
    background-color: #5578eb;
}
.k-avatar.k-avatar--info .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--warning .k-avatar__upload i {
    color: #ffb822;
}
.k-avatar.k-avatar--warning .k-avatar__upload:hover {
    background-color: #ffb822;
}
.k-avatar.k-avatar--warning .k-avatar__upload:hover i {
    color: #111111;
}
.k-avatar.k-avatar--danger .k-avatar__upload i {
    color: #fd397a;
}
.k-avatar.k-avatar--danger .k-avatar__upload:hover {
    background-color: #fd397a;
}
.k-avatar.k-avatar--danger .k-avatar__upload:hover i {
    color: #ffffff;
}
.k-avatar.k-avatar--circle .k-avatar__holder {
    border-radius: 50%;
}
.k-avatar.k-avatar--circle .k-avatar__upload {
    right: 0px;
    top: 5px;
}
.k-avatar.k-avatar--circle .k-avatar__cancel {
    right: 3px;
    bottom: 10px;
}
.k-avatar.k-avatar--outline .k-avatar__holder {
    border: 3px solid #ffffff;
    -webkit-box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
    box-shadow: 0px 0px 13px 0px rgba(0, 0, 0, 0.1);
}
</style>
@endpush


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
	<li class="active">User Information</li>
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
	<div class="col-sm-4 col-md-3">
		<!-- Contact Widget -->
        <!---------------------------------->
        <div class="panel pos-rel">
            <div class="widget-control text-right">
                <div class="btn-group dropdown">
                    <a href="#" class="dropdown-toggle btn btn-trans" data-toggle="dropdown" aria-expanded="false"><i class="demo-psi-dot-vertical icon-lg"></i></a>
                    <ul class="dropdown-menu dropdown-menu-right" style="">
                        <li><a href="#"><i class="icon-lg icon-fw demo-psi-pen-5"></i> Edit</a></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-recycling"></i> Remove</a></li>
                        <li class="divider"></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-mail"></i> Send a Message</a></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-calendar-4"></i> View Details</a></li>
                        <li><a href="#"><i class="icon-lg icon-fw demo-pli-lock-user"></i> Lock</a></li>
                    </ul>
                </div>
            </div>
            <div class="pad-all">
                <div class="media pad-ver">
                    <div class="media-left">
                        <a href="#" class="box-inline">
                            @if (is_null($model->picture))
                                <img alt="Profile Picture" class="img-md img-circle" src="{{ asset('assets/image/user/default.jpg') }}">
                            @else
                                <img alt="Profile Picture" class="img-md img-circle" src="{{ $model->picture }}">
                            @endif
                        </a>
                    </div>
                    <div class="media-body pad-top">
                        <a href="#" class="box-inline">
                            <span class="text-lg text-semibold text-main">{{ !empty(trim($model->full_name)) ? $model->full_name : $model->username }}</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------->

        <div class="panel panel-panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><b>Components</b></h3>
            </div>
            <div class="pad-ver">
                <div class="list-group bg-trans mar-no">
                    <a class="list-group-item {{ request()->is('*edit') ? 'text-bold' : '' }}" href="{{ route('admin.users.edit', $model->id) }}">
                        <i class="demo-pli-information icon-lg icon-fw"></i> Manage Information
                    </a>
                    
                    @role('super-administrator')
                        <a class="list-group-item" href="{{ route('admin.users.permission', $model->id) }}">
                            <i class="demo-pli-information icon-lg icon-fw"></i> Manage Permission
                        </a>
                        <a class="list-group-item" href="{{ route('admin.users.role', $model->id) }}">
                            <i class="demo-pli-mine icon-lg icon-fw"></i> Manage Role
                        </a>
                    @endrole

                    <a class="list-group-item" href="#">
                        <i class="demo-pli-credit-card-2 icon-lg icon-fw"></i> User Logs
                    </a>
                </div>
            </div>
        </div>
	</div>

	<div class="col-sm-8 col-md-9">
        <div id="alert-message">
            
        </div>

		<div class="panel panel-primary">
            <!--Panel heading-->
            <div class="panel-heading">
                <div class="panel-control">

                    <!--Nav tabs-->
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab-1" data-toggle="tab" data-form="btn-update_password">Account Details</a>
                        </li>
                        <li>
                            <a href="#tab-2" data-toggle="tab" data-form="btn-update_details">Personal Information</a>
                        </li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form action="{{ route('admin.users.change_password', $model->id) }}" class="form-horizontal" id="form-update_password" method="POST">
                            @csrf
                            <p class="text-main text-bold">Account Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" value="{{ $model->username }}" readonly>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-6">
                                    @if ($model->status == 1)
                                        <span class="label label-info">Active</span>
                                    @else
                                        <span class="label label-danger">Inactive</span>
                                    @endif
                                </div>
                            </div>

                            <p class="text-main text-bold">Change Password</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">New Password</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">New Password Confirmation</label>
                                <div class="col-sm-6">
                                    <input type="password" name="password_confirmation" class="form-control">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="tab-2" class="tab-pane fade">
                        <form action="{{ route('admin.users.update', $model->id) }}" class="form-horizontal" id="form-update_details" method="POST" enctype="multipart/form-data">
                            @csrf

                            <p class="text-main text-bold">Profile Picture</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Avatar</label>
                                <div class="col-md-9">
                                    <div class="k-avatar k-avatar--outline k-avatar--circle" id="k_profile_avatar">
                                        @if (is_null($model->picture))
                                            <div class="k-avatar__holder" style="background-image: url('{{ asset('assets/image/user/default.jpg') }}');"></div>
                                        @else
                                            <div class="k-avatar__holder" style="background-image: url('{{ $model->picture }}');"></div>
                                        @endif

                                        <label class="k-avatar__upload" data-toggle="k-tooltip" title="" data-original-title="Change avatar">
                                            <i class="fa fa-pencil"></i>
                                            <input type="file" name="picture">
                                        </label>
                                        <span class="k-avatar__cancel" data-toggle="k-tooltip" title="" data-original-title="Cancel avatar">
                                            <i class="fa fa-times"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <p class="text-main text-bold">Personal Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">First name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="first_name" value="{{ $model->first_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Middle name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="middle_name" value="{{ trim(str_replace('.', '', $model->middle_name)) }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="last_name" value="{{ $model->last_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Suffix</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="suffix" value="{{ $model->suffix }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nickname</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="nick_name" value="{{ $model->nick_name }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Birthday</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="birthday" data-input="datepicker">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Gender</label>
                                <div class="col-sm-6">
                                    <select name="gender" class="form-control">
                                        <option value=""></option>
                                        <option value="M" {{ $model->gender == 'M' ? 'selected' : '' }}>M</option>
                                        <option value="F" {{ $model->gender == 'F' ? 'selected' : '' }}>F</option>
                                    </select>
                                </div>
                            </div>

                            <p class="text-main text-bold">Contact Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telephone No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="telephone_number" value="{{ $model->telephone_number }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone_number" value="{{ $model->phone_number }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email" value="{{ $model->email == 'None' ? '' : $model->email }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address" value="{{ $model->address }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        <button id="btn-update_password" class="btn btn-default btn-block" data-input="btn-update_user">Save</button>
                        <button id="btn-update_details" class="btn btn-default btn-block hidden" data-input="btn-update_user">Save</button>
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
    var f = '#form-update_password';

    p.initialize = function () {
        this._Avatar();
        this._Datepicker();
        this._TabChange();
        this._ChangePassword();
        this._ChangeDetails();
    }

    p._Avatar = function () {
        var KAvatar = function(elementId, options) {
            // Main object
            var the = this;
            var init = false;

            // Get element object
            var element = $(elementId);

            if (!element) {
                return; 
            }


            var defaultOptions = {
            };

            var Plugin = {
                construct: function(options) {
                    Plugin.init(options);
                    Plugin.build();

                    return the;
                },

                init: function(options) {
                    the.element = element;
                    the.events = [];

                    the.input = element.find('input[type="file"]');

                    the.holder = element.find('.k-avatar__holder');
                    the.cancel = element.find('.k-avatar__cancel');
                    the.src = $(the.holder).css('backgroundImage');

                    the.options = $.extend({}, defaultOptions, options);
                },

                /**
                 * Build Form Wizard
                 */
                build: function() {
                    // Handle avatar change
                    $(the.input).on('change', function(e) {
                        e.preventDefault();

                      if (e.target.files && e.target.files[0]) {
                          var reader = new FileReader();

                          reader.onload = function(e) {
                              $(the.holder).css('background-image', 'url('+e.target.result +')')
                          }

                          reader.readAsDataURL(e.target.files[0]);

                          $(the.element).addClass('k-avatar--changed')
                      }
                    });

                    $(the.cancel).on('click', function(e) {
                        e.preventDefault();

                        $(the.element).removeClass('k-avatar--changed');
                        $(the.holder).css('background-image', the.src);

                        the.input.value = "";
                    });
                },

                /**
                 * Trigger events
                 */
                eventTrigger: function(name) {
                    //KUtil.triggerCustomEvent(name);
                    for (var i = 0; i < the.events.length; i++) {
                        var event = the.events[i];
                        if (event.name == name) {
                            if (event.one == true) {
                                if (event.fired == false) {
                                    the.events[i].fired = true;
                                    event.handler.call(this, the);
                                }
                            } else {
                                event.handler.call(this, the);
                            }
                        }
                    }
                },

                addEvent: function(name, handler, one) {
                    the.events.push({
                        name: name,
                        handler: handler,
                        one: one,
                        fired: false
                    });

                    return the;
                }
            };

            the.setDefaults = function(options) {
                defaultOptions = options;
            };

            the.on = function(name, handler) {
                return Plugin.addEvent(name, handler);
            };

            the.one = function(name, handler) {
                return Plugin.addEvent(name, handler, true);
            };

            Plugin.construct.apply(the, [options]);

            return the;
        };

        var avatar = new KAvatar('#k_profile_avatar', {
            change: true,
            cancel: true
        });
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

    p._TabChange = function () {
        $('.nav-tabs li').click(function (e) {
            $('[data-input="btn-update_user"]').addClass('hidden');
            $('#' + $(e.currentTarget).find('a').attr('data-form')).removeClass('hidden');
        })
    }

    p._ChangePassword = function () {
        var form = $('#form-update_password').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
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
                $('button').removeAttr('disabled');
                
                if(!_.some(error.response.data.errors, _.isEmpty)) {
                    var error_message = $('<div>', {
                        class: 'alert alert-danger',
                        html: '<button class="close" data-dismiss="alert"><i class="pci-cross pci-circle"></i></button>\
                                <strong>Something went wrong!</strong>\
                                <ul id="error_list"></ul>'
                    })

                    _.forEach(error.response.data.errors, function (row) {
                        _.forEach(row, function (row) {
                            error_message.find('ul').append('<li>' + row + '</li>');
                        })
                    })

                    error_message.appendTo($('#alert-message'));
                }
            });
        });

        $('#btn-update_password').click(function () {
            form.submit();
        })
    }

    p._ChangeDetails = function () {

        var form = $('#form-update_details').bootstrapValidator({
            message: 'This value is not valid',
            fields: {
                employee_number: {
                    message: 'The ID No. is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The ID No. is required.'
                        }
                    }
                },
                picture: {
                    message: 'The Picture is not valid',
                    validators: {
                        file: {
                            extension: 'jpeg,png',
                            type: 'image/jpeg,image/png',
                            maxSize: 2048 * 1024,
                            message: 'The selected file is not valid'
                        }
                    }
                },
                first_name: {
                    message: 'The First name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The First name is required.'
                        }
                    }
                },
                last_name: {
                    message: 'The Last name is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Last name is required.'
                        }
                    }
                },
                birthday: {
                    message: 'The Birthday is not valid',
                    validators: {
                        callback: {
                            message: 'Please enter a valid date format (yyyy-mm-dd).',
                            callback: function (value, validator) {
                                if(!_.isEmpty(value)) {
                                    var m = new moment(value, 'YYYY-MM-DD', true);

                                    return m.isValid();
                                }

                                return true;
                            }
                        }
                    }
                },
                email: {
                    message: 'The Email is not valid',
                    validators: {
                        callback: {
                            message: 'The value is not a valid email address',
                            callback: function (value, validator) {
                                var pattern = /^\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i;

                                if(!_.isEmpty(value)) {
                                    return pattern.test(value);
                                }

                                return true;
                            }
                        }
                    }
                }
            }
        })
        on('success.form.bv', function(e) {
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

        $('#btn-update_details').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush