<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        {{-- <li class="nav-item d-none d-sm-inline-block">
             <a href="index3.html" class="nav-link">Home</a>
         </li>
         <li class="nav-item d-none d-sm-inline-block">
             <a href="#" class="nav-link">Contact</a>
         </li>--}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
                {{ ucwords(auth()->guard('admin')->user()->name) }}
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="{{ url('admin/profile')  }}" class="dropdown-item">Profile</a></li>
            {{--<li><a href="#" class="dropdown-item">Setting</a></li>--}}
            <!-- Level two dropdown-->
            {{-- <li class="dropdown-submenu dropdown-hover">
                 <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Hover for action</a>
                 <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                     <li>
                         <a tabindex="-1" href="#" class="dropdown-item">level 2</a>
                     </li>

                     <!-- Level three dropdown-->
                     <li class="dropdown-submenu">
                         <a id="dropdownSubMenu3" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">level 2</a>
                         <ul aria-labelledby="dropdownSubMenu3" class="dropdown-menu border-0 shadow">
                             <li><a href="#" class="dropdown-item">3rd level</a></li>
                             <li><a href="#" class="dropdown-item">3rd level</a></li>
                         </ul>
                     </li>
                     <!-- End Level three -->

                     <li><a href="#" class="dropdown-item">level 2</a></li>
                     <li><a href="#" class="dropdown-item">level 2</a></li>
                 </ul>
             </li>--}}
            <!-- End Level two -->
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger"  href="{{ url('admin/logout') }}">
                Logout &nbsp; <i class="fa fa-sign-out-alt"></i>
            </a>
        </li>
        {{--<li class="nav-item">--}}
        {{--<a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">--}}
        {{--<i class="fas fa-th-large"></i>--}}
        {{--</a>--}}
        {{--</li>--}}
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/home') }}" class="brand-link">
        <img src="{{ url('assets/admin') }}/dist/img/banner_logo.jpg" alt="Logo image" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Banner maker </span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            @include('admin.layout.menu')
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>