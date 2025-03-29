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
                    <a class="list-group-item" href="{{ route('admin.users.edit', $model->id) }}">
                        <i class="demo-pli-information icon-lg icon-fw"></i> Manage Information
                    </a>
                    <a class="list-group-item" href="{{ route('admin.users.permission', $model->id) }}">
                        <i class="demo-pli-information icon-lg icon-fw"></i> Manage Permission
                    </a>
                    <a class="list-group-item {{ request()->is('*permission') ? 'text-bold' : '' }}" href="{{ route('admin.users.role', $model->id) }}">
                        <i class="demo-pli-mine icon-lg icon-fw"></i> Manage Role
                    </a>
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
                            <a href="#tab-1" data-toggle="tab">User Role</a>
                        </li>
                    </ul>

                </div>
                <h3 class="panel-title">&nbsp;</h3>
            </div>

            <!--Panel body-->
            <div class="panel-body">
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane fade in active">
                        <form action="#" class="form-horizontal" id="form-update_permission" method="POST">
                            @csrf
                            <p class="text-main text-bold">User Role</p>
                            <hr>

                            <div data-item="role-list"></div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-2 pull-right">
                        &nbsp;
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
        this._Roles();
    }

    p.AssignRole = function (o) {
        var o = $(o),
            r = o.val();

        axios({
            method: 'POST',
            url: '{{ route('admin.users.manage_role', $model->id) }}',
            data: {
                role: r
            }
        }).catch(function (error) {
            toastr.error('Something went wrong. Please contact administrator.', 'Error');
        });
    }

    p._Roles = function () {
       axios.all([
            axios({
                method: 'POST',
                url: '{{ route('admin.role.load') }}'
            }),
            axios({
                method: 'POST',
                url: '{{ route('admin.users.get_role', $model->id) }}'
            })
        ]).then(axios.spread(function (roles, get_roles) {
            var role = roles.data;
            var get_role = get_roles.data;

            var $container = $('[data-item="role-list"]');
            var $row = $('<div>', {
                    class: 'row',
                });

            var $column = $('<div>', {
                class: 'col-md-4',
                html:   '<div class="content-group">\
                            <h6 class="text-semibold heading-divided"> <i class = "icon-folder6 position-left"></i>Role List</h6>\
                            <hr>\
                            <div class="list-group bg-trans list-todo mar-no"></div>\
                        </div>'
                });

            role.forEach(function (item) {
                var c = ($.inArray(item.name, get_role) !== -1);
                            
                var a = $('<a>', {
                    href: '#',
                    class: 'list-group-item',
                    html:  '<input id="role-' + item.id + '" class="magic-checkbox" type="checkbox" value="' + item.name + '" onclick="js.AssignRole(this)" ' + (!c ? '' : 'checked') + '>\
                            <label for="role-' + item.id + '">\
                                <span>' + item.title + '</span>\
                            </label>'
                }).appendTo($column);

                $row.append($column);
            })

            $container.append($row);
        })).catch(function (error) {
            toastr.error('Something went wrong. Please contact administrator.', 'Error');
        })
    }
    
    namespace.js = new js;

}(this, jQuery));
</script>
@endpush