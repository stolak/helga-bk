<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('pageTitle')</title>
    <!--STYLESHEET-->
    <!--=================================================-->

    <!--Open Sans Font [ OPTIONAL ]-->
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <!--Nifty Stylesheet [ REQUIRED ]-->
    <link href="{{ asset('assets/css/nifty.min.css')}}" rel="stylesheet">
    <!--Nifty Premium Icon [ DEMONSTRATION ]-->
    <link href="{{ asset('assets/css/demo/nifty-demo-icons.min.css')}}" rel="stylesheet">
    <!--=================================================-->
    <!--Pace - Page Load Progress Par [OPTIONAL]-->
    <link href="{{ asset('assets/plugins/pace/pace.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <script src="{{ asset('assets/plugins/pace/pace.min.js')}}"></script>
<script> var murl = "{{ url('/')}}"; </script>

    <!--Demo [ DEMONSTRATION ]-->
    <link href="{{ asset('assets/css/demo/nifty-demo.min.css')}}" rel="stylesheet">
 @yield('styles')
<style>
.navbar-content
{
box-shadow: 0 6px 4px -2px #26ae61;
}
</style>
<style type="text/css" media="print">
#content-container, #pagecontent
{
width:100%;
padding:0px !important;
margin:0px !important;
}
#.panel, .panel-body, #mainnav-container, #mainnav, #container.mainnav-lg #content-container, #content-content
{

padding:0px;
margin:0px;
}
</style
</head>

