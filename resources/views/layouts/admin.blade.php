<!DOCTYPE html>
<html @if (app()->getLocale() == 'ar') dir="rtl" @else dir="ltr" @endif data-nav-layout="vertical" data-theme-mode="light" data-header-styles="light"
    data-menu-styles="light" data-toggled="close">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/login/icon.svg') }}">

    <title>{{ trans('panel.site_title') }}</title>
    
    <!-- Choices JS -->
    <script src="{{ asset('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>

    <!-- Main Theme Js -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Bootstrap Css -->
    @if (app()->getLocale() == 'ar')
        <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.rtl.min.css') }}" rel="stylesheet">
    @else
        <link id="style" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    @endif

    <!-- Style Css -->
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{ asset('assets/libs/node-waves/waves.min.css') }}" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@simonwep/pickr/themes/nano.min.css') }}">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{ asset('assets/libs/choices.js/public/assets/styles/choices.min.css') }}">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/@tarekraafat/autocomplete.js/css/autoComplete.css') }}"> 

    <!-- Toastify CSS -->
    <link rel="stylesheet" href="{{ asset('assets/libs/toastify-js/toastify.css') }}">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/datatable.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard_offline/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css">

    @if (app()->getLocale() == 'ar')
        <style>
            @import url(https://fonts.googleapis.com/earlyaccess/droidarabicnaskh.css);
            body{
                font-family: 'Droid Arabic Naskh', serif;
            }
            .main-menu i{
                font-size: 1.2rem;
                padding: 0 0 0 10px;
            }   
        </style>
    @else
        <style>
            .main-menu i{
                font-size: 1.2rem;
                padding: 0 10px 0 0;
            }   
        </style>
    @endif 
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
        form label{
            margin-bottom: .5rem;
        } 
        .ck-editor__editable,
        textarea {
            min-height: 150px;
        }
        .card-header{
            padding: 1rem;
            font-size: 1.0rem;
            font-weight: 400;
        }
        .form-group .required::after {
            content: " *";
            color: red;
        } 
        
    </style>
    @yield('styles')
</head>

<body class="">


    <div class="page">
        @include('partials.header')
        @include('partials.sidebar')

        
        <div class="main-content app-content">
            <div class="container-fluid">
                @if (session('message'))
                    <div class="row mb-2">
                        <div class="col-lg-12">
                            <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                        </div>
                    </div>
                @endif
                @if ($errors->count() > 0)
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif 
                
                <div style="margin-top: .7rem !important;">
                    @yield('content')  
                </div>

            </div>
        </div>
        
        <!-- Start::main-modal -->

        <div class="modal fade" id="header-responsive-search" tabindex="-1" aria-labelledby="header-responsive-search"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0" placeholder="Search Anything ..."
                                aria-label="Search Anything ..." aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End::main-modal -->

    </div>

    <!-- Scroll To Top -->
        <div class="scrollToTop">
            <span class="arrow"><i class="ti ti-arrow-narrow-up fs-20"></i></span>
        </div>
        <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>

    @include('sweetalert::alert')


    <script src="{{ asset('dashboard_offline/js/jquery.min.js') }}"></script> 

    <!-- Popper JS -->
    <script src="{{ asset('assets/libs/@popperjs/core/umd/popper.min.js') }}"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('dashboard_offline/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/dataTables.buttons.min.js') }}"></script> 
    <script src="{{ asset('dashboard_offline/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/dataTables.select.min.js') }}"></script>

    <!-- Defaultmenu JS -->
    <script src="{{ asset('assets/js/defaultmenu.min.js') }}"></script>

    <!-- Node Waves JS-->
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>

    <!-- Sticky JS -->
    <script src="{{ asset('assets/js/sticky.js') }}"></script>

    <!-- Simplebar JS -->
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.js') }}"></script>

    <!-- Auto Complete JS -->
    <script src="{{ asset('assets/libs/@tarekraafat/autocomplete.js/autoComplete.min.js') }}"></script>

    <!-- Color Picker JS -->
    <script src="{{ asset('assets/libs/@simonwep/pickr/pickr.es5.min.js') }}"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>  
    
    <!-- Toastify JS -->
    <script src="{{ asset('assets/libs/toastify-js/toastify.js') }}"></script>
    
    <!-- Toast JS -->
    <script src="{{ asset('assets/libs/toastify-js/toasts.js') }}"></script>

    <!-- Custom-Switcher JS -->
    {{-- <script src="{{ asset('assets/js/custom-switcher.min.js') }}"></script> --}}

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/16.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('dashboard_offline/js/moment.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dashboard_offline/js/dropzone.min.js') }}"></script> 
    <script src="{{ asset('js/map.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://maps.google.com/maps/api/js?key={{ config('app.google_map_key') }}&libraries=places&v=weekly"></script>


    <script>   
        function showAlert(type, title, message, seconds = 3000) {
            let bgColor;
            switch(type) {
                case 'success':
                    bgColor = "#51d28c";
                    break;
                case 'error':
                case 'danger':
                    bgColor = "#f34e4e";
                    break;
                case 'warning':
                    bgColor = "#f7b84b";
                    break;
                case 'info':
                    bgColor = "#299cdb";
                    break;
                default:
                    bgColor = "#51d28c";
            }

            Toastify({
                text: message || title,
                duration: seconds,
                close: true,
                gravity: "top",
                position: "left",
                backgroundColor: bgColor,
                stopOnFocus: true,
                onClick: function(){} // Callback after click
            }).showToast();
        }

        function updateStatuses(el, type, model) {
            if (el.checked) {
                var status = 1;
            } else {
                var status = 0;
            }
            $.post('{{ route('admin.updateStatuses') }}', {
                _token: '{{ csrf_token() }}',
                id: el.value,
                status: status,
                type: type,
                model: model,
            }, function(data) {
                if (data == 1) {
                    showAlert('success', '{{ trans("flash.success") }}', '');
                } else {
                    showAlert('danger', 'Something Went Wrong', '');
                }
            });
        }

    </script>
    <script>
        $(function() {
            let copyButtonTrans = '{{ trans('global.datatables.copy') }}'
            let csvButtonTrans = '{{ trans('global.datatables.csv') }}'
            let excelButtonTrans = '{{ trans('global.datatables.excel') }}'
            let pdfButtonTrans = '{{ trans('global.datatables.pdf') }}'
            let printButtonTrans = '{{ trans('global.datatables.print') }}'
            let colvisButtonTrans = '{{ trans('global.datatables.colvis') }}'
            let selectAllButtonTrans = '{{ trans('global.select_all') }}'
            let selectNoneButtonTrans = '{{ trans('global.deselect_all') }}'

            let languages = {
                'ar': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json',
                'en': 'https://cdn.datatables.net/plug-ins/1.10.19/i18n/English.json'
            };

            $.extend(true, $.fn.dataTable.Buttons.defaults.dom.button, {
                className: 'btn'
            })
            $.extend(true, $.fn.dataTable.defaults, {
                language: {
                    url: languages['{{ app()->getLocale() }}']
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
                    style: 'multi+shift',
                    selector: 'td:first-child'
                },
                order: [],
                scrollX: true,
                pageLength: 100,
                dom: 'lBfrtip<"actions">',
                buttons: [{
                        extend: 'selectAll',
                        className: 'btn-primary-light rounded-pill',
                        text: selectAllButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        },
                        action: function(e, dt) {
                            e.preventDefault()
                            dt.rows().deselect();
                            dt.rows({
                                search: 'applied'
                            }).select();
                        }
                    },
                    {
                        extend: 'selectNone',
                        className: 'btn-primary-light rounded-pill',
                        text: selectNoneButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'copy',
                        className: 'btn-light rounded-pill',
                        text: copyButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'csv',
                        className: 'btn-light rounded-pill',
                        text: csvButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excel',
                        className: 'btn-light rounded-pill',
                        text: excelButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-light rounded-pill',
                        text: pdfButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        className: 'btn-light rounded-pill',
                        text: printButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'colvis',
                        className: 'btn-light rounded-pill',
                        text: colvisButtonTrans,
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
            
            $.fn.dataTable.ext.classes.sPageButton = '';
        });
    </script>
    @yield('scripts')
</body>

</html>
