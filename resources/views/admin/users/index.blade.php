@extends('layouts.admin.main')

@push('css')
<link href="{{ asset('assets/nifty/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/nifty/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet">
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
	<li class="active">User List</li>
</ol>
@endsection

@section('content')

<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        @can('users.create')
            <a href="{{ route('admin.users.create') }}" id="demo-btn-addrow" class="btn btn-purple">Add New</a>
        @endcan
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
                    <th>Username</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th width="150">Last Logged-in</th>
                    <th width="150">IP Address</th>
                    <th width="100">Status</th>
                    <th width="120">Action</th>
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
        return '{{ auth()->user()->can('users.edit') }}';
    }

    p.IsDeletable = function () {
        return '{{ auth()->user()->can('users.delete') }}';
    }

    p.SetStatus = function (o) {
        if(!p.IsEditable()) {
            toastr.error('You don\'t have permission to edit user status.', 'Error');

            return;
        }

        var o = $(o);
        var i = o.attr('data-id');
        var url = o.attr('data-url').replace(':id', i);

        axios({
            method: 'POST',
            url: url
        }).then(function (response) {
            var data = response.data;

            dt
              .rows({ selected: true })
              .every(function (rowIdx, tableLoop, rowLoop) {
                    if(this.data().id == i) {
                        $(this.node()).find('[data-item-info="set-status"]').html(
                            data == 1 ? 'Set as Inactive' : 'Set as Active'
                        );

                        dt.cell(rowIdx, 5).data(data);
                    }

              })
              .draw();
        }).catch(function (error) {

        })
    }

    p.EditDetails = function (o) {
        if(!p.IsDeletable()) {
            toastr.error('You don\'t have permission to edit user information', 'Error');

            return;
        }

        var o = $(o);
        var i = o.attr('data-id');
        var url = o.attr('data-url').replace(':id', i);

        window.open(url, '_blank');
    }

    p.Delete = function (o) {
        if(!p.IsDeletable()) {
            toastr.error('You don\'t have permission to delete user', 'Error');

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
        		url: '{{ route('admin.users.load') }}'
        	}, 
        	columns: [
        		{ data: 'username', name: 'username' },
        		{ data: 'full_name', name: 'full_name' },
        		{ data: 'email', name: 'email' },
        		{ data: 'last_login_at', name: 'last_login_at' },
        		{ data: 'last_login_ip', name: 'last_login_ip' },
        		{ 
        			data: 'status', 
        		  	render: function (data, type, row) {
        		  		if(data == 1) {
        		  			return '<div class="label label-table label-success">Active</div>';
        		  		} else {
        		  			return '<div class="label label-table label-danger">Inactive</div>';
        		  		}
        		  	},
        		  	className: 'text-center'
        		}, { 
        			data: null, 
                    orderable: false,
                    searchable: false,
        		  	render: function (data, type) {
        		  		return '\
                            <div class="dropdown" style="display: inline;">\
                                <a href="javascript:;" class="btn btn-md btn-clean btn-icon-md" data-toggle="dropdown" title="Change Status">\
                                    <i class="fa fa-ellipsis-h"></i>\
                                </a>\
                                <ul class="dropdown-menu">\
                                    <li class="dropdown-header">Set Status</li>\
                                    <li><a href="javascript:;" onclick="js.SetStatus(this)" data-item-info="set-status" data-id="' + data.id + '" data-url="' + '{{ route('admin.users.set_status', ':id') }}' + '">' + (data.status == 1 ? 'Set as Inactive' : 'Set as Active') + '</a></li>\
                                </ul>\
                            </div>\
	                        <a href="javascript:;" onclick="js.EditDetails(this)" class="btn btn-md btn-clean btn-icon-md" data-item-info="edit-details" data-id="' + data.id + '" data-url="' + '{{ route('admin.users.edit', ':id') }}' + '" title="Edit details">\
	                            <i class="fa fa-edit"></i>\
	                        </a>\
	                        <a href="javascript:;" onclick="js.Delete(this)" class="btn btn-md btn-clean btn-icon-md" data-item-info="delete-details" data-id="' + data.id + '" data-url="' + '{{ route('admin.users.delete', ':id') }}' + '" title="Delete">\
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