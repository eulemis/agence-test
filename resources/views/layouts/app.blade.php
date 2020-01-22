<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>{{ config('app.name') }} | Admin Dashboard</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="Preview page of Metronic Admin Theme #1 for statistics, charts, recent events and reports" name="description" />
    <meta content="" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/simple-line-icons/simple-line-icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/morris/morris.css') }}" rel="stylesheet" type="text/css" />
   
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/jqvmap.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/select2/css/select2-bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/css/components-rounded.min.css') }}" rel="stylesheet" id="style_components" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/css/plugins.min.css') }}" rel="stylesheet" type="text/css" />
   
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="{{ asset('assets/metronic_v4.7.5/assets/layouts/layout2/css/layout.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/layouts/layout2/css/themes/default.css') }}" rel="stylesheet" type="text/css" id="style_color" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/layouts/layout2/css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/clockface/css/clockface.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/css.css') }}" rel="stylesheet" type="text/css" />

    <!--link href="{{ asset('assets/css/lightbox.css') }}" rel="stylesheet" type="text/css" /-->
    <!-- END THEME LAYOUT STYLES -->
    <link rel="shortcut icon" href="favicon.ico" /> </head>
    @yield('styles')
    <script>
        var $urlBase        = "{{URL::to('/')}}";
        var $urlImage       = "{{ asset('images/archivos') }}";
        
      
     
    </script>
 <body class="page-header-fixed page-sidebar-closed-hide-logo page-container-bg-solid ">
        <!-- BEGIN HEADER -->
        <div class="page-header navbar navbar-fixed-top">
            <!-- BEGIN HEADER INNER -->
            <div class="page-header-inner ">
                <!-- BEGIN LOGO -->
                    <div class="page-logo" style="background: #f7ffff;">
                    <a href="{{ url('/home') }}">
                        <img src="{{ asset('images/logo.gif') }}" alt="logo" class="logo-default" height="50px;" /> </a>
                        <div class="menu-toggler sidebar-toggler">
                            <span></span>
                        </div>
                    </div>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <!-- BEGIN PAGE ACTIONS -->
                <!-- DOC: Remove "hide" class to enable the page header actions -->
                <div class="page-actions">

                </div>
                <!-- END PAGE ACTIONS -->
                <!-- BEGIN PAGE TOP -->
                <div class="page-top">

                    <!-- BEGIN TOP NAVIGATION MENU -->
                    <div class="top-menu">
                        @include('layouts.partials.top-menu')
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
                <!-- END PAGE TOP -->
            </div>
            <!-- END HEADER INNER -->
        </div>
        <!-- END HEADER -->
        <!-- BEGIN HEADER & CONTENT DIVIDER -->
        <div class="clearfix"> </div>
        <!-- END HEADER & CONTENT DIVIDER -->
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
               @include('layouts.partials.page-sidebar-menu')
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                           @yield('content')
                    <!-- END THEME PANEL -->

                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
            <!-- BEGIN QUICK SIDEBAR -->
            <a href="javascript:;" class="page-quick-sidebar-toggler">
                <i class="icon-login"></i>
            </a>

            </div>
            <!-- END QUICK SIDEBAR -->
        </div>
        <!-- END CONTAINER -->
     @include('layouts.partials.page-footer')

                <!-- END FOOTER -->
            </div>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/respond.min.js') }}"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/excanvas.min.js') }}"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/ie8.fix.min.js') }}"></script>
     
            <!-- BEGIN CORE PLUGINS -->
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/js.cookie.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery.blockui.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}" type="text/javascript"></script>
            <!-- END CORE PLUGINS -->
            <!-- BEGIN PAGE LEVEL PLUGINS -->
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/moment.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/morris/morris.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/morris/raphael-min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/counterup/jquery.waypoints.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/counterup/jquery.counterup.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/amcharts.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/serial.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/pie.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/radar.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/themes/light.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/themes/patterns.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amcharts/themes/chalk.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/ammap/ammap.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/ammap/maps/js/worldLow.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/amcharts/amstockcharts/amstock.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/horizontal-timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/flot/jquery.flot.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/flot/jquery.flot.resize.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/flot/jquery.flot.categories.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery-easypiechart/jquery.easypiechart.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js') }}" type="text/javascript"></script>
           

            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/select2/js/select2.full.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootbox/bootbox.min.js') }}" type="text/javascript"></script>

            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/img-checkbox/imgcb.js') }}" type="text/javascript"></script>

            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/plugins/jquery/jquery.form.min.js') }}"></script>

            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery-validation/js/jquery.validate.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/jquery-validation/js/additional-methods.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/datatables/dataTables.select.min.js') }}" type="text/javascript"></script>

            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/pages/scripts/form-wizard.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}" type="text/javascript"></script>

            <!-- END PAGE LEVEL PLUGINS -->
            <!-- BEGIN THEME GLOBAL SCRIPTS -->
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/scripts/app.min.js') }}" type="text/javascript"></script>
            <!-- END THEME GLOBAL SCRIPTS -->
            <!-- BEGIN PAGE LEVEL SCRIPTS -->
            <script src="{{ asset('assets/metronic_v4.7.5/assets/pages/scripts/dashboard.min.js') }}" type="text/javascript"></script>
            <!-- END PAGE LEVEL SCRIPTS -->
            <!-- BEGIN THEME LAYOUT SCRIPTS -->
            <script src="{{ asset('assets/metronic_v4.7.5/assets/layouts/layout2/scripts/layout.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/layouts/layout2/scripts/demo.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/layouts/global/scripts/quick-sidebar.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/layouts/global/scripts/quick-nav.min.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/metronic_v4.7.5/assets/global/plugins/clockface/js/clockface.js') }}" type="text/javascript"></script>
            <script src="{{ asset('assets/plugins/jquery-loading-overlay/dist/loadingoverlay.min.js') }}" type="text/javascript"></script>
            
            <script src="{{ asset('assets/plugins/highcharts.js') }}" type="text/javascript"></script>
           


            <script type="text/javascript">
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
         </script>


    <script src="{{ asset('assets/js/js.js') }}" type="text/javascript"></script>
    
    @yield('scripts')
    <!-- END THEME LAYOUT SCRIPTS -->
    <script>
        $(document).ready(function()
        {
            $('#clickmewow').click(function()
            {
                $('#radio1003').attr('checked', 'checked');
            });

        })
    </script>

</body>

</html>
