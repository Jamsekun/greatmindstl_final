@extends('layouts.admin.main')

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">New Lottery Results</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li>Lottery Result List</li>
	<li class="active">New Lottery Result</li>
</ol>
@endsection

@section('content')
<!---------------------------------->
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        <a href="{{ route('admin.lottery_results.index') }}" class="btn btn-purple">Back</a>
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
                        <li class="active"><a data-toggle="tab" href="#tab-1">Result Information</a></li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form class="form-horizontal" id="form-lottery_results" method="POST" action="{{ route('admin.lottery_results.store') }}">
                            @csrf

                            <p class="text-main text-bold">Result Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="date" value="{{ old('date') }}" data-input="datepicker" autocomplete="off">
                                </div>
                            </div>
                            
                            <div class="form-group pad-ver">
                                <label class="col-md-2 control-label">Draw Time</label>
                                <div class="col-md-6">
                                    <div class="input-group date">
                                        <input type="text" class="form-control" name="draw_time" data-input="timepicker">
                                        <span class="input-group-addon"><i class="demo-pli-clock"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Winning Numbers</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="number_1" value="{{ old('number_1') }}" maxlength="2" style="margin-bottom: 5px;" autocomplete="off">
                                </div>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="number_2" value="{{ old('number_2') }}" maxlength="2" style="margin-bottom: 5px;" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Tally Sheet</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="tally_sheet" autocomplete="off">
                                </div>
                            </div>

			                <div class="form-group">
                                <label class="col-sm-2 control-label">Created By</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="amount" value="{{ auth()->user()->UserInformation->full_name }}" disabled>
                                </div>
                            </div>

                            <p class="text-main text-bold">Winners</p>
                            <hr>

                            <div id="repeater">
                            	<div data-repeater-list="lottery_results_winners">
							      	<div data-repeater-item>
							        	<div class="form-group">
							        		<label class="col-sm-2 control-label">Agent/Amount</label>
			                                <div class="col-sm-3">
			                                    <select class="form-control" name="agent" data-input="select2" data-name="agent">
			                                    </select>
			                                </div>
			                                <div class="col-sm-2">
			                                	<input type="text" class="form-control" name="amount" data-name="amount" placeholder="Amount" style="margin-bottom: 5px;">
			                                </div>
			                                <div class="col-sm-2">
			                                	<button type="button" class="btn btn-sm btn-danger" style="margin-top: 2px;" data-repeater-delete>X</button>
			                                </div>
							        	</div>
							      	</div>
							    </div>

                            	<div class="form-group">
                            		<label class="col-sm-2 control-label">&nbsp;</label>
                            		<div class="col-sm-6">
                            			<button type="button" class="btn btn-primary" data-repeater-create>ADD</button>
                            		</div>
                            	</div>
                            </div>			
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-footer text-right">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        <button type="button" id="btn-lottery_results" class="btn btn-default btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ secure_asset('assets/nifty/plugins/jquery-repeater/jquery.repeater.min.js') }}"></script>
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
    	this._Repeater();
        this._Datepicker();
        this._validate();
    }

    p._Repeater = function () {
    	$('#repeater').repeater({
            initEmpty: true,
            show: function () {
                $(this).slideDown();

                _.forEach($(this).find('input, select'), function (input) {
            	   if($(input).attr('data-name') == 'agent') {
                        $('#form-lottery_results').bootstrapValidator('addField', $(input).attr('name'), {
                            validators: {
                                notEmpty: {
                                    message: 'The agent is required.'
                                }
                            }
                        });

                        $('select[name="' + $(input).attr('name') + '"]').select2({
                            minimumInputLength: 2,
                            placeholder: "Search Agent",
                            allowClear: true,
                            ajax: {
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                },
                                url: '{{ route('admin.agents.search') }}',
                                type: 'POST',
                                data: function (params) {
                                    var query = {
                                        filter: 'search_agent',
                                        search: params.term
                                    }

                                    return query;
                                },
                                processResults: function (data) {
                                    return {
                                        results: $.map(data, function (item) {
                                            return {
                                                    text: item.employee_number + ': ' + item.first_name + ' ' + item.last_name,
                                                    id: item.id,
                                                }
                                            })
                                    }
                                }
                            }
                        });
                    }

                    if($(input).attr('data-name') == 'amount') {
                        $('#form-lottery_results').bootstrapValidator('addField', $(input).attr('name'), {
                            validators: {
                                notEmpty: {
                                    message: 'The amount is required.'
                                },
                                numeric : {
                                    message : 'Please enter the valid number.',
                                },
                                greaterThan: {
                                    value: 1,
                                    message: 'Amount must be greater than 0.'
                                }
                            }
                        });
                    }
                });
            },
            hide: function (element) {
            	$(this).slideUp(element);

            	_.forEach($(this).find('input, select'), function (input) {
            		$('#form-lottery_results').bootstrapValidator('removeField', $(input).attr('name'));
            	});
            },
            isFirstItemUndeletable: true
        })
    }

    p._Datepicker = function () {
        $('[data-input="datepicker"]').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd', 
            todayBtn: 'linked',
            todayHighlight: false
        }).on('changeDate show', function(e) {
            $('#form-lottery_results').bootstrapValidator('revalidateField', $(e.currentTarget).attr('name'));
        });

        $('[data-input="timepicker"]').timepicker({
            minuteStep: 1,
            showInputs: false,
            disableFocus: true,
            defaultTime: false
        });
    }

    p._validate = function () {
        var form = $('#form-lottery_results').bootstrapValidator({
        	excluded: [':disabled', ':hidden', ':not(:visible)'],
            message: 'This value is not valid',
            fields: {
                date: {
                    message: 'The Date is not valid',
                    validators: {
                    	notEmpty: {
                            message: 'The date is required.'
                        },
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
                draw_time: {
		            validators: {
		                notEmpty: {
		                    message: 'The draw time is required.'
		                },
		            }
		        },
                tally_sheet: {
                    validators: {
                        notEmpty: {
                            message: 'The tally sheet is required.'
                        },
                        integer: {
                            message: 'Please enter the valid number.',
                        },
                        greaterThan: {
                            value: 1,
                            message: 'Tally sheet must be greater than 0.'
                        }
                    }
                },
		        number_1: {
                    message: 'The amount is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The amount is required.'
                        },
                        integer: {
				            message : 'Please enter the valid number.',
				        },
				        greaterThan: {
	                        value: 1,
	                        message: 'Amount must be greater than 0.'
	                    }
                    }
                },
                number_2: {
                    message: 'The amount is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The amount is required.'
                        },
                        integer : {
				            message : 'Please enter the valid number.',
				        },
				        greaterThan: {
	                        value: 1,
	                        message: 'Amount must be greater than 0.'
	                    }
                    }
                }
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
                $('input[type="radio"]').prop('checked', false);
                $('[data-repeater-item]').remove();
                
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

        $('#btn-lottery_results').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush