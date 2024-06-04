<nav id="navbar-white" class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <span><a class="navbar-brand" href="/">
                <img src="{{ secure_asset('images/logo1.png') }}">
            </a></span>
        <button href="#menu-toggle" class="slidebar-toggle" id="menu-toggle">
            <span class="sr-only">Toggle sidebar</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <div class="navbar-collapse collapse">

        <div class="container-fluid">

            <div class="col-sm-3 col-md-3" id="divSearch">
                <form action="{{ secure_url('search') }}" class="navbar-form" role="search" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="{{ trans('common.filter_lbl_search') }}" id="qrySearch" name="query" value="{{ old('',request()->get('query')) }}">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <ul class="nav navbar-nav navbar-right">
                @if(in_array(auth()->user()->group_id,[2,3,4]))
                    <?php
                        $note_count = \app\Library\AppHelper::getNoteCount();
                    ?>
                    <li class="dropdown dropdown-notifications">
                        <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                            <i data-count="{{ $note_count }}" class="glyphicon glyphicon-bell notification-icon"></i>
                        </a>

                        <div class="dropdown-container">
                            <div class="dropdown-toolbar">
                                <div class="dropdown-toolbar-actions">
                                    <a href="{{ secure_url('notifications/mark-all-as-read') }}" style="text-decoration: none">{{ trans('common.mark_all_as_read') }}</a>
                                </div>
                                <div class="dropdown-toolbar-t itle">{{ trans('common.notifications') }} (<span class="notif-count">{{ $note_count }}</span>)</div>
                            </div>
                            <ul class="dropdown-menu">
                                {!! \app\Library\AppHelper::renderNotification() !!}
                            </ul>
                            <div class="dropdown-footer text-center">
                                <a href="{{ secure_url('notifications') }}">{{ trans('common.view_all') }}</a>
                            </div>
                        </div>
                    </li>
                @endif
                    @php
                        $iso = (\App::getLocale() === 'fr') ? 'Fr' : 'En';
                    @endphp

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ strtoupper($iso) }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('lang.switch', (\App::getLocale() === 'fr') ? 'en' : 'fr') }}">
                                    {{ (\App::getLocale() === 'fr') ? 'English' : 'Français' }}
                                </a>
                            </li>

                            @if(in_array(auth()->user()->group_id,[1,2]))
                                <li>
                                    <a href="{{ url('translation') }}">
                                        <i class="fa fa-language"></i>&nbsp;{{ trans('translation.manage_translations') }}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ ucfirst(auth()->user()->username) }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ secure_url('profile') }}"><i class="glyphicon glyphicon-user"></i> Profile</a></li>
                       @if(\Session::has('impersonated') && \Session::get('impersonated') == 'true')
                        <li><a href="{{ secure_url('end/impersonate/'.\app\Library\SecurityHelper::simpleEncDec('ec',auth()->user()->id)) }}"><i class="fa fa-exclamation-triangle"></i>&nbsp;{{ trans('common.lbl_stop_imper') }}</a></li>
                        @endif
                        <li><a  href="{{ secure_url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i> {{ trans('common.lbl_logout') }}</a></li>
                        <form id="logout-form" action="{{ secure_url('logout') }}" method="POST"
                              style="display: none;">{{ csrf_field() }}</form>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>