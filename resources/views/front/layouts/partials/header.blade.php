<header id="header" class="app-header navbar" role="menu">
    <!-- navbar header -->
    <div class="navbar-header bg-black">
        <button class="pull-right visible-xs dk" ui-toggle-class="show" target=".navbar-collapse">
            <i class="glyphicon glyphicon-cog"></i>
        </button>
        <button class="pull-right visible-xs" ui-toggle-class="off-screen" target=".app-aside" ui-scroll="app">
            <i class="glyphicon glyphicon-align-justify"></i>
        </button>
        <!-- brand -->
        <a href="{{ route('front.home') }}" class="navbar-brand text-lt">
            {{-- <i class="fa fa-btc"></i> --}}
            {{-- <img src="{{ asset('uploads') }}/icons/808358.png" alt="."> --}}
            <span class="hidden-folded m-l-xs">Dirosa</span>
        </a>
        <!-- / brand -->
    </div>
    <!-- / navbar header -->

    <!-- navbar collapse -->
    <div class="collapse pos-rlt navbar-collapse box-shadow bg-white-only">
        <!-- buttons -->
        <div class="nav navbar-nav hidden-xs">
            <a href="#" class="btn no-shadow navbar-btn" ui-toggle-class="app-aside-folded" target=".app">
                <i class="fa fa-dedent fa-fw text"></i>
                <i class="fa fa-indent fa-fw text-active"></i>
            </a>
            {{-- <a href="#" class="btn no-shadow navbar-btn" ui-toggle-class="show" target="#aside-user">
                <i class="icon-user fa-fw"></i>
            </a> --}}
        </div>
        <!-- / buttons -->

        <!-- search form -->
        {{-- <form class="navbar-form navbar-form-sm navbar-left shift" ui-shift="prependTo"
            data-target=".navbar-collapse" role="search" ng-controller="TypeaheadDemoCtrl">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" ng-model="selected"
                        typeahead="state for state in states | filter:$viewValue | limitTo:8"
                        class="form-control input-sm bg-light no-border rounded padder"
                        placeholder="Search projects...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-sm bg-light rounded"><i
                                class="fa fa-search"></i></button>
                    </span>
                </div>
            </div>
        </form> --}}
        <!-- / search form -->

        <!-- nabar right -->
        <ul class="nav navbar-nav navbar-right">
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item">
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                </li>
            @else
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle clear" data-toggle="dropdown">
                        <span class="thumb-sm avatar pull-right m-t-n-sm m-b-n-sm m-l-sm">
                            <img src="{{ asset('uploads') }}/{{ Auth::user()->image }}" alt="...">
                            <i class="on md b-white bottom"></i>
                        </span>
                        <span class="hidden-sm hidden-md">{{ Auth::user()->name }}</span> <b class="caret"></b>
                    </a>
                    <!-- dropdown -->
                    <ul class="dropdown-menu animated fadeInRight w">
                        <li>
                            {{-- <a ui-sref="access.signin">Logout</a> --}}
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                    <!-- / dropdown -->
                </li>
            @endguest
        </ul>
        <!-- / navbar right -->
    </div>
    <!-- / navbar collapse -->
</header>
