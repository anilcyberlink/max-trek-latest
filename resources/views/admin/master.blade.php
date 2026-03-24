<!DOCTYPE html>
<html>

<head>
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <title> {{ config('app.name', '') }} - @yield('title') </title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="Cyberlink">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="<?= url('/') ?>" />
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans:300,400,600'>
    @yield('additional-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/skin/default_skin/css/theme3.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin-tools/admin-forms/css/admin-forms.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Favicon -->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/skin/default_skin/css/bootstrap3-wysihtml5.min.css') }}">
    <link rel="shortcut icon" href="{{asset('themes-assets/images/favicon.png')}}">
    <script src="{{ asset('js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{ asset('tinymce/init-tinymce.js')}}"></script>


    <style>
        span.panel-controls {
            display: none;
        }

        .tox-editor-container .tox-promotion {
            visibility: hidden !important;
        }
    </style>


</head>

<body class="dashboard-page sb-l-o sb-r-c">
    <!-- Start: Main -->
    <div id="main">
        <!-- Start: Header -->
        <header class="navbar navbar-fixed-top">
            @if($setting)
                <div class="navbar-branding">
                    <a class="navbar-brand" href="{{ url('/') }}" target="_blank">
                        @if ($setting->logo)
                            <img src="{{ asset('uploads/original/' . $setting->logo) }}" alt="{{ config('app.name') }}"
                                width="110" />
                        @else
                            <h3 class="uk-margin-remove">{{$setting->site_name}}</h3>
                        @endif
                    </a>
                    <span id="toggle_sidemenu_l" class="ad ad-lines"></span>
                </div>
            @endif
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="avoid:javascript;" class="dropdown-toggle fw600 p15" data-toggle="dropdown"> <img src="{{ asset(env('PUBLIC_PATH') . 'assets/img/avatars/1.png') }}" alt="avatar" class="mw30 br64 mr15">{{ Auth::user()->name }}<span class="caret caret-tp hidden-xs"></span></a>
                    <ul class="dropdown-menu list-group dropdown-persist w250" role="menu">
                        <!--<li><a class="nav-link" href="{{ route('admin.userprofile') }}">User Profile</a></li> -->
                        <!--<li><a class="nav-link" href="{{ route('admin.changepassword') }}">Change Password </a></li> -->
                        @guest
                            <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="dropdown-footer">
                                <a class="animated animated-short fadeInUp" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span
                                        class="fa fa-power-off pr5"></span>{{ __('Logout') }}</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endguest
                    </ul>
                </li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </header>

        <!-- Start: Sidebar Left -->
        <aside id="sidebar_left" class="nano nano-primary affix">
            <!-- Start: Sidebar Left Content -->
            <div class="sidebar-left-content nano-content">
                <!-- Start: Sidebar Left Menu -->
                <ul class="nav sidebar-menu">
                    <li class="sidebar-label pt15"> Menu </li>
                    <li class="{{ (Request::segment(2) == 'dashboard') ? 'active' : '' }}">
                        <a href="{{ url('admin/dashboard') }}">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="sidebar-title">Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ (Request::segment(2) == 'banner') ? 'active' : '' }}">
                        <a href="{{ url('admin/partner') }}">
                            <span class="fa fa-picture-o "></span>
                            <span class="sidebar-title"> Manage Partners </span>
                        </a>
                    </li>
                    <li class="">
                        @if(Request::segment(2) == 'posttype' || Request::segment(2) == 'postcategory' || Request::segment(2) == 'company' || Request::segment(2) == 'terms-and-polices' || Request::segment(2) == 'festive-celerbations' || Request::segment(2) == 'local-experiences' || Request::segment(2) == 'contact-now' || Request::segment(2) == 'about'|| Request::segment(3) == 'about' || Request::segment(2) == 'team' || Request::segment(3) == 'team'|| Request::segment(2) == 'faq'|| Request::segment(2) == 'blog'|| Request::segment(2) == 'legal-document'|| Request::segment(2) == 'why-us')
                            <a class="accordion-toggle menu-open">
                        @else
                            <a class="accordion-toggle">
                        @endif
                            <span class="fa fa-archive "></span>
                            <span class="sidebar-title"> Manage Posts </span>
                            <span class="caret"></span>
                        </a>
                        <ul class="nav sub-nav">
                            <li class="{{ (Request::segment(2) == 'posttype') ? 'active' : '' }}">
                                <a href="{{ url('type/posttype') }}">
                                    <span class="fa fa-arrows"></span>
                                    Post Types
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ url('admin/postcategory') }}">
                                    <span class="fa fa-arrows"></span>
                                    Post Categories
                                </a>
                            </li> -->
                            <!-- Post Type List -->
                            @if($posttype)
                                @foreach($posttype as $row)
                                    <li class="{{ (Request::segment(2) == $row->uri) ? 'active' : '' }}">
                                        @if(has_posts($row->id))
                                            <a href="{{ url('admin/' . $row->uri)}}">
                                        @else
                                                <a href="{{ url('type/posttype/' . $row->id . '/edit') }}">
                                            @endif
                                                <span class="fa fa fa-arrows-h"></span>
                                                {{$row->post_type}}
                                            </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </li>

                    <!-- <li class="">
                        @if(Request::segment(2) == 'pagetype' || Request::segment(2) == 'terms-and-conditions' || Request::segment(2) == 'gear-list' || Request::segment(2) == 'travel-insurane' || Request::segment(2) == 'embassies-and-consulates' || Request::segment(2) == 'expedition-permit-fees' || Request::segment(2) == 'visa-fee' || Request::segment(2) == 'faq')
                            <a class="accordion-toggle menu-open">
                        @else
                                <a class="accordion-toggle">
                            @endif
                                <span class="fa fa-folder-open"></span>
                                <span class="sidebar-title"> Manage Pages </span>
                                <span class="caret"></span>
                            </a>
                            <ul class="nav sub-nav">
                                <li class="{{ (Request::segment(2) == 'pagetype') ? 'active' : '' }}">
                                    <a href="{{ url('admin/pagetype') }}">
                                        <span class="fa fa-arrows"></span>
                                        Page Types
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/pagecategory') }}">
                                    <span class="fa fa-arrows"></span>
                                    Page Categories                
                                    </a>                
                                </li> 
                                @if($pagetype)
                                    @foreach($pagetype as $row)
                                        <li class="{{ (Request::segment(2) == $row->uri) ? 'active' : '' }}">
                                            <a href="{{ url('adminpages/' . $row->uri)}}">
                                                <span class="">></span>
                                                {{$row->page_type}}
                                            </a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                    </li> -->

                    <li class="">
                        @if(Request::segment(2) == 'expedition' || Request::segment(2) == 'tour-trip' || Request::segment(2) == 'region' || Request::segment(2) == 'tripgrade' || Request::segment(2) == 'trip-region' || Request::segment(2) == 'activity' || Request::segment(2) == 'trip' || Request::segment(2) == 'tripgroup' || Request::segment(2) == 'banner-trip')
                            <a class="accordion-toggle menu-open">
                        @else
                                <a class="accordion-toggle">
                            @endif
                                <span class="fa fa-map-marker "></span>
                                <span class="sidebar-title"> Manage Trips</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="nav sub-nav">
                                <li
                                    class="{{ (Request::segment(2) == 'expedition' || Request::segment(2) == 'tour-trip') ? 'active' : '' }}">
                                    <a href="{{ route('expedition.index') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        Expeditions
                                    </a>
                                </li>
                                {{--<li class="{{ (Request::segment(2) == 'tripgroup')?'active':'' }}">
                                    <a href="{{ route('tripgroup.index') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        Trip Group
                                    </a>
                                </li> --}}
                                <li class="{{ (Request::segment(2) == 'tripgrade') ? 'active' : '' }}">
                                    <a href="{{ route('tripgrade.index') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        Trip Grade
                                    </a>
                                </li>
                                <li
                                    class="{{ (Request::segment(2) == 'region' || Request::segment(2) == 'trip-region') ? 'active' : '' }}">
                                    <a href="{{ url('admin/region') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        <span class="sidebar-title"> Trekking Regions </span>
                                    </a>
                                </li>

                                {{-- <li class="{{ (Request::segment(2) == 'activity')?'active':'' }}">
                                    <a href="{{ url('admin/activity') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        <span class="sidebar-title"> Trip Categories </span>
                                    </a>
                                </li> --}}
                                <li class="{{ (Request::segment(2) == 'banner-trip') ? 'active' : '' }}">
                                    <a href="{{ url('admin/banner-trip') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        <span class="sidebar-title"> Banner Trips </span>
                                    </a>
                                </li>
                                <li class="{{ (Request::segment(2) == 'trip') ? 'active' : '' }}">
                                    <a href="{{ url('admin/trip') }}">
                                        <span class="fa fa fa-arrows-h"></span>
                                        <span class="sidebar-title"> Trip List </span>
                                    </a>
                                </li>
                            </ul>
                    </li>
                    <!-- <li class="{{ (Request::segment(1) == 'admin-travel-guide-index'||Request::segment(1) == 'admin-travel-guide'||Request::segment(1) == 'admin-travel-guide-edit')?'active':'' }}">
                        <a href="{{ route('travel_guide_index') }}">
                            <span class="fa fa-book"></span>
                            <span class="sidebar-title">Travel Guide </span>
                        </a>
                    </li> -->
                    <li class="{{ (Request::segment(1) == 'admin-trip-review') ? 'active' : '' }}">

                        <a href="{{ route('trip-review') }}">
                            <span class="fa fa-dot-circle-o "></span>
                            <span class="sidebar-title">Manage Review</span>
                        </a>
                    </li>
                    {{-- <li class="{{ (Request::segment(2) == 'teams')?'active':'' }}">
                        <a href="{{ url('admin/teams') }}">
                            <span class="fa fa fa-user"></span>
                            <span class="sidebar-title"> Manage Team </span>
                        </a>
                    </li> --}}


                    <!--  <li class="">-->
                    <!--   @if(Request::segment(1) == 'newsletter-create' || Request::segment(1) == 'subscriber-create'|| Request::segment(1) == 'send-newsletter'|| Request::segment(1) == 'subscriber-index'|| Request::segment(1) == 'subscriber-edit'|| Request::segment(1) == 'newsletter-index'|| Request::segment(1) == 'newsletter-edit')-->
                    <!--    <a class="accordion-toggle menu-open">-->
                    <!--    @else-->
                    <!--     <a class="accordion-toggle">-->
                    <!--             @endif -->
                    <!--        <span class="glyphicon glyphicon-user"></span>-->
                    <!--        <span class="sidebar-title"> Manage Newsletter </span>-->
                    <!--        <span class="caret"></span>-->
                    <!--    </a>-->
                    <!--    <ul class="nav sub-nav">-->
                    <!--       <li class="{{ (Request::segment(1) == 'newsletter-create'|| Request::segment(1) == 'newsletter-index'|| Request::segment(1) == 'newsletter-edit')?'active':'' }}">-->
                    <!--            <a href="{{ route('newsletter.index') }}">-->
                    <!--                <span class="fa fa fa-arrows-h"></span>-->
                    <!--                Newsletters-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--        <li class="{{ (Request::segment(1) == 'subscriber-create'|| Request::segment(1) == 'subscriber-index'|| Request::segment(1) == 'subscriber-edit')?'active':'' }}">-->
                    <!--            <a href="{{ route('subscriber.index') }}">-->
                    <!--                <span class="fa fa fa-arrows-h"></span>-->
                    <!--               Subscribers-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--         <li class="{{ (Request::segment(1) == 'send-newsletter')?'active':'' }}">-->
                    <!--            <a href="{{ route('send.newsletter') }}">-->
                    <!--                <span class="fa fa fa-arrows-h"></span>-->
                    <!--               Send Newsletter-->
                    <!--            </a>-->
                    <!--        </li>-->
                    <!--    </ul>-->
                    <!--</li>                 -->
                    <li class="">
                        @if(Request::segment(1) == 'contact-us' || Request::segment(1) == 'admin-trip-booking' || Request::segment(1) == 'category-inquiry' || Request::segment(1) == 'tailor-made' || Request::segment(1) == 'trip-inquiry' || Request::segment(1) == 'trip-customize')
                            <a class="accordion-toggle menu-open">
                        @else
                                <a class="accordion-toggle">
                            @endif
                                <span class="fa fa-map-marker "></span>
                                <span class="sidebar-title"> Booking & Inquiries</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="nav sub-nav">
                                {{--
                                <li class="{{ (Request::segment(1) == 'contact-us')?'active':'' }}">

                                    <a href="{{ url('contact-us') }}">
                                        <span class="fa fa-dot-circle-o "></span>
                                        <span class="sidebar-title">Contact Us</span>
                                    </a>
                                </li> --}}

                                <li class="{{ (Request::segment(1) == 'admin-trip-booking') ? 'active' : '' }}">
                                    <a href="{{ route('trip-booking') }}">
                                        <span class="fa fa-ticket "></span>
                                        <span class="sidebar-title">Trip Booking</span>
                                    </a>
                                </li>
                                {{-- <li class="{{ (Request::segment(1) == 'category-inquiry')?'active':'' }}">
                                    <a href="{{ url('category-inquiry') }}">
                                        <span class="fa fa-ticket "></span>
                                        <span class="sidebar-title">Category Inquiry</span>
                                    </a>
                                </li> --}}
                                <li class="{{ (Request::segment(1) == 'trip-inquiry') ? 'active' : '' }}">
                                    <a href="{{ url('trip-inquiry') }}">
                                        <span class="fa fa-ticket "></span>
                                        <span class="sidebar-title">Trip Inquiry</span>
                                    </a>
                                </li>
                            </ul>
                    </li>
                    <li class="{{ (Request::segment(2) == 'settings') ? 'active' : '' }}">
                        <a href="{{ url('admin/settings') }}">
                            <span class="fa fa-cog "></span>
                            <span class="sidebar-title"> Settings </span>
                        </a>
                    </li>
            </div>
        </aside>

        <section id="content_wrapper">
            <!-- End: Topbar-Dropdown -->
            <header id="topbar">
                <div class="topbar-left">
                    <ol class="breadcrumb">
                        <li class="crumb-icon">
                            <a href="{{ url('dashboard') }}">
                                <span class="glyphicon glyphicon-home"></span>
                            </a>
                        </li>
                    </ol>
                </div>

                <div class="topbar-right">
                    @yield('breadcrumb')
                </div>
            </header>

            <!-- Begin: Content -->
            <section id="content" class="animated fadeIn">
                <!-- Admin-panels -->
                <div class="admin-panels fade-onload">
                    <div class="row">
                        <div class="container">
                            @include('admin.common.message')
                            @yield('content')
                        </div>
                    </div>
                </div>

                <!-- Begin: Page Footer -->
                <?php /* ?>
                <footer id="content-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="footer-legal">&copy; <?php echo date('Y'); ?> Cyberlink Pvt. Ltd. </span>
                        </div>
                        <div class="col-md-6 text-right">
                            <span class="footer-meta"></span>
                            <a href="#content" class="footer-return-top">
                                <span class="fa fa-arrow-up"></span>
                            </a>
                        </div>
                    </div>
                </footer>
                <?php */?>
                <!-- End: Page Footer -->
            </section>
        </section>
        <!-- End: Content-Wrapper -->

        <!-- Start: Right Sidebar -->
    </div>
    <!-- End: Main -->

    <!-- BEGIN: PAGE SCRIPTS -->

    <!-- jQuery -->
    <script src="{{ asset('vendor/jquery/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery_ui/jquery-ui.min.js') }}"></script>

    <!-- HighCharts Plugin -->
    <script src="{{ asset('vendor/plugins/highcharts/highcharts.js') }}"></script>

    <!-- Sparklines Plugin -->
    <script src="{{ asset('vendor/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <script>
        $('.textarea').wysihtml5({
            toolbar: {
                "fa": true,
                "font-styles": false,
                "emphasis": true,
                "lists": true,
                "html": false,
                "link": true,
                "image": false,
                "color": false,
                "blockquote": true
            }
        });
    </script>
    <!-- Simple Circles Plugin -->
    <script src="{{ asset('vendor/plugins/circles/circles.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.5/angular.min.js"></script>
    <!-- JvectorMap Plugin + US Map (more maps in plugin/assets folder) -->
    <script src="{{ asset('vendor/plugins/jvectormap/jquery.jvectormap.min.js') }}"></script>
    <script src="{{ asset('vendor/plugins/jvectormap/assets/jquery-jvectormap-us-lcc-en.js') }}"></script>
    @yield('libraries')
    <!-- Theme Javascript -->
    <script src="{{ asset('assets/js/utility/utility.js') }}"></script>
    <script src="{{ asset('assets/js/demo/demo.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Widget Javascript -->
    <script src="{{ asset('assets/js/demo/widgets.js') }}"></script>

    @yield('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--<script src="https://cdn.tiny.cloud/1/g3e9kv831pbj6lpanxhz2q43uw9ut5demo6pmdtv3nycypny/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>-->
    <!--<script src="{{ asset('tinymce/init-tinymce.js') }}"></script>-->
    <script>
        $(document).ready(function () {
            $(".category-search").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".category-list li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });


        $(document).ready(function () {
            $(".category-search1").on("keyup", function () {
                var value = $(this).val().toLowerCase();
                $(".category-list1 li").filter(function () {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <script type="text/javascript">
        jQuery(document).ready(function () {

            "use strict";

            // Init Theme Core
            Core.init();

            // Init Demo JS
            //Demo.init();

            // Init Widget Demo JS
            // demoHighCharts.init();

            // Because we are using Admin Panels we use the OnFinish
            // callback to activate the demoWidgets. It's smoother if
            // we let the panels be moved and organized before
            // filling them with content from various plugins

            // Init plugins used on this page
            // HighCharts, JvectorMap, Admin Panels

            // Init Admin Panels on widgets inside the ".admin-panels" container
            $('.admin-panels').adminpanel({
                grid: '.admin-grid',
                draggable: true,
                preserveGrid: true,
                mobile: false,
                onStart: function () {
                    // Do something before AdminPanels runs
                },
                onFinish: function () {
                    $('.admin-panels').addClass('animated fadeIn').removeClass('fade-onload');

                    // Init the rest of the plugins now that the panels
                    // have had a chance to be moved and organized.
                    // It's less taxing to organize empty panels
                    demoHighCharts.init();
                    runVectorMaps(); // function below
                },
                onSave: function () {
                    $(window).trigger('resize');
                }
            });
        });

        // Date picker for tender form
        $(function () {
            $("#datepicker1").datepicker({
                dateFormat: 'dd-mm-yy'
            });
            $("#datepicker2").datepicker({
                dateFormat: 'dd-mm-yy'
            });
        });
    </script>
    <!-- END: PAGE SCRIPTS -->
</body>

</html>