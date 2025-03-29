@extends('layouts.admin.main')

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">Manage Employees</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li>Employee List</li>
	<li class="active">New Employee</li>
</ol>
@endsection

@section('content')
<!---------------------------------->
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        <a href="{{ route('admin.agents.index') }}" class="btn btn-purple">Back</a>
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
                        <li class="active"><a data-toggle="tab" href="#tab-1">Personal Information</a></li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form class="form-horizontal" id="form-account_information" method="POST" action="{{ route('admin.agents.store') }}" enctype="multipart/form-data">
                            @csrf

                            <p class="text-main text-bold">Profile Picture</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-md-2 control-label">Search Image</label>
                                <div class="col-md-9">
                                    <span class="pull-left btn btn-primary btn-file">
                                    Browse... <input type="file" name="picture">
                                    </span>
                                </div>
                            </div>

                            <p class="text-main text-bold">Company Information</p>
                            <hr>


                            <div class="form-group">
                                <label class="col-sm-2 control-label">ID No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="employee_number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Position</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="position">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Station</label>
                                <div class="col-sm-6">
                                    <select name="station" class="form-control">
                                        <option></option>

                                        @php
                                            $branches = \App\Models\Branch::get();
                                        @endphp

                                        @foreach ($branches as $branch)
                                            <option value="{{ $branch->value }}">{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Field Coordinator</label>
                                <div class="col-sm-6">
                                    <select name="field_coordinator" class="form-control text-uppercase">
                                        <option></option>
                                        
                                        @php
                                            $field_coordinators = \App\Models\FieldCoordinator::get();
                                        @endphp

                                        @foreach ($field_coordinators as $field_coordinator)
                                            <option value="{{ $field_coordinator->value }}">{{ $field_coordinator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Field Supervisor</label>
                                <div class="col-sm-6">
                                    <input type="text" name="field_supervisor" class="form-control text-uppercase">
                                </div>
                            </div>

                            <p class="text-main text-bold">Personal Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">First name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="first_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Middle name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="middle_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last name</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="last_name">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Suffix</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="suffix">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Nickname</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control text-uppercase" name="nick_name">
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
                                        <option value="M">M</option>
                                        <option value="F">F</option>
                                    </select>
                                </div>
                            </div>

                            <p class="text-main text-bold">Contact Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Telephone No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="telephone_number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone No.</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="phone_number">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="address">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        <button type="button" id="btn-create_agent" class="btn btn-default btn-block">Save</button>
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
                employee_number: {
                    message: 'The ID No. is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The ID No. is required.'
                        },
                        remote: {
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            },
                            url: '{{ route('admin.agents.search') }}',       
                            message: 'The ID No. is already taken',       
                            delay: 1000,
                            type: 'POST',   
                            data: function (validator) {
                                return {
                                    employee_number: $('input[name="employee_number"]').val(),         
                                    method: "check_agent" 
                                };
                            }
                        }
                    }
                },
                picture: {
                    message: 'The Picture is not valid',
                    validators: {
                        file: {
                            extension: 'jpg,jpeg,png',
                            type: 'image/jpg,image/jpeg,image/png',
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

                                if(!_.isEmpty(value) && value != 'None') {
                                    return pattern.test(value);
                                }

                                return true;
                            }
                        }
                    }
                },
                address: {
                    message: 'The Address is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The Address is required.'
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

        $('#btn-create_agent').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush