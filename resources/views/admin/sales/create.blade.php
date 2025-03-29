@extends('layouts.admin.main')

@push('css')
<link rel="stylesheet" href="{{ asset('assets/nifty/plugins/handsontable/handsontable.min.css') }}">
<style>
    .datepicker {
        z-index: 99999 !important;
    }
</style>
@endpush

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">Manage Sales</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li>Sales</li>
	<li class="active">New Sales</li>
</ol>
@endsection

@section('content')
<!---------------------------------->
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        <a href="{{ route('admin.sales.index') }}" class="btn btn-purple">Back</a>
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
                        <li class="active"><a data-toggle="tab" href="#tab-1">Sales Information</a></li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form class="form-horizontal" id="form-sales_information" method="POST" action="{{ route('admin.sales.store') }}">
                            @csrf

                            <p class="text-main text-bold">Sales Information</p>
                            <hr>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Station</label>
                                <div class="col-sm-6">
                                    <select name="station" class="form-control">
                                    	<option></option>
                                        @php
                                            $stations = \App\Models\Station::get();
                                        @endphp

                                        @foreach ($stations as $station)
                                            @can("station.{$station->name}")
                                                <option value="{{ $station->name }}" {{ old('station') == $station->name ? 'selected' : '' }}>{{ $station->value }}</option>
                                            @endcan
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Management</label>
                                <div class="col-sm-6">
                                    <select name="field_coordinator" class="form-control">
                                        <option></option>
                                        @php
                                            $field_coordinators = \App\Models\FieldCoordinator::get();
                                        @endphp

                                        @foreach ($field_coordinators as $field_coordinator)
                                            <option value="{{ $field_coordinator->value }}" {{ old('field_coordinator') == $field_coordinator->value ? 'selected' : '' }}>{{ $field_coordinator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
                                        <input type="text" class="form-control" name="draw_time" data-input="timepicker" value="{{ old('draw_time') }}">
                                        <span class="input-group-addon"><i class="demo-pli-clock"></i></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Total Gross</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="total_gross_pay" value="{{ old('total_gross_pay') }}" readonly>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Total NET</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="total_net" value="{{ old('total_net') }}" readonly>
                                </div>
                            </div>


			                <div class="form-group">
                                <label class="col-sm-2 control-label">Created By</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="amount" value="{{ auth()->user()->UserInformation->full_name }}" disabled>
                                </div>
                            </div>

                            <hr>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">&nbsp;</label>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-primary" data-add-row>ADD ITEM</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="sales-items">
                                
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
                        <button type="button" id="btn-create_sales" class="btn btn-default btn-block">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/nifty/plugins/handsontable/handsontable.js') }}"></script>
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
    var ht;

    p.initialize = function () {
        this._AddRow();
        this._SalesItems();
        this._Datepicker();
        this._validate();
    }

    p.Summary = function () {
        var total_gross_pay = 0;
        var total_net = 0;

        _.forEach(ht.getSourceData(), function (row) {
            if(_.has(row, 'gross_pay') && $.isNumeric(row.gross_pay)) {
                total_gross_pay += parseFloat(row.gross_pay);
                total_net += parseFloat(row.net);
            }
        });

        $('[name="total_gross_pay"]').val(total_gross_pay.toFixed(2));
        $('[name="total_net"]').val(total_net.toFixed(2));

        $('#form-sales_information').bootstrapValidator('revalidateField', $('[name="total_gross_pay"]').attr('name'));
        $('#form-sales_information').bootstrapValidator('revalidateField', $('[name="total_net"]').attr('name'));
    }

    p._AddRow = function () {
        $('[data-add-row]').click(function () {
            ht.alter('insert_row', ht.countRows(), 1)
        })
    }

    p._SalesItems = function () {
        var is_valid = true;

        ht = new Handsontable($('#sales-items')[0], {
            licenseKey: 'non-commercial-and-evaluation',
            rowHeaders: true,
            colHeaders: true,
            minSpareRows: 1,
            height: 400,
            colWidths: function (index) {
                var width = 150;

                if(index == 1) width = 90;
                if(index == 2 || index == 3) width = 70;

                return width;
            },
            columns: [
                {
                    data: 'kabo_number',
                    type: 'text'
                }, {
                    data: 'gross_pay',
                    type: 'numeric',
                    strict: true,
                    allowInvalid: false
                }, {
                    data: 'nine_percent',
                    type: 'numeric',
                    readOnly: true
                }, {
                    data: 'four_percent',
                    type: 'numeric',
                    readOnly: true
                }, {
                    data: 'net',
                    type: 'numeric',
                    readOnly: true
                }, {
                    data: 'out_pay',
                    type: 'numeric',
                    strict: true,
                    allowInvalid: false
                }
            ], 
            nestedHeaders: [
                [
                    {
                        label: 'Kabo #', 
                        colspan: 1
                    }, {
                        label: 'Gross', 
                        colspan: 1
                    }, {
                        label: '9%', 
                        colspan: 1
                    }, {
                        label: '4%', 
                        colspan: 1
                    }, {
                        label: 'NET', 
                        colspan: 1
                    }, {
                        label: 'PAY OUT', 
                        colspan: 1
                    },
                ],
            ],
            beforeChange: function (src, changes) {
                is_valid = true;

                if(changes == 'edit' || changes == 'Autofill.fill') {
                    _.forEach(src, function (item) {
                        var column = item[1];
                        var row = item[0];
                        var old_value = $.trim(item[2]);
                        var new_value = $.trim(item[3]);

                        if(old_value == new_value) is_valid = false;

                        if(column == 'kabo_number') {
                            if(_.findIndex(ht.getSourceData(), function (item) {
                                return item.kabo_number == new_value;
                            }) >= 0) {
                                toastr.error('Kabo Number already exists.', 'Invalid Data');
                                is_valid = false;
                            }
                        }

                    });

                    return is_valid;
                }
            },
            beforeCreateRow: function (index, amount, source) {
                return is_valid;
            },
            afterChange: function (src, changes) {
                if(changes == 'edit' || changes == 'Autofill.fill') {
                    _.forEach(src, function (item) {
                        p.Summary();
                    });

                    ht.render();
                }
            },
            beforeRenderer: function (td, row, col, prop, value, cellProperties) {
                function TEXT(instance, td, row, col, prop, value, cellProperties) {
                    Handsontable.renderers.TextRenderer.apply(this, arguments);

                    var data = instance.getSourceDataAtRow(row);

                    if(col == 1) {
                        td.style.textAlign = 'right';

                        if($.isNumeric(td.innerHTML)) {
                            td.innerHTML = parseFloat(td.innerHTML).toFixed(2)
                        }
                    } else if(col == 2) {
                        td.style.textAlign = 'right';

                        if(_.has(data, 'gross_pay')) {
                            td.innerHTML = (data.gross_pay * 0.9).toFixed(2);

                            data.nine_percent = td.innerHTML;
                        } else {
                            td.innerHTML = '0.00';
                        }
                    } else if(col == 3) {
                        td.style.textAlign = 'right';

                        if(_.has(data, 'gross_pay')) {
                            td.innerHTML = (data.gross_pay * 0.04).toFixed(2);

                            data.four_percent = td.innerHTML;
                        } else {
                            td.innerHTML = '0.00';
                        }
                    } else if(col == 4) {
                        td.style.textAlign = 'right';

                        if(_.has(data, 'gross_pay')) {
                            td.innerHTML = ((data.gross_pay * 0.9).toFixed(2) - (data.gross_pay * 0.04).toFixed(2)).toFixed(2);

                            data.net = td.innerHTML;
                        } else {
                            td.innerHTML = '0.00';
                        }
                    } else if(col == 5) {
                        td.style.textAlign = 'right';
                        
                        if($.isNumeric(td.innerHTML)) {
                            td.innerHTML = parseFloat(td.innerHTML).toFixed(2)
                        }
                    }

                    return td;
                }

                cellProperties.renderer = TEXT

                return cellProperties;
            },
            data: []
        })
    }

    p._Datepicker = function () {
        $('[data-input="datepicker"]').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd', 
            todayBtn: 'linked',
            todayHighlight: false
        }).on('changeDate show', function(e) {
            $('#form-sales_information').bootstrapValidator('revalidateField', $(e.currentTarget).attr('name'));
        });

        $('[data-input="timepicker"]').timepicker({
            minuteStep: 1,
            showInputs: false,
            disableFocus: true,
            defaultTime: false
        }).on('changeTime.timepicker', function(e) {
            $('#form-sales_information').bootstrapValidator('revalidateField', $(e.currentTarget).attr('name'));
        });
    }

    p._validate = function () {
        var form = $('#form-sales_information').bootstrapValidator({
        	excluded: [':disabled', ':hidden', ':not(:visible)'],
            message: 'This value is not valid',
            fields: {
            	station: {
                    message: 'The station is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The station is required.'
                        }
                    }
                },
                field_coordinator: {
                    message: 'The management is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The management is required.'
                        }
                    }
                },
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
                    message: 'The draw time is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The draw time is required.'
                        }
                    }
                },
                total_gross_pay: {
                    message: 'The total gross is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The total gross is required.'
                        },
                        numeric : {
                            message : 'Please enter the valid number.',
                        },
                        greaterThan: {
                            value: 0,
                            message: 'Amount must be greater than 0.'
                        }
                    }
                },
                total_net: {
                    message: 'The total net is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The total net is required.'
                        },
                        numeric : {
                            message : 'Please enter the valid number.',
                        },
                        greaterThan: {
                            value: 0,
                            message: 'Total net must be greater than 0.'
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
                form_data.append('items', JSON.stringify( _.pickBy(ht.getSourceData(), function(value, key) {
                    return !(value.gross_pay === undefined) || !(value.kabo_number === undefined);
                }) ));

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
                ht.updateSettings({
                    data : []
                });

                $('button').removeAttr('disabled');
            }).catch(function (error) {
                $('button').removeAttr('disabled');

                

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
        })

        $('#btn-create_sales').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush