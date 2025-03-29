@extends('layouts.admin.main')

@push('css')
<link href="{{ asset('assets/nifty/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/nifty/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/nifty/plugins/nestable-list/nestable-list.min.css') }}" rel="stylesheet">
<link href="{{ asset('assets/nifty/plugins/morris-js/morris.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="pad-all text-center">
    <h3>Welcome back to the STL Dashboard.</h3>
    <p1>
        Scroll down to see quick links, results and overviews of stl application
        <p></p>
    </p1>
</div>

<div class="row">
    <div class="col-lg-7">
        <div id="demo-sales" class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">Sales/Expenses</h3>
            </div>

            <!--chart placeholder-->
            <div class="pad-no">
                <div id="sales-chart" style="height: 255px;"></div>
            </div>

            <!--Chart information-->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-xs-4">
                                <p class="text-semibold text-uppercase text-main">Total Sales Amount</p>
                                <div class="media">
                                    <div class="media-left">
                                        <span class="text-2x text-thin text-main"><b>450,000</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-xs-6 text-sm">
                                 <p>
                                    <span>ALABANG AREA</span>
                                    <span class="pad-lft text-semibold">
                                        <span class="text-lg">2000</span>
                                        <span class="labellabel-success mar-lft">
                                            <i class="pci-caret-down text-success"></i>
                                            <smal>- 20</smal>
                                        </span>
                                    </span>
                                </p>
                                <p>
                                    <span>SUCAT AREA</span>
                                    <span class="pad-lft text-semibold">
                                        <span class="text-lg">2000</span>
                                        <span class="labellabel-success mar-lft">
                                            <i class="pci-caret-down text-success"></i>
                                            <smal>- 20</smal>
                                        </span>
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-6 text-sm">
                                <p>
                                    <span>BAYANAN/POBLACION</span>
                                    <span class="pad-lft text-semibold">
                                        <span class="text-lg">2500</span>
                                        <span class="labellabel-danger mar-lft">
                                            <i class="pci-caret-up text-danger"></i>
                                            <smal>+ 57</smal>
                                        </span>
                                    </span>
                                </p>
                                 <p>
                                    <span>POBLACION/TUNASAN UPPER</span>
                                    <span class="pad-lft text-semibold">
                                        <span class="text-lg">2000</span>
                                        <span class="labellabel-success mar-lft">
                                            <i class="pci-caret-down text-success"></i>
                                            <smal>- 20</smal>
                                        </span>
                                    </span>
                                </p>
                                <p>
                                    <span>POBLACION/TUNASAN LOWER</span>
                                    <span class="pad-lft text-semibold">
                                        <span class="text-lg">2500</span>
                                        <span class="labellabel-danger mar-lft">
                                            <i class="pci-caret-up text-danger"></i>
                                            <smal>+ 57</smal>
                                        </span>
                                    </span>
                                </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <p class="text-uppercase text-semibold text-main">SALES/EXPENSES</p>
                        <ul class="list-unstyled">
                            <li class="pad-btm">
                                <div class="clearfix">
                                    <p class="pull-left mar-no">Sales</p>
                                    <p class="pull-right mar-no">70%</p>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar progress-bar-info" style="width: 70%;">
                                        <span class="sr-only">70% Complete</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="clearfix">
                                    <p class="pull-left mar-no">Expenses</p>
                                    <p class="pull-right mar-no">10%</p>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar progress-bar-primary" style="width: 10%;">
                                        <span class="sr-only">10% Complete</span>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <!--Sparkline Area Chart-->
                <div class="panel panel-purple panel-colorful">
                    <div class="pad-all media">
                        <div class="media-left">
                            <i class="demo-pli-male icon-3x icon-fw"></i>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no media-heading" data-count="agents">0</p>
                            <span>No. of Employees</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-6">
                <!--Sparkline Line Chart-->
                <div class="panel panel-success panel-colorful">
                    <div class="pad-all media">
                        <div class="media-left">
                            <i class="demo-pli-male icon-3x icon-fw"></i>
                        </div>
                        <div class="media-body">
                            <p class="text-2x mar-no media-heading" data-count="users">0</p>
                            <span>No. of Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">History</h3>
                    </div>
                    <div class="panel-body pad-no">
                        <div class="nano" style="height: 381px;">
                            <div class="nano-content">
                                <ul class="file-list" id="history">
                                    
                                </ul>                        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="tab-base">
            <!--Nav Tabs-->
            <ul class="nav nav-tabs" id="nav-data">
                <li class="active">
                    <a data-toggle="tab" href="#demo-lft-tab-2" aria-expanded="true">New Employees <span class="badge badge-info" data-count="new-employees">0</span></a>
                </li>
            </ul>

            <!--Tabs Content-->
            <div class="tab-content">
                <div id="demo-lft-tab-2" class="tab-pane fade active in">
                    <hr>
                    <table id="table-new-employees" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th width="120">ID No.</th>
                                <th>Full Name</th>
                                <th width="150">Position</th>
                                <th width="100">Station</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-2 col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-control">
                    <button class="demo-panel-ref-btn btn btn-default" onclick="js._EmployeeHeadCount();">
                        <i class="demo-psi-repeat-2 icon-fw"></i> Refresh
                    </button>
                    <div class="btn-group dropdown">
                        <button data-toggle="dropdown" class="dropdown-toggle btn btn-default btn-active-primary">
                            Filter <i class="caret"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:;" data-input="employee-count" data-value="station">Station</a></li>
                            <li><a href="javascript:;" data-input="employee-count" data-value="field_coordinator">Field Coordinator</a></li>
                            <li><a href="javascript:;" data-input="employee-count" data-value="position">Position</a></li>
                        </ul>
                    </div>
                </div>
                <h3 class="panel-title">Employee Count</h3>
            </div>
            <div class="panel-body">
                <div class="nano" style="height: 475px;">
                    <div class="nano-content" id="employee-count">
                        <div class="load2">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/nifty/plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/nifty/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/nifty/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/nifty/plugins/morris-js/morris.min.js') }}"></script>