<!--TIPS-->
<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->
<body>
<div id="container" class="effect aside-float aside-bright mainnav-lg">

    <!--NAVBAR-->
    <!--===================================================-->
    <header id="navbar" class="hidden-print">
        <div id="navbar-container" class="boxed" style="background: #04a95d;">

            <!--Brand logo & name-->
            <!--================================-->
            <div class="navbar-header" style="background: #04a95d;">
                <a href="{{url('/')}}" class="navbar-brand" style="background: #04a95d;">
                    <!--<img src="img/logo.png" alt="Nifty Logo" class="brand-icon">-->
                    <div class="brand-title">
                        <span class="brand-text text-center">CRM</span>
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



                    <!--Search-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li>
                        <div class="custom-search-form">
                            <label class="btn btn-trans" for="search-input" data-toggle="collapse" data-target="#nav-searchbox">
                                <i class="demo-pli-magnifi-glass"></i>
                            </label>
                            <form>
                                <div class="search-container collapse" id="nav-searchbox">
                                    <input id="search-input" type="text" class="form-control" placeholder="Type for search...">
                                </div>
                            </form>
                        </div>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Search-->

                </ul>
                <ul class="nav navbar-top-links">
                    <li class="dropdown">
                     <a href="#" class="mega-dropdown-toggle">
                       Welcome <strong>{{strtoupper(Auth::user()->name)}}</strong>
                       </a>
                    </li>

                    <!--Mega dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <li class="mega-dropdown">
                        <a href="#" class="mega-dropdown-toggle">
                            <i class="demo-pli-layout-grid"></i>
                        </a>

                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End mega dropdown-->



                    <!--Notification dropdown-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                            <i class="demo-pli-bell"></i>
                            <span class="badge badge-header badge-danger"></span>
                        </a>


                        <!--Notification dropdown menu-->
                        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">


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
                                    <a href="{{url('create-user')}}"><i class="demo-pli-unlock icon-lg icon-fw"></i>Create User</a>
                                </li>
                                <li>
                                    <a href="{{url('logout')}}"><i class="demo-pli-unlock icon-lg icon-fw"></i> Logout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End user dropdown-->


                    <!--<li>
                        <a href="#" class="aside-toggle">
                            <i class="demo-pli-dot-vertical"></i>
                        </a>
                    </li>-->
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
           @yield('pageHead')


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
        <aside id="aside-container hidden-print">
            <div id="aside">
                <div class="nano">
                    <div class="nano-content">

                    </div>
                </div>
            </div>
        </aside>
        <!--===================================================-->
        <!--END ASIDE-->


        <!--MAIN NAVIGATION-->
        <!--===================================================-->
        <nav id="mainnav-container" class="hidden-print">
            <div id="mainnav" >


                <!--OPTIONAL : ADD YOUR LOGO TO THE NAVIGATION-->
                <!--It will only appear on small screen devices.-->
                <!--================================
                <div class="mainnav-brand">
                    <a href="{{url('/')}}" class="brand">
                        <img src="img/logo.png" alt="Nifty Logo" class="brand-icon">
                        <span class="brand-text">NJC</span>
                    </a>
                    <a href="#" class="mainnav-toggle"><i class="pci-cross pci-circle icon-lg"></i></a>
                </div>
                -->



                <!--Menu-->
                <!--================================-->
                <div id="mainnav-menu-wrap">
                    <div class="nano">
                        <div class="nano-content">

                            <!--Profile Widget-->
                            <!--================================-->
                            <div id="mainnav-profile" class="mainnav-profile">
                                <div class="profile-wrap text-center">
                                    <a href="#profile-nav" class="box-block" data-toggle="collapse" aria-expanded="false">
                                            <span class="pull-right dropdown-toggle">
                                                <i class="dropdown-caret"></i>
                                            </span>
                                        <p class="mnp-name">CRM</p>
                                        <!--<span class="mnp-desc">performance.evaluation@njc.gov.ng</span>-->
                                    </a>
                                </div>
                                <div id="profile-nav" class="collapse list-group bg-trans">
                                    <!--<a href="#" class="list-group-item">
                                        <i class="demo-pli-male icon-lg icon-fw"></i> View Profile
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="demo-pli-gear icon-lg icon-fw"></i> Settings
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <i class="demo-pli-information icon-lg icon-fw"></i> Help
                                    </a>-->
                                    <a href="{{url('logout')}}" class="list-group-item">
                                        <i class="demo-pli-unlock icon-lg icon-fw"></i> Logout
                                    </a>
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

                         <!-- Sidebar -->
                         <ul id="mainnav-menu" class="list-group">
                            @include('layouts.sidemenu')
                            @include('layouts.techsidemenu')
                           </ul>
                         <!-- End sidebar -->


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



    <!-- FOOTER -->
    <!--===================================================-->
    <!--<footer id="footer"></footer>-->

        <!-- Visible when footer positions are fixed -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        



        <!-- Visible when footer positions are static -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <div class="hide-fixed pull-right pad-rgt hidden-print">
            All rights Reserve - <strong>Stolak SoFtech</strong>
        </div>



        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
        <!-- Remove the class "show-fixed" and "hide-fixed" to make the content always appears. -->
        <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

        <p class="pad-lft hidden-print">&#0169; 2018 Your Company</p>



    
    <!--===================================================-->
    <!-- END FOOTER -->


    <!-- SCROLL PAGE BUTTON -->
    <!--===================================================-->
    <button class="scroll-top btn hidden-print">
        <i class="pci-chevron chevron-up"></i>
    </button>
    <!--===================================================-->
</div>
<!--===================================================-->
<!-- END OF CONTAINER -->





<!--JAVASCRIPT-->
<!--=================================================-->

<!--jQuery [ REQUIRED ]-->
<script src="{{ asset('assets/js/jquery.min.js')}}"></script>

<!--BootstrapJS [ RECOMMENDED ]-->
<script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>

<!--NiftyJS [ RECOMMENDED ]-->
<script src="{{ asset('assets/js/nifty.min.js')}}"></script>

<!--=================================================-->

<!--Flot Chart [ OPTIONAL ]-->
<script src="{{ asset('assets/plugins/flot-charts/jquery.flot.min.js')}}"></script>
<script src="{{ asset('assets/plugins/flot-charts/jquery.flot.resize.min.js')}}"></script>
<script src="{{ asset('assets/plugins/flot-charts/jquery.flot.tooltip.min.js')}}"></script>

<!--Sparkline [ OPTIONAL ]-->
<script src="{{ asset('assets/plugins/sparkline/jquery.sparkline.min.js')}}"></script>

<!--Specify page [ SAMPLE ]-->
<script src="{{ asset('assets/js/demo/dashboard.js')}}"></script>
@yield('scripts')



</body>

</html>
