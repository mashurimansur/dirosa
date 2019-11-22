<aside id="aside" class="app-aside hidden-xs bg-black">
    <div class="aside-wrap">
        <div class="navi-wrap">
            <!-- user -->
            <div class="clearfix hidden-xs text-center hide" id="aside-user">
                <div class="dropdown wrapper">
                    <a href="#">
                        <span class="thumb-lg w-auto-folded avatar m-t-sm">
                            <img src="{{ asset('uploads') }}/{{ Auth::user()->image }}" class="img-full" alt="...">
                        </span>
                    </a>
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle hidden-folded">
                        <span class="clear">
                            <span class="block m-t-sm">
                                <strong class="font-bold text-lt">{{ Auth::user()->name }}</strong>
                            </span>
                        </span>
                    </a>
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
                    <li {{ Request::is('murobbi/dashboard') ? 'class=active' : '' }}>
                        <a href="{{ route('dashboard.index') }}">
                            {{-- <b class="badge bg-info pull-right">9</b> --}}
                            <i class="glyphicon glyphicon-stats icon text-primary-dker"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li {{ Request::is('murobbi/halaqah*') ? 'class=active' : '' }}>
                        <a href="{{ route('halaqah.index') }}">
                            {{-- <b class="badge bg-info pull-right">9</b> --}}
                            <i class="glyphicon glyphicon-home icon text-info-lter"></i>
                            <span>Halaqah</span>
                        </a>
                    </li>
                    <li class="line dk"></li>


                    <li class="hidden-folded padder m-t m-b-sm text-muted text-xs">
                        <span>Setting</span>
                    </li>
                    <li {{ Request::is('murobbi/profile') ? 'class=active' : '' }}>
                        <a href="{{ route('profile.edit') }}">
                            <i class="icon-user icon text-success-lter"></i>
                            {{-- <b class="badge bg-success pull-right">30%</b> --}}
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>
