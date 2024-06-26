<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CMS - {{ date('Y') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
    <meta content="Coderthemes" name="author">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/theme_admin/images/favicon.ico">

    <!-- App css -->
    <link href="/theme_admin/css/icons.min.css" rel="stylesheet" type="text/css">
    <link href="/theme_admin/css/app.min.css" rel="stylesheet" type="text/css" id="light-style">
    <link href="/theme_admin/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style">
    <style>
        .form-group {
            margin-bottom: 1rem;
        }
        .form-group label {
            margin-bottom: 5px;
        }
        .hover-focus, .hover-focus .form-check-label {
            cursor: pointer;
        }

        /*.side-nav-second-level {*/
        /*    list-style-type: circle !important;*/
        /*}*/
        /*.side-nav-second-level li::marker {*/
        /*    padding-left: 20px;*/
        /*}*/


    </style>
</head>

<body class="loading"
      data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": true}'>
<!-- Begin page -->
<div class="wrapper">
    <!-- ========== Left Sidebar Start ========== -->
    <div class="leftside-menu">

        <!-- LOGO -->
        <a href="" class="logo text-center logo-light">
            <span class="logo-lg">
                <img src="{{ $settingGlobal->logo ?? 'https://123code.net/images/logo.png' }}" alt="" style="width: 120px;height: 40px">
            </span>
            <span class="logo-sm">
                <img src="{{ $settingGlobal->logo ?? 'https://123code.net/images/logo.png' }}" alt="" height="16">
            </span>
        </a>

        <!-- LOGO -->
        <a href="" class="logo text-center logo-dark">
            <span class="logo-lg">
                <img src="/theme_admin/images/logo-dark.png" alt="" height="16">
            </span>
            <span class="logo-sm">
                <img src="/theme_admin/images/logo_sm_dark.png" alt="" height="16">
            </span>
        </a>

        <div class="h-100" id="leftside-menu-container" data-simplebar="">
            <ul class="side-nav">
                @foreach(config('adm_acl_setting_config.sidebar') as $item)
                    @if(isset($item['submenus']))
                        <a data-bs-toggle="collapse" href="#{{ $item['key'] }}" aria-expanded="false" aria-controls="sidebarEcommerce" class="side-nav-link">
                            <i class="{{ $item['icon-v2'] }}"></i>
                            <span> {{ $item['name'] }} </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="{{ $item['key'] }}">
                            <ul class="side-nav-second-level">
                                @foreach($item['submenus'] as $subMenu)
                                    <li>
                                        <a href="{{ route($subMenu['route']) }}">{{ $subMenu['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <li class="side-nav-item {{  in_array(Request::segment(2), $item['prefix']) ? 'menuitem-active active' : '' }}">
                            <a class="side-nav-link"
                               href="{{ route($item['route']) }}" title="{{ $item['name'] }}">
                                <i class="{{ $item['icon-v2'] ?? $item['icon'] }}"></i>
                                <span>{{ $item['name'] }}</span>
                            </a>
                        </li>
                    @endif
                @endforeach
            </ul>

            <!-- Help Box -->
            <div class="clearfix"></div>

        </div>
        <!-- Sidebar -left -->

    </div>
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">
            <!-- Topbar Start -->
            <div class="navbar-custom">
                <ul class="list-unstyled topbar-menu float-end mb-0">
                    <li class="dropdown notification-list">
                        <a class="nav-link dropdown-toggle nav-user arrow-none me-0" data-bs-toggle="dropdown" href="#"
                           role="button" aria-haspopup="false" aria-expanded="false">
                                <span class="account-user-avatar">
                                    <img src=""
                                         onerror="this.src='/theme_admin/images/preloader.gif';"
                                         alt="user-image"
                                         class="rounded-circle">
                                </span>
                            <span>
                                    <span class="account-user-name">Hi - {{ Auth::user()->name ?? "" }}</span>
                                    <span class="account-position">ACL</span>
                                </span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
                            <!-- item-->
                            <div class=" dropdown-header noti-title">
                                <h6 class="text-overflow m-0">Welcome ! {{ Auth::user()->name ?? "" }}</h6>
                            </div>
                            <!-- item-->
                            <a href="" class="dropdown-item notify-item">
                                <i class="mdi mdi-account-circle me-1"></i>
                                <span>Cập nhật thông tin</span>
                            </a>
                            <!-- item-->
                            <a href="{{ route('get.adm_acl_setting.logout') }}" title="Logout" class="dropdown-item notify-item">
                                <i class="mdi mdi-logout me-1"></i>
                                <span>Đăng xuất</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- end Topbar -->

            <!-- Start Content-->
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12 mt-3">
                        @yield('content')

{{--                        <div class="card mt-3">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="tab-content">--}}
{{--                                    --}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                </div>
                <!-- end page title -->

            </div> <!-- container -->

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <script>document.write(new Date().getFullYear())</script>
                        © phuphan
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-end footer-links d-none d-md-block">
                            <a href="javascript: void(0);">Giới thiệu</a>
                            <a href="javascript: void(0);">Hỗ trợ</a>
                            <a href="javascript: void(0);">Liên hệ</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->


<!-- Right Sidebar -->
<div class="end-bar">

    <div class="rightbar-title">
        <a href="javascript:void(0);" class="end-bar-toggle float-end">
            <i class="dripicons-cross noti-icon"></i>
        </a>
        <h5 class="m-0">Settings</h5>
    </div>

    <div class="rightbar-content h-100" data-simplebar="">

        <div class="p-3">
            <div class="alert alert-warning" role="alert">
                <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
            </div>

            <!-- Settings -->
            <h5 class="mt-3">Color Scheme</h5>
            <hr class="mt-1">

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="light"
                       id="light-mode-check" checked="">
                <label class="form-check-label" for="light-mode-check">Light Mode</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="color-scheme-mode" value="dark"
                       id="dark-mode-check">
                <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
            </div>


            <!-- Width -->
            <h5 class="mt-4">Width</h5>
            <hr class="mt-1">
            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="width" value="fluid" id="fluid-check" checked="">
                <label class="form-check-label" for="fluid-check">Fluid</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="width" value="boxed" id="boxed-check">
                <label class="form-check-label" for="boxed-check">Boxed</label>
            </div>


            <!-- Left Sidebar-->
            <h5 class="mt-4">Left Sidebar</h5>
            <hr class="mt-1">
            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="theme" value="default" id="default-check">
                <label class="form-check-label" for="default-check">Default</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="theme" value="light" id="light-check" checked="">
                <label class="form-check-label" for="light-check">Light</label>
            </div>

            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" name="theme" value="dark" id="dark-check">
                <label class="form-check-label" for="dark-check">Dark</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="compact" value="fixed" id="fixed-check"
                       checked="">
                <label class="form-check-label" for="fixed-check">Fixed</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="compact" value="condensed" id="condensed-check">
                <label class="form-check-label" for="condensed-check">Condensed</label>
            </div>

            <div class="form-check form-switch mb-1">
                <input class="form-check-input" type="checkbox" name="compact" value="scrollable" id="scrollable-check">
                <label class="form-check-label" for="scrollable-check">Scrollable</label>
            </div>

            <div class="d-grid mt-4">
                <button class="btn btn-primary" id="resetBtn">Reset to Default</button>

                <a href="../../product/hyper-responsive-admin-dashboard-template/index.htm" class="btn btn-danger mt-3"
                   target="_blank"><i class="mdi mdi-basket me-1"></i> Purchase Now</a>
            </div>
        </div> <!-- end padding-->

    </div>
</div>

<div class="rightbar-overlay"></div>
<!-- /End-bar -->


<!-- bundle -->
<script src="/theme_admin/js/vendor.min.js"></script>
<script src="/theme_admin/js/app.min.js"></script>
<script>
    var SEO = {
        init : function ()
        {
            this.showFormSeo()
            this.keypressInput()
        },

        showFormSeo()
        {
            $(".js-action-seo").click(function (event){
                event.preventDefault()
                $(".box-seo").toggleClass('hide')
            })
        },

        keypressInput()
        {
            $(".keypress-count").keyup(function (event){
                event.preventDefault()
                let $this = $(this)
                let value = $this.val()
                let elementSlug = $this.attr('data-slug')
                let elementTitleSeo = $this.attr('data-title-seo')
                let elementDescSeo = $this.attr('data-desc-seo')

                let $boxCountChar = $this.prev()
                if($boxCountChar.hasClass('char_counter'))
                {
                    $boxCountChar.find(".current").text(value.length)
                }
                // if(Global.checkUpdateForm() === false)
                // {
                //     $(elementSlug).val(slug)
                //     $(elementTitleSeo).val(value)
                //     $(elementDescSeo).val(value)
                //     $(elementTitleSeo).text(value)
                //     $(elementSlug).text(slug)
                // }
            })
        }
    }

    SEO.init()

</script>
@yield('script')
</body>
</html>