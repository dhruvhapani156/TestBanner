<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
        <a href="{{ url('admin/home') }}" class="nav-link {{ !empty($menu) && $menu=="home"?"active":"" }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>Dashboard</p>
        </a>
    </li>

    <li class="nav-item {{ !empty($menu) && $menu=="festival"?"menu-open ":"" }}">
        <a href="#" class="nav-link {{ !empty($menu) && $menu=="festival"?"active":"" }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Festival
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: {{ !empty($menu) && $menu=="festival"?"block ":"none" }};">
            <li class="nav-item">
                <a href="{{ url('admin/category') }}" class="nav-link {{ !empty($submenu) && $submenu=="category"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Festival Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/image_upload') }}" class="nav-link {{ !empty($submenu) && $submenu=="image_upload"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Festival Image Upload</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/festival_video_upload') }}" class="nav-link {{ !empty($submenu) && $submenu=="festival_video_upload"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Festival Video Upload</p>
                </a>
            </li>

        </ul>
    </li>


    {{--<li class="nav-item {{ !empty($menu) && $menu=="video"?"menu-open ":"" }}">--}}
        {{--<a href="#" class="nav-link {{ !empty($menu) && $menu=="video"?"active":"" }}">--}}
            {{--<i class="nav-icon fas fa-tachometer-alt"></i>--}}
            {{--<p>--}}
                {{--Video--}}
                {{--<i class="right fas fa-angle-left"></i>--}}
            {{--</p>--}}
        {{--</a>--}}
        {{--<ul class="nav nav-treeview" style="display: {{ !empty($menu) && $menu=="video"?"block ":"none" }};">--}}
            {{--<li class="nav-item">--}}
                {{--<a href="{{ url('admin/video_category') }}" class="nav-link {{ !empty($menu) && $menu=="video_category"?"active":"" }}">--}}
                    {{--<i class="fas fa-circle nav-icon"></i>--}}
                    {{--<p>Video Category</p>--}}
                {{--</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a href="{{ url('admin/video_upload') }}" class="nav-link {{ !empty($menu) && $menu=="video_upload"?"active":"" }}">--}}
                    {{--<i class="fas fa-circle nav-icon"></i>--}}
                    {{--<p>Video Upload</p>--}}
                {{--</a>--}}
            {{--</li>--}}
        {{--</ul>--}}
    {{--</li>--}}

    <li class="nav-item {{ !empty($menu) && $menu=="business"?"menu-open ":"" }}">
        <a href="#" class="nav-link {{ !empty($menu) && $menu=="business"?"active":"" }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Business
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: {{ !empty($menu) && $menu=="business"?"block ":"none" }};">
            <li class="nav-item">
                <a href="{{ url('admin/business_category') }}" class="nav-link {{ !empty($submenu) && $submenu=="business_category"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Business Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/business_category_image_upload') }}" class="nav-link {{ !empty($submenu) && $submenu=="business_category_image_upload"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Business Image Upload</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/business_video_upload') }}" class="nav-link {{ !empty($submenu) && $submenu=="business_video_upload"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Business Video Upload</p>
                </a>
            </li>
        </ul>
    </li>


    {{--<li class="nav-item">--}}
        {{--<a href="{{ url('admin/banner_upload') }}" class="nav-link {{ !empty($menu) && $menu=="banner_upload"?"active":"" }}">--}}
            {{--<i class="fas fa-circle nav-icon"></i>--}}
            {{--<p>Banner Upload</p>--}}
        {{--</a>--}}
    {{--</li>--}}

    <li class="nav-item {{ !empty($menu) && $menu=="greeting"?"menu-open ":"" }}">
        <a href="#" class="nav-link {{ !empty($menu) && $menu=="greeting"?"active":"" }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Greeting
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview" style="display: {{ !empty($menu) && $menu=="greeting"?"block ":"none" }};">
            <li class="nav-item">
                <a href="{{ url('admin/greeting_category') }}" class="nav-link {{ !empty($submenu) && $submenu=="greeting_category"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Greeting Category</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('admin/greeting_image') }}" class="nav-link {{ !empty($submenu) && $submenu=="greeting_image"?"active":"" }}">
                    <i class="fas fa-circle nav-icon"></i>
                    <p>Greeting Image</p>
                </a>
            </li>

        </ul>
    </li>



    <li class="nav-item">
        <a href="{{ url('admin/slider') }}" class="nav-link  {{ !empty($menu) && $menu=="slider"?"active":"" }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>Banner Upload</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('admin/business') }}" class="nav-link  {{ !empty($menu) && $menu=="business"?"active":"" }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>Business list</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('admin/feedback') }}" class="nav-link  {{ !empty($menu) && $menu=="feedback"?"active":"" }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>Feedback</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ url('admin/user') }}" class="nav-link  {{ !empty($menu) && $menu=="user"?"active":"" }}">
            <i class="fas fa-circle nav-icon"></i>
            <p>User</p>
        </a>
    </li>
    <li class="nav-item ">
        <a href="{{ url('admin/logout') }}" class="nav-link text-danger" >
            <i class="fas fa-sign-out-alt nav-icon"></i>
            <p>Logout</p>
        </a>
    </li>

</ul>