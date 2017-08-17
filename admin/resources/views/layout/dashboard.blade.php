<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lokapala</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/plugins/iCheck/flat/blue.css') }}">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <link href="{{ asset('css/jquery.fancybox.css') }}" rel='stylesheet' type='text/css'>
    <!-- bootstrap wysihtml5 - text editor -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jquery.toast.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2-bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE-2.3.0/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.fancybox.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.toast.min.js') }}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
     <!-- Scripts -->
    <script>
        var base_web_url = '{{ env('APP_URL') }}';
       
    </script>
</head>
<body class="hold-transition skin-blue sidebar-mini" ng-app="main-App">
<div class="wrapper">
    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
          
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="javascript:void(0)" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    
                    <li class="dropdown user user-menu">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{ asset('AdminLTE-2.3.0/dist/img/avatar5.png') }}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{Auth::user()->email}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{ asset('AdminLTE-2.3.0/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
                                <p>
                                        {{Auth::user()->email }}
                                    
                                </p>
                            </li>
                            <!-- Menu Body -->
                          
                            <!-- Menu Footer-->
                            <li class="user-footer">
                               
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="javascript:void(0)" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ asset('AdminLTE-2.3.0/dist/img/avatar5.png') }}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->email}}</p>
                    <a href="javascript:void(0)"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <ul class="sidebar-menu">
                <li class="header">Lokapala</li>
                <li class=" treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-dashboard"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">                       
                        <li><a href="{{ url('/users') }}"><i class="fa fa-user"></i>User Management</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-book"></i> <span>Reference</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/categories') }}"><i class="fa fa-paper-plane-o"></i>Category</a></li>                       
                        <li><a href="{{ url('/tags') }}"><i class="fa fa-tags"></i>#Tagging</a></li>
                         <li><a href="{{ url('/topics') }}"><i class="fa fa-hourglass-half"></i>Topic</a></li>
                    </ul>
                </li> 
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-picture-o"></i> <span>Images</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/images') }}"><i class="fa fa-file-image-o"></i>Images</a></li>                       
                       
                    </ul>
                </li>
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-newspaper-o"></i> <span>Content Management</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/content') }}"><i class="fa fa-pencil-square-o"></i>Content</a></li>                       
                       
                    </ul>
                </li>  
                <li class="treeview">
                    <a href="javascript:void(0)">
                        <i class="fa fa-wrench"></i> <span>Configuration</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="{{ url('/configuration') }}"><i class="fa fa-wrench"></i>Configuration</a></li>                       
                       
                    </ul>
                </li>        
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                 @yield('content')
               <!--<ng-view></ng-view> -->
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
</footer>
    <div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
 <script src="{{ asset('js/jquery.slug.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
<!-- Angular JS -->
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>  
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-messages.js"></script>
<!-- MY App -->
<script src="{{ asset('app/packages/dirPagination.js') }}"></script>
<script src="{{ asset('app/routes.js') }}"></script>
<script src="{{ asset('app/services/myServices.js') }}"></script>
<script src="{{ asset('app/helper/myHelper.js') }}"></script>
<!-- App Controller -->
<script src="{{ asset('/app/controllers/CmsController.js') }}"></script>

<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{ asset('AdminLTE-2.3.0/plugins/morris/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('AdminLTE-2.3.0/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/knob/jquery.knob.js') }}"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
<script src="{{ asset('AdminLTE-2.3.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('AdminLTE-2.3.0/plugins/fastclick/fastclick.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-2.3.0/dist/js/app.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('AdminLTE-2.3.0/dist/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('AdminLTE-2.3.0/dist/js/demo.js') }}"></script>

</body>
</html>
