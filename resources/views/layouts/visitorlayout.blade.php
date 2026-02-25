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
<div id="container" class="effect aside-float aside-bright">

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
                    
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Navigation toogle button-->



                    <!--Search-->
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                   
                    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                    <!--End Search-->

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
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8">
                    @yield('pageHead')


            <!--Page content-->
            <!--===================================================-->
                    <div id="page-content">
        
                    @yield('content')
        
                    </div>
                </div>
            <div class="col-sm-2">
            </div>
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
