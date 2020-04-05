<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ trans('global.site_title') }}</title>
    <link href="{{ asset('css/adminCss/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet" />
    <link href="{{ asset('css/adminCss/jquery.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/adminCss/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/adminCss/buttons.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/adminCss/select.dataTables.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/adminCss/coreui.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
    <link href="{{ asset('css/adminCss/select2.min.css') }}" rel="stylesheet" />
    <!--link href="{{ asset('css/adminCss/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" /-->
    <link href="{{ asset('css/adminCss/dropzone.min.css') }}" rel="stylesheet" />
	<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.css"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote-bs4.css" rel="stylesheet">
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
	@yield('styles')
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed pace-done sidebar-lg-show">
    <header class="app-header navbar">
        <button class="navbar-toggler sidebar-toggler d-lg-none mr-auto" type="button" data-toggle="sidebar-show">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="{{route('home')}}">
            <span class="navbar-brand-full">Himalayan Frontiers</span>
            <span class="navbar-brand-minimized">HF</span>
        </a>
        <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button" data-toggle="sidebar-lg-show">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!--ul class="nav navbar-nav ml-auto">
            @if(count(config('panel.available_languages', [])) > 1)
                <li class="nav-item dropdown d-md-down-none">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ strtoupper(app()->getLocale()) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        @foreach(config('panel.available_languages') as $langLocale => $langName)
                            <a class="dropdown-item" href="{{ url()->current() }}?change_language={{ $langLocale }}">{{ strtoupper($langLocale) }} ({{ $langName }})</a>
                        @endforeach
                    </div>
                </li>
            @endif
        </ul-->
		<ul class="nav navbar-nav d-md-down-none">
		   <li class="nav-item px-3">
			  <a class="nav-link" href="{{route('dashboard')}}">Dashboard</a>
		   </li>
		   <li class="nav-item px-3">
			  <a class="nav-link" href="{{route('admin.users.index')}}">Users</a>
		   </li>
		   <li class="nav-item px-3">
			  <a class="nav-link" href="{{route('admin.paymentSettings')}}">Settings</a>
		   </li>
		   <li class="nav-item px-3">
			  <!--a class="nav-link text-danger" href="https://coreui.io/#sneak-peek"><strong>Sneak Peek! Try CoreUI PRO 3.0.0-alpha</strong></a-->
		   </li>
		</ul>
		<ul class="nav navbar-nav ml-auto">
		   <li class="nav-item dropdown d-md-down-none">
			  <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			  <i class="fa fa-cart-arrow-down"></i>
			  <span class="badge badge-pill badge-danger">{{$commonServices->newOrders()}}</span>
			  </a>
			  <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
				 <div class="dropdown-header text-center">
					<strong>You have {{$commonServices->newOrders()}} new booking</strong>
				 </div>
				@php 
			    
					$orders = $commonServices->newOrdersAll(); 
				
				@endphp		
				@foreach($orders as $order )
					
					<a class="dropdown-item" href="{{ route('admin.booking.display',[$order['order_id'],$order['notification_id']])}}">
						<div class="message">
							<p>{{ $order['itinerary_name'] }}</p>
						</div>
					</a>
				@endforeach
				 <a class="dropdown-item text-center" href="{{route('admin.booking.index')}}">
				 <strong>View all Bookings</strong>
				 </a>
			  </div>
		   </li>
		   <li class="nav-item dropdown d-md-down-none">
			  <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			  <i class="fa fa-question-circle"></i>
			  <span class="badge badge-pill badge-danger">{{$commonServices->newInqueries()}}</span>
			  </a>
			  <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
				 <div class="dropdown-header text-center">
					<strong>You have {{$commonServices->newInqueries()}} Inqueries</strong>
				 </div>
				@php 
			    
					$inqueries = $commonServices->newInqueriesAll(); 
				
				@endphp		
				@foreach($inqueries as $inquery )
					
					<a class="dropdown-item" href="{{ route('admin.inquery.display',[$inquery['inquery_id'],$inquery['notification_id']])}}">
						<div class="message">
							<p>{{ $inquery['inquery_msg'] }}</p>
						</div>
					</a>
				@endforeach
				 <a class="dropdown-item text-center" href="{{ route("admin.inqueries.index") }}">
				 <strong>View all Inqueries</strong>
				 </a>
			  </div>
		   </li>
		   
		   <li class="nav-item dropdown d-md-down-none">
			  <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			  <i class="fa fa-envelope-o"></i>
			  <span class="badge badge-pill badge-info">{{$commonServices->newContactUs()}}</span>
			  </a>
			  <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg">
				 <div class="dropdown-header text-center">
					<strong>You have {{$commonServices->newContactUs()}} messages</strong>
				 </div>
				@php 
			    
					$contactMessages = $commonServices->newContactMessages(); 
				
				@endphp		
				@foreach($contactMessages as $contact )
					
					<a class="dropdown-item" href="{{ route('admin.contactUs.display',[$contact['contact_id'],$contact['notification_id']])}}">
						<div class="message">
							<p>{{ $contact['contact_msg'] }}</p>
						</div>
					</a>
				@endforeach
				 <a class="dropdown-item text-center" href="{{ route("admin.contact-us.index") }}">
				 <strong>View all messages</strong>
				 </a>
			  </div>
		   </li>
		   <li class="nav-item dropdown">
			  <a class="nav-link nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
			  <img class="img-avatar" src="{{url('storage/images/1577210338.png')}}" alt="admin@bootstrapmaster.com">
			  </a>
			  <div class="dropdown-menu dropdown-menu-right">
				 <div class="dropdown-header text-center">
					<strong>Account</strong>
				 </div>
				 <a class="dropdown-item" href="{{route('admin.profile')}}">
				 <i class="fa fa-user"></i> Profile</a>
				 
				 <div class="dropdown-divider"></div>
				
				 <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
				 <i class="fa fa-lock"></i> Logout</a>
			  </div>
		   </li>
		</ul>
		<button class="navbar-toggler aside-menu-toggler d-md-down-none" type="button" data-toggle="aside-menu-lg-show">
		<span class="navbar-toggler-icon"></span>
		</button>
		<button class="navbar-toggler aside-menu-toggler d-lg-none" type="button" data-toggle="aside-menu-show">
		<span class="navbar-toggler-icon"></span>
		</button>
    </header>

    <div class="app-body">
        @include('partials.menu')
        <main class="main">
			<ol class="breadcrumb">
			   
				@php $link = "" @endphp
				@for($i = 1; $i <= count(Request::segments()); $i++)
					@if (!is_numeric(Request::segment($i)))
						@if($i < count(Request::segments()) & $i > 0)
							
		 
							@php $link .= "/" . Request::segment($i) @endphp
						
							<li class="breadcrumb-item"><a href="<?= $link ?>">{{ ucwords(str_replace('-',' ',Request::segment($i)))}}</a></li>
							@else <li class="breadcrumb-item"> {{ucwords(str_replace('-',' ',Request::segment($i)))}}</li>
							
						@endif
					@endif	
				@endfor
			   
			   <li class="breadcrumb-menu d-md-down-none">
				  <div class="btn-group" role="group" aria-label="Button group">
					 <a class="btn" href="#">
					 <i class="icon-speech"></i>
					 </a>
					 <a class="btn" href="{{route('dashboard')}}">
					 <i class="icon-graph"></i> &nbsp;Dashboard</a>
					 <a class="btn" href="{{route('admin.paymentSettings')}}">
					 <i class="icon-settings"></i> &nbsp;Settings</a>
				  </div>
			   </li>
			</ol>

            <div class="container-fluid">

                @yield('content')

            </div>


        </main>
        <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </div>
    <script src="{{ asset('js/adminJs/jquery.min.js') }}"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('/js/adminJs/popper.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/coreui.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/buttons.print.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/pdfmake.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/vfs_fonts.js') }}"></script>
    <script src="{{ asset('/js/adminJs/jszip.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/ckeditor.js') }}"></script>
    <script src="{{ asset('/js/adminJs/moment.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/select2.full.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/dropzone.min.js') }}"></script>
    <script src="{{ asset('/js/adminJs/summernote-bs4.min.js') }}"></script>
	<script src="{{asset('/js/adminJs/summernote_accordian.js')}}"></script>
    <script src="{{ asset('/js/adminJs/custom.js') }}"></script>
    <link href="{{ asset('css/toster.css') }}" rel="stylesheet">
    <script src="{{ asset('js/toster.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert@2.1.2/dist/sweetalert.min.js"></script>
    @include('notification')

    <script>
        $(function() {
        let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
        let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
        let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
        let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
        let printButtonTrans = '{{ trans('global.datatables.print') }}'
        let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
        let languages = {
            'en': '/js/adminJs/English.json'
        };

        $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, { className: 'btn' })
        $.extend(true, $.fn.dataTable.defaults, {
            language: {
            url: languages.{{ app()->getLocale() }}
            },
            columnDefs: [{
                orderable: false,
                className: 'select-checkbox',
                targets: 0
            }, {
                orderable: false,
                searchable: false,
                targets: -1
            }],
            select: {
            style:    'multi+shift',
            selector: 'td:first-child'
            },
            order: [],
            scrollX: true,
            pageLength: 100,
            dom: 'lBfrtip<"actions">',
            buttons: [
            {
                extend: 'copy',
                className: 'btn-default',
                text: copyButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            },
            {
                extend: 'csv',
                className: 'btn-default',
                text: csvButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            },
            {
                extend: 'excel',
                className: 'btn-default',
                text: excelButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                className: 'btn-default',
                text: pdfButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            },
            {
                extend: 'print',
                className: 'btn-default',
                text: printButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            },
            {
                extend: 'colvis',
                className: 'btn-default',
                text: colvisButtonTrans,
                exportOptions: {
                columns: ':visible'
                }
            }
            ]
        });

        $.fn.dataTable.ext.classes.sPageButton = '';
        });
        $(document).ready(function() {

            $('.summernote').summernote({
				height: 200,
				toolbar: [
					['style', ['bold', 'italic', 'underline', 'clear']],
					['font', ['strikethrough', 'superscript', 'subscript']],
					['fontsize', ['fontsize']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']],
					['insert', ['link', 'picture', 'video']],
					['misc', ['accordion', 'codeview']],
					['height', ['height']],
			],
			
            });

        });

    </script>
    
    @yield('scripts')
</body> 
</html>