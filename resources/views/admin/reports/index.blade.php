@extends('layouts.admin.main')

@section('page-head')
<div id="page-title">
    <h1 class="page-header text-overflow">Reports</h1>
</div>

<ol class="breadcrumb">
    <li>
        <a href="{{ route('admin.index') }}">
            <i class="demo-pli-home"></i>
            Home
        </a>
    </li>
    <li class="active">Reports</li>
</ol>
@endsection

@section('content')

    <p>This is the Reports page.</p>
    
    <div class="row pad-btm">
    <div class="col-sm-6 toolbar-left">

            <a id="demo-btn-addrow" class="btn btn-purple">Add New</a>
            <a id="demo-btn-addrow" class="btn btn-purple">Add New</a>
            <a id="demo-btn-addrow" class="btn btn-purple">Add New</a>
            <a id="demo-btn-addrow" class="btn btn-purple">Add New</a>
     
    </div>
</div>

@endsection