<script src="{{ asset('assets/nifty/plugins/morris-js/raphael-js/raphael.min.js') }}"></script>

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
    var filter_employee_count = {
        category: 'station'
    }

    p.initialize = function () {
        this._TabChange();
        this._Graph();
        this._Count();
        this._History();
        this._NewEmployees();
        this._FilterEmployeeCount();
        this._EmployeeHeadCount();
    }

    p._TabChange = function () {
        $('#nav-data li a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    }

    p._Graph = function () {
        Morris.Bar({
            element: 'sales-chart',
            data: [
                { y: '2021-07-11', a: 100, b: 90, c: 100 },
                { y: '2021-07-12', a: 75,  b: 65 },
            ],
            xkey: 'y',
            ykeys: ['a', 'b', 'c'],
            labels: ['Series A', 'Series B', 'Series C'],
            gridEnabled: true,
            gridLineColor: 'rgba(0,0,0,.1)',
            gridTextColor: '#8f9ea6',
            gridTextSize: '11px',
            barColors: ['#1abc9c', '#d8e8e5', '#d8e8e5'],
            resize:true,
            hideHover: 'auto'
        });
    }

    p._Count = function () {
        axios.all([
            axios.post('{{ route('admin.users.count') }}'), 
            axios.post('{{ route('admin.agents.count') }}'),
        ]).then(axios.spread((users, agents, winners, sales) => {
            $('[data-count="users"]').html(users.data);
            $('[data-count="agents"]').html(agents.data);
        }));
    }

    p._History = function () {
        var panel_body = $('#history');
            panel_body.find('div').remove();
            panel_body.append('<div class="load2">\
                                 <div class="loader"></div>\
                               </div>');
        axios({
            method: 'POST',
            url: '{{ route('history') }}'
        }).then(function (response) {
            panel_body.find('.load2').remove();

            var data = response.data;

            _.forEach(data, function (row) {
                $('<li>', {
                    html: '<div class="file-attach-icon"></div>\
                            <a href="#" class="file-details">\
                                <div class="media-block">\
                                    <div class="media-left"><i class="demo-psi-folder-zip text-success"></i></div>\
                                    <div class="media-body">\
                                        <p class="file-name">' + row.description + '</p>\
                                        <small>Description: ' + row.type + ' | User: ' + row.name + ' | Date: ' + row.date + '</small>\
                                    </div>\
                                </div>\
                            </a>'
                }).appendTo(panel_body)
            })
        })
    }

    p._NewEmployees = function () {
        $('#table-new-employees').DataTable({
            responsive: true,
            filter: false,
            info: false,
            paging: false,
            scrollX: true,
            scrollY: 400,
            ajax: {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ route('admin.agents.load') }}',
                data: {
                    latest: true
                },
                complete: function (response) {
                    $('[data-count="new-employees"]').text(response.responseJSON.recordsTotal)
                }
            }, 
            columns: [
                { data: 'employee_number', name: 'employee_number' },
                { data: 'full_name', name: 'full_name' },
                { data: 'position', name: 'position' },
                { data: 'station', name: 'station' },
            ]
        })
    }

    p._FilterEmployeeCount = function () {
        $('[data-input="employee-count"]').click(function () {
            var value = $(this).attr('data-value');

            filter_employee_count.category = value;

            p._EmployeeHeadCount();
        })
    }

    p._EmployeeHeadCount = function () {
        var panel_body = $('#employee-count');
            panel_body.find('div').remove();
            panel_body.append('<div class="load2">\
                                 <div class="loader"></div>\
                               </div>');
        axios({
            method: 'POST',
            url: '{{ route('admin.agents.load') }}',
        }).then(function (response) {
            panel_body.find('.load2').remove();

            _(response.data.data)
            .sortBy(filter_employee_count.category)
            .groupBy(filter_employee_count.category)
            .map((objs, key) => ({
                'key': key,
                'total': _.countBy(objs, filter_employee_count.category) }))
            .value()
            .forEach(function (item) {
                console.log(item);

                panel_body.append('<div class="pad-btm">\
                                        <a href="#" target="_blank" class="text-semibold text-main">\
                                            ' + item.key + '\
                                            <span class="pull-right badge badge-success">' + item.total[item.key] + '</span>\
                                        </a>\
                                    </div>')
            });
        });
    }

    namespace.js = new js;

}(this, jQuery));
</script>
@endpush