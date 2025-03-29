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
    <h1 class="page-header text-overflow">Manage Expenses</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li>Expenses</li>
	<li class="active">New Expenses</li>
</ol>
@endsection

@section('content')
<!---------------------------------->
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        <a href="{{ route('admin.expenses.index') }}" class="btn btn-purple">Back</a>
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
                        <li class="active"><a data-toggle="tab" href="#tab-1">Expenses Information</a></li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form class="form-horizontal" id="form-expenses_information" method="POST" action="{{ route('admin.expenses.store') }}">
                            @csrf

                            <p class="text-main text-bold">Expenses Information</p>
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
                                <label class="col-sm-2 control-label">Date</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="date" value="{{ old('date') }}" data-input="datepicker" autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Total Amount</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="total_amount" value="{{ old('total_amount') }}" readonly>
                                </div>
                            </div>

			                <div class="form-group">
                                <label class="col-sm-2 control-label">Created By</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" name="created_by" value="{{ auth()->user()->UserInformation->full_name }}" disabled>
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
                                    <div id="expenses-items">
                                
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
                        <button type="button" id="btn-create_expense" class="btn btn-default btn-block">Save</button>
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
        this._ExpensesItems();
        this._Datepicker();
        this._validate();
    }

    p.Summary = function () {
        var total_amount = 0;

        _.forEach(ht.getSourceData(), function (row) {
            if(_.has(row, 'amount') && $.isNumeric(row.amount)) {
                total_amount += parseFloat(row.amount);
            }
        });

        $('[name="total_amount"]').val(total_amount.toFixed(2));
        $('#form-expenses_information').bootstrapValidator('revalidateField', $('[name="total_amount"]').attr('name'));
    }

    p._AddRow = function () {
        $('[data-add-row]').click(function () {
            ht.alter('insert_row', ht.countRows(), 1)
        })
    }

    p._ExpensesItems = function () {
        var is_valid = true;

        ht = new Handsontable($('#expenses-items')[0], {
            licenseKey: 'non-commercial-and-evaluation',
            rowHeaders: true,
            colHeaders: true,
            minSpareRows: 1,
            height: 400,
            colWidths: function (index) {
                var width = 150;

                if(index == 0) width = 500;
                if(index == 1) width = 200;

                return width;
            },
            columns: [
                {
                    data: 'description',
                    type: 'text'
                }, {
                    data: 'amount',
                    type: 'numeric',
                    strict: true,
                    allowInvalid: false
                }
            ], 
            nestedHeaders: [
                [
                    {
                        label: 'Description', 
                        colspan: 1
                    }, {
                        label: 'Amount', 
                        colspan: 1
                    }
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
            $('#form-expenses_information').bootstrapValidator('revalidateField', $(e.currentTarget).attr('name'));
        });
    }

    p._validate = function () {
        var form = $('#form-expenses_information').bootstrapValidator({
        	excluded: [':disabled', ':hidden', ':not(:visible)'],
            message: 'This value is not valid',
            fields: {
                station: {
                    message: 'The station is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The station is required.'
                        },
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
                total_amount: {
                    message: 'The amount is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The total amount is required.'
                        },
                        numeric : {
                            message : 'Please enter the valid number.',
                        },
                        greaterThan: {
                            value: 0,
                            message: 'Total amount must be greater than 0.'
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
            form_data.append('items', JSON.stringify( _.pickBy(ht.getSourceData(), function(value, key) {
                return !(value.description === undefined) || !(value.amount === undefined);
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

        $('#btn-create_expense').click(function () {
            form.submit();
        })
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush