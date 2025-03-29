<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<title>Greatmind STL @yield('title')</title>
	<!-- favicon -->        
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/image/logo/logo3.png') }}">

	<!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <link href="{{ asset('assets/nifty/plugins/font-awesome/css/font-awesome.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/themify-icons/themify-icons.min.css', Request::secure()) }}" rel="stylesheet">

    <link href="{{ asset('assets/nifty/css/bootstrap.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/css/nifty.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/css/demo/nifty-demo-icons.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/css/themes/type-a/theme-ocean.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/pace/pace.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/toastr/toastr.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/select2/css/select2.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/bootstrap-select/bootstrap-select.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/bootstrap-validator/bootstrapValidator.min.css', Request::secure()) }}">
    <link href="{{ asset('assets/nifty/plugins/select2/css/select2.min.css', Request::secure()) }}" rel="stylesheet">
    <link href="{{ asset('assets/nifty/plugins/css-loaders/css/css-loaders.css', Request::secure()) }}" rel="stylesheet">

    @stack('css')

    <script src="{{ asset('assets/nifty/plugins/pace/pace.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/js/jquery.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/js/bootstrap.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/js/nifty.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/toastr/toastr.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/bootbox/bootbox.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/js/axios.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/bootstrap-select/bootstrap-select.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/select2/js/select2.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/bootstrap-validator/bootstrapValidator.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/momentjs/moment.min.js', Request::secure()) }}"></script>
    <script src="{{ asset('assets/nifty/plugins/select2/js/select2.min.js', Request::secure()) }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.21/lodash.min.js"></script>
    <script type="text/javascript">
    	axios.defaults.headers.common = {
		    'X-CSRF-TOKEN': '{{ csrf_token() }}',
		    'X-Requested-With': 'XMLHttpRequest',
		};

		toastr.options = {
		  	"closeButton": true,
		  	"debug": false,
		  	"newestOnTop": false,
		  	"progressBar": false,
		  	"positionClass": "toast-bottom-right",
		  	"preventDuplicates": false,
		  	"onclick": null,
		  	"showDuration": "300",
		  	"hideDuration": "1000",
		  	"timeOut": "5000",
		  	"extendedTimeOut": "1000",
		  	"showEasing": "swing",
		  	"hideEasing": "linear",
		  	"showMethod": "fadeIn",
		  	"hideMethod": "fadeOut"
		}
    </script>

    @stack('js')
</head>
<body>
    <div id="container" class="effect aside-float aside-bright mainnav-lg">
        <!--NAVBAR-->
        <!--===================================================-->
        <header id="navbar">
	        <div id="navbar-container" class="boxed">

	            <!--Brand logo & name-->
	            <!--================================-->
	            <div class="navbar-header">
	                <a href="{{ route('admin.index') }}" class="navbar-brand">
	                    <div class="brand-title">
	                        <span class="brand-text" style="font-size: 18px !important;">Greatmind STL</span>
	                    </div>
	                </a>
	            </div>
	            <!--================================-->
	            <!--End brand logo & name-->


	            <!--Navbar Dropdown-->
	            <!--================================-->
	            <div class="navbar-content">
	                <ul class="nav navbar-top-links">

	                    <!--Navigation toogle button-->
	                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                    <li class="tgl-menu-btn">
	                        <a class="mainnav-toggle" href="#">
	                            <i class="demo-pli-list-view"></i>
	                        </a>
	                    </li>
	                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                    <!--End Navigation toogle button-->
	                </ul>
	                <ul class="nav navbar-top-links">

	                    <!--Notification dropdown-->
	                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                    <li class="dropdown">
	                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
	                            <i class="demo-pli-bell"></i>
	                            <span class="badge badge-header badge-danger"></span>
	                        </a>


	                        <!--Notification dropdown menu-->
	                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
	                            <div class="nano scrollable">
	                                <div class="nano-content">
	                                    <ul class="head-list">
	                                        <li>
	                                            <a href="#" class="media add-tooltip" data-title="Used space : 95%" data-container="body" data-placement="bottom">
	                                                <div class="media-left">
	                                                    <i class="demo-pli-data-settings icon-2x text-main"></i>
	                                                </div>
	                                                <div class="media-body">
	                                                    <p class="text-nowrap text-main text-semibold">HDD is full</p>
	                                                    <div class="progress progress-sm mar-no">
	                                                        <div style="width: 95%;" class="progress-bar progress-bar-danger">
	                                                            <span class="sr-only">95% Complete</span>
	                                                        </div>
	                                                    </div>
	                                                </div>
	                                            </a>
	                                        </li>
	                                        <li>
	                                            <a class="media" href="#">
	                                                <div class="media-left">
	                                                    <i class="demo-pli-file-edit icon-2x"></i>
	                                                </div>
	                                                <div class="media-body">
	                                                    <p class="mar-no text-nowrap text-main text-semibold">Write a news article</p>
	                                                    <small>Last Update 8 hours ago</small>
	                                                </div>
	                                            </a>
	                                        </li>
	                                        <li>
	                                            <a class="media" href="#">
	                                                <span class="label label-info pull-right">New</span>
	                                                <div class="media-left">
	                                                    <i class="demo-pli-speech-bubble-7 icon-2x"></i>
	                                                </div>
	                                                <div class="media-body">
	                                                    <p class="mar-no text-nowrap text-main text-semibold">Comment Sorting</p>
	                                                    <small>Last Update 8 hours ago</small>
	                                                </div>
	                                            </a>
	                                        </li>
	                                        <li>
	                                            <a class="media" href="#">
	                                                <div class="media-left">
	                                                    <i class="demo-pli-add-user-star icon-2x"></i>
	                                                </div>
	                                                <div class="media-body">
	                                                    <p class="mar-no text-nowrap text-main text-semibold">New User Registered</p>
	                                                    <small>4 minutes ago</small>
	                                                </div>
	                                            </a>
	                                        </li>
	                                    </ul>
	                                </div>
	                            </div>

	                            <!--Dropdown footer-->
	                            <div class="pad-all bord-top">
	                                <a href="#" class="btn-link text-main box-block">
	                                    <i class="pci-chevron chevron-right pull-right"></i>Show All Notifications
	                                </a>
	                            </div>
	                        </div>
	                    </li>
	                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                    <!--End notifications dropdown-->


	                    <!--User dropdown-->
	                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                    <li id="dropdown-user" class="dropdown">
	                        <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
	                            <span class="ic-user pull-right">
	                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                                <!--You can use an image instead of an icon.-->
	                                <!--<img class="img-circle img-user media-object" src="img/profile-photos/1.png" alt="Profile Picture">-->
	                                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                                <i class="demo-pli-male"></i>
	                            </span>
	                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                            <!--You can also display a user name in the navbar.-->
	                            <!--<div class="username hidden-xs">Aaron Chavez</div>-->
	                            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                        </a>


	                        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
	                            <ul class="head-list">
	                                <li>
	                                    <a href="#"><i class="demo-pli-male icon-lg icon-fw"></i> Profile</a>
	                                </li>
	                                <li>
	                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a>

	                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                                        @csrf
	                                    </form>
	                                </li>
	                            </ul>
	                        </div>
	                    </li>
	                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
	                    <!--End user dropdown-->
	                </ul>
	            </div>
	            <!--================================-->
	            <!--End Navbar Dropdown-->

	        </div>
	    </header>
        <!--===================================================-->
        <!--END NAVBAR-->

        <div class="boxed">
            <!--CONTENT CONTAINER-->
            <!--===================================================-->
            <div id="content-container">
                <div id="page-head">
                    @yield('page-head')
                </div>

                <!--Page content-->
                <!--===================================================-->
                <div id="page-content">
                    @yield('content')
                </div>
                <!--===================================================-->
                <!--End page content-->
            </div>
            <!--===================================================-->
            <!--END CONTENT CONTAINER-->

            <!--ASIDE-->
            <!--===================================================-->
            <aside id="aside-container">
                <div id="aside">
                    <div class="nano">
                        <div class="nano-content">
                            <!--Nav tabs-->
                            <!--================================-->
                            <ul class="nav nav-tabs nav-justified">
                                <li class="active">
                                    <a href="#demo-asd-tab-1" data-toggle="tab">
                                        <i class="demo-pli-speech-bubble-7 icon-lg"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-2" data-toggle="tab"> <i class="demo-pli-information icon-lg icon-fw"></i> Report </a>
                                </li>
                                <li>
                                    <a href="#demo-asd-tab-3" data-toggle="tab"> <i class="demo-pli-wrench icon-lg icon-fw"></i> Settings </a>
                                </li>
                            </ul>
                            <!--================================-->
                            <!--End nav tabs-->
                        </div>
                    </div>
                </div>
            </aside>
            <!--===================================================-->
            <!--END ASIDE-->

            <!--MAIN NAVIGATION-->
            <!--===================================================-->
            <nav id="mainnav-container">
	            <div id="mainnav">
	                <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
	                <!--It will only appear on small screen devices.-->

	                <!--Menu-->
	                <!--================================-->
	                <div id="mainnav-menu-wrap">
	                    <div class="nano">
	                        <div class="nano-content">
	                            <!--Profile Widget-->
	                            <!--================================-->
	                            <div id="mainnav-profile" class="mainnav-profile">
	                                <div class="profile-wrap text-center">
	                                    <div class="pad-btm">
	                                    	@if (is_null(auth()->user()->UserInformation->picture))
	                                    		<img class="img-circle img-md" src="{{ asset('assets/image/user/default.jpg') }}" alt="Profile Picture" />
	                                    	@else
	                                    		<img class="img-circle img-md" src="{{ auth()->user()->UserInformation->picture }}" alt="Profile Picture" />
	                                    	@endif
	                                    </div>
	                                    <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
	                                        <span class="pull-right dropdown-toggle">
	                                            <i class="dropdown-caret"></i>
	                                        </span>
	                                        <p class="mnp-name">{{ auth()->user()->UserInformation->full_name }}</p>
	                                        <span class="mnp-desc">{{ auth()->user()->UserInformation->email }}</span>
	                                    </a>
	                                </div>
	                                <div id="profile-nav" class="collapse list-group bg-trans">
	                                    <a href="#" class="list-group-item"> <i class="demo-pli-male icon-lg icon-fw"></i> View Profile </a>
	                                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="list-group-item"> <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout </a>
	                                </div>
	                            </div>

	                            <!--Shortcut buttons-->
	                            <!--================================-->
	                            <div id="mainnav-shortcut" class="hidden">
	                                <ul class="list-unstyled shortcut-wrap">
	                                    <li class="col-xs-3" data-content="My Profile">
	                                        <a class="shortcut-grid" href="#">
	                                            <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
	                                                <i class="demo-pli-male"></i>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="col-xs-3" data-content="Messages">
	                                        <a class="shortcut-grid" href="#">
	                                            <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
	                                                <i class="demo-pli-speech-bubble-3"></i>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="col-xs-3" data-content="Activity">
	                                        <a class="shortcut-grid" href="#">
	                                            <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
	                                                <i class="demo-pli-thunder"></i>
	                                            </div>
	                                        </a>
	                                    </li>
	                                    <li class="col-xs-3" data-content="Lock Screen">
	                                        <a class="shortcut-grid" href="#">
	                                            <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
	                                                <i class="demo-pli-lock-2"></i>
	                                            </div>
	                                        </a>
	                                    </li>
	                                </ul>
	                            </div>
	                            <!--================================-->
	                            <!--End shortcut buttons-->

	                            <ul id="mainnav-menu" class="list-group">
	                                <!--Category name-->
	                                <li class="list-header">Navigation</li>

	                                <!--Menu list item-->
	                                <li class="{{ request()->is('admin') ? 'active-sub active' : '' }}">
	                                    <a href="{{ route('admin.index') }}">
	                                        <i class="demo-pli-home"></i>
	                                        <span class="menu-title">
	                                            Home
	                                        </span>
	                                    </a>
	                                </li>

	                                @can('agents.view')
	                                <li class="{{ request()->is('admin/employees*') ? 'active-sub active' : '' }}">
	                                    <a href="{{ route('admin.agents.index') }}">
	                                        <i class="fa fa-group"></i>
	                                        <span class="menu-title">
	                                            Employees
	                                        </span>
	                                    </a>
	                                </li>
	                                @endcan
	                                
	                                <li class="{{ request()->is('admin/reports*') ? 'active-sub active' : '' }}">
     <a href="{{ route('admin.reports.index') }}">
        <i class="fa fa-file-text-o"></i>  <span class="menu-title">
            Reports
        </span>
    </a>
</li>

	                                <li class="list-divider"></li>

	                                <!--Category name-->
	                                <li class="list-header">Components</li>

	                                <!--Menu list item-->
	                                @can('users.view')
	                               	<li class="{{ request()->is('admin/users*') ? 'active-sub active' : '' }}">
	                                    <a href="{{ route('admin.users.index') }}">
	                                        <i class="fa fa-user"></i>
	                                        <span class="menu-title">
	                                            Manager Users
	                                        </span>
	                                    </a>
	                                </li>
	                                @endcan

	                                @can('sales.view')
	                                <li class="{{ request()->is('admin/sales*') ? 'active-sub active' : '' }}">
	                                    <a href="{{ route('admin.sales.index') }}">
	                                        <i class="ti-stats-up"></i>
	                                        <span class="menu-title">
	                                            Manage Sales
	                                        </span>
	                                    </a>
	                                </li>
	                                @endcan

	                                @can('expenses.view')
	                                <li class="{{ request()->is('admin/expenses*') ? 'active-sub active' : '' }}">
	                                    <a href="{{ route('admin.expenses.index') }}">
	                                        <i class="fa fa-money"></i>
	                                        <span class="menu-title">
	                                            Manage Expenses
	                                        </span>
	                                    </a>
	                                </li>
	                                @endcan

	                                @can('lottery_results.view')
	                                <li class="{{ request()->is('admin/lottery-results*') ? 'active-sub active' : '' }}">
	                                    <a href="{{ route('admin.lottery_results.index') }}">
	                                        <i class="fa fa-braille"></i>
	                                        <span class="menu-title">
	                                            Lottery Results
	                                        </span>
	                                    </a>
	                                </li>
	                                @endcan

	                                <!--Category name-->
	                                <li class="list-header">Reports</li>
	                                
	                                <li class="{{ request()->is('admin/sales/report*') ? 'active-sub active' : '' }}">
	                                    <a href="#}">
	                                        <i class="fa fa-user"></i>
	                                        <span class="menu-title">
	                                            Sales Report
	                                        </span>
	                                    </a>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	                <!--================================-->
	                <!--End menu-->
	            </div>
	        </nav>
            <!--===================================================-->
            <!--END MAIN NAVIGATION-->
        </div>

        <!-- SCROLL PAGE BUTTON -->
        <!--===================================================-->
        <button class="scroll-top btn">
            <i class="pci-chevron chevron-up"></i>
        </button>
        <!--===================================================-->
    </div>
    <!--===================================================-->
    <!-- END OF CONTAINER -->
</body>
</html>