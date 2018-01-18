<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->

<html lang="{{ app()->getLocale() }}">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />

    <title>@yield('title')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
    <link href="/css/mtr-v4.5.6/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/mtr-v4.5.6/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/mtr-v4.5.6/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/mtr-v4.5.6/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/mtr-v4.5.6/global/plugins/jquery-ui-1.12.1/jquery-ui.css" rel="stylesheet">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="/css/mtr-v4.5.6/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="/css/mtr-v4.5.6/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
    <link href="/css/mtr-v4.5.6/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
    <!-- END THEME GLOBAL STYLES -->

    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="/css/mtr-v4.5.6/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/mtr-v4.5.6/layouts/layout4/css/themes/light.min.css" rel="stylesheet" type="text/css" id="style_color" />
    <link href="/css/mtr-v4.5.6/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
    <link href="/css/custom/style.css" rel="stylesheet" type="text/css" />
    <!-- END THEME LAYOUT STYLES -->

    <link rel="shortcut icon" href="/favicon.ico" />

    <!-- <link href="/rekuest/smo017/custom/custom.css" rel="stylesheet" type="text/css" /> -->
</head>
<!-- END HEAD -->

<body class="page-container-bg-solid page-header-fixed">

<!-- BEGIN HEADER & CONTENT DIVIDER -->
<div class="clearfix"></div>
<!-- END HEADER & CONTENT DIVIDER -->

<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEAD-->
            <div class="page-head">
                <!-- BEGIN PAGE TITLE -->
                <div class="page-title">
                    <h1>@yield('h1')
                        <small>@yield('h2')</small>
                    </h1>
                </div>
                <!-- END PAGE TITLE -->
            </div>
            <!-- END PAGE HEAD-->

        <!-- BEGIN PAGE BASE CONTENT -->
        @yield('content')
        <!-- END PAGE BASE CONTENT -->
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->


<!--[if lt IE 9]>
<script src="/css/mtr-v4.5.6/global/plugins/respond.min.js"></script>
<script src="/css/mtr-v4.5.6/global/plugins/excanvas.min.js"></script>
<![endif]-->

<!-- BEGIN CORE PLUGINS -->
<script src="/css/mtr-v4.5.6/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/jquery-ui-1.12.1/jquery-ui.js"></script>
<!-- END CORE PLUGINS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/css/mtr-v4.5.6/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/counterup/jquery.waypoints.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/counterup/jquery.counterup.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="/css/mtr-v4.5.6/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->

<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="/css/mtr-v4.5.6/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/pages/scripts/components-date-time-pickers.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/tinymce-4.4.3/js/tinymce/tinymce.min.js" type="text/javascript"></script>
<script src="/css/mtr-v4.5.6/global/plugins/tinymce-4.4.3/js/tinymce/jquery.tinymce.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="/css/mtr-v4.5.6/global/plugins/dropzone.js"></script>

<!-- CUSTOM SCRIPT -->
@stack('script')
<!-- END CUSTOM SCRIPT -->

</body>
