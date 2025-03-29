@extends('layouts.admin.main')

@push('css')
<link href="{{ asset('assets/nifty/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/nifty/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet">
@endpush

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
	<li class="active">Employee List</li>
</ol>
@endsection

@section('content')

<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        @can('agents.create')
            <a href="{{ route('admin.agents.create') }}" class="btn btn-purple">Add New</a>
        @endcan

        <a href="{{ route('admin.agents.export') }}" class="btn btn-purple">Export</a>
    </div>
</div>

<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title">&nbsp;</h3>
    </div>
    <div class="panel-body">
        <table id="datatable-user" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th width="100">ID No.</th>
                    <th>Full Name</th>
                    <th width="50">Position</th>
                    <th width="50">Station</th>
                    <th width="150">Field Coordinator</th>
                    <th width="50">Birthday</th>
                    <th width="120">Telephone No.</th>
                    <th width="120">Phone No.</th>
                    <th width="120">Email</th>
                    <th width="100">Status</th>
                    <th width="100">Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@endsection

@push('js')
<script src="{{ asset('assets/nifty/plugins/datatables/media/js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/nifty/plugins/datatables/media/js/dataTables.bootstrap.js') }}"></script>
<script src="{{ asset('assets/nifty/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js') }}"></script>
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
    var dt;

    p.initialize = function () {
        this._DataTable();
    }

    p.IsEditable = function () {
        return '{{ auth()->user()->can('agents.edit') }}';
    }

    p.IsDeletable = function () {
        return '{{ auth()->user()->can('agents.delete') }}';
    }

    p.EditDetails = function (o) {
        if(!p.IsEditable()) {
            toastr.error('You don\'t have permission to edit emplyoee information.', 'Error');

            return;
        }

        var o = $(o);
        var i = o.attr('data-id');
        var url = o.attr('data-url').replace(':id', i);

        window.open(url, '_blank');
    }

    p.Delete = function (o) {
        if(!p.IsDeletable()) {
            toastr.error('You don\'t have permission to delete employee.', 'Error');

            return;
        }

        var o = $(o);
        var i = o.attr('data-id');
        var url = o.attr('data-url').replace(':id', i);


        bootbox.confirm({
            message: 'Are you sure you want to delete this user?',
            animate: false,
            callback: function (result) {
                if (result) {
                    axios({
                        method: 'POST',
                        url: url
                    }).then(function (response) {
                        var index = _.findIndex(dt.rows().data(), function (row, item) {
                            return row.id == i;
                        })

                        dt.row(index).remove().draw(false);

                        toastr.success('Agent has been deleted.', 'Success');
                    }).catch(function (error) {

                    })
                }
            }
        })
    }

    p._DataTable = function () {
    	dt = $('#datatable-user').DataTable({
    		responsive: true,
    		scrollX: true,
			pageLength: 50,
        	scrollY: 500,
        	serverSide: true,
    		processing: true,
        	language: {
            	paginate: {
              		previous: '<i class="demo-psi-arrow-left"></i>',
              		next: '<i class="demo-psi-arrow-right"></i>'
            	}
        	},
        	ajax: {
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		},
        		type: 'POST',
        		url: '{{ route('admin.agents.load') }}'
        	}, 
        	columns: [
        		{ data: 'employee_number', name: 'employee_number' },
        		{ data: 'full_name', name: 'full_name' },
                { data: 'position', name: 'position' },
                { data: 'station', name: 'station' },
                { data: 'field_coordinator', name: 'field_coordinator' },
                { data: 'birthday', name: 'birthday' },
                { data: 'telephone_number', name: 'telephone_number' },
                { data: 'phone_number', name: 'phone_number' },
                { data: 'email', name: 'email' },
                { data: 'status', name: 'status' },
        		{ 
        			data: null, 
                    orderable: false,
                    searchable: false,
        		  	render: function (data, type, row) {
        		  		return '\
                            <a href="javascript:;" onclick="js.EditDetails(this)" class="btn btn-md btn-clean btn-icon-md" data-item-info="edit-details" data-id="' + data.id + '" data-url="' + '{{ route('admin.agents.edit', ':id') }}' + '" title="Edit details">\
                                <i class="fa fa-edit"></i>\
                            </a>\
                            <a href="javascript:;" onclick="js.Delete(this)" class="btn btn-md btn-clean btn-icon-md" data-item-info="delete-details" data-id="' + data.id + '" data-url="' + '{{ route('admin.agents.delete', ':id') }}' + '" title="Delete">\
                                <i class="fa fa-trash-o"></i>\
                            </a>\
                        ';
        		  	},
                    className: 'text-center'
        		}
        	]
    	})
    }

    namespace.js = new js;
}(this, jQuery));
</script>
@endpush