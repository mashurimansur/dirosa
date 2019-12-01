<aside id="aside" class="app-aside hidden-xs bg-black">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- user -->
            <div class="clearfix hidden-xs text-center hide" id="aside-user">
                <div class="dropdown wrapper">
                    <a href="app.page.profile">
                        <span class="thumb-lg w-auto-folded avatar m-t-sm">
                            <img src="{{ asset('murobbi') }}/img/a0.jpg" class="img-full" alt="...">
                        </span>
                    </a>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                        <span class="clear">
                            <span class="block m-t-sm">
                                <strong class="font-bold text-lt">John.Smith</strong>
                                <b class="caret"></b>
                            </span>
                            <span class="text-muted text-xs block">Art Director</span>
                        </span>
                    </a>
                    <!-- dropdown -->
                    <ul class="dropdown-menu animated fadeInRight w hidden-folded">
                        <li class="wrapper b-b m-b-sm bg-info m-t-n-xs">
                            <span class="arrow top hidden-folded arrow-info"></span>
                            <div>
                                <p>300mb of 500mb used</p>
                            </div>
                            <div class="progress progress-xs m-b-none dker">
                                <div class="progress-bar bg-white" data-toggle="tooltip"
                                    data-original-title="50%" style="width: 50%"></div>
                            </div>
                        </li>
                        <li>
                            <a href>Settings</a>
                        </li>
                        <li>
                            <a href="page_profile.html">Profile</a>
                        </li>
                        <li>
                            <a href>
                                <span class="badge bg-danger pull-right">3</span>
                                Notifications
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="page_signin.html">Logout</a>
                        </li>
                    </ul>
                    <!-- / dropdown -->
                </div>
                <div class="line dk hidden-folded"></div>
            </div>
            <!-- / user -->

            <!-- nav -->
            <nav ui-nav class="navi clearfix">
                <ul class="nav">
                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span>Navigation</span>
                    </li>
                    <li>
                        <a href="{{ route('front.home') }}">
                            <i class="glyphicon glyphicon-home icon text-primary-dker"></i>
                            <span class="font-bold">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('front.halaqah') }}">
                            <i class="glyphicon glyphicon-envelope icon text-info-lter"></i>
                            <span class="font-bold">Halaqah</span>
                        </a>
                    </li>
                    <li class="line dk"></li>

                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span>Setting</span>
                    </li>
                    <li {{ Request::is('profile*') ? 'class=active' : '' }}>
                        <a href="{{ route('front.profile.edit') }}">
                            <i class="icon-user icon text-success-lter"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li {{  Request::is('tentang*') ? 'class=active' : ''  }}>
                        <a href="{{ route('front.about.index') }}">
                            <i class="icon-question icon"></i>
                            <span>Tentang</span>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- nav -->
        </div>
    </div>
</aside>
