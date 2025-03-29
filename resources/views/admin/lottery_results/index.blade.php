@extends('layouts.admin.main')

@push('css')
<link href="{{ asset('assets/nifty/plugins/datatables/media/css/dataTables.bootstrap.css') }}" rel="stylesheet">
<link href="{{ asset('assets/nifty/plugins/datatables/extensions/Responsive/css/responsive.dataTables.min.css') }}" rel="stylesheet">
@endpush

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">Lottery Results</h1>
</div>

<ol class="breadcrumb">
	<li>
		<a href="{{ route('admin.index') }}">
			<i class="demo-pli-home"></i>
			Home
		</a>
	</li>
	<li class="active">Lottery Result List</li>
</ol>
@endsection

@section('content')
<div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">
        @can('lottery_results.create')
            <a href="{{ route('admin.lottery_results.create') }}" id="demo-btn-addrow" class="btn btn-purple">Add New</a>
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
                    <th>Result</th>
                    <th width="100">Total Winners</th>
                    <th width="150">Date</th>
                    <th width="150">Draw Time</th>
                    <th width="150">Tally Sheet</th>
                    <th>Created By</th>
                    <th>Updated By</th>
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
        return '{{ auth()->user()->can('lottery_results.edit') }}';
    }

    p.IsDeletable = function () {
        return '{{ auth()->user()->can('lottery_results.delete') }}';
    }

    p.EditDetails = function (o) {
        if(!p.IsEditable()) {
            toastr.error('You don\'t have permission to edit lottery results.', 'Error');

            return;
        }

        var o = $(o);
        var i = o.attr('data-id');
        var url = o.attr('data-url').replace(':id', i);

        window.open(url, '_blank');
    }

    p._DataTable = function () {
    	dt = $('#datatable-user').DataTable({
    		responsive: true,
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
        		url: '{{ route('admin.lottery_results.load') }}'
        	}, 
        	columns: [
        		{ data: 'result', name: 'result' },
        		{ data: 'count', name: 'count' },
        		{ data: 'date', name: 'date' },
        		{ data: 'draw_time', name: 'draw_time' },
        		{ data: 'tally_sheet', name: 'tally_sheet' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
        		{ 
        			data: null, 
                    orderable: false,
                    searchable: false,
        		  	render: function (data, type) {
        		  		return '\
	                        <a href="javascript:;" onclick="js.EditDetails(this)" class="btn btn-md btn-clean btn-icon-md" data-item-info="edit-details" data-id="' + data.id + '" data-url="' + '{{ route('admin.lottery_results.edit', ':id') }}' + '" title="Edit details">\
	                            <i class="fa fa-edit"></i>\
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