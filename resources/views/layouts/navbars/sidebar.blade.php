<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('logo.png') }}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                        <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Settings') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Activity') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Support') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Dashboard') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fa fa-user-secret" style="color: #f4645f;"></i>
                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Admin Area') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                           <!--  <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('User profile') }}
                                </a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">
                                    {{ __('User Management') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{route('category.index')}}">
                        <i class="ni ni-box-2 text-blue"></i> {{ __('Category') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('subCategory.index')}}">
                        <i class="ni ni-books text-orange"></i> {{ __('Sub Category') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('buyer.index')}}">
                        <i class="ni ni-circle-08 text-red"></i> {{ __('Buyer') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('vendor.index')}}">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Vendor') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('coupon.index')}}">
                        <i class="fa fa-tag text-yellow"></i> {{ __('Coupon') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{route('apiKey.index')}}">
                        <i class="fa fa-key text-black"></i> {{ __('API Key') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('blog.index')}}">
                        <i class="fa fa-rss-square text-green"></i> {{ __('Blog') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{route('privacyAndPolicy.index')}}">
                        <i class="fa fa-snowflake text-cyan"></i> {{ __('Privacy And Policy') }}
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{route('termAndCondition.index')}}">
                        <i class="fa fa-gavel text-purple"></i> {{ __('Term And Condition') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="#navbar-report" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-report">
                        <i class="fa fa-print" style="color: #f4645f;"></i>

                        <span class="nav-link-text" style="color: #f4645f;">{{ __('Reports') }}</span>
                    </a>

                    <div class="collapse show" id="navbar-report">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('vendorsReport.index') }}">
                                    {{ __('Vendor Leader Board') }}
                                </a>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('awufulReferralVendorsReport.index') }}">
                                    {{ __('Awuful Referral Vendor Report') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('buyersReport.index') }}">
                                    {{ __('Buyer Leader Board') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('awufulReferralBuyersReport.index') }}">
                                    {{ __('Awuful Referral Buyer Report') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('blogsReport.index') }}">
                                    {{ __('Blog Report') }}
                                </a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('salesReport.index') }}">
                                    {{ __('Sales Report') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-planet text-blue"></i> {{ __('Icons') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-pin-3 text-orange"></i> {{ __('Maps') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-key-25 text-info"></i> {{ __('Login') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="ni ni-circle-08 text-pink"></i> {{ __('Register') }}
                    </a>
                </li>
                <li class="nav-item mb-5 bg-danger" style="position: absolute; bottom: 0;">
                    <a class="nav-link text-white" href="https://www.creative-tim.com/product/argon-dashboard-pro-laravel" target="_blank">
                        <i class="ni ni-cloud-download-95"></i> Upgrade to PRO
                    </a>
                </li> -->
            </ul>
           
        </div>
    </div>
</nav>